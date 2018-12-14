<?php

$raw_input = "
Step P must be finished before step F can begin.
Step F must be finished before step M can begin.
Step Q must be finished before step S can begin.
Step K must be finished before step G can begin.
Step W must be finished before step X can begin.
Step V must be finished before step I can begin.
Step S must be finished before step Y can begin.
Step U must be finished before step D can begin.
Step J must be finished before step B can begin.
Step Z must be finished before step C can begin.
Step Y must be finished before step D can begin.
Step X must be finished before step A can begin.
Step E must be finished before step N can begin.
Step M must be finished before step B can begin.
Step N must be finished before step I can begin.
Step I must be finished before step T can begin.
Step H must be finished before step A can begin.
Step A must be finished before step B can begin.
Step O must be finished before step L can begin.
Step T must be finished before step L can begin.
Step D must be finished before step R can begin.
Step G must be finished before step L can begin.
Step C must be finished before step R can begin.
Step R must be finished before step L can begin.
Step L must be finished before step B can begin.
Step O must be finished before step R can begin.
Step Q must be finished before step I can begin.
Step M must be finished before step L can begin.
Step R must be finished before step B can begin.
Step J must be finished before step O can begin.
Step O must be finished before step B can begin.
Step Y must be finished before step L can begin.
Step G must be finished before step R can begin.
Step P must be finished before step Z can begin.
Step K must be finished before step Y can begin.
Step X must be finished before step I can begin.
Step E must be finished before step H can begin.
Step I must be finished before step H can begin.
Step P must be finished before step K can begin.
Step G must be finished before step B can begin.
Step H must be finished before step L can begin.
Step X must be finished before step C can begin.
Step P must be finished before step X can begin.
Step X must be finished before step M can begin.
Step Q must be finished before step H can begin.
Step S must be finished before step Z can begin.
Step C must be finished before step B can begin.
Step N must be finished before step A can begin.
Step M must be finished before step R can begin.
Step X must be finished before step E can begin.
Step P must be finished before step L can begin.
Step H must be finished before step G can begin.
Step E must be finished before step D can begin.
Step D must be finished before step L can begin.
Step W must be finished before step A can begin.
Step S must be finished before step X can begin.
Step V must be finished before step O can begin.
Step H must be finished before step B can begin.
Step T must be finished before step B can begin.
Step Y must be finished before step C can begin.
Step A must be finished before step R can begin.
Step N must be finished before step L can begin.
Step V must be finished before step Z can begin.
Step W must be finished before step V can begin.
Step S must be finished before step M can begin.
Step Z must be finished before step A can begin.
Step W must be finished before step S can begin.
Step Q must be finished before step R can begin.
Step N must be finished before step G can begin.
Step Z must be finished before step L can begin.
Step K must be finished before step O can begin.
Step X must be finished before step R can begin.
Step V must be finished before step H can begin.
Step P must be finished before step R can begin.
Step M must be finished before step A can begin.
Step K must be finished before step L can begin.
Step P must be finished before step M can begin.
Step F must be finished before step N can begin.
Step W must be finished before step H can begin.
Step K must be finished before step B can begin.
Step H must be finished before step C can begin.
Step X must be finished before step H can begin.
Step V must be finished before step U can begin.
Step S must be finished before step H can begin.
Step J must be finished before step X can begin.
Step S must be finished before step N can begin.
Step V must be finished before step A can begin.
Step H must be finished before step O can begin.
Step Y must be finished before step O can begin.
Step H must be finished before step R can begin.
Step X must be finished before step T can begin.
Step J must be finished before step H can begin.
Step G must be finished before step C can begin.
Step E must be finished before step R can begin.
Step W must be finished before step J can begin.
Step F must be finished before step E can begin.
Step P must be finished before step I can begin.
Step F must be finished before step T can begin.
Step J must be finished before step L can begin.
Step U must be finished before step Z can begin.
Step Q must be finished before step D can begin.
";

//turn all input into a 2d array.
$input_explode = explode(".",$raw_input);
$line = 0;

foreach ($input_explode as $value) {
    //$value = $value_input;
    //echo $value."<br>";
    //echo substr($value,7,1)."<br>";
    $input[$line][0] = substr($value,7,1);
    $input[$line][1] = substr($value,38,1);
    $input[$line][2] = 0;
    $line++;
}

//find the start letter (the letter to rule them all (p,q,w)
for ($a = 0; $a < 99; $a++) {
    for ($b = 0; $b < 99; $b++) {
        if ($input[$a][0] == $input[$b][1]) {
            $input[$a][2] = 1;
        }
    }
}
//print_r ($input);

