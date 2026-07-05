<?php

class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function numberOfGoodSubsets($nums) {
        $MOD = 1000000007;
        $primes = [2,3,5,7,11,13,17,19,23,29];
        $numPrimes = count($primes);

        $count = array_fill(0, 31, 0);
        foreach ($nums as $n) {
            $count[$n]++;
        }

        $ones = $count[1];

        $dp = array_fill(0, 1 << $numPrimes, 0);
        $dp[0] = 1;

        for ($num = 2; $num <= 30; $num++) {
            if ($count[$num] == 0) continue;

            $x = $num;
            $mask = 0;
            $isSquareFree = true;
            for ($i = 0; $i < $numPrimes; $i++) {
                $p = $primes[$i];
                if ($x % $p == 0) {
                    $cnt = 0;
                    while ($x % $p == 0) {
                        $x /= $p;
                        $cnt++;
                    }
                    if ($cnt > 1) {
                        $isSquareFree = false;
                        break;
                    }
                    $mask |= (1 << $i);
                }
            }

            if (!$isSquareFree) continue;

            $newDp = $dp;
            for ($m = 0; $m < (1 << $numPrimes); $m++) {
                if ($dp[$m] == 0) continue;
                if (($m & $mask) == 0) {
                    $nm = $m | $mask;
                    $newDp[$nm] = ($newDp[$nm] + $dp[$m] * $count[$num]) % $MOD;
                }
            }
            $dp = $newDp;
        }

        $result = 0;
        for ($m = 1; $m < (1 << $numPrimes); $m++) {
            $result = ($result + $dp[$m]) % $MOD;
        }

        $multiplier = 1;
        for ($i = 0; $i < $ones; $i++) {
            $multiplier = ($multiplier * 2) % $MOD;
        }

        $result = ($result * $multiplier) % $MOD;

        return $result;
    }
}
?>
