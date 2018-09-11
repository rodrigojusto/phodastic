<?php
/**
 * Created by PhpStorm.
 * User: n5802063
 * Date: 10/09/2018
 * Time: 13:25
 */

namespace RodrigoJusto\Phodastic\Math;


use PHPUnit\Runner\Exception;

class Math
{
    public static function harmonicMeanIgnoreInvalidValues(array $values, int $countValues=null ): float
    {
        /** Initializes $sum with 0 */
        $sum = 0.0;
        /** Verifies if countValues has especified otherwise get from size of $values */
        if($countValues == null){
            $countValues = sizeof($values);
        }
        foreach ($values as $value){
            /** Checks if it is a valid number otherwise subtract 1 from $ countValue and ignore the current value */
            if(!is_numeric($value) || $value==0){
                $countValues--;
                continue;
            }

            $sum = $sum + (float)(1/$value);
        }
        /** Calculate Harmonic Mean and return after */
        $hmean = (float)($countValues/$sum);

        unset($sum, $values, $countValues);
        return $hmean;
    }

    /**
     * Get the HarmonicMean
     * 
     * @param array $values
     * @param null $count
     * @param bool $ignoreInvalidValues
     * @return float     
     *
     */ 
    function harmonicMean(array $values, $count = null, bool $ignoreInvalidValues = false)
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
