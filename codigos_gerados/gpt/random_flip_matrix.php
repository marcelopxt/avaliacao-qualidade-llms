<?php

class Solution {
private $m;
private $n;
private $total;
private $remain;
private $map = [];

/**
* @param Integer $m
* @param Integer $n
*/
function __construct($m, $n) {
$this->m = $m;
$this->n = $n;
$this->total = $m * $n;
$this->remain = $this->total;
}

/**
* @return Integer[]
*/
function flip() {
$r = random_int(0, $this->remain - 1);
$this->remain--;

$x = isset($this->map[$r]) ? $this->map[$r] : $r;
$last = isset($this->map[$this->remain]) ? $this->map[$this->remain] : $this->remain;
$this->map[$r] = $last;

return [intdiv($x, $this->n), $x % $this->n];
}

/**
* @return NULL
*/
function reset() {
$this->remain = $this->total;
$this->map = [];
}
}

/**
* Your Solution object will be instantiated and called as such:
* $obj = new Solution($m, $n);
* $ret_1 = $obj->flip();
* $obj->reset();
*/
?>