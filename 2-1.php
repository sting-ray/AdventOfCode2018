<?php

//281 is too low!

echo "<html><body>";
$input = file("2-1-input.txt");
$two = 0;
$three = 0;

foreach ($input as $line) {
    echo "checking: ".$line."<br>";
    $two_check = 0;
    $three_check = 0;
    foreach(range('a','z') as $letter) {
        if (substr_count($line, $letter) == 2) {
            $two_check = 1;
            echo $letter.substr_count($line, $letter)."<br>";
        }
        if (substr_count($line, $letter) == 3) {
            $three_check = 1;
            echo $letter.substr_count($line, $letter)."<br>";
        }
    }
    if ($two_check == 1) {
        $two++;
    }
    if ($three_check == 1) {
        $three++;
    }
}
$total = $two * $three;
echo $two." x ".$three." = ".$total;