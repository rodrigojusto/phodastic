<?php

namespace RodrigoJusto\Phodastic\Math;

use \Exception;

/**
 * Financial class for various financial calculations
 */
class Financial {
    /**
     * Calculate simple interest
     * 
     * @param float $capital Initial capital
     * @param float $rate Interest rate (decimal)
     * @param int $period Time period
     * @return float Interest amount
     */
    public static function simpleInterest(float $capital, float $rate, int $period): float {
        return $capital * $rate * $period;
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
        return $capital * pow((1 + $rate), $period);
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
        return $pv * pow((1 + $rate), $period);
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
        return $fv / pow((1 + $rate), $period);
    }
    
    /**
     * Calculate payment for a loan
     * 
     * @param float $principal Loan amount
     * @param float $rate Interest rate per period (decimal)
     * @param int $periods Number of periods
     * @return float Payment amount per period
     */
    public static function payment(float $principal, float $rate, int $periods): float {
        if ($rate == 0) {
            return $principal / $periods;
        }
        
        return $principal * $rate * pow(1 + $rate, $periods) / (pow(1 + $rate, $periods) - 1);
    }
    
    /**
     * Calculate net present value
     * 
     * @param float $rate Discount rate
     * @param array $cashflows Array of cash flows
     * @return float Net present value
     */
    public static function npv(float $rate, array $cashflows): float {
        $npv = 0;
        
        foreach ($cashflows as $period => $cashflow) {
            $npv += $cashflow / pow(1 + $rate, $period);
        }
        
        return $npv;
    }
    
    /**
     * Calculate internal rate of return
     * 
     * @param array $cashflows Array of cash flows
     * @param float $guess Initial guess (default 0.1)
     * @return float|null Internal rate of return or null if not converging
     */
    public static function irr(array $cashflows, float $guess = 0.1): ?float {
        $maxIterations = 100;
        $tolerance = 0.00001;
        
        $rate = $guess;
        
        for ($i = 0; $i < $maxIterations; $i++) {
            $npv = self::npv($rate, $cashflows);
            
            if (abs($npv) < $tolerance) {
                return $rate;
            }
            
            // Calculate derivative of NPV function
            $derivative = 0;
            foreach ($cashflows as $period => $cashflow) {
                $derivative -= $period * $cashflow / pow(1 + $rate, $period + 1);
            }
            
            // Newton-Raphson method
            $newRate = $rate - $npv / $derivative;
            
            if (abs($newRate - $rate) < $tolerance) {
                return $newRate;
            }
            
            $rate = $newRate;
        }
        
        return null; // Did not converge
    }
    
    /**
     * Calculate tax amount
     * 
     * @param float $amount Amount to be taxed
     * @param float $taxRate Tax rate (decimal)
     * @return float Tax amount
     */
    public static function calculateTax(float $amount, float $taxRate): float {
        return $amount * $taxRate;
    }
    
    /**
     * Calculate amount after tax
     * 
     * @param float $amount Pre-tax amount
     * @param float $taxRate Tax rate (decimal)
     * @return float Amount after tax
     */
    public static function amountAfterTax(float $amount, float $taxRate): float {
        return $amount * (1 + $taxRate);
    }
    
    /**
     * Calculate amount before tax
     * 
     * @param float $amountWithTax Amount including tax
     * @param float $taxRate Tax rate (decimal)
     * @return float Amount before tax
     */
    public static function amountBeforeTax(float $amountWithTax, float $taxRate): float {
        return $amountWithTax / (1 + $taxRate);
    }
    
    /**
     * Calculate depreciation using straight-line method
     * 
     * @param float $cost Initial cost
     * @param float $salvage Salvage value
     * @param int $life Useful life
     * @return float Annual depreciation
     */
    public static function straightLineDepreciation(float $cost, float $salvage, int $life): float {
        return ($cost - $salvage) / $life;
    }
    
    /**
     * Calculate depreciation using declining balance method
     * 
     * @param float $cost Initial cost
     * @param float $salvage Salvage value
     * @param int $life Useful life
     * @param float $factor Depreciation factor (default 2 for double declining)
     * @param int $period Period to calculate depreciation for
     * @return float Depreciation for the period
     */
    public static function decliningBalanceDepreciation(float $cost, float $salvage, int $life, float $factor = 2.0, int $period = 1): float {
        $rate = $factor / $life;
        $accumulatedDepreciation = 0;
        $currentValue = $cost;
        
        for ($i = 1; $i <= $period; $i++) {
            $depreciation = $currentValue * $rate;
            
            // Switch to straight-line if it gives higher depreciation
            $remainingLife = $life - $i + 1;
            $straightLine = ($currentValue - $salvage) / $remainingLife;
            
            if ($straightLine > $depreciation) {
                $depreciation = $straightLine;
            }
            
            // Don't depreciate below salvage value
            if ($currentValue - $depreciation < $salvage) {
                $depreciation = $currentValue - $salvage;
            }
            
            $currentValue -= $depreciation;
            
            if ($i == $period) {
                return $depreciation;
            }
        }
        
        return 0;
    }
}