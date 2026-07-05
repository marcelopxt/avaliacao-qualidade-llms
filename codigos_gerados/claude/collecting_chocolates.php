<?php

class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $x
     * @return Integer
     */
    function minCost($nums, $x) {
        $n = count($nums);
        $best = array_fill(0, $n, PHP_INT_MAX);
        $total = 0;
        $ans = PHP_INT_MAX;

        for ($k = 0; $k < $n; $k++) {
            for ($i = 0; $i < $n; $i++) {
                $type = ($i - $k % $n + $n) % $n;
                if ($nums[$i] < $best[$type]) {
                    $best[$type] = $nums[$i];
                }
            }
            $sum = 0;
            for ($t = 0; $t < $n; $t++) {
                $sum += $best[$t];
            }
            $cost = $sum + $k * $x;
            if ($cost < $ans) {
                $ans = $cost;
            }
        }

        return $ans;
    }
}
?>
