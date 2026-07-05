<?php

class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function maxProduct($nums) {
        $n = count($nums);
        
        $abs_nums = $nums;
        usort($abs_nums, function($a, $b) {
            return abs($b) <=> abs($a);
        });
        $max_abs_2 = abs($abs_nums[0] * $abs_nums[1]) * 100000;
        
        if ($n > 3) {
            sort($nums);
            $max_3 = max(
                $nums[$n - 1] * $nums[$n - 2] * $nums[$n - 3],
                $nums[0] * $nums[1] * $nums[$n - 1]
            );
            return max($max_abs_2, $max_3);
        }
        
        return $max_abs_2;
    }
}
?>
