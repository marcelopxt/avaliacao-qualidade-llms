<?php

class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function maxProduct($nums) {
        $n = count($nums);
        $pairs = [];
        foreach ($nums as $idx => $v) {
            $pairs[] = [$v, $idx];
        }
        usort($pairs, function($a, $b) {
            return $a[0] <=> $b[0];
        });

        $topCount = min(6, $n);
        $topList = array_slice($pairs, $n - $topCount, $topCount);
        $topList = array_reverse($topList); // descending by value

        $bottomCount = min(6, $n);
        $bottomList = array_slice($pairs, 0, $bottomCount); // ascending by value

        $candidateIndices = [];
        foreach ($topList as $p) {
            $candidateIndices[$p[1]] = true;
        }
        foreach ($bottomList as $p) {
            $candidateIndices[$p[1]] = true;
        }

        $V_MAX = 100000;
        $V_MIN = -100000;

        $filterVals = function($list, $excludeIdx, $count) {
            $res = [];
            foreach ($list as $p) {
                if ($p[1] === $excludeIdx) continue;
                $res[] = $p[0];
                if (count($res) >= $count) break;
            }
            return $res;
        };

        $evaluateForIndex = function($excludeIdx) use ($topList, $bottomList, $filterVals, $V_MAX, $V_MIN) {
            $topF = $filterVals($topList, $excludeIdx, 3);
            $botF = $filterVals($bottomList, $excludeIdx, 2);
            $best = null;

            if (count($topF) >= 3) {
                $val = $topF[0] * $topF[1] * $topF[2];
                $best = ($best === null) ? $val : max($best, $val);
            }
            if (count($topF) >= 1 && count($botF) >= 1) {
                $val = $V_MIN * $botF[0] * $topF[0];
                $best = ($best === null) ? $val : max($best, $val);
            }
            if (count($topF) >= 2) {
                $val = $V_MAX * $topF[0] * $topF[1];
                $best = ($best === null) ? $val : max($best, $val);
            }
            if (count($botF) >= 2) {
                $val = $V_MAX * $botF[0] * $botF[1];
                $best = ($best === null) ? $val : max($best, $val);
            }
            return $best;
        };

        $ans = PHP_INT_MIN;

        foreach (array_keys($candidateIndices) as $idx) {
            $r = $evaluateForIndex($idx);
            if ($r !== null) {
                $ans = max($ans, $r);
            }
        }

        if (count($candidateIndices) < $n) {
            $r = $evaluateForIndex(-1);
            if ($r !== null) {
                $ans = max($ans, $r);
            }

            $topFull = $filterVals($topList, -1, 3);
            $botFull = $filterVals($bottomList, -1, 2);

            if (count($topFull) >= 3) {
                $ans = max($ans, $topFull[0] * $topFull[1] * $topFull[2]);
            }
            if (count($topFull) >= 1 && count($botFull) >= 2) {
                $ans = max($ans, $topFull[0] * $botFull[0] * $botFull[1]);
            }
        }

        return $ans;
    }
}
?>
