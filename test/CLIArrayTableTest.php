<?php

class CLIArrayTableTest extends PHPUnit_Framework_TestCase {

    private $arrayTable;

    //instantiate an object of the class
    public function setUp() {
        $this->arrayTable = new \SMSApplication\CLIArrayTable([['foo' => 'bar'], ['foo' => 'baz']]);
    }

    //Test that SUT throws exception when empty array argument's passed to constructor
    public function testException_EmptyArrayConstructorArg() {
        try {
            $this->arrayTable = new \SMSApplication\CLIArrayTable([['foo' => 'bar'], ['foo' => 'baz']]);
        } catch (Exception $ex) {
            $this->assertEquals($ex->getMessage(), "Sorry, constructor requires a non-empty array argument.");
            return;
        }
        $this->fail("Expected Exception has not been raised.");
    }

    //Test that SUT throws exception when wrong arguments are passed to constructor
    public function testException_InvalidConstructorArgs() {
        try {
            $this->arrayTable = new \SMSApplication\CLIArrayTable([['foo' => 'bar', 'baz' => 'foobar'], ['baz' => 'foobar']]);
        } catch (Exception $ex) {
            $this->assertEquals($ex->getMessage(), "Sorry, constructor requires a non-empty 2D array argument.");
            return;
        }
        $this->fail("Expected Exception has not been raised.");
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
