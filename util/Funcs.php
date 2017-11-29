<?php

class Todo_Util_Funcs {
    
    public static function parseDate($str) {
        if (date('Y-m-d', strtotime($str)) == $str) {
            return new DateTime($str);
        }
        return null;
    }
    
    public static function parseBool($str) {
        if (in_array($str, array('yes', 'no'))) {
            return ((bool) ($str === 'yes'));
        }
        return null;
    }
    
}