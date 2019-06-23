<?php
/**
 * Created by PhpStorm.
 * User: n5802063
 * Date: 10/09/2018
 * Time: 13:25
 */

namespace RodrigoJusto\Phodastic\Math;

use \Exception;

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

    public static function harmonicMean(array $values, int $countValues=null ): float
    {
        /** Initializes $sum with 0 */
        $sum = 0.0;
        /** Verifies if countValues has especified otherwise get from size of $values */
        if($countValues == null){
            $countValues = sizeof($values);
        }
        foreach ($values as $value){
            try{
                $sum = $sum + (float)(1/$value);
            }catch (Exception $e){
                return $e->getMessage();
            }
        }
        /** Calculate Harmonic Mean and return after */
        $hmean = (float)($countValues/$sum);
        return $hmean;
    }

}