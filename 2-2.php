<?php

echo "<html><body>";
$input = file("2-1-input.txt");


foreach ($input as $line) {
    foreach ($input as $line2) {
        $count = 0;
        for ($column=0; $column < 26; $column++) {
            $char = substr($line,$column,1);
            $char2 = substr($line2,$column,1);
            if ($char == $char2) {
                $count++;
            }
        }
        if ($count > 24) {
            if ($line != $line2) {
                echo $line." ".$line2."<br>";
            }
        }
    }
}
