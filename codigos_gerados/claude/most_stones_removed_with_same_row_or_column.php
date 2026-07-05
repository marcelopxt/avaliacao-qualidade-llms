<?php

class Solution {

    private $parent = [];

    private function find($x) {
        if (!isset($this->parent[$x])) {
            $this->parent[$x] = $x;
        }
        if ($this->parent[$x] != $x) {
            $this->parent[$x] = $this->find($this->parent[$x]);
        }
        return $this->parent[$x];
    }

    private function union($x, $y) {
        $rootX = $this->find($x);
        $rootY = $this->find($y);
        if ($rootX != $rootY) {
            $this->parent[$rootX] = $rootY;
        }
    }

    /**
     * @param Integer[][] $stones
     * @return Integer
     */
    function removeStones($stones) {
        $this->parent = [];
        $n = count($stones);

        foreach ($stones as $stone) {
            $x = $stone[0];
            $y = $stone[1] + 10001;
            $this->union($x, $y);
        }

        $roots = [];
        foreach ($stones as $stone) {
            $x = $stone[0];
            $root = $this->find($x);
            $roots[$root] = true;
        }

        return $n - count($roots);
    }
}
?>
