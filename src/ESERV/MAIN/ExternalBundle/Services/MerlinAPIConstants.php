<?php

namespace ESERV\MAIN\ExternalBundle\Services;

class MerlinAPIConstants {

    // Audit Error Types Codes
    const AUDIT_ERROR_TYPE_ACCESS_CODE = 'X';
    const AUDIT_ERROR_TYPE_VALIDATION_CODE = 'V';
    const AUDIT_ERROR_TYPE_EXCEPTION_CODE = 'E';
    const AUDIT_ERROR_TYPE_AUTHENTICATION_CODE = 'A';
    const AUDIT_ERROR_TYPE_DATA_CODE = 'D';
    const AUDIT_ERROR_SESSION_HIJACK = 'SH';
    
    // Extra XML nodes
    const XML_EXTRA_NODE_API_INFO = 'API_INFO';
    const XML_EXTRA_NODE_INFO = 'INFO';
    const LOGINVERIFICATION_NODE = 'LOGINVERIFICATION';
    const CHECKLOGIN_NODE = 'CHECKLOGIN';
    const LOGOUT_NODE = 'LOGOUT';
    const VERIFY_NODE = 'VERIFY';
    const WILDCARD_CHAR = '*';
}
