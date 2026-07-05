<?php

class Solution {

/**
* @param Integer[][] $stones
* @return Integer
*/
function removeStones($stones) {
$parent = [];
$rank = [];

foreach ($stones as $stone) {
$r = $stone[0];
$c = ~$stone[1];

if (!isset($parent[$r])) {
$parent[$r] = $r;
$rank[$r] = 0;
}
if (!isset($parent[$c])) {
$parent[$c] = $c;
$rank[$c] = 0;
}

$this->union($r, $c, $parent, $rank);
}

$roots = [];
foreach ($stones as $stone) {
$root = $this->find($stone[0], $parent);
$roots[$root] = true;
}

return count($stones) - count($roots);
}

private function find($x, &$parent) {
if ($parent[$x] !== $x) {
$parent[$x] = $this->find($parent[$x], $parent);
}
return $parent[$x];
}

private function union($a, $b, &$parent, &$rank) {
$ra = $this->find($a, $parent);
$rb = $this->find($b, $parent);

if ($ra === $rb) {
return;
}

if ($rank[$ra] < $rank[$rb]) {
    $parent[$ra]=$rb;
    } elseif ($rank[$ra]> $rank[$rb]) {
    $parent[$rb] = $ra;
    } else {
    $parent[$rb] = $ra;
    $rank[$ra]++;
    }
    }
    }
?>
