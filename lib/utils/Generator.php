<?php

class Generator {
    // type posibilities -> { alpha, alnum, all }
    public static function code($type = 'alnum', $size = 16) {
        switch ($type) {
            case 'alpha':
                $values = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case 'alnum':
                $values = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890';
                break;
            case 'all':
                $values = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890:;,._+-*/#@$%&()[]{}';
                break;
        }
        
        $length = strlen($values);
        $code = '';
        for ($i = 0; $i < $size; $i++) {
            $code .= $values[rand(0, $length - 1)];
        }
        return $code;
    }
}
