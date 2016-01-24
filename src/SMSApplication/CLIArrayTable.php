<?php
namespace Test;

class CLIArrayTable {
    private $myArray;//stores the 2D array
    private $array_columns = [];
    //constructor ensures we pass a 2D array once the object is created
    public function __construct($myArray) {
        $this->myArray = $myArray;
    }
    
    public function showArrayTable(){
        foreach ($this->myArray as $myArrays){
            //loop through inner arrays
            foreach ($myArrays as $key => $value){
                //array_column returns values from multi dimensional array based on column keys
                $this->array_columns[$key] = array_column($this->myArray, $key);
            }
        }
        //loop through array-columns and format output
        foreach ($this->array_columns as $column_key => $column_value){
            $output = print "\n{$column_key}\n........\n";
            foreach ($column_value as $index => $val){
                $output .= print "{$index}|{$val}\n";
            }
        }
        return $output;
    }
    
    public function __toString(){
        return $this->showArrayTable();
    }
}

$arrayTable = new CLIArrayTable([['foo'=>'bar','foo2'=>'bar2','foo3'=>'bar3'],['foo'=>'bar','foo2'=>'baz2']]);
echo $arrayTable;