//creat array for the letters
//unused, if letter has not yet been used in a sequence
//active, if it is the last used number in sequence
//potential, if it could be the next number in sequence
//inuse, part is being built now
//used, if it's already been used
//for ($a = "A"; $a <= "Z"; $a++) {

$az_counter = 1;
foreach(range('A','Z') as $a) {
    $letter[$a] = "unused";
    $letter_value[$a] = $az_counter;
    $az_counter++;
}

//We know from earlier function that p is the starting letter, cutting corners...
$letter["P"] = "potential";
$letter["Q"] = "potential";
$letter["W"] = "potential";
$worker[0]["time"] = 0;
$worker[1]["time"] = 0;
$worker[2]["time"] = 0;
$worker[3]["time"] = 0;
$worker[4]["time"] = 0;
$worker[0]["letter"] = 0;
$worker[1]["letter"] = 0;
$worker[2]["letter"] = 0;
$worker[3]["letter"] = 0;
$worker[4]["letter"] = 0;
$code = "";

echo "<table border='1'><tr><th>Sec</th><th>0 L</th><th>0 T</th><th>1 L</th><th>1 T</th><th>2 L</th><th>2 T</th><th>3 L</th><th>3 T</th><th>4 L</th><th>4 T</th></tr>";


//loop to sort it all out
for ($second = 1; $second < 9999; $second++) {
    //Set all letters to their correct status.
    //for ($b = "A"; $b <= "Z"; $b++) {
    /*foreach(range('A','Z') as $b) {
        if ($letter[$b] == "unused") {
            $checker = 0;
            for ($c = 0; $c < 99; $c++) {
                if ($input[$c][1] == $b) {
                    if ($letter[$input[$c][0]] == "unused") {
                        $checker = 1;
                    }
                    if ($letter[$input[$c][0]] == "potential") {
                        $checker = 1;
                    }
                    if ($letter[$input[$c][0]] == "inuse") {
                        $checker = 1;
                    }
                }
            }
            //echo " ".$checker." | ";
            if ($checker == 0) {
                $letter[$b] = "potential";
            }
        }
    }*/
    //Work work, off I go then
    //$code = $code.$active_letter;
    //$letter[$active_letter] = "used";
    //$active_letter = min(array_keys($letter,"potential"));
    //$letter[$active_letter] = "active";
    //print_r($letter);

    echo "<tr><td>".$second."</td>";
    //Process each worker
    for ($d = 0; $d < 5; $d++) {
        //subtract 1 second from worker before doing the calculations
        if ($worker[$d]["time"] > 0) {
            $worker[$d]["time"]--;
        }

        //if they are not working currently
        if ($worker[$d]["time"] == 0) {
            //if they have been working on a part, it is now done
            $letter[$worker[$d]["letter"]] = "used";
            $worker[$d]["letter"] = 0;

            //Update the A-Z table now that something has been completed
            foreach(range('A','Z') as $b) {
                if ($letter[$b] == "unused") {
                    $checker = 0;
                    for ($c = 0; $c < 99; $c++) {
                        if ($input[$c][1] == $b) {
                            if ($letter[$input[$c][0]] == "unused") {
                                $checker = 1;
                            }
                            if ($letter[$input[$c][0]] == "potential") {
                                $checker = 1;
                            }
                            if ($letter[$input[$c][0]] == "inuse") {
                                $checker = 1;
                            }
                        }
                    }
                    //echo " ".$checker." | ";
                    if ($checker == 0) {
                        $letter[$b] = "potential";
                    }
                }
            }

            //Is there an available/potential part/letter
            //If so assign it
            if (array_keys($letter,"potential")) {
                $active_letter = min(array_keys($letter,"potential"));
                $letter[$active_letter] = "inuse";
                $worker[$d]["letter"] = $active_letter;
                //calculate how long letter will take
                $worker[$d]["time"] = 60 + $letter_value[$active_letter];
            }
        }
        //else {
        //    $worker[$d]["time"]--;
        //}
        //Show some output
        //echo $second." Worker: ".$d." Task: ".$worker[$d]["letter"]." Remaining: ".$worker[$d]["time"]." | ";
        echo "<td>".$worker[$d]["letter"]."</td><td>".$worker[$d]["time"]."</td>";
    }
    echo "</tr>";

    //Result: 447 is to low!!
    //REsult: 865 is wrong..
    //Result: 866 is to high!!
    if (($worker[0]["time"] == 0) && ($worker[1]["time"] == 0) && ($worker[2]["time"] == 0) && ($worker[3]["time"] == 0) && ($worker[4]["time"] == 0)) {
        echo "</table><br>";
        foreach(range('A','Z') as $b) {
            echo $b." ".$letter[$b]."<br>";
        }
        $seconds = $second - 2;
        echo "Total time taken is: ".$seconds." seconds";
        break;
    }

}