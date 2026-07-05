<?php

class Solution {
    private $m;
    private $n;
    private $total;
    private $map;

    function __construct($m, $n) {
        $this->m = $m;
        $this->n = $n;
        $this->total = $m * $n;
        $this->map = [];
    }

    function flip() {
        $r = mt_rand(0, $this->total - 1);
        $this->total--;
        $x = isset($this->map[$r]) ? $this->map[$r] : $r;
        $last = isset($this->map[$this->total]) ? $this->map[$this->total] : $this->total;
        $this->map[$r] = $last;
        unset($this->map[$this->total]);
        $i = intdiv($x, $this->n);
        $j = $x % $this->n;
        return [$i, $j];
    }

    function reset() {
        $this->total = $this->m * $this->n;
        $this->map = [];
    }
}
?>
