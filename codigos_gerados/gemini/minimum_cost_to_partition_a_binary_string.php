<?php

class Solution {

    /**
     * @param String $s
     * @param Integer $encCost
     * @param Integer $flatCost
     * @return Integer
     */
    function minCost($s, $encCost, $flatCost) {
        $n = strlen($s);
        $pref = array_fill(0, $n + 1, 0);
        for ($i = 0; $i < $n; $i++) {
            $pref[$i + 1] = $pref[$i] + ($s[$i] === '1' ? 1 : 0);
        }

        $lengths = [];
        $curr = $n;
        $lengths[] = $curr;
        while ($curr % 2 == 0) {
            $curr /= 2;
            $lengths[] = $curr;
        }
        $lengths = array_reverse($lengths);

        $dp = [];
        foreach ($lengths as $idx => $L) {
            $dp[$L] = [];
            for ($i = 0; $i <= $n - $L; $i += $L) {
                $X = $pref[$i + $L] - $pref[$i];
                $noSplitCost = ($X == 0) ? $flatCost : $L * $X * $encCost;
                
                if ($idx == 0) {
                    $dp[$L][$i] = $noSplitCost;
                } else {
                    $prevL = $lengths[$idx - 1];
                    $splitCost = $dp[$prevL][$i] + $dp[$prevL][$i + $prevL];
                    $dp[$L][$i] = min($noSplitCost, $splitCost);
                }
            }
        }

        return $dp[$n][0];
    }
}
?>
