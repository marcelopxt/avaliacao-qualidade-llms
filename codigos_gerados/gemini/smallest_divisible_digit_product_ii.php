<?php

class Solution {
    public function smallestNumber(string $num, int $t): string {
        $temp = $t;
        foreach ([2, 3, 5, 7] as $p) {
            while ($temp % $p == 0) {
                $temp /= $p;
            }
        }
        if ($temp > 1) {
            return "-1";
        }

        $n = strlen($num);
        
        $pos = strpos($num, '0');
        if ($pos !== false) {
            $num[$pos] = '1';
            for ($i = $pos + 1; $i < $n; $i++) {
                $num[$i] = '1';
            }
        }

        $suff_t = array_fill(0, $n + 1, 1);
        $suff_t[$n] = $t;
        for ($i = $n - 1; $i >= 0; $i--) {
            $d = (int)$num[$i];
            $g = $this->gcd($suff_t[$i + 1], $d);
            $suff_t[$i] = $suff_t[$i + 1] / $g;
        }

        if ($suff_t[0] == 1) {
            return $num;
        }

        for ($i = $n - 1; $i >= 0; $i--) {
            $curr_d = (int)$num[$i];
            for ($d = $curr_d + 1; $d <= 9; $d++) {
                $rem_t = $suff_t[$i + 1] / $this->gcd($suff_t[$i + 1], $d);
                $rem_len = $n - 1 - $i;
                if ($this->canSatisfy($rem_t, $rem_len)) {
                    $num[$i] = (string)$d;
                    $this->fillGreedy($num, $i + 1, $n, $rem_t);
                    return $num;
                }
            }
        }

        $new_len = $n + 1;
        while (true) {
            if ($this->canSatisfy($t, $new_len)) {
                $num = str_repeat('1', $new_len);
                $this->fillGreedy($num, 0, $new_len, $t);
                return $num;
            }
            $new_len++;
        }
    }

    private function gcd(int $a, int $b): int {
        while ($b != 0) {
            $t = $b;
            $b = $a % $b;
            $a = $t;
        }
        return $a;
    }

    private function canSatisfy(int $rem_t, int $rem_len): bool {
        if ($rem_t == 1) return true;
        
        $c9 = 0; $c8 = 0; $c7 = 0; $c6 = 0; $c5 = 0; $c4 = 0; $c3 = 0; $c2 = 0;
        
        while ($rem_t % 7 == 0) { $c7++; $rem_t /= 7; }
        while ($rem_t % 5 == 0) { $c5++; $rem_t /= 5; }
        while ($rem_t % 3 == 0) { $c3++; $rem_t /= 3; }
        while ($rem_t % 2 == 0) { $c2++; $rem_t /= 2; }
        
        $c9 = intdiv($c3, 2); $c3 %= 2;
        $c8 = intdiv($c2, 3); $c2 %= 3;
        
        if ($c3 == 1 && $c2 >= 1) {
            $c6++; $c3--; $c2--;
        }
        if ($c2 == 2) {
            $c4++; $c2 = 0;
        }
        
        $req = $c9 + $c8 + $c7 + $c6 + $c5 + $c4 + $c3 + $c2;
        return $req <= $rem_len;
    }

    private function fillGreedy(string &$num, int $start, int $end, int $rem_t) {
        $rem_len = $end - $start;
        for ($i = $end - 1; $i >= $start; $i--) {
            for ($d = 9; $d >= 1; $d--) {
                $next_t = $rem_t / $this->gcd($rem_t, $d);
                if ($this->canSatisfy($next_t, $i - $start)) {
                    $num[$i] = (string)$d;
                    $rem_t = $next_t;
                    break;
                }
            }
        }
    }
}
?>
