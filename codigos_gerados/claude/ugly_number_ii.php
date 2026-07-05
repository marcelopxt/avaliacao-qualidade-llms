<?php

class Solution {

    /**
     * @param Integer $n
     * @return Integer
     */
    function nthUglyNumber($n) {
        $ugly = [1];
        $i2 = 0;
        $i3 = 0;
        $i5 = 0;

        for ($i = 1; $i < $n; $i++) {
            $next2 = $ugly[$i2] * 2;
            $next3 = $ugly[$i3] * 3;
            $next5 = $ugly[$i5] * 5;

            $next = min($next2, $next3, $next5);
            $ugly[] = $next;

            if ($next == $next2) $i2++;
            if ($next == $next3) $i3++;
            if ($next == $next5) $i5++;
        }

        return $ugly[$n - 1];
    }
}
?>