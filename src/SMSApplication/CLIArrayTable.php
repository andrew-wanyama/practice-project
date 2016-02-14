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

        foreach ($this->myArray[0] as $key => $value) {
            $this->array_columns[$key] = array_column($this->myArray, $key);
        }
        $output = '';

        $maxColWidths = $this->calculateMaxWidths($this->array_columns, $startCountAt);
        $output .= sprintf("%{$maxColWidths['row_num_col']}s%s", "", $this->rowNumbersColSep);
        $headerKeys = array_keys($this->array_columns);

        foreach ($headerKeys as $heading) {
            $headingFormat = "%-{$maxColWidths[$heading]}s{$this->cellSep}";
            $output .= sprintf($headingFormat, $heading);
        }
        $output .= "\n";

        foreach ($maxColWidths as $maxColWidth) {
            $output .= sprintf("%{$maxColWidth}s%s", str_repeat($this->headerSep, $maxColWidth), $this->cellSep);
        }
        $output .= "\n";

        for ($row = 0, $maxRows = count(array_values($this->array_columns)[0]); $row < $maxRows; $row++) {
            $output .= sprintf("%{$maxColWidths['row_num_col']}d%s", $startCountAt, $this->rowNumbersColSep);
            $keysCount = 0;
            foreach (array_values($this->array_columns) as $data) {
                $maxDataWidth = $maxColWidths[$headerKeys[$keysCount]];
                $output .= sprintf("%-{$maxDataWidth}s%s", $data[$row], $this->cellSep);
                $keysCount += 1;
            }
            $startCountAt += 1;
            $output .= "\n";
            foreach ($maxColWidths as $maxColWidth) {
                $output .= sprintf("%{$maxColWidth}s%s", str_repeat($this->headerSep, $maxColWidth), $this->cellSep);
            }
            $output .= "\n";
        }
        return $output;
    }

    private function calculateMaxWidths($array, $startCountAt) {
        $maxWidths = array();
        foreach ($array as $columnKey => $value) {
            $maxWidths['row_num_col'] = strlen($startCountAt + max(array_keys($value)));
            $keyLength = strlen($columnKey);
            $strLengths = array_map('strlen', $value);
            $maxWidth = max($strLengths);
            if ($keyLength > $maxWidth) {
                $maxWidth = $keyLength;
            }
            $maxWidths[$columnKey] = $maxWidth;
        }
        return $maxWidths;
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
