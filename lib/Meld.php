<?php

class Meld
{
    public function join($element1, $element2) {
        if (is_object($element1)) {
            return (object)$this->arrays((array)$element1, (array)$element2);
        } else if (is_array($element1)) {
            return $this->arrays($element1, $element2);
        } else {
            return $this->primitives($element1, $element2);
        }
    }

    public function arrays($array1, $array2) {
        if (!is_array($array1) || !is_array($array2)) {
            return $array1;
        }

        $join = $array1;

        foreach ($array2 as $key => $element) {
            if (!isset($join[$key])) {
                $join[$key] = $element;
            } else {
                $value1 = $join[$key];
                $value2 = $element;

                if (empty($value1)) {
                    $join[$key] = $value2;
                } else {
                    $join[$key] = $this->join($value1, $value2);
                }
            }
        }

        return $join;
    }

    public function primitives($value1, $value2) {
        if (gettype($value1) <> gettype($value2)) {
            return $value1;
        }

        if (empty($value1)) {
            return $value2;
        }

        return $value1;
    }
}
