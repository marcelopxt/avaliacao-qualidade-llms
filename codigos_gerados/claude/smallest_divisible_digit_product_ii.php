<?php

class Solution {
    /**
     * @param String $num
     * @param Integer $t
     * @return String
     */
    function smallestNumber($num, $t) {
        $n = strlen($num);
        $t = (int)$t;

        $a = 0; $b = 0; $c = 0; $d = 0;
        while ($t % 2 == 0) { $t = intdiv($t, 2); $a++; }
        while ($t % 3 == 0) { $t = intdiv($t, 3); $b++; }
        while ($t % 5 == 0) { $t = intdiv($t, 5); $c++; }
        while ($t % 7 == 0) { $t = intdiv($t, 7); $d++; }
        if ($t != 1) return "-1";

        $vec = [
            0 => [0,0,0,0],
            1 => [0,0,0,0],
            2 => [1,0,0,0],
            3 => [0,1,0,0],
            4 => [2,0,0,0],
            5 => [0,0,1,0],
            6 => [1,1,0,0],
            7 => [0,0,0,1],
            8 => [3,0,0,0],
            9 => [0,2,0,0],
        ];

        $solve2 = [];
        for ($ra = 0; $ra <= $a; $ra++) {
            $solve2[$ra] = [];
            for ($rb = 0; $rb <= $b; $rb++) {
                $best = PHP_INT_MAX;
                $zmax = max($ra, $rb);
                for ($z = 0; $z <= $zmax; $z++) {
                    $x = ($ra - $z > 0) ? (int)ceil(($ra - $z) / 3) : 0;
                    $y = ($rb - $z > 0) ? (int)ceil(($rb - $z) / 2) : 0;
                    $tot = $x + $y + $z;
                    if ($tot < $best) $best = $tot;
                }
                $solve2[$ra][$rb] = $best;
            }
        }

        $digits = [];
        for ($i = 0; $i < $n; $i++) $digits[$i] = intval($num[$i]);

        $pv2 = array_fill(0, $n + 1, 0);
        $pv3 = array_fill(0, $n + 1, 0);
        $pv5 = array_fill(0, $n + 1, 0);
        $pv7 = array_fill(0, $n + 1, 0);
        for ($i = 0; $i < $n; $i++) {
            $v = $vec[$digits[$i]];
            $pv2[$i+1] = $pv2[$i] + $v[0];
            $pv3[$i+1] = $pv3[$i] + $v[1];
            $pv5[$i+1] = $pv5[$i] + $v[2];
            $pv7[$i+1] = $pv7[$i] + $v[3];
        }

        $firstZero = $n;
        for ($i = 0; $i < $n; $i++) {
            if ($digits[$i] == 0) { $firstZero = $i; break; }
        }

        if ($firstZero == $n) {
            if ($pv2[$n] >= $a && $pv3[$n] >= $b && $pv5[$n] >= $c && $pv7[$n] >= $d) {
                return $num;
            }
        }

        $fillGreedy = function($length, $ra, $rb, $rc, $rd) use ($vec, $solve2) {
            $res = '';
            $curra = $ra; $currb = $rb; $currc = $rc; $currd = $rd;
            for ($pos = 0; $pos < $length; $pos++) {
                $remSlots = $length - $pos - 1;
                for ($cand = 1; $cand <= 9; $cand++) {
                    $v = $vec[$cand];
                    $nra = max(0, $curra - $v[0]);
                    $nrb = max(0, $currb - $v[1]);
                    $nrc = max(0, $currc - $v[2]);
                    $nrd = max(0, $currd - $v[3]);
                    $need = $solve2[$nra][$nrb] + $nrc + $nrd;
                    if ($need <= $remSlots) {
                        $res .= strval($cand);
                        $curra = $nra; $currb = $nrb; $currc = $nrc; $currd = $nrd;
                        break;
                    }
                }
            }
            return $res;
        };

        $startI = min($firstZero, $n - 1);
        $foundAnswer = null;
        for ($i = $startI; $i >= 0; $i--) {
            $p2 = $pv2[$i]; $p3 = $pv3[$i]; $p5 = $pv5[$i]; $p7 = $pv7[$i];
            $startDigit = $digits[$i] + 1;
            if ($startDigit < 1) $startDigit = 1;
            for ($cand = $startDigit; $cand <= 9; $cand++) {
                $v = $vec[$cand];
                $ra = max(0, $a - $p2 - $v[0]);
                $rb = max(0, $b - $p3 - $v[1]);
                $rc = max(0, $c - $p5 - $v[2]);
                $rd = max(0, $d - $p7 - $v[3]);
                $remainingSlots = $n - 1 - $i;
                $need = $solve2[$ra][$rb] + $rc + $rd;
                if ($need <= $remainingSlots) {
                    $prefixStr = substr($num, 0, $i);
                    $tail = $fillGreedy($remainingSlots, $ra, $rb, $rc, $rd);
                    $foundAnswer = $prefixStr . strval($cand) . $tail;
                    break 2;
                }
            }
        }

        if ($foundAnswer !== null) return $foundAnswer;

        $L0 = $solve2[$a][$b] + $c + $d;
        $Lf = max($n + 1, $L0);
        return $fillGreedy($Lf, $a, $b, $c, $d);
    }
}
?>
