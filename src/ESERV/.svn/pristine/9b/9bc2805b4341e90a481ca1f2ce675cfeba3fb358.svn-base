<?php

namespace ESERV\MAIN\Services;

class AppConstants {

    const ARRAY_KEY_CODE = 'mtl_2360579730a81d83adb4047f5d3fe21b';
    
    const TEMPLATE_TYPE_LETTER_CODE = 'L';
    const TEMPLATE_TYPE_EMAIL_CODE = 'E';
    const TEMPLATE_TYPE_HEADER_CODE = 'H';
    const TEMPLATE_TYPE_FOOTER_CODE = 'F';    
    
    // Mailmerge fields open and close tags
    const MAIL_MERGE_FIELD_OPEN = '{';
    const MAIL_MERGE_FIELD_CLOSE = '}';
    const MAIL_MERGE_DATE_FORMAT = 'd-M-Y';

    //Start of Global Validation regular expressions 
        const NUMBER_REG_EXP = '/^\d+$/';
        const NUMBER_REG_EXP_ERROR = 'Invalid Number.';
        //const NI_NUMBER_REG_EXP = '/^[A-CEGHJ-PR-TW-Z]{1}[A-CEGHJ-NPR-TW-Z]{1}[0-9]{6}[A-D]{1}$/';
        const NI_NUMBER_REG_EXP = '/^[\s_-]*[a-ceghj-pr-tw-zA-CEGHJ-PR-TW-Z]{1}[a-ceghj-npr-tw-zA-CEGHJ-NPR-TW-Z]{1}[\s_-]*[0-9]{2}[\s_-]*[0-9]{2}[\s_-]*[0-9]{2}[\s_-]*[a-dA-D]{1}[\s_-]*$/';
        const NI_NUMBER_REG_EXP_ERROR = 'Invalid NI Number.';
        const UK_POSTCODE_REG_EXP = '/^(GIR ?0AA|[A-PR-UWYZ]([0-9]{1,2}|([A-HK-Y][0-9]([0-9ABEHMNPRV-Y])?)|[0-9][A-HJKPS-UW]) ?[0-9][ABD-HJLNP-UW-Z]{2})$/';
        const UK_POSTCODE_REG_EXP_ERROR = 'Invalid UK Postcode.';
        const EMAIL_REG_EXP = '/\S+@\S+\.\S+/';
        const EMAIL_REG_EXP_ERROR = 'Invalid email address.';
        //const WEB_ADDRESS_REG_EXP = '/^(http[s]?:\\/\\/(www\\.)?|ftp:\\/\\/(www\\.)?|www\\.){1}([0-9A-Za-z-\\.@:%_\+~#=]+)+((\\.[a-zA-Z]{2,3})+)(/(.)*)?(\\?(.)*)?/'; //old shows Warning: preg_match(): Unknown modifier '('
        const WEB_ADDRESS_REG_EXP = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'; //new
        const WEB_ADDRESS_REG_EXP_ERROR = 'Invalid web address.';
        const MONEY_AMOUNT_REG_EXP = '/^\d+(\.\d{2})$/';
        const MONEY_AMOUNT_REG_EXP_ERROR = 'Invalid format. Must be (0.00)';
        const PROPORTION_REG_EXP = '/^[0]?[\.][123456789]{1}$/';
        const PROPORTION_REG_EXP_ERROR = 'Invalid Proportion. Must be 0.1 to 0.9';
        const DATE_IN_YY_REG_EXP = '/^(19|20)\d{2}$/';
        const DATE_IN_YY_REG_EXP_ERROR = 'Invalid format. Must be (YYYY).';
        const DATE_IN_MM_YY_REG_EXP = '/^\d{1,2}\/\d{4}$/';
        const DATE_IN_MM_YY_REG_EXP_ERROR = 'Invalid format. Must be (MM/YYYY)';

        const DATE_IN_DD_MM_YY_REG_EXP = '/^(((0[1-9]|[12]\d|3[01])\/(0[13578]|1[02])\/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|3[01])\/(0[13578]|1[02])\/((18|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\/(0[13456789]|1[012])\/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\/(0[13456789]|1[012])\/((18|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\/02\/((19|[2-9]\d)\d{2}))|(29\/02\/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$/';
        const DATE_IN_DD_MM_YY_REG_EXP_ERROR = 'Invalid format. Must be (DD/MM/YYYY)';
        
