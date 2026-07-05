<?php

class Solution {

    /**
     * @param String[] $words
     * @return Integer[][]
     */
    function supersequences($words) {
        $charIndex = [];
        $chars = [];
        foreach ($words as $w) {
            for ($k = 0; $k < 2; $k++) {
                $c = $w[$k];
                if (!isset($charIndex[$c])) {
                    $charIndex[$c] = count($chars);
                    $chars[] = $c;
                }
            }
        }
        $n = count($chars);
        $forced2 = 0;
        $pred = array_fill(0, $n, 0);
        foreach ($words as $w) {
            $a = $charIndex[$w[0]];
            $b = $charIndex[$w[1]];
            if ($a === $b) {
                $forced2 |= (1 << $a);
            } else {
                $pred[$b] |= (1 << $a);
            }
        }

        $size = 1 << $n;
        $full = $size - 1;

        $valid = array_fill(0, $size, false);
        $valid[0] = true;
        for ($S = 1; $S < $size; $S++) {
            for ($v = 0; $v < $n; $v++) {
                if (($S & (1 << $v)) === 0) continue;
                if (($pred[$v] & $S) === 0) {
                    if ($valid[$S ^ (1 << $v)]) {
                        $valid[$S] = true;
                        break;
                    }
                }
            }
        }

        $nonForced = $full & ~$forced2;

        $popcount = function ($x) {
            $c = 0;
            while ($x > 0) {
                $c += $x & 1;
                $x >>= 1;
            }
            return $c;
        };

        $maxWeight = -1;
        for ($S = 0; $S < $size; $S++) {
            if ($valid[$S]) {
                $w = $popcount($S & $nonForced);
                if ($w > $maxWeight) {
                    $maxWeight = $w;
                }
            }
        }

        $seen = [];
        $result = [];
        for ($S = 0; $S < $size; $S++) {
            if ($valid[$S]) {
                $w = $popcount($S & $nonForced);
                if ($w === $maxWeight) {
                    $D = $forced2 | ($full & ~$S);
                    if (!isset($seen[$D])) {
                        $seen[$D] = true;
                        $freq = array_fill(0, 26, 0);
                        for ($i = 0; $i < $n; $i++) {
                            $ci = ord($chars[$i]) - ord('a');
                            $freq[$ci] = ($D & (1 << $i)) ? 2 : 1;
                        }
                        $result[] = $freq;
                    }
                }
            }
        }

        return $result;
    }
}
?>
