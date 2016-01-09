<?php
require __DIR__ . '/vendor/autoload.php';

class SampleClassTest extends PHPUnit_Framework_TestCase {
    //test sayHello method
    public function testsayHello() {
        $sample_obj = new \Test\SampleClass();
        $expected = "Hello World!";
        $actual = $sample_obj->sayHello();
        $this->assertEquals($expected, $actual);    
    }
}
