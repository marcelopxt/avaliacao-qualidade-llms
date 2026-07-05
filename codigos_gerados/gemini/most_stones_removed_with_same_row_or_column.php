<?php

class Solution {
    private $parent = [];
    private $count = 0;

    function removeStones($stones) {
        foreach ($stones as $stone) {
            $this->union($stone[0], $stone[1] + 10001);
        }
        return count($stones) - $this->count;
    }

    private function find($x) {
        if (!isset($this->parent[$x])) {
            $this->parent[$x] = $x;
            $this->count++;
        }
        if ($this->parent[$x] !== $x) {
            $this->parent[$x] = $this->find($this->parent[$x]);
        }
        return $this->parent[$x];
    }

    private function union($x, $y) {
        $rootX = $this->find($x);
        $rootY = $this->find($y);
        if ($rootX !== $rootY) {
            $this->parent[$rootX] = $rootY;
            $this->count--;
        }
    }
}
?>
