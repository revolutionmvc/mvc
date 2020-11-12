<?php

$obj = new Helper();
$obj->random_id();

class Helper {

    public static function random_id() {
        $today = time();
        $date = date('D-M-Y');
        $rand = rand(1, 1000000000);

        $new_name = $date . "-" . $today . "-" . $rand;
        return $new_name;
    }

    public static function random_number() {

        $rand = rand(1, 1000000000);
        return $rand;
    }

    static function dd($data) {
        var_dump($data);
        exit();
    }

    //['post'=>$_POST,'name'=>['a','b','c']];
    static function isset_post($data) {
//        print_r($data);
        $status = array();
        $post = $data['post'];
        $name = $data['name'];
        $status = array();
        foreach ($name as $key => $value) {
            if (isset($post[$value])) {
                array_push($status, 1);
            } else {
                array_push($status, 0);
            }
        }

        if (in_array(0, $status)) {
            return false;
        } else {
            return true;
        }
    }

}
