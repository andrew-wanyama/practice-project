<?php

namespace SMSApplication;

class CLIArrayTable {

    private $myArray;
    private $array_columns = [];

    public function __construct($my2DArray) {
        if (!is_array($my2DArray) || empty($my2DArray)) {
            throw new \Exception("Sorry, constructor requires a non-empty array argument.");
        }
        foreach ($my2DArray as $myArray) {
            if (!is_array($myArray) || empty($myArray)) {
                throw new \Exception("Sorry, constructor requires a non-empty 2D array argument.");
            } else {
                $this->myArray = $my2DArray;
            }
        }
    }

    public function getArray() {
        return $this->myArray;
    }

    public function toString() {
        foreach ($this->myArray as $myArrays) {
            foreach ($myArrays as $key => $value) {
                $this->array_columns[$key] = array_column($this->myArray, $key);
            }
        }
        $output = '';
        foreach ($this->array_columns as $column_key => $column_value) {
            $output .= "\n{$column_key}\n........\n";
            foreach ($column_value as $index => $val) {
                $output .= "{$index}|{$val}\n";
            }
        }
        return $output;
    }

    public function __toString() {
        return $this->toString();
    }

}
