<?php
/**
 * Created by PhpStorm.
 * User: n5802063
 * Date: 10/09/2018
 * Time: 13:25
 */

namespace RodrigoJusto\Phodastic\Math;

use Exception;

class Math
{
    /**
     * Get the HarmonicMean
     * 
     * @param array $values
     * @param null $count
     * @param bool $ignoreInvalidValues
     * @return float     
     *
     */ 
    public static function harmonicMean(array $values, $count = null, bool $ignoreInvalidValues = false)
    {
        if(is_numeric($count) && $count != null){
            $values = array_splice($values, 0, $count);
        }

        // Applies function param shift
        if(func_num_args() == 2 && is_bool($count)) {
            $ignoreInvalidValues = $count;
        }

        $values = array_map(function($value) use ($ignoreInvalidValues){
            if ($ignoreInvalidValues && !is_numeric($value)) {
                return null;
            }

            if(!is_numeric($value)) {
                throw new Exception('Null, Zero or non numeric values found in array.');
            }

            return $value + 0;

        }, $values);

        if($ignoreInvalidValues) {
            $values = array_filter($values, function ($value) {
                return $value !== null;
            });
        }

        $mean = array_reduce($values, function($carry, $value) use ($ignoreInvalidValues) {
            return $carry + (float) 1 / $value;
        }, 0);

        return (float) sizeof($values) / $mean;

    }
}
