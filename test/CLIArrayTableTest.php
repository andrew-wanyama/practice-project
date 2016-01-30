<?php

class CLIArrayTableTest extends PHPUnit_Framework_TestCase {

    private $arrayTable;

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Sorry, constructor requires a non-empty array argument.
     */
    public function testException_EmptyArrayConstructorArg() {
        $this->arrayTable = new \SMSApplication\CLIArrayTable([]);
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Sorry, constructor requires a non-empty 2D array argument.
     */
    public function testException_InvalidConstructorArgs() {
        $this->arrayTable = new \SMSApplication\CLIArrayTable([[], []]);
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

    public function testToString_RightFormatCase2() {
        $this->arrayTable = new \SMSApplication\CLIArrayTable([['foo' => 'bar', 'baz' => 'foobar'], ['baz' => 'foobar']]);
        $strOutput = "\nfoo\n........\n0|bar\n";
        $strOutput .= "\nbaz\n........\n0|foobar\n1|foobar\n";
        $this->assertEquals($this->arrayTable->toString(), $strOutput);
    }

    public function testToString_RightFormatCase3() {
        $this->arrayTable = new \SMSApplication\CLIArrayTable([['baz' => 'foobar'], ['foo' => 'bar', 'baz' => 'foobar']]);
        $strOutput = "\nbaz\n........\n0|foobar\n1|foobar\n";
        $strOutput .= "\nfoo\n........\n0|bar\n";
        $this->assertEquals($this->arrayTable->toString(), $strOutput);
    }

    /**
     * @expectedException Exception
     * @expectedExceptionMessage Sorry, constructor requires a non-empty array argument.
     */
    public function testException_NonArrayArgs() {
        $this->arrayTable = new \SMSApplication\CLIArrayTable('bar');
    }

    /**
     * @expectedException Exception
     */
    public function testException_MoreThan2DArrayArgs() {
        $this->arrayTable = new \SMSApplication\CLIArrayTable([['foo' => 'bar', 'foo' => 'baz', ['foo' => 'bar', 'foo' => 'baz']]]);
        $this->arrayTable->toString();
    }

}
