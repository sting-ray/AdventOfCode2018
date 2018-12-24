<?php

$executionStartTime = microtime(true);
echo "<html><body><h1>Advent of Code</h1><br>";
$input = file("4-1-input.txt");
//set_time_limit(240);

//Answers:
//76576 is too high!
//20859 is correct:) - Pt1
//460 is too low!

foreach ($input as $line) {
    $events[] = $line;
}
//sort array, hopefully in date & time order
sort ($events);

//map every sleep minute for every guard into an array

//[1518-05-04 23:56] Guard #523 begins shift
//Array ( [0] => [1518-05-04 23:56] Guard #523 begins shift [1] => 05 [2] => 04 [3] => 23 [4] => 56 [5] => 523 )
//#guard[guard_id][min=>count]

$guardId = 0;
$sleepTime = 0;

foreach ($events as $line) {
    //Begin shift
    if (preg_match('/\[1518-(\d+)-(\d+) (\d+):(\d+)\] Guard #(\d+) begins shift/', $line, $event)) {
        $guardId = $event[5];
    }
    //Sleep event
    elseif (preg_match('/\[1518-(\d+)-(\d+) (\d+):(\d+)\] falls asleep/', $line, $event)) {
        $sleepTime = $event[4];
    }
    //Wake event
    elseif (preg_match('/\[1518-(\d+)-(\d+) (\d+):(\d+)\] wakes up/', $line, $event)) {
        for ($time = $sleepTime; $time < $event[4]; $time++) {
            $guards[$guardId][$time]++;
            $guardsTotal[$guardId]++;
        }
    }
    //Error event
    else {
        echo "something went wrong:".$event[0]."<br";
    }
}

//find largest time/minute and associated guard.
$minuteId = 0;
$minuteHighest = 0;
$guardId = 0;
$guardHighest = 0;

foreach ($guardsTotal as $id => $guardSleep) {
    echo "GuardID: ".$id." Slept for: ".$guardSleep."<br>";
    if ($guardHighest < $guardSleep) {
        $guardHighest = $guardSleep;
        $guardId = $id;
        foreach ($guards[$id] as $minute => $value) {
            if ($minuteHighest < $value) {
                $minuteHighest = $value;
                $minuteId = $minute;
            }
        }
    }
}
print_r($guards[409]);

$total = $minuteId * $guardId;

echo "<br>Part 1 answer - Guard: ".$guardId." * Minute: ".$minuteId." = ".$total;
//------ Pt2-----

//find the Guard who slept the most single minute the most
//$guards[$guardId][$time]++;
//correct answer is: 76576 <- Got it first try!:)

$minute = 0;
$highest = 0;
$guard = 0;

foreach ($guards as $guardId => $times) {
    foreach ($times as $time => $amount) {
        if ($amount > $highest) {
            $highest = $amount;
            $minute = $time;
            $guard = $guardId;
        }
    }
}

$total = $guard * $minute;

echo "<br>Part 2 answer - Guard: ".$guard." * Minute: ".$minute." = ".$total;

$executionEndTime = microtime(true);
$executionSeconds = $executionEndTime - $executionStartTime;
echo "<hr><br> Script has ended and took this many seconds to run:".$executionSeconds;