        const DATE_IN_DD_MON_YYYY_REG_EXP = '/^(([0-9])|([0-2][0-9])|([3][0-1]))\-(Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)\-\d{4}$/';
        const DATE_IN_DD_MON_YYYY_REG_EXP_ERROR = 'Invalid format. Must be (DD MON YYYY)';
        
        const ACADEMIC_YEAR_YYYY_YY = '/^\d{4}\/\d{2}$/';
        const ACADEMIC_YEAR_YYYY_YY_EXP_ERROR = 'Invalid format. Must be (YYYY/YY).';
        
        const USERNAME_REG_EXP = '/^[a-zA-Z0-9]{6,15}$/';
        const USERNAME_REG_EXP_EXP_ERROR = 'Invalid username. Must be 6 - 15 alphabets or numbers.';
        
    //End of Global Validation regular expressions

    // Start of Media Store
     const ENTITY_NAME_QUEUED_DB_PROCCESS = 'QueuedDbProcess'; 
     const ENTITY_NAME_ACTIVITY = 'Activity'; 
    // End of Media Store 
     
    // Queued DB Process Types
    const ESERV_MERGE_LETTER = 'ESERV_MERGE_LETTER';
    const ESERV_SEND_EMAIL = 'ESERV_SEND_EMAIL';
    const ESERV_IMPORT_FILES = 'ESERV_IMPORT_FILES';
    const ESERV_EXPORT_FILES = 'ESERV_EXPORT_FILES';
    const ESERV_DEREG_SELECT = 'ESERV_DEREG_SELECT';
    const ESERV_DEREG = 'ESERV_DEREG';
    const ESERV_INDUCTION_DOCS_TO_PLP = 'ESERV_IND_DOCS_TO_PLP';
    const ESERV_E_SERVICES_ALERTS = 'ESERV_E_SERVICES_ALERTS';
    const ESERV_DATA_EXTRACTS = 'ESERV_DATA_EXTRACTS';
    // Queued DB Process Types
    
    //Email constants
    const text_type = 'text/plain';
    const html_type = 'text/html';
    
    const QUERY_ENTITY_NAME = 'SearchQuery';
    
    //Start of GTCW
        //Start of Common
        const SYMFONY_DATE_FORMAT = 'dd/MM/yyyy';    
        //const DATEPICKER_DATE_FORMAT = 'DD/MM/YYYY';        
        const DATEPICKER_DATE_FORMAT = 'dd/mm/yy';
        const PHP_DATE_FORMAT = 'd/m/Y';
        const DATEPICKER_DATE_FORMAT_DD_MON_YYYY = 'yy-mm-dd';
        const DATEPICKER_ACADEMIC_YEAR_FORMAT = 'yy/y';
        const ORGANISATION_MIN_AGE = 16;
        const DATEPICKER_DATE_INPUT_PLACEHOLDER = 'DD/MM/YYYY';  
        //End of Common
        
