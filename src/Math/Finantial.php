<?php

namespace RodrigoJusto\Phodastic\Math;

use \Exception;

class Finantial{
    /** Finantial Math interests (need to be refactor) **/
    public static function simpleInterest(float $capital, float $tax, int $period):float{
        $interest = $capital * $tax * $time;
        return $interest;
    }
    
    public static function compoundInterest(float $capital,float $tax, int $period):float{
        $interest = $capital * (1+$tax) ^ $period;
        return $interest;
    }
}