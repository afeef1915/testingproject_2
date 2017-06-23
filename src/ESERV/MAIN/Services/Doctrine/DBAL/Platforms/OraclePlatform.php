<?php

namespace ESERV\MAIN\Services\Doctrine\DBAL\Platforms;

use Doctrine\DBAL\Platforms\OraclePlatform as DoctrineOraclePlatform;
use Symfony\Component\DependencyInjection\Container;
use Doctrine\DBAL\Schema\TableDiff;

class OraclePlatform extends DoctrineOraclePlatform
{

    public $c;
    public $clientDateFormat;

    public function __construct(Container $c)
    {
        $this->c = $c;
        $this->clientDateFormat = $this->c->hasParameter('client_date_format') ? $this->c->getParameter('client_date_format') : array();
    }

    public function getDateTimeFormatString()
    {
        return isset($this->clientDateFormat['date_time']['php']) ? $this->clientDateFormat['date_time']['php'] : 'Y-m-d H:i:s';
    }

    public function getDateTimeTzFormatString()
    {
        return isset($this->clientDateFormat['date_time']['php']) ? $this->clientDateFormat['date_time']['php'] : 'Y-m-d H:i:s';
    }

    public function getDateFormatString()
    {
        return isset($this->clientDateFormat['date']['php']) ? $this->clientDateFormat['date']['php'] : 'Y-m-d';
    }

    public function getTimeFormatString()
    {
        return isset($this->clientDateFormat['time']['php']) ? $this->clientDateFormat['time']['php'] : 'H:i:s';
    }

    protected function doModifyLimitQuery($query, $limit, $offset = null)
    {
        $limit = (int) $limit;
        $offset = (int) $offset;
        $extra_sort_sql = "";

        if (preg_match('/^\s*SELECT/i', $query)) {
            if (!preg_match('/\sFROM\s/i', $query)) {
                $query .= " FROM dual";
            }
            if ($limit > 0) {
                $query = "SELECT * FROM (SELECT a.*, rownum AS doctrine_rownum FROM ($query) a )";
                $max = $offset + $limit;
                if ($offset > 0) {
                    $min = $offset + 1;
                    $query .= " WHERE doctrine_rownum between $min  AND $max ";
                } else {
                    $query .= " WHERE doctrine_rownum <= $max ";
                }
            }
        }

        return $query;
    }

    public function getDateAddHourExpression($date, $hours)
    {
        return '(' . $date . '+' . $hours . '/24)';
    }

    /**
     * {@inheritDoc}
     */
    public function getDateSubHourExpression($date, $hours)
    {
        return '(' . $date . '-' . $hours . '/24)';
    }

    /**
     * {@inheritDoc}
     */
    public function getDateAddDaysExpression($date, $days)
    {
        return '(' . $date . '+' . $days . ')';
    }

    /**
     * {@inheritDoc}
     */
    public function getDateSubDaysExpression($date, $days)
    {
        return '(' . $date . '-' . $days . ')';
    }

    /**
     * {@inheritDoc}
     */
    public function getDateAddMonthExpression($date, $months)
    {
        return "ADD_MONTHS(" . $date . ", " . $months . ")";
    }

    /**
     * {@inheritDoc}
     */
    public function getDateSubMonthExpression($date, $months)
    {
        return "ADD_MONTHS(" . $date . ", -" . $months . ")";
    }

    public function getCreateAutoincrementSql($name, $table, $start = 1)
    {
        $table = strtoupper($table);
        $name = strtoupper($name);

        $sql = array();

        $indexName = $table . '_AI_PK';

        $idx = new Index($indexName, array($name), true, true);

        $sql[] = 'DECLARE
  constraints_Count NUMBER;
BEGIN
  SELECT COUNT(CONSTRAINT_NAME) INTO constraints_Count FROM USER_CONSTRAINTS WHERE TABLE_NAME = \'' . $table . '\' AND CONSTRAINT_TYPE = \'P\';
  IF constraints_Count = 0 OR constraints_Count = \'\' THEN
    EXECUTE IMMEDIATE \'' . $this->getCreateConstraintSQL($idx, $table) . '\';
  END IF;
END;';


        $sequenceName = $this->getIdentitySequenceName($table, $name);
        $sequence = new Sequence($sequenceName, $start);
        $sql[] = $this->getCreateSequenceSQL($sequence);

        $triggerName = $table . '_AI_PK';
        $sql[] = 'CREATE TRIGGER ' . $triggerName . '
   BEFORE INSERT
   ON ' . $table . '
   FOR EACH ROW
DECLARE
   last_Sequence NUMBER;
   last_InsertID NUMBER;
   seq_Name  CLOB;
BEGIN
   SELECT to_lob(data_default) INTO seq_name FROM user_tab_columns WHERE table_name = \'' . $table . '\' And identity_column = \'YES\';
   SELECT ' . $sequenceName . '.NEXTVAL INTO :NEW.' . $name . ' FROM DUAL;
   IF (:NEW.' . $name . ' IS NULL OR :NEW.' . $name . ' = 0) THEN
      SELECT ' . $sequenceName . '.NEXTVAL INTO :NEW.' . $name . ' FROM DUAL;
   ELSE
      SELECT NVL(Last_Number, 0) INTO last_Sequence
        FROM User_Sequences
       WHERE Sequence_Name = \'' . $sequenceName . '\';
      SELECT :NEW.' . $name . ' INTO last_InsertID FROM DUAL;
      WHILE (last_InsertID > last_Sequence) LOOP
         SELECT ' . $sequenceName . '.NEXTVAL INTO last_Sequence FROM DUAL;
      END LOOP;
   END IF;
END;';

        return $sql;
    }

