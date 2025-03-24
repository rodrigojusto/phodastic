<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

final class FinancialTest extends TestCase {
    public function testSimpleInterest(): void {
        $this->assertEquals(200.0, \RodrigoJusto\Phodastic\Math\Financial::simpleInterest(1000, 0.1, 2));
    }
    
    public function testCompoundInterest(): void {
        $this->assertEquals(1210.0, round(\RodrigoJusto\Phodastic\Math\Financial::compoundInterest(1000, 0.1, 2), 2));
    }
    
    public function testFutureValue(): void {
        $this->assertEquals(1210.0, round(\RodrigoJusto\Phodastic\Math\Financial::futureValue(1000, 0.1, 2), 2));
    }
    
    public function testPresentValue(): void {
        $this->assertEquals(826.45, round(\RodrigoJusto\Phodastic\Math\Financial::presentValue(1000, 0.1, 2), 2));
    }
    
    public function testPayment(): void {
        $this->assertEquals(1162.95, round(\RodrigoJusto\Phodastic\Math\Financial::payment(2000, 0.1, 2), 2));
    }
    
    public function testNpv(): void {
        $cashflows = [
            0 => -1000,
            1 => 500,
            2 => 600,
            3 => 800
        ];
        $this->assertEquals(609.61, round(\RodrigoJusto\Phodastic\Math\Financial::npv(0.1, $cashflows), 2));
    }
    
    public function testIrr(): void {
        $cashflows = [
            0 => -1000,
            1 => 500,
            2 => 600,
            3 => 800
        ];
        $this->assertEquals(0.4, round(\RodrigoJusto\Phodastic\Math\Financial::irr($cashflows), 1));
    }
    
    public function testCalculateTax(): void {
        $this->assertEquals(200.0, \RodrigoJusto\Phodastic\Math\Financial::calculateTax(1000, 0.2));
    }
    
    public function testAmountAfterTax(): void {
        $this->assertEquals(1200.0, \RodrigoJusto\Phodastic\Math\Financial::amountAfterTax(1000, 0.2));
    }
    
    public function testAmountBeforeTax(): void {
        $this->assertEquals(1000.0, \RodrigoJusto\Phodastic\Math\Financial::amountBeforeTax(1200, 0.2));
    }
    
    public function testStraightLineDepreciation(): void {
        $this->assertEquals(900.0, \RodrigoJusto\Phodastic\Math\Financial::straightLineDepreciation(10000, 1000, 10));
    }
    
    public function testDecliningBalanceDepreciation(): void {
        $this->assertEquals(2000.0, \RodrigoJusto\Phodastic\Math\Financial::decliningBalanceDepreciation(10000, 1000, 10, 2.0, 1));
    }
}