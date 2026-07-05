<?php

class Solution {

/**
* @param Integer[] $nums
* @return Integer
*/
function pivotIndex($nums) {
$total = array_sum($nums);
$left = 0;

foreach ($nums as $i => $num) {
if ($left == $total - $left - $num) {
return $i;
}
$left += $num;
}

return -1;
}
}
?>
