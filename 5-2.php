<?php

$executionStartTime = microtime(true);
echo "<html><body><h1>Advent of Code</h1><br>";
$input = file("5-1-input.txt");
set_time_limit(7200);



$input2 = $input[0];
//$input2 = "dabAcCaCBAcCcaDA";

$check = array();

//Create an array of combinations to check:
foreach(range('A','Z') as $char) {
    $check[] = $char.strtolower($char);
    $check[] = strtolower($char).$char;
};

//For part 2, we use part 1's code and go through each letter and get result
foreach(range('A','Z') as $char) {
    $string = str_replace($char,"",$input2);
    $string = str_replace(strtolower($char),"",$string);
    for ($a = 0; $a < 2; $a++) {
        for ($loop = 0; $loop <= strlen($string); $loop++) {
            if (in_array(substr($string, $loop, 2), $check)) {
                $string = substr($string, 0, $loop) . substr($string, $loop + 2);
                //Reset the loop back to 0
                $loop = 0;
            }
        }
    }
    echo "removing: ".$char."<br>";
    echo "end string is: ".$string."<br>";
    echo "length of string is: ".strlen($string)."<p>";
}




$executionEndTime = microtime(true);
$executionSeconds = $executionEndTime - $executionStartTime;
echo "<hr><br> Script has ended and took this many seconds to run:".$executionSeconds;