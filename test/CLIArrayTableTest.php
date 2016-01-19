<?php
class CLIArrayTableTest extends PHPUnit_Framework_TestCase{
    private $arrayTable;
    //instantiate an object of the class
    public function setUp() {
        $this->arrayTable = new \Test\CLIArrayTable([['foo'=>'bar'],['foo'=>'baz']]);
    }
    //test for correct values within the array
    /*
    public function testShowArrayTable(){
        $expected = $this->arrayTable->showArrayTable();
        $this->assertEquals($expected, 'bar');
    }
     * 
     */
    //test that output is a string
    public function testShowArrayTable() {
        $this->assertTrue(is_string($this->arrayTable->showArrayTable()));
    }
}
