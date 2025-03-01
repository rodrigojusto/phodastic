<?php

use PHPUnit\Framework\TestCase;
use RodrigoJusto\Phodastic\Math\Financial;

class FinancialTest extends TestCase
{
    /**
     * Test simple interest calculation
     */
    public function testSimpleInterest()
    {
        $this->assertEquals(200, Financial::simpleInterest(1000, 0.1, 2));
        $this->assertEquals(0, Financial::simpleInterest(0, 0.1, 2));
        $this->assertEquals(0, Financial::simpleInterest(1000, 0, 2));
        $this->assertEquals(0, Financial::simpleInterest(1000, 0.1, 0));
    }

    /**
     * Test compound interest calculation
     */
    public function testCompoundInterest()
    {
        $this->assertEquals(1210, Financial::compoundInterest(1000, 0.1, 2), '', 0.01);
        $this->assertEquals(0, Financial::compoundInterest(0, 0.1, 2));
        $this->assertEquals(1000, Financial::compoundInterest(1000, 0, 2));
        $this->assertEquals(1000, Financial::compoundInterest(1000, 0.1, 0));
    }

    /**
     * Test future value calculation
     */
    public function testFutureValue()
    {
        $this->assertEquals(1210, Financial::futureValue(1000, 0.1, 2), '', 0.01);
        $this->assertEquals(0, Financial::futureValue(0, 0.1, 2));
        $this->assertEquals(1000, Financial::futureValue(1000, 0, 2));
        $this->assertEquals(1000, Financial::futureValue(1000, 0.1, 0));
    }

    /**
     * Test present value calculation
     */
    public function testPresentValue()
    {
        $this->assertEquals(826.45, Financial::presentValue(1000, 0.1, 2), '', 0.01);
        $this->assertEquals(0, Financial::presentValue(0, 0.1, 2));
        $this->assertEquals(1000, Financial::presentValue(1000, 0, 2));
        $this->assertEquals(1000, Financial::presentValue(1000, 0.1, 0));
    }

    /**
     * Test sales tax calculation
     */
    public function testSalesTax()
    {
        $this->assertEquals(100, Financial::salesTax(1000, 0.1));
        $this->assertEquals(0, Financial::salesTax(0, 0.1));
        $this->assertEquals(0, Financial::salesTax(1000, 0));
    }

    /**
     * Test amount with tax calculation
     */
    public function testAmountWithTax()
    {
        $this->assertEquals(1100, Financial::amountWithTax(1000, 0.1));
        $this->assertEquals(0, Financial::amountWithTax(0, 0.1));
        $this->assertEquals(1000, Financial::amountWithTax(1000, 0));
    }

    /**
     * Test monthly payment calculation
     */
    public function testMonthlyPayment()
    {
        $this->assertEquals(193.33, Financial::monthlyPayment(10000, 0.06, 5), '', 0.01);
        $this->assertEquals(0, Financial::monthlyPayment(0, 0.06, 5));
        $this->assertEquals(166.67, Financial::monthlyPayment(10000, 0, 5), '', 0.01);
    }

    /**
     * Test straight-line depreciation calculation
     */
    public function testStraightLineDepreciation()
    {
        $this->assertEquals(1800, Financial::straightLineDepreciation(10000, 1000, 5));
        $this->assertEquals(0, Financial::straightLineDepreciation(1000, 1000, 5));
        $this->assertEquals(2000, Financial::straightLineDepreciation(10000, 0, 5));
    }

    /**
     * Test net present value calculation
     */
    public function testNetPresentValue()
    {
        $cashFlows = [
            0 => -1000,
            1 => 300,
            2 => 400,
            3 => 500
        ];
        $this->assertEquals(0.08, Financial::netPresentValue(0.1, $cashFlows), '', 0.01);
    }

    /**
     * Test return on investment calculation
     */
    public function testReturnOnInvestment()
    {
        $this->assertEquals(0.2, Financial::returnOnInvestment(1200, 1000));
        $this->assertEquals(-0.2, Financial::returnOnInvestment(800, 1000));
    }

    /**
     * Test exception for division by zero in ROI
     */
    public function testReturnOnInvestmentException()
    {
        $this->expectException(Exception::class);
        Financial::returnOnInvestment(1200, 0);
    }

    /**
     * Test inflation-adjusted value calculation
     */
    public function testInflationAdjustedValue()
    {
        $this->assertEquals(826.45, Financial::inflationAdjustedValue(1000, 0.1, 2), '', 0.01);
        $this->assertEquals(0, Financial::inflationAdjustedValue(0, 0.1, 2));
        $this->assertEquals(1000, Financial::inflationAdjustedValue(1000, 0, 2));
        $this->assertEquals(1000, Financial::inflationAdjustedValue(1000, 0.1, 0));
    }

    /**
     * Test effective annual rate calculation
     */
    public function testEffectiveAnnualRate()
    {
        $this->assertEquals(0.1038, Financial::effectiveAnnualRate(0.1, 12), '', 0.0001);
        $this->assertEquals(0, Financial::effectiveAnnualRate(0, 12));
        $this->assertEquals(0.1, Financial::effectiveAnnualRate(0.1, 1), '', 0.0001);
    }
}