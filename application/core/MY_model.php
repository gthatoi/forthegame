<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class My_Model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }

    /**
     * getErrorCodeData
     * get the error code message from the given error code
     * @param  [string] [$error_code]
     * @return [array]
     */
    public function getErrorCodeData($error_code){

            $return = array();
            $error_message = "";

            switch($error_code){

                case "01":
                $error_message = "Invalid Post Data.";
                break;

                case "02":
                $error_message = "API authentication failed.";
                break;

                case "03":
                $error_message = "Session Expired.";
                break;

                case "04":
                $error_message = "Validation Errors.";
                break;

                case "05":
                $error_message = "Logic Errors.";
                break;

                case "06":
                $error_message = "Email not verified.";
                break;

                case "07":
                $error_message = "Mobile not verified.";
                break;

                case "08":
                $error_message = "Invalid OTP.";
                break;

                case "09":
                $error_message = "Payment gateway Data Tampered.";
                break;

                case "10":
                $error_message = "Payment gateway Data Reconcile Failed.";
                break;

                case "11":
                $error_message = "Error while database operation.";
                break;
            }

            $return['error_code'] = $error_code;
            $return['error_message'] = $error_message;
            return $return;
        }


}