        //Start of Application Code Types
        const ACT_PHONE_TYPE = 'PHONE';
        const ACT_EMAIL_ADDRESS_TYPE = 'EMAIL';
        const ACT_WEBSITE = 'WEBSITE';
        const ACT_QUTYPE = 'QUTYPE';
        
        
        const ACT_ETHNIC_GROUP = 'ETHNIC';
        const ACT_NATIONAL_IDENTITY = 'NATIDE';
        const ACT_EMPLOYER_TYPE = 'EMTYPE';
        
        
        const ACT_VOTING_CATEGORY = 'VCAT';
        const ACT_NATIONAL_QUALIFIED_TEACHER = 'NQT';
        const ACT_NATIONAL_QUALIFIED_TEACHER_NAME = 'Newly Qualified';
        const ACT_APPLICATION_STATUS = 'AS';
        const ACT_RESTRICTION_BARRING = 'DISCIP';
        const ACT_WORKPLACE_TYPE = 'WPTYPE';
        const ACT_DENOMINATION_TYPE = 'DEN';
        const MYMERLIN_HELP_MSG_CODE = 'MMHELPMSG';
        const ACT_INDUCTION_STATUS = 'INDST';
        const ACT_INDUCTION_STATUS_PASS = 'P';
        const ACT_INDUCTION_ROUTE = 'INDRT';
        const ACT_INDUCTION_ROUTE_SHORT_TERM = 'STS';
        const ACT_MEP_STATUS = 'MEPST';
        const ACT_EM_LANGUAGE = 'EML';
        const ACT_CONTRACT_EMPLOYMENT = 'CONEMP';
        const ACT_EXTENSION_UNIT = 'EXTUNIT';
        const ACT_INDUCTION_SEASON = 'INDSEAS';
        const ACT_FUNDING_NOT_RELEASED = 'FNR';
        const ACT_SUBJECTS_TAUGHT = 'INDSUBTAU';
        const ACT_MEP_STAGE = 'MEPSTG'; 
        const ACT_MEP_MODULE = 'MEPMOD';
        const ACT_MEP_MODULE_OUTCOME = 'MEPMODOUT';
        const ACT_INDUCTION_YEAR = 'INDYEAR';
        const ACT_EPD_EVAL_AGREED = 'EVALAGD';
        const ACT_PROF_DEV_CATEGORY = 'PDC';
        const ACT_MENTOR_STATUS = 'MENTST';
        const ACT_MENTOR_PHASE = 'MENTPH';
        const ACT_MENTOR_PAYMENT_TYPE = 'MENPYTY';
        const ACT_MENTOR_TRAVEL_CODE = 'MENTTV';    
        const ACT_EMPLOYER_TYPE_LA = 'L';
        const ACT_EMPLOYER_TYPE_AGENCY = 'A';
        const ACT_CPD_PROF_STD = 'CPDSTAN';
        const ACT_EMP_TYPE_MEP_UNIVERSITY = 'U';
        const ACT_IND_TERM_FILE_STATUS = 'INDTDST';
        const ACT_IND_PHASE = 'INDPHA';
        //End of Application Code Types
        
        //Start of Application Code
        const AC_MAIN_WEBSITE = 'MW';
        const AC_ITET_QUALIFICATION = 'I';
        const AC_DEGREE_QUALIFICATION = 'D';
        const AC_QUALIFICATION_COLLEGE = 'F';
        const AC_QUALIFICATION_SCHOOL = 'I';
        const AC_QUALIFICATION_LEARNING_SUPPORT = 'LSU';
        const AC_QUALIFICATION_YOUTH = 'YTH';
        const AC_QUALIFICATION_YOUTH_SUPPORT = 'YTHS';
        const AC_QUALIFICATION_WORK_BASED_LEARNING_PRACTITIONER = 'WBLP';        
        const AC_ORGANISATION_PHONE_NUMBER = 'O';
        const AC_PASS = 1;
        const AC_FIRST_CLASS_HONOURS = 01;
        const AC_PHONE_NUMBER = 'H';
        const AC_MOBILE_NUMBER = 'M';
        const AC_FAX_NUMBER = 'F';
        const AC_PERSONAL_EMAIL = 'PE';
        const AC_EMP_TYPE_CONSORTIUM_AREA = 'K';
        const AC_ACTIVITY_SOURCE = 'ACTSRC';
        const AC_ACTSRC_WEB_ACCESS = '12';
        const AC_ACTSRC_ONLINE_PAYMENT = '13';
        const AC_ACTSRC_LETTERS = '2';
        const AC_ACTSRC_EMAIL = '3';
        const AC_EMP_TYPE_AGENCY = 'A';
        const AC_EMP_TYPE_LA_EMP = 'L';
        const AC_EMP_TYPE_FE_EMP = 'F';        
        const AC_EMP_TYPE_WBC_EMP = 'WBC';        
        const AC_EMP_DESC_TEACHER = 'E0007';
        const AC_CPD_CPDE_CTRL_PS = 'PS';
        const AC_CPD_CPDE_CTRL_LS = 'LS';
        const AC_RESULT_ENTERED_BUT_NOT_SUBMITTED = 'E';
        const AC_RESULT_SUBMITTED = 'S';
        const AC_ROUTE_TO_QTS_ITET = 'I';
        const AC_ROUTE_TO_QTS_OTHER = 'D';
        const AC_INDSTS_FAIL_BUT_APPEAL = 'FA';
        const AC_IND_STATUS_IND_EXTENDED = 'IE';
        const AC_INDSTS_IND_EXTENDED_BUT_APPEAL = 'IA';
        const AC_INDSTS_NOT_YET_COMPLETED = 'NW';
        const AC_INDSTS_EXEMPT = 'E';
        const AC_INDSTS_EXEMPT_IN_WALES = 'EW';
        const AC_INDSTS_EXEMPT_IND_COMP_IN_GUERNSEY = 'EG';
        const AC_INDSTS_EXEMPT_IND_COMP_IN_SEC_SCH = 'ESCE';
        const AC_INDSTS_EXEMPT_IN_WALES_BUT_EXT_IN_ENG = 'EWEE';
        const AC_IND_ROUTE_GENERAL = 'GEN';
        const AC_IND_ROUTE_SHORT_TERM = 'STS';
        const AC_IND_ROUTE_GENERAL_AND_SHORT_TERM = 'GENSTS';
        const AC_MEP_STATUS_OPTED_OUT = 'OUT';
        const AC_MEP_STATUS_NOT_AVAILABLE = 'NA';
        const AC_MEP_STATUS_MISSED_DEADLINE = 'MD';
        const AC_MEP_STATUS_INELIGIBLE = 'INELIG';
        const AC_MEP_STATUS_NOT_COMPLETE_REGISTRATION = 'NCREG';
        const AC_MEP_STATUS_INTERRUPTION_OF_STUDIES = 'IOS';
        const AC_MEP_STATUS_REG_MEP_STUDENT = 'R';
        const AC_MEP_STATUS_WITHDRAWN = 'W';
        const AC_EMP_TYPE_YOUTH_ORGANISATION = 'YO';
        const AC_EMP_TYPE_WORK_BASED_CONTRACTOR = 'WBC';
        const AC_EMP_TYPE_WORK_BASED_SUB_CONTRACTOR = 'WBSC';        
        //End of Application Code
        
