<?php

class Solution {

    /**
     * @param String $s
     * @param String $queryCharacters
     * @param Integer[] $queryIndices
     * @return Integer[]
     */
    function longestRepeating($s, $queryCharacters, $queryIndices) {
        $n = strlen($s);
        $k = strlen($queryCharacters);
        
        $tree_size = 4 * $n;
        $max_len = array_fill(0, $tree_size, 0);
        $pref_len = array_fill(0, $tree_size, 0);
        $suff_len = array_fill(0, $tree_size, 0);
        $pref_char = array_fill(0, $tree_size, '');
        $suff_char = array_fill(0, $tree_size, '');
        $seg_len = array_fill(0, $tree_size, 0);

        $this->build(0, 0, $n - 1, $s, $max_len, $pref_len, $suff_len, $pref_char, $suff_char, $seg_len);

        $ans = [];
        for ($i = 0; $i < $k; $i++) {
            $idx = $queryIndices[$i];
            $char = $queryCharacters[$i];
            $this->update(0, 0, $n - 1, $idx, $char, $max_len, $pref_len, $suff_len, $pref_char, $suff_char, $seg_len);
            $ans[] = $max_len[0];
        }

        return $ans;
    }

    private function build($node, $start, $end, &$s, &$max_len, &$pref_len, &$suff_len, &$pref_char, &$suff_char, &$seg_len) {
        $seg_len[$node] = $end - $start + 1;
        if ($start == $end) {
            $max_len[$node] = 1;
            $pref_len[$node] = 1;
            $suff_len[$node] = 1;
            $pref_char[$node] = $s[$start];
            $suff_char[$node] = $s[$start];
            return;
        }
        $mid = ($start + $end) >> 1;
        $left = 2 * $node + 1;
        $right = 2 * $node + 2;
        $this->build($left, $start, $mid, $s, $max_len, $pref_len, $suff_len, $pref_char, $suff_char, $seg_len);
        $this->build($right, $mid + 1, $end, $s, $max_len, $pref_len, $suff_len, $pref_char, $suff_char, $seg_len);
        $this->merge($node, $left, $right, $max_len, $pref_len, $suff_len, $pref_char, $suff_char, $seg_len);
    }

    private function update($node, $start, $end, $idx, $char, &$max_len, &$pref_len, &$suff_len, &$pref_char, &$suff_char, &$seg_len) {
        if ($start == $end) {
            $max_len[$node] = 1;
            $pref_len[$node] = 1;
            $suff_len[$node] = 1;
            $pref_char[$node] = $char;
            $suff_char[$node] = $char;
            return;
        }
        $mid = ($start + $end) >> 1;
        $left = 2 * $node + 1;
        $right = 2 * $node + 2;
        if ($idx <= $mid) {
            $this->update($left, $start, $mid, $idx, $char, $max_len, $pref_len, $suff_len, $pref_char, $suff_char, $seg_len);
        } else {
            $this->update($right, $mid + 1, $end, $idx, $char, $max_len, $pref_len, $suff_len, $pref_char, $suff_char, $seg_len);
        }
        $this->merge($node, $left, $right, $max_len, $pref_len, $suff_len, $pref_char, $suff_char, $seg_len);
    }

    private function merge($node, $left, $right, &$max_len, &$pref_len, &$suff_len, &$pref_char, &$suff_char, &$seg_len) {
        $pref_char[$node] = $pref_char[$left];
        $suff_char[$node] = $suff_char[$right];

        $pref_len[$node] = $pref_len[$left];
        if ($pref_len[$left] == $seg_len[$left] && $pref_char[$left] == $pref_char[$right]) {
            $pref_len[$node] += $pref_len[$right];
        }

        $suff_len[$node] = $suff_len[$right];
        if ($suff_len[$right] == $seg_len[$right] && $suff_char[$right] == $suff_char[$left]) {
            $suff_len[$node] += $suff_len[$left];
        }

        $max_len[$node] = max($max_len[$left], $max_len[$right]);
        if ($suff_char[$left] == $pref_char[$right]) {
            $max_len[$node] = max($max_len[$node], $suff_len[$left] + $pref_len[$right]);
        }
    }
}
?>
