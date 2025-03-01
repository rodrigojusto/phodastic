<?php

namespace RodrigoJusto\Phodastic\Math;

use \Exception;

/**
 * Financial class provides various financial calculations including
 * interest, tax, rates, loans, investments, and depreciation.
 */
class Financial {
    /**
     * Calculate simple interest
     * 
     * @param float $capital The principal amount
     * @param float $rate The interest rate (decimal)
     * @param int $period The time period
     * @return float The simple interest amount
     */
    public static function simpleInterest(float $capital, float $rate, int $period): float {
        return $capital * $rate * $period;
    }
    
    /**
     * Calculate compound interest
     * 
     * @param float $capital The principal amount
     * @param float $rate The interest rate (decimal)
     * @param int $period The time period
     * @return float The final amount after compound interest
     */
    public static function compoundInterest(float $capital, float $rate, int $period): float {
        return $capital * pow((1 + $rate), $period);
    }
    
    /**
     * Calculate future value of an investment
     * 
     * @param float $presentValue The present value
     * @param float $rate The interest rate (decimal)
     * @param int $period The time period
     * @return float The future value
     */
    public static function futureValue(float $presentValue, float $rate, int $period): float {
        return $presentValue * pow((1 + $rate), $period);
    }
    
    /**
     * Calculate present value of a future amount
     * 
     * @param float $futureValue The future value
     * @param float $rate The discount rate (decimal)
     * @param int $period The time period
     * @return float The present value
     */
    public static function presentValue(float $futureValue, float $rate, int $period): float {
        return $futureValue / pow((1 + $rate), $period);
    }
    
    /**
     * Calculate sales tax
     * 
     * @param float $amount The amount before tax
     * @param float $taxRate The tax rate (decimal)
     * @return float The tax amount
     */
    public static function salesTax(float $amount, float $taxRate): float {
        return $amount * $taxRate;
    }
    
    /**
     * Calculate total amount with sales tax
     * 
     * @param float $amount The amount before tax
     * @param float $taxRate The tax rate (decimal)
     * @return float The total amount including tax
     */
    public static function amountWithTax(float $amount, float $taxRate): float {
        return $amount * (1 + $taxRate);
    }
    
    /**
     * Calculate monthly payment for a loan
     * 
     * @param float $principal The loan amount
     * @param float $annualRate The annual interest rate (decimal)
     * @param int $years The loan term in years
     * @return float The monthly payment
     */
    public static function monthlyPayment(float $principal, float $annualRate, int $years): float {
        $monthlyRate = $annualRate / 12;
        $numberOfPayments = $years * 12;
        
        return $principal * ($monthlyRate * pow(1 + $monthlyRate, $numberOfPayments)) / 
               (pow(1 + $monthlyRate, $numberOfPayments) - 1);
    }
    
    /**
     * Calculate straight-line depreciation
     * 
     * @param float $cost The initial cost
     * @param float $salvage The salvage value
     * @param int $life The useful life in years
     * @return float The annual depreciation
     */
    public static function straightLineDepreciation(float $cost, float $salvage, int $life): float {
        return ($cost - $salvage) / $life;
    }
    
    /**
     * Calculate net present value (NPV)
     * 
     * @param float $rate The discount rate (decimal)
     * @param array $cashFlows Array of cash flows (initial investment as negative)
     * @return float The net present value
     */
    public static function netPresentValue(float $rate, array $cashFlows): float {
        $npv = 0;
        
        foreach ($cashFlows as $period => $cashFlow) {
            $npv += $cashFlow / pow(1 + $rate, $period);
        }
        
        return $npv;
    }
    
    /**
     * Calculate return on investment (ROI)
     * 
     * @param float $gain The gain from investment
     * @param float $cost The cost of investment
     * @return float The ROI as a decimal
     */
    public static function returnOnInvestment(float $gain, float $cost): float {
        if ($cost == 0) {
            throw new Exception('Division by zero: Cost cannot be zero.');
        }
        
        return ($gain - $cost) / $cost;
    }
    
    /**
     * Calculate inflation-adjusted value
     * 
     * @param float $presentValue The present value
     * @param float $inflationRate The inflation rate (decimal)
     * @param int $years The number of years
     * @return float The inflation-adjusted value
     */
    public static function inflationAdjustedValue(float $presentValue, float $inflationRate, int $years): float {
        return $presentValue / pow(1 + $inflationRate, $years);
    }
    
    /**
     * Calculate effective annual rate
     * 
     * @param float $nominalRate The nominal annual rate (decimal)
     * @param int $compoundingsPerYear The number of compoundings per year
     * @return float The effective annual rate
     */
    public static function effectiveAnnualRate(float $nominalRate, int $compoundingsPerYear): float {
        return pow(1 + $nominalRate / $compoundingsPerYear, $compoundingsPerYear) - 1;
    }
}