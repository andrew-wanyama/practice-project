<?php

class CLIArrayTableTest extends PHPUnit_Framework_TestCase {

    private $arrayTable;

    //instantiate an object of the class
    public function setUp() {
        $this->arrayTable = new \SMSApplication\CLIArrayTable([['foo' => 'bar'], ['foo' => 'baz']]);
    }

    //test that output is a string
    public function testToString() {
        $this->assertTrue(is_string($this->arrayTable->toString()));
    }

    //assert correct representation of array as a string
    public function testToString_RightFormat() {
        $strOutput = "\nfoo\n........\n";
        $strOutput .= "0|bar\n";
        $strOutput .= "1|baz\n";
        $this->assertEquals($this->arrayTable->toString(), $strOutput);
    }

}
