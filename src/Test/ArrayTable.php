<?php
namespace Test;

class ArrayTable {
    //class takes as input a 2D array
    public function getArray($array) {
        return $array[0]['foo'];        
    }
}

$myArrayTable = new ArrayTable();
echo $myArrayTable->getArray([['foo'=>'bar'],['foo'=>'baz']]);


