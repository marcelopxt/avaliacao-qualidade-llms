<?php

class Solution {

/**
* @param Integer[] $nums
* @return Integer
*/
function maxProduct($nums) {
$M = 100000;
$n = count($nums);

sort($nums);

$orig = max(
$nums[$n-1] * $nums[$n-2] * $nums[$n-3],
$nums[0] * $nums[1] * $nums[$n-1]
);

if ($n == 3) $orig = PHP_INT_MIN;

$best = $orig;

for ($i = 0; $i < $n; $i++) {
    $vals=[];

    $k=0;
    while ($k < $n && count($vals) < 3) {
    if ($k !=$i) $vals[]=$nums[$k];
    $k++;
    }

    $k=$n - 1;
    while ($k>= 0 && count($vals) < 6) {
        if ($k !=$i) $vals[]=$nums[$k];
        $k--;
        }

        $vals=array_values(array_unique($vals));
        $m=count($vals);
        $pairAbs=0;
        for ($a=0; $a < $m; $a++) {
        for ($b=$a + 1; $b < $m; $b++) {
        $p=abs($vals[$a] * $vals[$b]);
        if ($p> $pairAbs) $pairAbs = $p;
        }
        }
        $cand = $pairAbs * $M;
        if ($cand > $best) $best = $cand;
        }

        return $best;
        }
        }
?>