        //Start of Contact Type
        const CT_PERSON = 'P';
        const CT_ORGANISATION = 'O';
        //End of Application Code
        
        //Start of Contact Status
        const CS_LIVE = 'LV';
        const CS_DEFUNCT = 'DF';
        const CS_ELIGIBLE_NOT_CURRENTLY_REGISTERED = 6;
        const CS_QTS_APPLICANT = 25;
        const CS_SUITABILITY_APPLICANT = 26;
        const CS_PERSON_LIVE = 'L';
        const CS_PERSON_CANCELLED = 'C';
        const CS_PERSON_DECEASED = 'D';
        const CS_APPLICANT = 'APL';
        //End of Contact Status
        
        //Start of Contact Subtype List
        const CSL_EMPLOYER = 'EM';
        const CSL_WORKPLACE = 'WP';
        const CSL_MEMBERSHIP_ORGANISATION = 'MO';
        const CSL_INDIVIDUAL_CODE = 'IND';
        const CSL_MENTOR_CODE = 'MENT';
        const CSL_TEACHER_CODE = 'TEACH';
        const CSL_FE_LECTURER_CODE = 'FE';
        const CSL_ESTABLISHMENT_CODE = 'EST';
        const CSL_REGISTRANT_CODE = 'REG';
        //End of Contact Subtype List
        
        //Start of Language
        const LAN_WELSH_CODE = 'WEL';
        //End of Language
        
        // Start Entity Names
        const APPLICATION_CODE_ENTITY_NAME = 'application_code';
        const QUALIFICATION_ENTITY_NAME = 'qualification';
        const SUBJECT_ENTITY_NAME = 'subject';
        const MEMBER_SUBJECT_ENTITY_NAME = 'member_subject';
        const EMPLOYER_ENTITY_NAME = 'employer';
        const PERSON_ENTITY_NAME = 'person';
        const WORKPLACE_ENTITY_NAME = 'workplace';
        const ESTABLISHMENT_ENTITY_NAME = 'establishment';
        const ACTIVITY_SUB_CATEGORY_ENTITY_NAME = 'activity_sub_category';
        const TEMPLATE_ENTITY_NAME = 'template';
        const MM_HELP_MESSAGE = 'help_message';
        const QUALIFICATION_CERTIFICATE_ENTITY_NAME = 'qualification_certificate';
        const USER_ALERT = 'user_alert';
        // End Entity Names
        
