<?php

namespace ESERV\MAIN\Services;

class ErrorCodeConstants 
{
    //Global
    const FORM_ERROR_PREFIX = 'An error occurred while executing :- ';
    const FORM_INVALID = 'Form is invalid.';
    
    //Employer
    const EMP_NOT_FOUND = 'No Employer found for id';
    const EMP_ADD_SUCCESSFUL = 'New Employer has been successfully added!';
    const EMP_UPDATE_SUCCESSFUL = 'Employer successfully updated!';
    const EMP_ADD_CODE_EXISTS = 'Code already exists in another employer. Please choose a different code.';
    const EMP_EDIT_CODE_EXISTS = 'Code already exists in another employer. Please choose a different code.';
    
    
    //Contact Sub Type
    const CONTACT_SUBTYPE_EMPTY = 'Contact subtype cannot be blank.';
    
    //Contact Status
    const CONTACT_STATUS_EMPTY = 'Contact status cannot be blank.';
    
    //Teacher
    const CANNOT_SAVE_REGISTRATION_INFO = 'Cannot save registration details when date suitable is null or in future.';
    
    //Interfaces
    const IMPORT_SUCCESS = 'File successfully uploaded for import.';
    const EXPORT_SUCCESS = 'Your request has been queued and you will be notified when the export is done.';
    
}
