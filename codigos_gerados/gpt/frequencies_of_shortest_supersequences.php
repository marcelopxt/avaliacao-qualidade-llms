<?php

class Solution {

/**
* @param String[] $words
* @return Integer[][]
*/
function supersequences($words) {
$present = [];
$id = [];
foreach ($words as $w) {
for ($i = 0; $i < 2; $i++) {
    $c=ord($w[$i]) - 97;
    if (!isset($present[$c])) {
    $present[$c]=true;
    $id[$c]=count($id);
    }
    }
    }

    $m=count($id);
    $letters=array_keys($id);

    $selfMask=0;
    $edges=[];
    foreach ($words as $w) {
    $a=ord($w[0]) - 97;
    $b=ord($w[1]) - 97;
    if ($a==$b) {
    $selfMask |=1 << $id[$a];
    } else {
    $edges[]=[$id[$a], $id[$b]];
    }
    }

    $limit=1 << $m;
    $best=$m + 1;
    $ans=[];

    for ($mask=0; $mask < $limit; $mask++) {
    if (($mask & $selfMask) !=$selfMask) continue;
    $dup=0;
    $map=[];
    for ($i=0; $i < $m; $i++) {
    if (($mask>> $i) & 1) {
    $map[$i] = $dup++;
    } else {
    $map[$i] = -1;
    }
    }

    $nNodes = $m + $dup;
    $g = array_fill(0, $nNodes, []);
    $ind = array_fill(0, $nNodes, 0);

    foreach ($edges as $e) {
    $u = $e[0];
    $v = $e[1];
    $from = (($mask >> $u) & 1) ? $m + $map[$u] : $u;
    $to = $v;
    $g[$from][] = $to;
    $ind[$to]++;
    }

    for ($i = 0; $i < $m; $i++) {
        if (($mask>> $i) & 1) {
        $from = $i;
        $to = $m + $map[$i];
        $g[$from][] = $to;
        $ind[$to]++;
        }
        }

        $q = [];
        $head = 0;
        for ($i = 0; $i < $nNodes; $i++) {
            if ($ind[$i]==0) $q[]=$i;
            }
            $cnt=0;
            while ($head < count($q)) {
            $x=$q[$head++];
            $cnt++;
            foreach ($g[$x] as $y) {
            $ind[$y]--;
            if ($ind[$y]==0) $q[]=$y;
            }
            }
            if ($cnt !=$nNodes) continue;

            if ($dup < $best) {
            $best=$dup;
            $ans=[];
            }
            if ($dup==$best) {
            $freq=array_fill(0, 26, 0);
            foreach ($letters as $c) {
            $freq[$c]=1;
            }
            for ($i=0; $i < $m; $i++) {
            if (($mask>> $i) & 1) {
            $freq[$letters[$i]]++;
            }
            }
            $key = implode(',', $freq);
            $ans[$key] = $freq;
            }
            }

            return array_values($ans);
            }
            }
?>
