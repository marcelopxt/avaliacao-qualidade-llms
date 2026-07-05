<?php

class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $k
     * @return Integer
     */
    function sumDivisibleByK($nums, $k) {
        $freq = [];
        foreach ($nums as $n) {
            if (!isset($freq[$n])) {
                $freq[$n] = 0;
            }
            $freq[$n]++;
        }
        $sum = 0;
        foreach ($freq as $num => $count) {
            if ($count % $k === 0) {
                $sum += $num * $count;
            }
        }
        return $sum;
    }
}
?>
