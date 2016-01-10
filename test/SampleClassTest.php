<?php
class SampleClassTest extends PHPUnit_Framework_TestCase {
    //test SampleClass is instantiated
    public function testFailure(){
        $actual = new \Test\SampleClass();
        $this->assertInstanceOf('\Test\SampleClas', $actual);            
    }
}
