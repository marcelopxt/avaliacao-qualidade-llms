<?php

class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function centeredSubarrays($nums) {
        $n = count($nums);
        $count = 0;
        for ($i = 0; $i < $n; $i++) {
            $sum = 0;
            for ($j = $i; $j < $n; $j++) {
                $sum += $nums[$j];
                for ($k = $i; $k <= $j; $k++) {
                    if ($nums[$k] == $sum) {
                        $count++;
                        break;
                    }
                }
            }
        }
        return $count;
    }
}
?>
