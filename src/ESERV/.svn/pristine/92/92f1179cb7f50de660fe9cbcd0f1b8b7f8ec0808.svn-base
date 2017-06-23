<?php

/*
 * Please add custom ESERV form validation methods here
 */
namespace ESERV\MAIN\Services\Form;

class ESERVValidation  {    
    
 public function isValidNiNumber($ni_Number) {        
        if (preg_match(\ESERV\MAIN\Services\AppConstants::NI_NUMBER_REG_EXP,$ni_Number)) {
            return true;
        }
        else{
            return false;
        }        
    }
}