        // Start of Membership Org
        const MEMBERSHIP_ORG_REG = 'TEA'; 
        const MEMBERSHIP_ORG_FE = 'FE'; 
        const MEMBERSHIP_ORG_TSW = 'TSW'; 
        const MEMBERSHIP_ORG_FSW = 'FSW'; 
        const MEMBERSHIP_ORG_YW = 'YW'; 
        const MEMBERSHIP_ORG_YSW = 'YSW'; 
        const MEMBERSHIP_ORG_WBLP = 'WBLP'; 
        // End of Membership Org
         
        // Start of Membership Status
        const MS_REGISTERED = 'Y';
        const MS_FULL_REGISTERATION = '1';
        const MS_NOT_REGISTERED = 'N';
        const MS_APPLICANT = 'APL';
        const MS_ELIGIBLE_NOT_CUR_REG = '6';
        const MS_PROVISIONAL_PR = 'PR';
        const MS_PROVISIONAL_22 = '22';
        const MS_DEREG_DECEASED_10 = '10';
        const MS_DEREG_FEENOTPAID_15 = '15';
        const MS_FULL_REG_STATE_REST = '2';
        const MS_FULL_REG_GTCW_DISC = '3';
        // End of Membership Status
        
        // Start of System Code Type
        const SCT_RESTRICTIONS_WEB_ENABLED_OPTION = 'DISCWEB'; 
        const SCT_RESTRICTIONS_WEB_ENABLED_LIVE='L';
        const SCT_RESTRICTIONS_WEB_ENABLED_EXPIRED='E';
        const SCT_TEMPLATE_DOCUMENT_TYPE_CODE = 'TPLDOC';
        const SCT_ACTIVITY_STATUS_CODE = 'ACTSTAT';
        const SCT_ACTIVITY_EMAIL_STATUS_CODE = 'ACTEMAILST';    
        const SCT_TEMPLATE_DOCUMENT_GROUP_CODE = 'TPLDOC'; 
        const SCT_NOTIFICATION_PRIORITY = 'NOTFPRT';
        const SCT_NOTIFICATION_LEVEL = 'USRNOTLEV';
        const SCT_MM_SEVERITY_TYPE = 'MMSEVTYPE';
        const SCT_MM_MESSAGE_TYPE = 'MMMSGTYPE';
        const SCT_STATUS_TYPE = 'STATYP';
        const SCT_SEARCH_RESULT = 'SEARE';
        const SCT_SEARCH_TYPE = 'SEATYPE';
        // End of System Code Type
        
        // Start of System Code 
        const SC_ACTIVITY_STATUS_COMPLETE_CODE = 'C';
        const SC_ACTIVITY_STATUS_OUTSTANDING_CODE = 'O';
        const SC_ACTIVITY_STATUS_DELETED_CODE = 'D';
        const SC_ACTIVITY_STATUS_PROCESSING_CODE = 'P';
        const SC_ACTIVITY_STATUS_QUEUED_CODE = 'Q';
        const SC_ACTIVITY_EMAIL_STATUS_QUEUED_CODE = 'QUEUED';
        const SC_ACTIVITY_EMAIL_STATUS_STOPPED_CODE = 'STOPPED';
        const SC_ACTIVITY_EMAIL_STATUS_SENDING_CODE = 'SENDING';
        const SC_ACTIVITY_EMAIL_STATUS_SENT_CODE = 'SENT';
        const SC_NOTIFICATION_LEVEL_SUCCESS = 'S';
        const SC_NOTIFICATION_LEVEL_WARNING = 'W';
        const SC_NOTIFICATION_LEVEL_FAILURE = 'F';
        const SC_NOTIFICATION_PRIORITY_LOW = 'L';
        const SC_NOTIFICATION_PRIORITY_MEDIUM = 'M';
        const SC_NOTIFICATION_PRIORITY_HIGH = 'H';
        const SC_MENTOR_PAYMENT_TYPE_SCHOOL_PAYMENTS = 'PS';
        const SC_MENTOR_PAYMENT_TYPE_TRAVEL_AND_CONSULTANT_PAYMENTS = 'TS';
        const SC_STATUS_TYPE_ACTIVE_NAME = 'Active';
        const SC_STATUS_TYPE_ACTIVE_CODE = 'A';
        const SC_STATUS_TYPE_INACTIVE_NAME = 'Inactive';
        const SC_STATUS_TYPE_INACTIVE_CODE = 'I';
        const SC_STATUS_TYPE_DECEASED_CODE = 'D';
        const SC_STATUS_TYPE_APPLICANT_CODE = 'APL';
        const SC_SEARCH_RESULT_EXACT_MATCH = 'E';
        const SC_SEARCH_RESULT_NO_MATCH = 'N';
        const SC_SEARCH_RESULT_MULTIPLE_MATCH = 'M';
        const SC_SEARCH_RESULT_OTHER = 'OTH';
        const SC_SEARCH_TYPE_SUPPLY_TEA = 'S';
        const SC_SEARCH_TYPE_PROSPECTIVE_TEA = 'P';
        const SC_SEARCH_TYPE_GENERAL = 'G';
        const SC_SEARCH_TYPE_EMPLOYER = 'EMP';
        const SC_SEARCH_TYPE_TEACHER = 'TEA';
        const SC_SEARCH_TYPE_PUBLIC = 'PUB';
        const SC_SEARCH_TYPE_OTHER = 'OTH';
        const SC_SEARCH_TYPE_SCHOOL = 'SCH';
        const SC_SEARCH_TYPE_FE_LECTURER = 'FEL';
        const SC_SEARCH_TYPE_TE = 'TE';
        // End of System Code 
        
