<?php

namespace SMSApplication;

class CLIArrayTable {

    private $myArray;
    private $array_columns = [];
    private $headerSep = '.';
    private $rowNumbersColSep = '|';
    private $cellSep = '|';

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

    public function toString($startCountAt = 0) {

        foreach ($this->myArray as $myArrays) {
            foreach ($myArrays as $key => $value) {
                $this->array_columns[$key] = array_column($this->myArray, $key);
            }
        }
        $output = '';
        foreach ($this->array_columns as $column_key => $column_value) {
            $first = true;
            foreach ($column_value as $index => $val) {
                $index += $startCountAt;
                if ($first) {
                    $header = "\n%s\n{$this->rowNumbersColSep}{$this->headerSep}\n";
                    $output .= sprintf($header, $column_key);
                    $first = false;
                }
                $tableRows = "%d{$this->cellSep}%s\n";
                $output .= sprintf($tableRows, $index, $val);
            }
        }
        return $output;
    }

    public function setHeaderSeparator($headerSep) {
        if ((!is_string($headerSep)) || (strlen($headerSep) !== 1)) {
            throw new \Exception("Please provide a single character for the header separator.");
        }
        $this->headerSep = $headerSep;
    }

    public function setRowNumbersColSeparator($rowNumbersColSep) {
        if ((!is_string($rowNumbersColSep)) || (strlen($rowNumbersColSep) !== 1)) {
            throw new \Exception("Please provide a single character for the row numbers column separator.");
        }
        $this->rowNumbersColSep = $rowNumbersColSep;
    }

    public function setCellSeparator($cellSep) {
        if ((!is_string($cellSep)) || (strlen($cellSep) !== 1)) {
            throw new \Exception("Please provide a single character for the cell separator.");
        }
        $this->cellSep = $cellSep;
    }

    public function __toString() {
        try {
            return $this->toString();
        } catch (\Exception $ex) {
            return "{$ex->getMessage()}\n";
        }
    }

}
