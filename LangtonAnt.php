<?php

$limit = 10000000; //steps to an ants
$White = false; //box color
$Black = true; //box color
$Size = 128;  //box size 
$grid = array_fill(0, $Size * $Size, $White);
$x = $Size / 2;
$y = $Size / 2;
$DeltaX = [0, +1, 0, -1];
$DeltaY = [+1, 0, -1, 0];
$direction = 0;
$Cycle = 104;
$Remainder = $limit % $Cycle;
$count = 0;
$last = $count;
$lastDeltas = [0];
$StopIfSameDeltas = 10;
$steps = 0;

while ($steps < $limit) {
    if ($steps % $Cycle == $Remainder) {
        $diff = $count - $last;
        $lastDeltas[] = $diff;
        $last = $count;
        if (count($lastDeltas) >= $StopIfSameDeltas) {
            $samesame = true;
            for ($i = 0; $i < $StopIfSameDeltas; $i++) {
                if ($lastDeltas[count($lastDeltas) - 1 - $i] != $diff) {
                    $samesame = false;
                    break;
                }
            }
            if ($samesame) {
                $remainingCycles = intval(($limit - $steps) / $Cycle);
                $count += $remainingCycles * $diff;
                break;
            }
        }
    }
    
    $pos = $y * $Size + $x;
    if ($grid[$pos] == $White) {
        $grid[$pos] = $Black;
        $count++;
        $direction = ($direction + 1) % 4;
    } else {
        $grid[$pos] = $White;
        $count--;
        $direction = ($direction + 4 - 1) % 4;
    }
    $x += $DeltaX[$direction];
    $y += $DeltaY[$direction];
    $steps++;
}
echo $count . PHP_EOL;