        //Start of Title for gender
        const MALE_GENDER_CODE = 'M';
        const FEMALE_GENDER_CODE = 'F';
        const NONE_GENDER_CODE = 'B';
        //End of Title for gender
         
        // Start of Fund
        const FD_SUBSCRIPTION = 'N';               
        // End of Fund
        
        // Start of Frequency
        const FY_ANNUAL = 'A';               
        // End of Frequency
        
        // Start of Client Data
        const CLEN_ORGANISATION = 'Organisation';
        const CLEN_PERSON = 'Person';
        
        const CLSUEN_ORG_WORKPLACE = 'Workplace';
        const CLSUEN_ORG_EMPLOYER = 'Employer';
        const CLSUEN_ORG_ESTABLISHMENT = 'Establishment';
        
        const CLSUEN_PER_TEACHER = 'Teacher';
        const CLSUEN_PER_MENTOR = 'Mentor';
        const CLSUEN_PER_INDIVIDUAL = 'Individual';
        const CLEN_EDITABLE_TABLES = '2';  //client_table_id in format '1,2,3,4'      
        const CLEN_EDITABLE_TABLES_SCHOOL = '3';  //client_table_id in format '1,2,3,4' 
        
        const CLTBL_NAME_NPQH = 'Npqh';
        const CLTBL_NAME_WELSH_LANG = 'Welshlanguage';
        // End of Client Data
         
        // Start of Address Type
        const AT_HOME = 'H';  
        const AT_MAIN_ADDRESS = 'M';
        // End of Address Type
        
        const COMM_EMAIL = 'E';
        const COMM_LETTER = 'L';
        const COMM_NOTE = 'N';
        
        const EMAIL_PRIMARY_REOCORD = 'Y';
        
        // Start of GTCW QTS Status
        const GTCW_QTS_STATUS_QT47  = 47;
        const GTCW_QTS_STATUS_QT49  = 49;
        const GTCW_QTS_STATUS_QT52  = 52;
        const GTCW_QTS_STATUS_QT67  = 67;
        const GTCW_QTS_STATUS_QT68  = 68;
        const GTCW_QTS_STATUS_QT69  = 69;
        const GTCW_QTS_STATUS_QT71  = 71;
        const GTCW_QTS_STATUS_QT72  = 72;
        // End of GTCW QTS Status   
        
        // Start of Cont Rate Master
        const CRM_REGISTERED = 'R';
        const CRM_UNREGISTERED = 'D';
        const CRM_NO_FEE = 'X';
        // End of Cont Rate Master              

       // Start of Activity Types
       const AT_OUTBOUND_EMAIL_CODE = 'OBE';
       const AT_LETTER_CODE = 'L';
       const AT_NOTE_CODE = 'N';
       const AT_ATTACHED_DOCUMENT = 'ATTDOC';
       // End of Activity Types
       
