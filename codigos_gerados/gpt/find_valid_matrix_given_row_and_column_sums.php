<?php

class Solution {

/**
* @param Integer[] $rowSum
* @param Integer[] $colSum
* @return Integer[][]
*/
function restoreMatrix($rowSum, $colSum) {
$m = count($rowSum);
$n = count($colSum);
$res = [];

for ($i = 0; $i < $m; $i++) {
    $res[$i]=array_fill(0, $n, 0);
    }

    $i=0;
    $j=0;
    while ($i < $m && $j < $n) {
    $v=min($rowSum[$i], $colSum[$j]);
    $res[$i][$j]=$v;
    $rowSum[$i] -=$v;
    $colSum[$j] -=$v;

    if ($rowSum[$i]==0) $i++;
    if ($colSum[$j]==0) $j++;
    }

    return $res;
    }
    }
?>
