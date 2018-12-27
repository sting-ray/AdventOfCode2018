<?php

$executionStartTime = microtime(true);
echo "<html><body><h1>Advent of Code</h1><br>";
$input = file("5-1-input.txt");
set_time_limit(240);

//Question 1:
//11266 is too high!
//11264 is the correct answer!

$string = $input[0];
//$string = "dabAcCaCBAcCcaDA";

$check = array();

//Create an array of combinations to check:
foreach(range('A','Z') as $char) {
    $check[] = $char.strtolower($char);
    $check[] = strtolower($char).$char;
};


//scan 2 char at a time progressing by 1 until aA/Aa (or related) combo found
//Once found, remove it as a string, then start scan again from beginning.
//STill missing stuff, so run several times, to try and brut force clean up..??

for ($a = 0; $a < 2; $a++) {
    for ($loop = 0; $loop <= strlen($string); $loop++) {
        if (in_array(substr($string, $loop, 2), $check)) {
            $string = substr($string, 0, $loop) . substr($string, $loop + 2);
            //Reset the loop back to 0
            $loop = 0;
        }
    }
}

echo "final polymer is: ".$string."<br>";
echo "Resulting in the answer for question 1: ".strlen($string)."<br>";





$executionEndTime = microtime(true);
$executionSeconds = $executionEndTime - $executionStartTime;
echo "<hr><br> Script has ended and took this many seconds to run:".$executionSeconds;