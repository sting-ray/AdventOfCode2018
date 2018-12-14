<?php

$frequency = 0;

$input = file("1-1-input.txt");

foreach ($input as $line) {
    $frequency = $frequency + $line;
    echo $frequency."br";
}

echo "total frequency is: ".$frequency;