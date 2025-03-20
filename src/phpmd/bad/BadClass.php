<?php

namespace App\phpmd\bad;

class BadClass
{
    private $unusedVariable = 42;

    public function complexMethod(): void
    {
        $sum = 0;
        for ($i = 0; $i < 100; $i++) {
            if ($i > 3) {
                if ($sum <= 15) {
                    if ($i % 2 === 0) {
                        $i = $i > 12 ? 13 : 11;
                    } else {
                        $i = $i > 15 ? 13 : 11;
                    }
                } elseif ($i % 2 === 0) {
                    $i = $i > 12 ? 13 : 11;
                }
            } elseif ($i % 2 === 0) {
                $i = $i > 1 ? 13 : 11;
            }
            $sum += $i;
        }
        echo $sum;
    }
}
