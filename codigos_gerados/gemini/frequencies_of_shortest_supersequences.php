<?php

class Solution {

    /**
     * @param String[] $words
     * @return Integer[][]
     */
    function supersequences($words) {
        $chars = [];
        foreach ($words as $w) {
            $chars[$w[0]] = true;
            $chars[$w[1]] = true;
        }
        $chars = array_keys($chars);
        sort($chars);
        $N = count($chars);
        $char_to_idx = array_flip($chars);
        
        $req = array_fill(0, $N, 0);
        foreach ($words as $w) {
            $u = $char_to_idx[$w[0]];
            $v = $char_to_idx[$w[1]];
            $req[$v] |= (1 << $u);
        }
        
        $all_chars_mask = (1 << $N) - 1;
        $target_state = $all_chars_mask | ($all_chars_mask << 16);
        
        $current_layer = [0 => [0 => true]];
        
        while (!empty($current_layer)) {
            $next_layer = [];
            foreach ($current_layer as $state => $freqs) {
                $started = $state & 0xFFFF;
                $finished = ($state >> 16) & 0xFFFF;
                
                for ($c = 0; $c < $N; $c++) {
                    $c_bit = 1 << $c;
                    if (!($started & $c_bit)) {
                        $next_state1 = ($started | $c_bit) | ($finished << 16);
                        foreach ($freqs as $f => $_) {
                            $next_layer[$next_state1][$f + (1 << (2 * $c))] = true;
                        }
                        if (($started & $req[$c]) === $req[$c]) {
                            $next_state2 = ($started | $c_bit) | (($finished | $c_bit) << 16);
                            foreach ($freqs as $f => $_) {
                                $next_layer[$next_state2][$f + (1 << (2 * $c))] = true;
                            }
                        }
                    } elseif (!($finished & $c_bit)) {
                        if (($started & $req[$c]) === $req[$c]) {
                            $next_state = $started | (($finished | $c_bit) << 16);
                            foreach ($freqs as $f => $_) {
                                $next_layer[$next_state][$f + (1 << (2 * $c))] = true;
                            }
                        }
                    }
                }
            }
            if (isset($next_layer[$target_state])) {
                $res = [];
                foreach ($next_layer[$target_state] as $f => $_) {
                    $row = array_fill(0, 26, 0);
                    for ($c = 0; $c < $N; $c++) {
                        $orig_char = $chars[$c];
                        $count = ($f >> (2 * $c)) & 3;
                        $row[ord($orig_char) - 97] = $count;
                    }
                    $res[] = $row;
                }
                return $res;
            }
            $current_layer = $next_layer;
        }
        return [];
    }
}
?>
