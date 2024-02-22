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
            ];

            $this->validateElements($elements);

            if (!in_array($type, ['SAC', 'Price'])) {
                throw new Exception("Um(a) tipo válido(a) deve ser fornecido(a)");
            }

            $parcelsNumber = ceil($time * 12);
            $monthlyRate = $rate / 12;
            $outstandingBalance = $capital;

            $totalFee = 0;

            if ($type === 'SAC') {
                $amortization = $capital / $parcelsNumber;

                for ($i = 0; $i < $parcelsNumber; $i++) {
                    $fee = $outstandingBalance * $monthlyRate;
                    $parcelValue = $outstandingBalance + $fee;
                    $outstandingBalance -= $amortization;

                    $data[$i] = [
                        'amortization' => round($amortization, 2),
                    ];

                    $totalFee += $fee;
                }
            }

            if ($type === 'Price') {
                for ($i = 0; $i < $parcelsNumber; $i++) {
                    $parcelValue = ($capital) * ((pow(1 + $monthlyRate, $parcelsNumber) * $monthlyRate) / ((pow(1 + $monthlyRate, $parcelsNumber) - 1)));
                    $fee = $outstandingBalance * $monthlyRate;
                    $amortization = $parcelValue - $fee;
                    $outstandingBalance -= $amortization;

                    $data[$i] = [
                        'amortization' => round($amortization, 2),
                    ];

                    $totalFee += $fee;
                }
            }

            $data['totalFee'] = round($totalFee, 2);

            return $data;
        }

        private function validateElements(array $elements): void {
            foreach ($elements as $key=>$value) {
                if (!is_numeric($value) || $value <= 0) {
                    throw new Exception("Um(a) $key válido(a) deve ser fornecido(a)");
                }
            }
        }
    }
?>