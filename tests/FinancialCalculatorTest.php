<?php
    use PHPUnit\Framework\TestCase;

    require_once './src/FinancialCalculator.php';

    class FinancialCalculatorTest extends TestCase {
        private FinancialCalculator $financialCalculator;

        public function setUp(): void {
            $this->financialCalculator = new FinancialCalculator();
        }

        public function testCalculateSimpleInsterest() {
            $result = $this->financialCalculator->calculateSimpleInterest(1000, 0.1, 1);

            $this->assertEquals(100.0, $result);
        }

        public function testCalculateSimpleInsterestWithInvalidFirstParameter() {
            $this->expectExceptionMessage('Um(a) capital válido(a) deve ser fornecido(a)');
            $this->financialCalculator->calculateSimpleInterest('string', 0.1, 1);
        }

        public function testCalculateSimpleInsterestWithInvalidSecondParameter() {
            $this->expectExceptionMessage('Um(a) taxa válido(a) deve ser fornecido(a)');
            $this->financialCalculator->calculateSimpleInterest(1000, -0.1, 1);
        }

        public function testCalculateSimpleInsterestWithInvalidThirdParameter() {
            $this->expectExceptionMessage('Um(a) tempo válido(a) deve ser fornecido(a)');
            $this->financialCalculator->calculateSimpleInterest(1000, 0.1, -1);
        }

        public function testCalculateCompoundInsterest() {
            $result = $this->financialCalculator->calculateCompoundInterest(1000, 0.1, 2);

            $this->assertEquals(210.0, $result);
        }

        public function testCalculateCompoundInsterestWithInvalidFirstParameter() {
            $this->expectExceptionMessage('Um(a) capital válido(a) deve ser fornecido(a)');
            $this->financialCalculator->calculateCompoundInterest('string', 0.1, 2);
        }

        public function testCalculateCompoundInsterestWithInvalidSecondParameter() {
            $this->expectExceptionMessage('Um(a) taxa válido(a) deve ser fornecido(a)');
            $this->financialCalculator->calculateCompoundInterest(1000, true, 2);
        }

        public function testCalculateCompoundInsterestWithInvalidThirdParameter() {
            $this->expectExceptionMessage('Um(a) tempo válido(a) deve ser fornecido(a)');
            $this->financialCalculator->calculateCompoundInterest(1000, 0.1, -2);
        }

        public function testCalculateAmortizationSAC() {
            $result = $this->financialCalculator->calculateAmortization(1000, 0.12, 1, 'SAC');

            $this->assertEquals([
                0 => [
                    'amortization' => 83.33
                ],
                1 => [
                    'amortization' => 83.33
                ],
                2 => [
                    'amortization' => 83.33
                ],
                3 => [
                    'amortization' => 83.33
                ],
                4 => [
                    'amortization' => 83.33
                ],
                5 => [
                    'amortization' => 83.33
                ],
                6 => [
                    'amortization' => 83.33
                ],
                7 => [
                    'amortization' => 83.33
                ],
                8 => [
                    'amortization' => 83.33
                ],
                9 => [
                    'amortization' => 83.33
                ],
                10 => [
                    'amortization' => 83.33
                ],
                11 => [
                    'amortization' => 83.33
                ],
                'totalFee' => 65.0
            ], $result);
        }

        public function testCalculateAmortizationPrice() {
            $result = $this->financialCalculator->calculateAmortization(1000, 0.12, 1, 'Price');

            $this->assertEquals([
                0 => [
                    'amortization' => 78.85
                ],
                1 => [
                    'amortization' => 79.64
                ],
                2 => [
                    'amortization' => 80.43
                ],
                3 => [
                    'amortization' => 81.24
                ],
                4 => [
                    'amortization' => 82.05
                ],
                5 => [
                    'amortization' => 82.87
                ],
                6 => [
                    'amortization' => 83.70
                ],
                7 => [
                    'amortization' => 84.54
                ],
                8 => [
                    'amortization' => 85.38
                ],
                9 => [
                    'amortization' => 86.24
                ],
                10 => [
                    'amortization' => 87.10
                ],
                11 => [
                    'amortization' => 87.97
                ],
                'totalFee' => 66.19
            ], $result);
        }

        public function testCalculateAmortizationWithInvalidFirstParameter() {
            $this->expectExceptionMessage('Um(a) capital válido(a) deve ser fornecido(a)');
            $this->financialCalculator->calculateAmortization(-1000, 0.1, 2, 'Price');
        }

        public function testCalculateAmortizationWithInvalidSecondParameter() {
            $this->expectExceptionMessage('Um(a) taxa válido(a) deve ser fornecido(a)');
            $this->financialCalculator->calculateAmortization(1000, null, 2, 'SAC');
        }

        public function testCalculateAmortizationWithInvalidThirdParameter() {
            $this->expectExceptionMessage('Um(a) tempo válido(a) deve ser fornecido(a)');
            $this->financialCalculator->calculateAmortization(1000, 0.1, -2, 'SAC');
        }

        public function testCalculateAmortizationWithInvalidFourthParameter() {
            $this->expectExceptionMessage('Um(a) tipo válido(a) deve ser fornecido(a)');
            $this->financialCalculator->calculateAmortization(1000, 0.1, 2, 'outro');
        }
    }
?>