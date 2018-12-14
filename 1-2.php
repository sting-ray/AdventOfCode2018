<?php

//Answer: 402 is too low!
//2010 is too high!

//script needs time to run
set_time_limit(600);

echo "<html><body>";
$frequency = 0;
$answers = array();
$input = file("1-1-input.txt");
$answers_counter = 0;

for ($counter = 0; $counter < 999; $counter++) {
    foreach ($input as $line) {
        //echo "Input is: ".$line."<br>";
        $frequency = $frequency + $line;
        foreach ($answers as $value) {
            if ($frequency == $value) {
                echo "answer is: " . $frequency;
                break 3;
            }
        }
        $answers[$answers_counter] = $frequency;
        $answers_counter++;
    }
    echo "frequency: ".$frequency." loop: ".$counter." <br>";
}