    public function getListTableForeignKeysSQL($table)
    {
        $table = strtoupper($table);

        return "SELECT alc.constraint_name,
          alc.DELETE_RULE,
          alc.search_condition,
          cols.column_name \"local_column\",
          cols.position,
          r_alc.table_name \"references_table\",
          r_cols.column_name \"foreign_column\"
     FROM user_cons_columns cols
LEFT JOIN user_constraints alc
       ON alc.constraint_name = cols.constraint_name
LEFT JOIN user_constraints r_alc
       ON alc.r_constraint_name = r_alc.constraint_name
LEFT JOIN user_cons_columns r_cols
       ON r_alc.constraint_name = r_cols.constraint_name
      AND cols.position = r_cols.position
    WHERE alc.constraint_name = cols.constraint_name
      AND alc.constraint_type = 'R'
      AND alc.table_name = '" . $table . "'";
    }
    
    public function getListTableColumnsSQL($table, $database = null)
    {
        $table = strtoupper($table);

        $tabColumnsTableName = "user_tab_columns";
        $colCommentsTableName = "user_col_comments";
        $ownerCondition = '';

        if (null !== $database) {
            $database = strtoupper($database);
            $tabColumnsTableName = "all_tab_columns";
            $colCommentsTableName = "all_col_comments";
            $ownerCondition = "AND c.owner = '".$database."'";
        }

        return "SELECT c.*, d.comments FROM $tabColumnsTableName c ".
               "INNER JOIN " . $colCommentsTableName . " d ON d.TABLE_NAME = c.TABLE_NAME AND d.COLUMN_NAME = c.COLUMN_NAME ".
               "WHERE c.table_name = '" . $table . "' ".$ownerCondition." ORDER BY c.column_name";
    }
    
    public function getAlterTableSQL(TableDiff $diff)
    {  
        $sql = array();
        $commentsSQL = array();
        $columnSql = array();

        $fields = array();

        foreach ($diff->addedColumns as $column) {
            if ($this->onSchemaAlterTableAddColumn($column, $diff, $columnSql)) {
                continue;
            }

            $fields[] = $this->getColumnDeclarationSQL($column->getQuotedName($this), $column->toArray());
            if ($comment = $this->getColumnComment($column)) {
                $commentsSQL[] = $this->getCommentOnColumnSQL($diff->name, $column->getName(), $comment);
            }
        }

        if (count($fields)) {
            $sql[] = 'ALTER TABLE ' . $diff->getName()->getQuotedName($this) . ' ADD (' . implode(', ', $fields) . ')';
        }

        $fields = array();
        foreach ($diff->changedColumns as $columnDiff) {
            if ($this->onSchemaAlterTableChangeColumn($columnDiff, $diff, $columnSql)) {
                continue;
            }

            $column = $columnDiff->column;
            $columnHasChangedComment = $columnDiff->hasChanged('comment');

            /**
             * Do not add query part if only comment has changed
             */
            if ( ! ($columnHasChangedComment && count($columnDiff->changedProperties) === 1)) {
                $columnInfo = $column->toArray();

                if ( ! $columnDiff->hasChanged('notnull')) {
                    $columnInfo['notnull'] = false;
                }

                $fields[] = $column->getQuotedName($this) . ' ' . $this->getColumnDeclarationSQL('', $columnInfo);
            }

            if ($columnHasChangedComment) {
                $commentsSQL[] = $this->getCommentOnColumnSQL(
                    $diff->name,
                    $column->getName(),
                    $this->getColumnComment($column)
                );
            }
        }

        if (count($fields)) {
            $sql[] = 'ALTER TABLE ' . $diff->getName()->getQuotedName($this) . ' MODIFY (' . implode(', ', $fields) . ')';
        }

        foreach ($diff->renamedColumns as $oldColumnName => $column) {
            if ($this->onSchemaAlterTableRenameColumn($oldColumnName, $column, $diff, $columnSql)) {
                continue;
            }

            $sql[] = 'ALTER TABLE ' . $diff->getName()->getQuotedName($this) . ' RENAME COLUMN ' . $oldColumnName .' TO ' . $column->getQuotedName($this);
        }

        $fields = array();
        foreach ($diff->removedColumns as $column) {
            if ($this->onSchemaAlterTableRemoveColumn($column, $diff, $columnSql)) {
                continue;
            }

            $fields[] = $column->getQuotedName($this);
        }

        if (count($fields)) {
            $sql[] = 'ALTER TABLE ' . $diff->getName()->getQuotedName($this) . ' DROP (' . implode(', ', $fields).')';
        }

        $tableSql = array();

        if ( ! $this->onSchemaAlterTable($diff, $tableSql)) {
            if ($diff->newName !== false) {
                $sql[] = 'ALTER TABLE ' . $diff->getName()->getQuotedName($this) . ' RENAME TO ' . $diff->getNewName()->getQuotedName($this);
            }

            $sql = array_merge($sql, $this->_getAlterTableIndexForeignKeySQL($diff), $commentsSQL);
        }

        return array_merge($sql, $tableSql, $columnSql);
    }
    
    public function getIdentitySequenceName($tableName, $columnName)
    {
        return $tableName;
    }

}
