<?php

class Hash{

    

    public static function make($string, $salt = ''){
        return hash('sha256', $string . $salt);
    }

    public static function salt($length){
        $length = ($length < 4) ? 4 : $length;
        return bin2hex(random_bytes(($length-($length%2))/2));
        //return random_bytes($length);
    }

    public static function unique(){
        return self::make(uniqid());
    }

}



