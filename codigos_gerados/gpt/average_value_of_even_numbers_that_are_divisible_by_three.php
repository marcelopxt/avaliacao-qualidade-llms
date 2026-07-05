<?php

class Solution {

/**
* @param Integer[] $nums
* @return Integer
*/
function averageValue($nums) {
$sum = 0;
$count = 0;
foreach ($nums as $num) {
if ($num % 6 == 0) {
$sum += $num;
$count++;
}
}
return $count == 0 ? 0 : intdiv($sum, $count);
}
}
?>