       // Start of Activity Category
       const ACTCAT_TEACHER_EMAIL = 'TE';
       const ACTCAT_TEACHER_LETTER = 'TL';
       const ACTCAT_TEACHER_NOTE = 'TN';
       const ACTCAT_SCHOOL_NOTE = 'SN';
       const ACTCAT_TEACHER_DOCUMENT = 'TD';
       // End of Activity Category
       
       // Start of Template Types
        const TT_Email = 'email'; 
       // End of Template Types
       
        // Start of Email Types
        const EMAIL_TYPE_CREATE_RECORD = 'CR';
        const EMAIL_TYPE_UPDATE_INDUCTION_SESSION = 'UIS';
        const EMAIL_TYPE_UPDATE_RECORD = 'UR';
        const EMAIL_TYPE_DELETE_RECORD = 'DR';
        const EMAIL_TYPE_ADD_TEACHER_TO_SCHOOL = 'AT';
        const EMAIL_TYPE_REMOVE_TEACHER_FROM_SCHOOL = 'RT';
        const EMAIL_TYPE_REMOVE_CONTACT_SUBJECT_TAUGHT = 'CST';
        const EMAIL_TYPE_NO_ADDRESS_AVAILABLE = 'NOADD';
        const EMAIL_TYPE_SEARCH_SCHOOL_TEACHER_E_RECORD = 'SSTER';
        const EMAIL_TYPE_NO_LONGER_EXT_MENTOR = 'NLEM';
        const EMAIL_TYPE_EMP_AS_SUP_TEACH_BY_SUP_AGENCY = 'ETEASTBSA';
        const EMAIL_TYPE_EMP_AS_SUP_TEACH_BY_SCHOOL = 'ETEASTBS';
        const EMAIL_TYPE_UPLOAD_QUAL_CERTIFICATE = 'UQC';
        const EMAIL_TYPE_NO_LONGER_EMP_AT_SCHOOL = 'NLEAS';
       // End of Email Types
        
       // Start of Professional Development Teacher Types
        const PROF_DEV_TYPE_ALL = ''; 
        const PROF_DEV_TYPE_SUITABILITY = 'SUITABILITY'; 
        const PROF_DEV_TYPE_QTS = 'QTS'; 
        const PROF_DEV_TYPE_TEACHER = 'TEACHER'; 
       // End of Media Store 
        
        const FOS_USER_ANONOMUS_USER = 'mtl'; 
       
       // Start of FOS GROUPS
       const FOS_GROUP_ADMINISTRATOR = 'Administrators';
       const FOS_GROUP_ESERVICES_USERS = 'E-Services Users';
       
       // Samir: Registered Practitioner Changes
       // Registered Practitioner TO TO: Change Dual Registrant to Registered Practitioner after data update
       const FOS_GROUP_REGISTERED_PRACTITIONER = 'E-Services Users - Registered Practitioner';         
       // End Registered Practitioner Changes
       
       const FOS_GROUP_REGISTERED_TEACHER = 'E-Services Users - Registered Teacher';         
       const FOS_GROUP_DUAL_REGISTRANT = 'E-Services Users - Dual Registrant';         
       const FOS_GROUP_REGISTERED_FURTHER_EDUCATION_TEACHER = 'E-Services Users - Registered Further Education Teacher';         
       
       const FOS_GROUP_SCHOOL = 'E-Services Users - School';
       const FOS_GROUP_FURTHER_EDUCATION_COLLEGES = 'E-Services Users - Further Education Colleges';
       const FOS_GROUP_LOCAL_AUTHORITY = 'E-Services Users - Local Authority';
       const FOS_GROUP_LA_EMPLOYER = 'E-Services Users - Local Authority LA Employer';
       const FOS_GROUP_LA_APPROPRIATE_BODY = 'E-Services Users - Local Authority LA Appropriate Body';
       const FOS_GROUP_LA_MEP_UNIVERSITY = 'E-Services Users - Local Authority MEP University';
       const FOS_GROUP_LA_CONSORTIUM = 'E-Services Users - Local Authority Consortium';
       const FOS_GROUP_OTHER_TEACHING_COUNCIL = 'E-Services Users - Other Teaching Council';
       const FOS_GROUP_EXTERNAL_MENTORS = 'E-Services Users - External Mentor';
       const FOS_GROUP_SCHOOL_BASED_INDUCTION_MENTORS = 'E-Services Users - School Based Induction Mentors';

