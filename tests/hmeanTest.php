<?php
/**
 * Created by PhpStorm.
 * User: n5802063
 * Date: 10/09/2018
 * Time: 15:01
 */
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class hmeanTest extends TestCase{
    public function testHmeanValidValues():void{
        $this->expectOutputString('1.714286');
        print (string)round(\RodrigoJusto\Phodastic\Math\Math::harmonicMean([1,2,4]),6);
    }
}