<?php

namespace ESERV\MAIN\WizardBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WzPage
 */
class WzPage
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $pageNo;

    /**
     * @var string
     */
    private $fieldOne;

    /**
     * @var string
     */
    private $fieldTwo;

    /**
     * @var string
     */
    private $fieldThree;

    /**
     * @var string
     */
    private $fieldFour;

    /**
     * @var string
     */
    private $fieldFive;

    /**
     * @var string
     */
    private $fieldSix;

    /**
     * @var string
     */
    private $fieldSeven;

    /**
     * @var string
     */
    private $fieldEight;

    /**
     * @var string
     */
    private $fieldNine;

    /**
     * @var string
     */
    private $fieldTen;

    /**
     * @var string
     */
    private $fieldEleven;

    /**
     * @var string
     */
    private $fieldTwelve;

    /**
     * @var string
     */
    private $fieldThirteen;

    /**
     * @var string
     */
    private $fieldFourteen;

    /**
     * @var string
     */
    private $fieldFifteen;

    /**
     * @var string
     */
    private $fieldSixteen;

    /**
     * @var string
     */
    private $fieldSeventeen;

    /**
     * @var string
     */
    private $fieldEighteen;

    /**
     * @var string
     */
    private $fieldNineteen;

    /**
     * @var string
     */
    private $fieldTwenty;

    /**
     * @var string
     */
    private $fieldTwentyOne;

    /**
     * @var string
     */
    private $fieldTwentyTwo;

    /**
     * @var string
     */
    private $fieldTwentyThree;

    /**
     * @var string
     */
    private $fieldTwentyFour;

    /**
     * @var string
     */
    private $fieldTwentyFive;

    /**
     * @var string
     */
    private $fieldTwentySix;

    /**
     * @var string
     */
    private $fieldTwentySeven;

    /**
     * @var string
     */
    private $fieldTwentyEight;

    /**
     * @var string
     */
    private $fieldTwentyNine;

    /**
     * @var string
     */
    private $fieldThirty;

    /**
     * @var string
     */
    private $fieldLongtextOne;

    /**
     * @var string
     */
    private $fieldLongtextTwo;

    /**
     * @var string
     */
    private $fieldLongtextThree;

    /**
     * @var string
     */
    private $fieldLongtextFour;

    /**
     * @var string
     */
    private $fieldLongtextFive;

    /**
     * @var \DateTime
     */
    private $fieldDateOne;

    /**
     * @var \DateTime
     */
    private $fieldDateTwo;

    /**
     * @var \DateTime
     */
    private $fieldDateThree;

    /**
     * @var \DateTime
     */
    private $fieldDateFour;

    /**
     * @var \DateTime
     */
    private $fieldDateFive;

    /**
     * @var boolean
     */
    private $fieldBooleanOne;

    /**
     * @var string
     */
    private $fieldBooleanTwo;

    /**
     * @var string
     */
    private $fieldBooleanThree;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var integer
     */
    private $createdBy;

    /**
     * @var integer
     */
    private $updatedBy;

    /**
     * @var string
     */
    private $completed;

    /**
     * @var \ESERV\MAIN\WizardBundle\Entity\WzControl
     */
    private $wzControl;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set pageNo
     *
     * @param integer $pageNo
     * @return WzPage
     */
    public function setPageNo($pageNo)
    {
        $this->pageNo = $pageNo;

        return $this;
    }

    /**
     * Get pageNo
     *
     * @return integer 
     */
    public function getPageNo()
    {
        return $this->pageNo;
    }

    /**
     * Set fieldOne
     *
     * @param string $fieldOne
     * @return WzPage
     */
    public function setFieldOne($fieldOne)
    {
        $this->fieldOne = $fieldOne;

        return $this;
    }

    /**
     * Get fieldOne
     *
     * @return string 
     */
    public function getFieldOne()
    {
        return $this->fieldOne;
    }

    /**
     * Set fieldTwo
     *
     * @param string $fieldTwo
     * @return WzPage
     */
    public function setFieldTwo($fieldTwo)
    {
        $this->fieldTwo = $fieldTwo;

        return $this;
    }

    /**
     * Get fieldTwo
     *
     * @return string 
     */
    public function getFieldTwo()
    {
        return $this->fieldTwo;
    }

    /**
     * Set fieldThree
     *
     * @param string $fieldThree
     * @return WzPage
     */
    public function setFieldThree($fieldThree)
    {
        $this->fieldThree = $fieldThree;

        return $this;
    }

    /**
     * Get fieldThree
     *
     * @return string 
     */
    public function getFieldThree()
    {
        return $this->fieldThree;
    }

    /**
     * Set fieldFour
     *
     * @param string $fieldFour
     * @return WzPage
     */
    public function setFieldFour($fieldFour)
    {
        $this->fieldFour = $fieldFour;

        return $this;
    }

    /**
     * Get fieldFour
     *
     * @return string 
     */
    public function getFieldFour()
    {
        return $this->fieldFour;
    }

    /**
     * Set fieldFive
     *
     * @param string $fieldFive
     * @return WzPage
     */
    public function setFieldFive($fieldFive)
    {
        $this->fieldFive = $fieldFive;

        return $this;
    }

    /**
     * Get fieldFive
     *
     * @return string 
     */
    public function getFieldFive()
    {
        return $this->fieldFive;
    }

    /**
     * Set fieldSix
     *
     * @param string $fieldSix
     * @return WzPage
     */
    public function setFieldSix($fieldSix)
    {
        $this->fieldSix = $fieldSix;

        return $this;
    }

    /**
     * Get fieldSix
     *
     * @return string 
     */
    public function getFieldSix()
    {
        return $this->fieldSix;
    }

    /**
     * Set fieldSeven
     *
     * @param string $fieldSeven
     * @return WzPage
     */
    public function setFieldSeven($fieldSeven)
    {
        $this->fieldSeven = $fieldSeven;

        return $this;
    }

    /**
     * Get fieldSeven
     *
     * @return string 
     */
    public function getFieldSeven()
    {
        return $this->fieldSeven;
    }

    /**
     * Set fieldEight
     *
     * @param string $fieldEight
     * @return WzPage
     */
    public function setFieldEight($fieldEight)
    {
        $this->fieldEight = $fieldEight;

        return $this;
    }

    /**
     * Get fieldEight
     *
     * @return string 
     */
    public function getFieldEight()
    {
        return $this->fieldEight;
    }

    /**
     * Set fieldNine
     *
     * @param string $fieldNine
     * @return WzPage
     */
    public function setFieldNine($fieldNine)
    {
        $this->fieldNine = $fieldNine;

        return $this;
    }

    /**
     * Get fieldNine
     *
     * @return string 
     */
    public function getFieldNine()
    {
        return $this->fieldNine;
    }

    /**
     * Set fieldTen
     *
     * @param string $fieldTen
     * @return WzPage
     */
    public function setFieldTen($fieldTen)
    {
        $this->fieldTen = $fieldTen;

        return $this;
    }

    /**
     * Get fieldTen
     *
     * @return string 
     */
    public function getFieldTen()
    {
        return $this->fieldTen;
    }

    /**
     * Set fieldEleven
     *
     * @param string $fieldEleven
     * @return WzPage
     */
    public function setFieldEleven($fieldEleven)
    {
        $this->fieldEleven = $fieldEleven;

        return $this;
    }

    /**
     * Get fieldEleven
     *
     * @return string 
     */
    public function getFieldEleven()
    {
        return $this->fieldEleven;
    }

    /**
     * Set fieldTwelve
     *
     * @param string $fieldTwelve
     * @return WzPage
     */
    public function setFieldTwelve($fieldTwelve)
    {
        $this->fieldTwelve = $fieldTwelve;

        return $this;
    }

    /**
     * Get fieldTwelve
     *
     * @return string 
     */
    public function getFieldTwelve()
    {
        return $this->fieldTwelve;
    }

    /**
     * Set fieldThirteen
     *
     * @param string $fieldThirteen
     * @return WzPage
     */
    public function setFieldThirteen($fieldThirteen)
    {
        $this->fieldThirteen = $fieldThirteen;

        return $this;
    }

    /**
     * Get fieldThirteen
     *
     * @return string 
     */
    public function getFieldThirteen()
    {
        return $this->fieldThirteen;
    }

    /**
     * Set fieldFourteen
     *
     * @param string $fieldFourteen
     * @return WzPage
     */
    public function setFieldFourteen($fieldFourteen)
    {
        $this->fieldFourteen = $fieldFourteen;

        return $this;
    }

    /**
     * Get fieldFourteen
     *
     * @return string 
     */
    public function getFieldFourteen()
    {
        return $this->fieldFourteen;
    }

    /**
     * Set fieldFifteen
     *
     * @param string $fieldFifteen
     * @return WzPage
     */
    public function setFieldFifteen($fieldFifteen)
    {
        $this->fieldFifteen = $fieldFifteen;

        return $this;
    }

    /**
     * Get fieldFifteen
     *
     * @return string 
     */
    public function getFieldFifteen()
    {
        return $this->fieldFifteen;
    }

    /**
     * Set fieldSixteen
     *
     * @param string $fieldSixteen
     * @return WzPage
     */
    public function setFieldSixteen($fieldSixteen)
    {
        $this->fieldSixteen = $fieldSixteen;

        return $this;
    }

    /**
     * Get fieldSixteen
     *
     * @return string 
     */
    public function getFieldSixteen()
    {
        return $this->fieldSixteen;
    }

    /**
     * Set fieldSeventeen
     *
     * @param string $fieldSeventeen
     * @return WzPage
     */
    public function setFieldSeventeen($fieldSeventeen)
    {
        $this->fieldSeventeen = $fieldSeventeen;

        return $this;
    }

    /**
     * Get fieldSeventeen
     *
     * @return string 
     */
    public function getFieldSeventeen()
    {
        return $this->fieldSeventeen;
    }

    /**
     * Set fieldEighteen
     *
     * @param string $fieldEighteen
     * @return WzPage
     */
    public function setFieldEighteen($fieldEighteen)
    {
        $this->fieldEighteen = $fieldEighteen;

        return $this;
    }

    /**
     * Get fieldEighteen
     *
     * @return string 
     */
    public function getFieldEighteen()
    {
        return $this->fieldEighteen;
    }

    /**
     * Set fieldNineteen
     *
     * @param string $fieldNineteen
     * @return WzPage
     */
    public function setFieldNineteen($fieldNineteen)
    {
        $this->fieldNineteen = $fieldNineteen;

        return $this;
    }

    /**
     * Get fieldNineteen
     *
     * @return string 
     */
    public function getFieldNineteen()
    {
        return $this->fieldNineteen;
    }

    /**
     * Set fieldTwenty
     *
     * @param string $fieldTwenty
     * @return WzPage
     */
    public function setFieldTwenty($fieldTwenty)
    {
        $this->fieldTwenty = $fieldTwenty;

        return $this;
    }

    /**
     * Get fieldTwenty
     *
     * @return string 
     */
    public function getFieldTwenty()
    {
        return $this->fieldTwenty;
    }

    /**
     * Set fieldTwentyOne
     *
     * @param string $fieldTwentyOne
     * @return WzPage
     */
    public function setFieldTwentyOne($fieldTwentyOne)
    {
        $this->fieldTwentyOne = $fieldTwentyOne;

        return $this;
    }

    /**
     * Get fieldTwentyOne
     *
     * @return string 
     */
    public function getFieldTwentyOne()
    {
        return $this->fieldTwentyOne;
    }

    /**
     * Set fieldTwentyTwo
     *
     * @param string $fieldTwentyTwo
     * @return WzPage
     */
    public function setFieldTwentyTwo($fieldTwentyTwo)
    {
        $this->fieldTwentyTwo = $fieldTwentyTwo;

        return $this;
    }

    /**
     * Get fieldTwentyTwo
     *
     * @return string 
     */
    public function getFieldTwentyTwo()
    {
        return $this->fieldTwentyTwo;
    }

    /**
     * Set fieldTwentyThree
     *
     * @param string $fieldTwentyThree
     * @return WzPage
     */
    public function setFieldTwentyThree($fieldTwentyThree)
    {
        $this->fieldTwentyThree = $fieldTwentyThree;

        return $this;
    }

    /**
     * Get fieldTwentyThree
     *
     * @return string 
     */
    public function getFieldTwentyThree()
    {
        return $this->fieldTwentyThree;
    }

    /**
     * Set fieldTwentyFour
     *
     * @param string $fieldTwentyFour
     * @return WzPage
     */
    public function setFieldTwentyFour($fieldTwentyFour)
    {
        $this->fieldTwentyFour = $fieldTwentyFour;

        return $this;
    }

    /**
     * Get fieldTwentyFour
     *
     * @return string 
     */
    public function getFieldTwentyFour()
    {
        return $this->fieldTwentyFour;
    }

    /**
     * Set fieldTwentyFive
     *
     * @param string $fieldTwentyFive
     * @return WzPage
     */
    public function setFieldTwentyFive($fieldTwentyFive)
    {
        $this->fieldTwentyFive = $fieldTwentyFive;

        return $this;
    }

    /**
     * Get fieldTwentyFive
     *
     * @return string 
     */
    public function getFieldTwentyFive()
    {
        return $this->fieldTwentyFive;
    }

    /**
     * Set fieldTwentySix
     *
     * @param string $fieldTwentySix
     * @return WzPage
     */
    public function setFieldTwentySix($fieldTwentySix)
    {
        $this->fieldTwentySix = $fieldTwentySix;

        return $this;
    }

    /**
     * Get fieldTwentySix
     *
     * @return string 
     */
    public function getFieldTwentySix()
    {
        return $this->fieldTwentySix;
    }

    /**
     * Set fieldTwentySeven
     *
     * @param string $fieldTwentySeven
     * @return WzPage
     */
    public function setFieldTwentySeven($fieldTwentySeven)
    {
        $this->fieldTwentySeven = $fieldTwentySeven;

        return $this;
    }

    /**
     * Get fieldTwentySeven
     *
     * @return string 
     */
    public function getFieldTwentySeven()
    {
        return $this->fieldTwentySeven;
    }

    /**
     * Set fieldTwentyEight
     *
     * @param string $fieldTwentyEight
     * @return WzPage
     */
    public function setFieldTwentyEight($fieldTwentyEight)
    {
        $this->fieldTwentyEight = $fieldTwentyEight;

        return $this;
    }

    /**
     * Get fieldTwentyEight
     *
     * @return string 
     */
    public function getFieldTwentyEight()
    {
        return $this->fieldTwentyEight;
    }

    /**
     * Set fieldTwentyNine
     *
     * @param string $fieldTwentyNine
     * @return WzPage
     */
    public function setFieldTwentyNine($fieldTwentyNine)
    {
        $this->fieldTwentyNine = $fieldTwentyNine;

        return $this;
    }

    /**
     * Get fieldTwentyNine
     *
     * @return string 
     */
    public function getFieldTwentyNine()
    {
        return $this->fieldTwentyNine;
    }

    /**
     * Set fieldThirty
     *
     * @param string $fieldThirty
     * @return WzPage
     */
    public function setFieldThirty($fieldThirty)
    {
        $this->fieldThirty = $fieldThirty;

        return $this;
    }

    /**
     * Get fieldThirty
     *
     * @return string 
     */
    public function getFieldThirty()
    {
        return $this->fieldThirty;
    }

    /**
     * Set fieldLongtextOne
     *
     * @param string $fieldLongtextOne
     * @return WzPage
     */
    public function setFieldLongtextOne($fieldLongtextOne)
    {
        $this->fieldLongtextOne = $fieldLongtextOne;

        return $this;
    }

    /**
     * Get fieldLongtextOne
     *
     * @return string 
     */
    public function getFieldLongtextOne()
    {
        return $this->fieldLongtextOne;
    }

    /**
     * Set fieldLongtextTwo
     *
     * @param string $fieldLongtextTwo
     * @return WzPage
     */
    public function setFieldLongtextTwo($fieldLongtextTwo)
    {
        $this->fieldLongtextTwo = $fieldLongtextTwo;

        return $this;
    }

    /**
     * Get fieldLongtextTwo
     *
     * @return string 
     */
    public function getFieldLongtextTwo()
    {
        return $this->fieldLongtextTwo;
    }

    /**
     * Set fieldLongtextThree
     *
     * @param string $fieldLongtextThree
     * @return WzPage
     */
    public function setFieldLongtextThree($fieldLongtextThree)
    {
        $this->fieldLongtextThree = $fieldLongtextThree;

        return $this;
    }

    /**
     * Get fieldLongtextThree
     *
     * @return string 
     */
    public function getFieldLongtextThree()
    {
        return $this->fieldLongtextThree;
    }

    /**
     * Set fieldLongtextFour
     *
     * @param string $fieldLongtextFour
     * @return WzPage
     */
    public function setFieldLongtextFour($fieldLongtextFour)
    {
        $this->fieldLongtextFour = $fieldLongtextFour;

        return $this;
    }

    /**
     * Get fieldLongtextFour
     *
     * @return string 
     */
    public function getFieldLongtextFour()
    {
        return $this->fieldLongtextFour;
    }

    /**
     * Set fieldLongtextFive
     *
     * @param string $fieldLongtextFive
     * @return WzPage
     */
    public function setFieldLongtextFive($fieldLongtextFive)
    {
        $this->fieldLongtextFive = $fieldLongtextFive;

        return $this;
    }

    /**
     * Get fieldLongtextFive
     *
     * @return string 
     */
    public function getFieldLongtextFive()
    {
        return $this->fieldLongtextFive;
    }

    /**
     * Set fieldDateOne
     *
     * @param \DateTime $fieldDateOne
     * @return WzPage
     */
    public function setFieldDateOne($fieldDateOne)
    {
        $this->fieldDateOne = $fieldDateOne;

        return $this;
    }

    /**
     * Get fieldDateOne
     *
     * @return \DateTime 
     */
    public function getFieldDateOne()
    {
        return $this->fieldDateOne;
    }

    /**
     * Set fieldDateTwo
     *
     * @param \DateTime $fieldDateTwo
     * @return WzPage
     */
    public function setFieldDateTwo($fieldDateTwo)
    {
        $this->fieldDateTwo = $fieldDateTwo;

        return $this;
    }

    /**
     * Get fieldDateTwo
     *
     * @return \DateTime 
     */
    public function getFieldDateTwo()
    {
        return $this->fieldDateTwo;
    }

    /**
     * Set fieldDateThree
     *
     * @param \DateTime $fieldDateThree
     * @return WzPage
     */
    public function setFieldDateThree($fieldDateThree)
    {
        $this->fieldDateThree = $fieldDateThree;

        return $this;
    }

    /**
     * Get fieldDateThree
     *
     * @return \DateTime 
     */
    public function getFieldDateThree()
    {
        return $this->fieldDateThree;
    }

    /**
     * Set fieldDateFour
     *
     * @param \DateTime $fieldDateFour
     * @return WzPage
     */
    public function setFieldDateFour($fieldDateFour)
    {
        $this->fieldDateFour = $fieldDateFour;

        return $this;
    }

    /**
     * Get fieldDateFour
     *
     * @return \DateTime 
     */
    public function getFieldDateFour()
    {
        return $this->fieldDateFour;
    }

    /**
     * Set fieldDateFive
     *
     * @param \DateTime $fieldDateFive
     * @return WzPage
     */
    public function setFieldDateFive($fieldDateFive)
    {
        $this->fieldDateFive = $fieldDateFive;

        return $this;
    }

    /**
     * Get fieldDateFive
     *
     * @return \DateTime 
     */
    public function getFieldDateFive()
    {
        return $this->fieldDateFive;
    }

    /**
     * Set fieldBooleanOne
     *
     * @param boolean $fieldBooleanOne
     * @return WzPage
     */
    public function setFieldBooleanOne($fieldBooleanOne)
    {
        $this->fieldBooleanOne = $fieldBooleanOne;

        return $this;
    }

    /**
     * Get fieldBooleanOne
     *
     * @return boolean 
     */
    public function getFieldBooleanOne()
    {
        return $this->fieldBooleanOne;
    }

    /**
     * Set fieldBooleanTwo
     *
     * @param string $fieldBooleanTwo
     * @return WzPage
     */
    public function setFieldBooleanTwo($fieldBooleanTwo)
    {
        $this->fieldBooleanTwo = $fieldBooleanTwo;

        return $this;
    }

    /**
     * Get fieldBooleanTwo
     *
     * @return string 
     */
    public function getFieldBooleanTwo()
    {
        return $this->fieldBooleanTwo;
    }

    /**
     * Set fieldBooleanThree
     *
     * @param string $fieldBooleanThree
     * @return WzPage
     */
    public function setFieldBooleanThree($fieldBooleanThree)
    {
        $this->fieldBooleanThree = $fieldBooleanThree;

        return $this;
    }

    /**
     * Get fieldBooleanThree
     *
     * @return string 
     */
    public function getFieldBooleanThree()
    {
        return $this->fieldBooleanThree;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return WzPage
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return WzPage
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set createdBy
     *
     * @param integer $createdBy
     * @return WzPage
     */
    public function setCreatedBy($createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return integer 
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Set updatedBy
     *
     * @param integer $updatedBy
     * @return WzPage
     */
    public function setUpdatedBy($updatedBy)
    {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * Get updatedBy
     *
     * @return integer 
     */
    public function getUpdatedBy()
    {
        return $this->updatedBy;
    }

    /**
     * Set completed
     *
     * @param string $completed
     * @return WzPage
     */
    public function setCompleted($completed)
    {
        $this->completed = $completed;

        return $this;
    }

    /**
     * Get completed
     *
     * @return string 
     */
    public function getCompleted()
    {
        return $this->completed;
    }

    /**
     * Set wzControl
     *
     * @param \ESERV\MAIN\WizardBundle\Entity\WzControl $wzControl
     * @return WzPage
     */
    public function setWzControl(\ESERV\MAIN\WizardBundle\Entity\WzControl $wzControl = null)
    {
        $this->wzControl = $wzControl;

        return $this;
    }

    /**
     * Get wzControl
     *
     * @return \ESERV\MAIN\WizardBundle\Entity\WzControl 
     */
    public function getWzControl()
    {
        return $this->wzControl;
    }
    
    /**
     * Set id
     *
     * @param integer $id
     * @return WzPage
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
