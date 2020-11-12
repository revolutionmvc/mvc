<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Validate
 *
 * @author Asanka
 */
class Validation {

    public $errors = array();

    function __construct() {
        
    }

    /**
     * 
     * @param array $array get information data
     * @return array Errors
     */
    function form_validate($array) {

        foreach ($array as $key => $value) {
            $methods = explode(',', $value[1]);
            $errors = NULL;
            foreach ($methods as $name) {
                if (method_exists($this, trim($name))) {
                    $errors .= $this->{trim($name)}($value[0]);
                }
                if (!empty($errors)) {
                    $errors .= ', ';
                }
            }

            if (!empty($errors)) {
                $errors = trim($errors, ', ');
                $this->add_error($key, $errors);
            }
        }

        return $this->errors;
    }

    private function add_error($key, $value) {
        $this->errors[$key] = $value;
    }

    private function is_password_mached($data) {
        $passwords = explode('&', $data);

        if (empty($passwords[0]) && empty($passwords[1])) {
            return 'Password could not be empty';
        } else if ($passwords[0] != $passwords[1]) {
            return 'Password did not matched';
        }
    }

    private function min_length($data) {
        
    }

    private function max_length($data) {
        
    }

    private function is_integer($data) {
        if (!empty($data)) {
            if (!filter_var($data, FILTER_VALIDATE_INT)) {
                return 'Enter Valid Integer';
            }
        }
    }

    private function is_alnum($data) {
        $data = trim($data);
        $error_chars = NULL;
        $error = array();
        $chars = array('+', '-', '*', ',', '<', '>', '/', '?', '"', "'", ':', ';', ']', '}', '{', '[', '|', '=', ')', '(', '&', '^', '%', '$', '#', '@', '!', '`', '~');

        foreach ($chars as $value) {
            if (strstr($data, $value)) {
                array_push($error, 1);
                $error_chars .= $value . ' ';
            } else {
                array_push($error, 0);
            }
        }
        if (in_array(1, $error)) {
            return 'Can not be include this characters ( ' . $error_chars . ' )';
        }
    }

    private function is_empty($data) {
        if (strlen($data) == 0) {
            return 'This field cannot be left blank.';
        }
    }
    private function is_empty_array($data) {
        if (empty($data)) {
            return 'This field cannot be left blank.';
        }
    }

    private function is_email($data) {
        if (!empty($data)) {
            if (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
                return 'Enter Valid Email.';
            }
        }
    }

    private function is_nic($data) {
        if (!empty($data)) {
            if (strlen($data) == 12) {
                if (!empty($this->is_integer($data))) {
                    return 'Enter Valid NIC Number.';
                }
            } else {
                if (strlen($data) == 10) {
                    if (strpos($data, 'v') == 9) {
                        $nic = rtrim($data, 'v');
                        if (!empty($this->is_integer($nic))) {
                            return 'Enter Valid NIC Number.';
                        }
                    } elseif (strpos($data, 'V') == 9) {
                        $nic = rtrim($data, 'V');
                        if (!empty($this->is_integer($nic))) {
                            return 'Enter Valid NIC Number.';
                        }
                    } else {
                        return 'Enter Valid NIC Number.';
                    }
                } elseif (strlen($data) == 9) {
                    if (!empty($this->is_integer($data))) {
                        return 'Enter Valid NIC Number.';
                    } else {
                        return "Enter Valid NIC Number. (Please Enter 'V' as the Final Character If old NIC )";
                    }
                } else {
                    return 'Enter Valid NIC Number.';
                }
            }
        }
    }

    private function is_phone_no($data) {
        if (!empty($data)) {
            if (empty($this->is_integer($data))) {
                if (mb_strlen($data) != 9) {
                    return 'Phone Number should be only contain 9 digits.';
                }
            } else {
                return 'Enter Valid Phone Number.';
            }
        }
    }

    //20-08-30
//    function is_match_nic_dob($NIC, $DOB) {
//
////$NIC = '970581618V';
//        $error_text = "NIC or Date of Birth invalid";
//        if (strlen($NIC) != 10 && strlen($NIC) != 12) {
//            $e1 = "Invalid NIC1 - L NOT 10 AND 12";
//            return $error_text;
//        } elseif (strlen($NIC) == 10 && !ctype_digit(substr($NIC, 0, 9))) {
//            $e2 = "Invalid NIC2 - L10 BUT NOT NUMERIC";
//            return $error_text;
//        } else {
//
//            //YEAR
//            if (strlen($NIC) == 10) {
//                $year = "19" . substr($NIC, 0, 2);
//                $day_text = (int) substr($NIC, 2, 3);
//            } else {
//                $year = substr($NIC, 0, 4);
//                $day_text = (int) substr($NIC, 4, 3);
//            }
//
//
//            //GENDER
//            if ($day_text > 500) {
//                $gender = "female";
//                $day_text = $day_text - 500;
//            } else {
//                $gender = "male";
//            }
//
//
//            //DAY DIGIT
//            if ($day_text < 1 && $day_text > 366) {
//                $e3 = "Invalid NIC - NOT 1-366 ";
//                return $error_text;
//            } else {
//
//                //MONTH
//                if ($day_text > 335) { //356-^
//                    $day = $day_text - 335;
//                    $month = "December";
//                } elseif ($day_text > 305) { //306-355
//                    $day = $day_text - 305;
//                    $month = "November";
//                } elseif ($day_text > 274) { //275-305
//                    $day = $day_text - 274;
//                    $month = "October";
//                } elseif ($day_text > 244) { //245-274
//                    $day = $day_text - 244;
//                    $month = "September";
//                } elseif ($day_text > 213) { //214-244
//                    $day = $day_text - 213;
//                    $month = "Auguest";
//                } elseif ($day_text > 182) { //183-213
//                    $day = $day_text - 182;
//                    $month = "July";
//                } elseif ($day_text > 152) { //153-182
//                    $day = $day_text - 152;
//                    $month = "June";
//                } elseif ($day_text > 121) { //122-152
//                    $day = $day_text - 121;
//                    $month = "May";
//                } elseif ($day_text > 91) { //92-121
//                    $day = $day_text - 91;
//                    $month = "April";
//                } elseif ($day_text > 60) { //61-91
//                    $day = $day_text - 60;
//                    $month = "March";
//                } elseif ($day_text > 31) { //32-60
//                    $day = $day_text - 31;
//                    $month = "February";
//                } elseif ($day_text < 32) { //31-0
//                    $day = $day_text;
//                    $month = "January";
//                }
//
////                echo $gender . " " . $year . " " . $month . " " . $day;
//                $dob_nic = date('m-d-Y',strtotime($month."-".$day."-".$year));
//                $dob = date('m-d-Y',strtotime($DOB));
//                if($dob_nic != $dob){
//                    return "NIC or Date of Birth not match";; 
//                }else{
//                    return "matched";
//                }
//            }
//        }
//    }

}
