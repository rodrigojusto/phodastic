<?php
/**
 * Created by PhpStorm.
 * User: n5802063
 * Date: 10/09/2018
 * Time: 13:23
 */

namespace RodrigoJusto\Phodastic;

use RodrigoJusto\Phodastic\Math\Financial;
use RodrigoJusto\Phodastic\Math\Math;

/**
 * Main class for Phodastic library
 */
class Phodastic
{
    /**
     * Calculate simple interest
     * 
     * @param float $capital Initial capital
     * @param float $rate Interest rate (decimal)
     * @param int $period Time period
     * @return float Interest amount
     */
    public static function simpleInterest(float $capital, float $rate, int $period): float {
        return Financial::simpleInterest($capital, $rate, $period);
    }
    
    /**
     * Calculate compound interest
     * 
     * @param float $capital Initial capital
     * @param float $rate Interest rate (decimal)
     * @param int $period Time period
     * @return float Final amount
     */
    public static function compoundInterest(float $capital, float $rate, int $period): float {
        return Financial::compoundInterest($capital, $rate, $period);
    }
    
    /**
     * Calculate future value
     * 
     * @param float $pv Present value
     * @param float $rate Interest rate (decimal)
     * @param int $period Number of periods
     * @return float Future value
     */
    public static function futureValue(float $pv, float $rate, int $period): float {
        return Financial::futureValue($pv, $rate, $period);
    }
    
    /**
     * Calculate present value
     * 
     * @param float $fv Future value
     * @param float $rate Interest rate (decimal)
     * @param int $period Number of periods
     * @return float Present value
     */
    public static function presentValue(float $fv, float $rate, int $period): float {
        return Financial::presentValue($fv, $rate, $period);
    }
    
    /**
     * Calculate harmonic mean
     * 
     * @param array $values Array of values
     * @param mixed $count Number of values to use or boolean for ignoreInvalidValues
     * @param bool $ignoreInvalidValues Whether to ignore invalid values
     * @return float Harmonic mean
     */
    public static function harmonicMean(array $values, $count = null, bool $ignoreInvalidValues = false): float {
        return Math::harmonicMean($values, $count, $ignoreInvalidValues);
    }
}