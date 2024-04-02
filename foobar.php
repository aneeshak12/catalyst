<?php

$output = "";

for ($i = 1; $i <= 100; $i++) {
    $isDivisibleByFive = $i % 5 === 0;
    $isDivisibleByThree = $i % 3 === 0;

    if ($isDivisibleByThree) {
        $output .= "foo";
    }

    if ($isDivisibleByFive) {
        $output .= "bar";
    }

    if (!$isDivisibleByFive && !$isDivisibleByThree) {
        $output .= $i;
    }

    $output .= ',';
}

echo substr($output, 0, strlen($output) - 1);
