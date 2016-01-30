<?php

class CLIArrayTableTest extends PHPUnit_Framework_TestCase {

    private $arrayTable;

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Sorry, constructor requires a non-empty array argument.
     */
    public function testException_EmptyArrayConstructorArg() {
        new \SMSApplication\CLIArrayTable([]);
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Sorry, constructor requires a non-empty 2D array argument.
     */
    public function testException_InvalidConstructorArgs() {
        new \SMSApplication\CLIArrayTable([[], []]);
    }

    //test that output is a string
    public function testToString() {
        $this->arrayTable = new \SMSApplication\CLIArrayTable([['foo' => 'bar'], ['foo' => 'baz']]);
        $this->assertTrue(is_string($this->arrayTable->toString()));
    }

    //assert correct representation of array as a string
    public function testToString_RightFormat() {
        $this->arrayTable = new \SMSApplication\CLIArrayTable([['foo' => 'bar'], ['foo' => 'baz']]);
        $strOutput = "\nfoo\n........\n";
        $strOutput .= "0|bar\n";
        $strOutput .= "1|baz\n";
        $this->assertEquals($this->arrayTable->toString(), $strOutput);
    }

    /**
     * @expectedException \Exception
     */
    public function testToString_RightFormatCase2() {
        new \SMSApplication\CLIArrayTable([['foo' => 'bar', 'baz' => 'foobar'], ['baz' => 'foobar']]);
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Sorry, constructor requires a non-empty array argument.
     */
    public function testException_NonArrayArgs() {
        new \SMSApplication\CLIArrayTable('bar');
    }

    /**
     * @expectedException Exception
     */
    public function testException_MoreThan2DArrayArgs() {
        $this->arrayTable = new \SMSApplication\CLIArrayTable([['foo' => 'bar', 'foo' => 'baz', ['foo' => 'bar', 'foo' => 'baz']]]);
        $this->arrayTable->toString();
    }

}
