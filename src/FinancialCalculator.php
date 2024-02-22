<?php
    class FinancialCalculator {
        public function calculateSimpleInterest(mixed $capital, mixed $rate, mixed $time): float {
            $elements = [
                'capital' => $capital,
                'taxa' => $rate,
                'tempo' => $time
            ];

            $this->validateElements($elements);

            return $capital * $rate * $time;
        }

        public function calculateCompoundInterest(mixed $capital, mixed $rate, mixed $time): float {
            $elements = [
                'capital' => $capital,
                'taxa' => $rate,
                'tempo' => $time
            ];

            $this->validateElements($elements);

            $totalInterest = 0;

            for ($i = 0; $i < $time; $i++) {
                $totalInterest += ($capital + $totalInterest) * $rate;
            }

            return $totalInterest;
        }

        public function calculateAmortization(mixed $capital, mixed $rate, mixed $time, mixed $type): array {
            $elements = [
                'capital' => $capital,
                'taxa' => $rate,
                'tempo' => $time,
                'tipo' => $type
            ];

            //$this->validateElements($elements);

            $parcelsNumber = $time * 12;
            $monthlyRate = $rate / 12;
            $outstandingBalance = $capital;

            $data = [];

            if ($type === 'SAC') {
                
            }

            if ($type === 'Price') {
                for ($i = 0; $i < $parcelsNumber; $i++) {
                    $parcelValue = ($capital) * ((pow(1 + $monthlyRate, $parcelsNumber) * $monthlyRate) / ((pow(1 + $monthlyRate, $parcelsNumber) - 1)));
                    $fee = $outstandingBalance * $monthlyRate;
                    $amortization = $parcelValue - $fee;
                    $outstandingBalance = $outstandingBalance > 0 ? $outstandingBalance - $amortization : 0;

                    array_push($data, [
                        'parcelValue' => round($parcelValue, 2),
                        'fee' => round($fee, 2),
                        'amortization' => round($amortization, 2),
                        'outstandingValue' => round($outstandingBalance, 2)
                    ]);
                }
            }

            return $data;
        }

        private function validateElements(array $elements): void {
            foreach ($elements as $key=>$value) {
                if (($key === 'tipo' && !in_array($value, ['SAC', 'Price'])) || !is_numeric($value) || $value <= 0) {
                    throw new Exception("Um(a) $key válido(a) deve ser fornecido(a)");
                }
            }
        }
    }
?>