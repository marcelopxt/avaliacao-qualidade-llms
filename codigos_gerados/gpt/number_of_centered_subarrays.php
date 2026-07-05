<?php

class Solution {

/**
* @param Integer[] $nums
* @return Integer
*/
function centeredSubarrays($nums) {
$n = count($nums);
$ans = 0;
for ($i = 0; $i < $n; $i++) {
    $sum=0;
    $freq=[];
    for ($j=$i; $j < $n; $j++) {
    $sum +=$nums[$j];
    $freq[$nums[$j]]=true;
    if (isset($freq[$sum])) {
    $ans++;
    }
    }
    }
    return $ans;
    }
    }
?>
