<?php

class Solution {

/**
* @param Integer[] $nums
* @param Integer $x
* @return Integer
*/
function minCost($nums, $x) {
$n = count($nums);
$best = $nums;
$ans = PHP_INT_MAX;

for ($k = 0; $k < $n; $k++) {
    if ($k> 0) {
    for ($i = 0; $i < $n; $i++) {
        $idx=($i - $k + $n) % $n;
        if ($nums[$idx] < $best[$i]) {
        $best[$i]=$nums[$idx];
        }
        }
        }
        $sum=(int)$k * $x;
        for ($i=0; $i < $n; $i++) {
        $sum +=$best[$i];
        }
        if ($sum < $ans) {
        $ans=$sum;
        }
        }

        return $ans;
        }
        }
?>
