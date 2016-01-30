<?php

namespace SMSApplication;

class CLIArrayTable {

    private $myArray;
    private $array_columns = [];

    public function __construct($my2DArray) {
        if (!is_array($my2DArray) || empty($my2DArray)) {
            throw new \Exception("Sorry, constructor requires a non-empty array argument.");
        }
        $isFirstRow = true;
        foreach ($my2DArray as $rowNumber => $row) {
            if (!is_array($row) || empty($row)) {
                throw new \Exception("Sorry, constructor requires a non-empty 2D array argument.");
            } else {
                foreach ($row as $subRows) {
                    if (is_array($subRows)) {
                        throw new \Exception("Sorry, constructor requires only a 2D array argument.");
                    }
                }
                $this->myArray = $my2DArray;
            }

            if (!$isFirstRow) {
                $currentKeys = array_keys($row);
                $intersection = array_intersect($currentKeys, $previousKeys);
                if (count($intersection) !== count($row) || count($intersection) !== count($previousKeys)) {
                    throw new \Exception("Sorry row $rowNumber does not contain all the keys.");
                }
            }
            $isFirstRow = false;
            $previousKeys = array_keys($row);
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

        echo "Please specify the count at which to start numbering rows: ";
        $handle = fopen("php://stdin", "r");
        $startAt = trim(fgets($handle));
        if (!($startAt)) {
            $separator = 0;
        }
        echo "Please specify the separating character: ";
        $handle2 = fopen("php://stdin", "r");
        $separator = trim(fgets($handle2));
        if (!($separator)) {
            $separator = "|";
        }
        echo "\nThank you, continuing...\n";

        $output = '';
        foreach ($this->array_columns as $column_key => $column_value) {
            $output .= "\n{$column_key}\n........\n";
            foreach ($column_value as $index => $val) {
                $index += $startAt;
                $output .= "{$index}$separator{$val}\n";
            }
        }
        return $output;
    }

    public function __toString() {
        try {
            return $this->toString();
        } catch (\Exception $ex) {
            return "{$ex->getMessage()}\n";
        }
    }

}
