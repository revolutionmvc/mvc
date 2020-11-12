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

    static function dd($data) {
        var_dump($data);
        exit();
    }

}
