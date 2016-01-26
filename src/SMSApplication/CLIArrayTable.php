<?php

namespace SMSApplication;

class CLIArrayTable {

    private $myArray;
    private $array_columns = [];

    public function __construct(array $my2DArray) {
        foreach ($my2DArray as $myArray) {
            if (!is_array($myArray)) {
                throw new \Exception("Sorry, constructor requires a 2D array argument.");
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
        foreach ($this->array_columns as $column_key => $column_value) {
            $output = "\n{$column_key}\n........\n";
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
