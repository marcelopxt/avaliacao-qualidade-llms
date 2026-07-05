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
        $qWithIdx = [];
        foreach ($queries as $i => $q) {
            $qWithIdx[] = [$q, $i];
        }
        
        usort($qWithIdx, function($a, $b) {
            return $a[0] <=> $b[0];
        });
        
        usort($logs, function($a, $b) {
            return $a[1] <=> $b[1];
        });
        
        $ans = array_fill(0, count($queries), 0);
        $counts = [];
        $uniqueCount = 0;
        
        $left = 0;
        $right = 0;
        $numLogs = count($logs);
        
        foreach ($qWithIdx as $pair) {
            $qTime = $pair[0];
            $qIdx = $pair[1];
            
            $startTime = $qTime - $x;
            $endTime = $qTime;
            
            while ($right < $numLogs && $logs[$right][1] <= $endTime) {
                $server = $logs[$right][0];
                if (!isset($counts[$server]) || $counts[$server] == 0) {
                    $counts[$server] = 1;
                    $uniqueCount++;
                } else {
                    $counts[$server]++;
                }
                $right++;
            }
            
            while ($left < $numLogs && $logs[$left][1] < $startTime) {
                $server = $logs[$left][0];
                if (isset($counts[$server])) {
                    $counts[$server]--;
                    if ($counts[$server] == 0) {
                        $uniqueCount--;
                    }
                }
                $left++;
            }
            
            $ans[$qIdx] = $n - $uniqueCount;
        }
        
        return $ans;
    }
}
?>
