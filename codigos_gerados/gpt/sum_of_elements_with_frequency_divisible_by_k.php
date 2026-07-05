<?php

class Solution {

/**
* @param Integer[] $nums
* @param Integer $k
* @return Integer
*/
function sumDivisibleByK($nums, $k) {
$freq = [];
foreach ($nums as $num) {
if (!isset($freq[$num])) $freq[$num] = 0;
$freq[$num]++;
}

$sum = 0;
foreach ($freq as $num => $count) {
if ($count % $k == 0) {
$sum += $num * $count;
}
}

return $sum;
}
}
?>