       const FOS_GROUP_DISCLOSURE_AND_BARRING_SERVICE = 'E-Services Users - Disclosure & Barring Service';
       const FOS_GROUP_YOUTH_VOLUNTARY_ORGANISATION = 'E-Services Users - Youth/Voluntary Organisation';
       const FOS_GROUP_WORK_BASED_CONTRACTOR_SUB_CONTRACTOR = 'E-Services Users - Work Based Learning Contractor/Sub-Contractor';
       
       const FOS_GROUP_MERLIN_USERS = 'Merlin Users';
       
       // End of FOS GROUPS
//End of GTCW
       
       const ESERV_DT_OUTPUT_OPTIONS = 'ESERV_DT_OUTPUT_OPTIONS';
       const ESERV_OP_DOC_LET_GROUPS = 'ESERV_OP_DOC_LET_GROUPS';
       
       //start of User Locked Page
       const LOCKED_PAGE_CODE_INDUCTION_PROFILE_DOC_EDIT = 'EP123';
       //end of User Locked Page
       
       //Start of document set
       const DOC_TYPE_REGTEA = 'REGTEA';
       //End of document set
       
       //Start of member status reason
       const MEM_STA_REA_NEW = 'NEW';
       const MEM_STA_ACTIVE = 'Active';
       const MEM_STA_APPLICANT_CODE = 'APL';
       const MEM_STA_ACTIVE_CODE = 'A';
       const MEM_STA_INACTIVE_CODE = 'I';
       //End of member status reason
       
       //Start of transaction origin
       const TRA_ORIGIN_RECEIPT = '7';
       //End of transaction origin
       
       //Start of payment method
       const PAYMENT_METHOD_DEBIT_CARD = '5';
       const PAYMENT_METHOD_NOT_AVAIALABLE = '10';
       //End of payment method
       
        //Start of transaction type
       const TRANSACTION_TYPE_PAYMENT = 'PY';
       //End of transaction type
       
       const MAXIMUM_FUNDING_AMOUNT = 1233.34; //See Log: 9041490
       const MAXIMUM_AMOUNT_AUTHORISED = 1000;
       
       //Start of CPD_ACT_CODE_VAL 
       const CPD_ACT_CODE_VAL_BRO = 'BRO';
       const CPD_ACT_CODE_VAL_SPE = 'SPE';
       const CPD_ACT_CODE_VAL_NPR = 'NPR';
       //End of CPD_ACT_CODE_VAL
       
       //Start of CPD Constants
       const CPD_PROFESSIONAL_LEARNING_PORTLET = 'PLP';
       const CPD_STATUS_PLP = 'PLP';
       //End of CPD constants
       
       const BG_PROCESS_PROC_NOT_AVAILABLE = 'PROCNA';
       
       //Start of Media Type
       const MEDTYP_APP_PDF = 'PDF';
       //End of Media Type
      
       const MENTOR_STATUS_LIST = "('C1','C1&2','C1&2IND','C1&3','C2','C3','C4','C2&3','C2&3IND','CALL','CALLIND','CMM','CM1','CM3IND','CMMIND','G1','G1&2','G1&3','G2','G2&3','G3','G4','GALL','GM1','GM3','GMM','RP','RPM','CM3','D','CSC','EAS', 'EM', 'CM', 'E', 'C')"; #Log 9043263 
       
       //Start of Wizard types
       const ESERV_WZ_TABLE_QUERY_CODE = 'ESERVTQ';
       //End of Wizard types
       
       const ESERV_MAIN_DT_HTML_REPLACE_STRING = '__VAL__';
       
       const RELATIONSHIP_TYPE_SUB_CONTRACTOR_OF = 'Sub-Contractor of/Contractor of';
       
       const THIS_IS_A_BLOB_CONTENT_MSG = 'THIS IS A BLOB CONTENT';
       const THIS_IS_A_NCLOB_CONTENT_MSG = 'THIS IS A NCLOB CONTENT';
}
