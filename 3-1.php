<?php

$executionStartTime = microtime(true);
echo "<html><body><h1>Advent of Code</h1><br>";
$input = file("3-1-input.txt");
set_time_limit(240);
//example: #74 @ 278,974: 18x23
//#1 @ 1,3: 4x4
//Answer: 103646 is too low!
//Answer: 330783 is too high!
$fabricx = 0;
$fabricy = 0;

$squares = array();

//create all the square objects
foreach ($input as $line) {
    //echo $line."<br>";
    $squares[] = new square($line);
}

//try and find total size of fabric
foreach ($squares as $square) {
    if ($fabricx < $square->xend) {
        $fabricx = $square->xend;
    }
    if ($fabricy < $square->yend) {
        $fabricy = $square->yend;
    }
}

//create a massive array
/*
for ($x=0; $x < $fabricx; $x++) {
    for ($y=0; $y < $fabricy; $y++) {
        $fabric[$x][$y] = 0;
    }
}
*/

//add +1 to any inch that has fabric overlap on it
foreach ($squares as $square) {
    for ($x = $square->xstart; $x < $square->xend; $x++) {
        for ($y = $square->ystart; $y < $square->yend; $y++) {
            $fabric[$x][$y]++;
            //echo "ID = ".$square->id." | x = ".$x." | y =  ".$y." | total = ".$fabric[$x][$y]."<br>";
        }
    }
}

$count = 0;
//echo "<table>";
for ($y = 0; $y < $fabricy; $y++) {
    //echo "<tr>";
    for ($x = 0; $x < $fabricx; $x++) {
        // set to > 0 for troubleshooting, > 1 to work
        if ($fabric[$x][$y] > 1) {
            //echo "<td>".$fabric[$x][$y]."</td>";
            $count++;
        }
        else {
            //echo "<td>.</td>";
        }
    }
    //echo "</tr>";
}
//echo "</table><p>";
echo "Part 1 answer: ".$count."<p><hr>";

//part 2:

echo "Part 2<br>";

//Figure out which squares have collisions
//For some reason this did not work, not sure why...??
//it gave multiple answers
/*
foreach ($squares as $square1) {
    foreach ($squares as $square2) {
        $square1->collision($square2);
    }
}*/

//try and do the collision detection a different way...
foreach ($squares as $square) {
    for ($x = $square->xstart; $x < $square->xend; $x++) {
        for ($y = $square->ystart; $y < $square->yend; $y++) {
            if ($fabric[$x][$y] > 1) {
                $square->collision = "yes";
            }
        }
    }
}

//Find any squares who did not collide

foreach($squares as $square) {
    if ($square->collision == "no") {
        echo "Answer is: ".$square->id."<br>";
    }
}


$executionEndTime = microtime(true);
$executionSeconds = $executionEndTime - $executionStartTime;
echo "<hr><br> Script has ended and took this many seconds to run:".$executionSeconds;

//square class
class square {

    public $collision = "no";

    function __construct($line)
    {
        $this->id = $this->getdata($line, "#", "@");
        $this->xstart = $this->getdata($line, "@", ",");
        $this->ystart = $this->getdata($line, ",", ":");
        $this->xlength = $this->getdata($line, ":", "x");
        $this->ylength = $this->getdata($line, "x", "\n");
        $this->xend = $this->xstart + $this->xlength;
        $this->yend = $this->ystart + $this->ylength;
        //echo "creating ID:".$this->id." | ".$this->xlength." | ".$this->ylength."<br>";
    }

    function getdata($line, $first, $last)
    {
        $start = 1 + (strpos($line, $first));
        $finish = strpos($line, $last);
        $length = $finish - $start;
        $find = substr($line, $start, $length);
        $output = trim($find, " ");
        return $output;
    }

    function collision($square) {
        if ($this->id != $square->id) {
            if ((($this->xstart >= $square->xstart) && ($this->xstart <= $square->xend)) || (($this->xend >= $square->xstart) && ($this->xend <= $square->xend))) {
                if ((($this->ystart >= $square->ystart) && ($this->ystart <= $square->yend)) || (($this->yend >= $square->ystart) && ($this->yend <= $square->yend))) {
                    $this->collision = "yes";
                    $square->collision = "yes";
                    //echo $this->id.$this->collision." collieded with: ".$square->id.$square->collision."<br>";
                }
            }
        }
    }
}