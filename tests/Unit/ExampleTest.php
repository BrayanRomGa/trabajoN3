<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $numero = 10;
        if ($numero==0) {
            echo "NEUTRO";
            $this->assertTrue(FALSE);
        }else {
            if (($numero%2)>0) {
                echo "IMPAR";
                $this->assertTrue(true);
            }elseif(($numero%2)==0) {
                echo "PAR";
                $this->assertTrue(true);
            }
        }
    }


}
