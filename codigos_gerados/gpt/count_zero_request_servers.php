<?php

class Solution {

/**
* @param Integer $n
* @param Integer[][] $logs
* @param Integer $x
* @param Integer[] $queries
* @return Integer[]
*/
function countServers($n, $logs, $x, $queries) {
usort($logs, function($a, $b) {
return $a[1] <=> $b[1];
    });

    $qs = [];
    $m = count($queries);
    for ($i = 0; $i < $m; $i++) {
        $qs[]=[$queries[$i], $i];
        }
        usort($qs, function($a, $b) {
        return $a[0] <=> $b[0];
        });

        $cnt = [];
        $active = 0;
        $l = 0;
        $r = 0;
        $logCount = count($logs);
        $ans = array_fill(0, $m, 0);

        foreach ($qs as $q) {
        $time = $q[0];
        $idx = $q[1];

        while ($r < $logCount && $logs[$r][1] <=$time) {
            $sid=$logs[$r][0];
            if (!isset($cnt[$sid])) {
            $cnt[$sid]=0;
            }
            if ($cnt[$sid]==0) $active++;
            $cnt[$sid]++;
            $r++;
            }

            $left=$time - $x;
            while ($l < $r && $logs[$l][1] < $left) {
            $sid=$logs[$l][0];
            $cnt[$sid]--;
            if ($cnt[$sid]==0) {
            $active--;
            }
            $l++;
            }

            $ans[$idx]=$n - $active;
            }

            return $ans;
            }
            }
?>
