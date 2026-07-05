<?php

class Solution {

private $n;
private $tree = [];
private $sArr = [];

private function pull($idx) {
$l = $this->tree[$idx * 2];
$r = $this->tree[$idx * 2 + 1];
$lenL = $l['len'];
$lenR = $r['len'];

$leftChar = $l['leftChar'];
$rightChar = $r['rightChar'];

$leftLen = $l['leftLen'];
if ($l['leftLen'] == $lenL && $l['rightChar'] == $r['leftChar']) {
$leftLen += $r['leftLen'];
}

$rightLen = $r['rightLen'];
if ($r['rightLen'] == $lenR && $l['rightChar'] == $r['leftChar']) {
$rightLen += $l['rightLen'];
}

$best = max($l['best'], $r['best']);
if ($l['rightChar'] == $r['leftChar']) {
$best = max($best, $l['rightLen'] + $r['leftLen']);
}

$this->tree[$idx] = [
'len' => $lenL + $lenR,
'leftChar' => $leftChar,
'rightChar' => $rightChar,
'leftLen' => $leftLen,
'rightLen' => $rightLen,
'best' => $best
];
}

private function build($idx, $l, $r) {
if ($l == $r) {
$c = $this->sArr[$l];
$this->tree[$idx] = [
'len' => 1,
'leftChar' => $c,
'rightChar' => $c,
'leftLen' => 1,
'rightLen' => 1,
'best' => 1
];
return;
}
$m = intdiv($l + $r, 2);
$this->build($idx * 2, $l, $m);
$this->build($idx * 2 + 1, $m + 1, $r);
$this->pull($idx);
}

private function update($idx, $l, $r, $pos, $c) {
if ($l == $r) {
$this->tree[$idx] = [
'len' => 1,
'leftChar' => $c,
'rightChar' => $c,
'leftLen' => 1,
'rightLen' => 1,
'best' => 1
];
return;
}
$m = intdiv($l + $r, 2);
if ($pos <= $m) {
    $this->update($idx * 2, $l, $m, $pos, $c);
    } else {
    $this->update($idx * 2 + 1, $m + 1, $r, $pos, $c);
    }
    $this->pull($idx);
    }

    /**
    * @param String $s
    * @param String $queryCharacters
    * @param Integer[] $queryIndices
    * @return Integer[]
    */
    function longestRepeating($s, $queryCharacters, $queryIndices) {
    $this->n = strlen($s);
    $this->sArr = str_split($s);
    $this->build(1, 0, $this->n - 1);

    $k = strlen($queryCharacters);
    $ans = [];
    for ($i = 0; $i < $k; $i++) {
        $pos=$queryIndices[$i];
        $c=$queryCharacters[$i];
        if ($this->sArr[$pos] !== $c) {
        $this->sArr[$pos] = $c;
        $this->update(1, 0, $this->n - 1, $pos, $c);
        }
        $ans[] = $this->tree[1]['best'];
        }
        return $ans;
        }
        }
?>
