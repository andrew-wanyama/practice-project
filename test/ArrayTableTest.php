<?php
class ArrayTableTest extends PHPUnit_Framework_TestCase {
    //store our object here
    private $myArrayTable;
    
    protected function setUp() {
        $this->myArrayTable = new \Test\ArrayTable();        
    }  
    protected function tearDown() {
        unset($this->myArrayTable);        
    }
    //test class is properly instantiated
    public function testInstantiation() {
        $this->assertInstanceOf('\Test\ArrayTable', $this->myArrayTable);        
    }
    //test to ensure we pass a 2D array
    public function testgetArray() {
        $array = [['foo'=>'bar'],['foo'=>'baz']];
        $this->myArrayTable->getArray($array);
        $this->assertCount(2, $array);        
    }
}
