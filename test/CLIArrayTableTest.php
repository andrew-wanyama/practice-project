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
            $this->arrayTable = new \SMSApplication\CLIArrayTable([]);
        } catch (Exception $ex) {
            $this->assertEquals($ex->getMessage(), "Sorry, constructor requires a non-empty array argument.");
            return;
        }
        $this->fail("Expected Exception has not been raised.");
    }

    //Test that SUT throws exception when wrong arguments are passed to constructor
    public function testException_InvalidConstructorArgs() {
        try {
            $this->arrayTable = new \SMSApplication\CLIArrayTable([[], []]);
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

    public function testToString_RightFormatCase2() {
        $this->arrayTable = new \SMSApplication\CLIArrayTable([['foo' => 'bar', 'baz' => 'foobar'], ['baz' => 'foobar']]);
        $strOutput = "\nfoo\n........\n0|bar\n";
        $strOutput .= "\nbaz\n........\n0|foobar\n1|foobar\n";
        $this->assertTrue(is_string($this->arrayTable->toString()));
        $this->assertEquals($this->arrayTable->toString(), $strOutput);
    }

    public function testToString_RightFormatCase3() {
        $this->arrayTable = new \SMSApplication\CLIArrayTable([['baz' => 'foobar'], ['foo' => 'bar', 'baz' => 'foobar']]);
        $strOutput = "\nbaz\n........\n0|foobar\n1|foobar\n";
        $strOutput .= "\nfoo\n........\n0|bar\n";
        $this->assertTrue(is_string($this->arrayTable->toString()));
        $this->assertEquals($this->arrayTable->toString(), $strOutput);
    }

    public function testException_NonArrayArgs() {
        try {
            $this->arrayTable = new \SMSApplication\CLIArrayTable('bar');
        } catch (Exception $ex) {
            $this->assertEquals($ex->getMessage(), "Sorry, constructor requires a non-empty array argument.");
            return;
        }
        $this->fail("Expected Exception has not been raised.");
    }

    public function testException_MoreThan2DArrayArgs() {
        $this->setExpectedException("Exception");
        $this->arrayTable = new \SMSApplication\CLIArrayTable([['foo' => 'bar', 'foo' => 'baz', ['foo' => 'bar', 'foo' => 'baz']]]);
        $this->arrayTable->toString();
    }

}
