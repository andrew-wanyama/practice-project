<?php

namespace SMSApplication;

class CLIArrayTable {

    private $myArray; //stores the 2D array
    private $array_columns = [];

    //constructor ensures we pass a 2D array once the object is created
    public function __construct(array $my2DArray) {
        foreach ($my2DArray as $myArray) {
            if (!is_array($myArray)) {
                die("Sorry, constructor requires a 2D array argument.\n");
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
            //loop through inner arrays
            foreach ($myArrays as $key => $value) {
                //array_column returns values from multi dimensional array based on column keys
                $this->array_columns[$key] = array_column($this->myArray, $key);
            }
        }
        //loop through array-columns and format output
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
