<?php
    use PHPUnit\Framework\TestCase;

    require_once './src/FinancialCalculator.php';

    class FinancialCalculatorTest extends TestCase {
        private FinancialCalculator $financialCalculator;

        public function setUp(): void {
            $this->financialCalculator = new FinancialCalculator();
        }

        public function testCalculateSimpleInsterest() {
            $this->assertEquals(100.0, $this->financialCalculator->calculateSimpleInterest(1000, 0.1, 1));
        }

        public function testCalculateSimpleInsterestWithInvalidFirstParameter() {
            $this->expectExceptionMessage('Um(a) capital válido(a) deve ser fornecido(a)');
            $this->assertEquals(100, $this->financialCalculator->calculateSimpleInterest('string', 0.1, 1));
        }

        public function testCalculateSimpleInsterestWithInvalidSecondParameter() {
            $this->expectExceptionMessage('Um(a) taxa válido(a) deve ser fornecido(a)');
            $this->assertEquals(100, $this->financialCalculator->calculateSimpleInterest(1000, -0.1, 1));
        }

        public function testCalculateSimpleInsterestWithInvalidThirdParameter() {
            $this->expectExceptionMessage('Um(a) tempo válido(a) deve ser fornecido(a)');
            $this->assertEquals(100, $this->financialCalculator->calculateSimpleInterest(1000, 0.1, -1));
        }

        public function testCalculateCompoundInsterest() {
            $this->assertEquals(210.0, $this->financialCalculator->calculateCompoundInterest(1000, 0.1, 2));
        }

        public function testCalculateCompoundInsterestWithInvalidFirstParameter() {
            $this->expectExceptionMessage('Um(a) capital válido(a) deve ser fornecido(a)');
            $this->assertEquals(210, $this->financialCalculator->calculateCompoundInterest('string', 0.1, 2));
        }

        public function testCalculateCompoundInsterestWithInvalidSecondParameter() {
            $this->expectExceptionMessage('Um(a) taxa válido(a) deve ser fornecido(a)');
            $this->assertEquals(210, $this->financialCalculator->calculateCompoundInterest(1000, true, 2));
        }

        public function testCalculateCompoundInsterestWithInvalidThirdParameter() {
            $this->expectExceptionMessage('Um(a) tempo válido(a) deve ser fornecido(a)');
            $this->assertEquals(210, $this->financialCalculator->calculateCompoundInterest(1000, 0.1, -2));
        }

        public function testCalculateAmortizationSAC() {
            $this->assertEquals([], $this->financialCalculator->calculateAmortization(1000, 0.1, 2, 'SAC'));
        }

        public function testCalculateAmortizationPrice() {
            $this->assertEquals([
                0 => [
                    'fee' => 10,
                    'amortization' => 78.85
                ],
                1 => [
                    'fee' => 9.21,
                    'amortization' => 79.64
                ],
                2 => [
                    'fee' => 8.42,
                    'amortization' => 80.43
                ],
                3 => [
                    'fee' => 7.61,
                    'amortization' => 81.24
                ],
                4 => [
                    'fee' => 6.80,
                    'amortization' => 82.05
                ],
                5 => [
                    'fee' => 5.98,
                    'amortization' => 82.87
                ],
                6 => [
                    'fee' => 5.15,
                    'amortization' => 83.70
                ],
                7 => [
                    'fee' => 4.31,
                    'amortization' => 84.54
                ],
                8 => [
                    'fee' => 3.47,
                    'amortization' => 85.38
                ],
                9 => [
                    'fee' => 2.61,
                    'amortization' => 86.24
                ],
                10 => [
                    'fee' => 1.75,
                    'amortization' => 87.10
                ],
                11 => [
                    'fee' => 0.88,
                    'amortization' => 87.97
                ],
            ], $this->financialCalculator->calculateAmortization(1000, 0.1, 2, 'Price'));
        }

        public function testCalculateAmortizationWithInvalidFirstParameter() {
            $this->expectExceptionMessage('Um(a) capital válido(a) deve ser fornecido(a)');
            $this->assertEquals([], $this->financialCalculator->calculateAmortization(-1000, 0.1, 2, 'Price'));
        }

        public function testCalculateAmortizationWithInvalidSecondParameter() {
            $this->expectExceptionMessage('Um(a) taxa válido(a) deve ser fornecido(a)');
            $this->assertEquals([], $this->financialCalculator->calculateAmortization(1000, null, 2, 'SAC'));
        }

        public function testCalculateAmortizationWithInvalidThirdParameter() {
            $this->expectExceptionMessage('Um(a) tempo válido(a) deve ser fornecido(a)');
            $this->assertEquals([], $this->financialCalculator->calculateAmortization(1000, 0.1, -2, 'SAC'));
        }

        public function testCalculateAmortizationWithInvalidFourthParameter() {
            $this->expectExceptionMessage('Um(a) tipo válido(a) deve ser fornecido(a)');
            $this->assertEquals([], $this->financialCalculator->calculateAmortization(1000, 0.1, 2, 'outro'));
        }
    }
?>