<?php

class Solution {

    /**
     * @param Integer[] $nums
     * @param Integer $x
     * @return Integer
     */
    function minCost($nums, $x) {
        $n = count($nums);
        $min_costs = $nums;
        $total_min_cost = INF;

        for ($ops = 0; $ops < $n; $ops++) {
            $current_cost = $ops * $x;
            for ($i = 0; $i < $n; $i++) {
                $min_costs[$i] = min($min_costs[$i], $nums[($i + $ops) % $n]);
                $current_cost += $min_costs[$i];
            }
            if ($current_cost < $total_min_cost) {
                $total_min_cost = $current_cost;
            }
        }

        return $total_min_cost;
    }
}
?>
