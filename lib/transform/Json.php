<?php

class JsonTransform
{
    public static function transform($object) {
        if (is_array($object)) {
            $array = array();
            if (JsonTransform::is_array($object)) {
                foreach ($object as $value) {
                    $array[] = JsonTransform::transform($value);
                }
                return '[' . implode(',', $array) . ']';
            } else {
                foreach ($object as $key => $value) {
                    $array[] = '"' . $key . '":'
                             . JsonTransform::transform($value);
                }
                return '{' . implode(',', $array) . '}';
            }
        } else {
            return '"' . $object . '"';
        }
    }

    public function is_array($object) {
        $keys = array_keys($object);
        foreach ($keys as $key) {
            if (!is_int($key)) {
                return false;
            }
        }
        return true;
    }
}
