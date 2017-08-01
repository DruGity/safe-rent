<?php

$result = array('y' => 0, 'm' => 0, 'd' => 0);

$b = "2020-10-27";
$a = "2014-10-28";

$monthArr = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

$dateArFirst = explode('-', $a);

$dateArSecond = explode('-', $b);

$result['y'] = $dateArFirst[0] - $dateArSecond[0];
if ($dateArFirst[0] < $dateArSecond[0]) {
    $result['y'] = $dateArSecond[0] - $dateArFirst[0];

    $result['m'] = $dateArSecond[1] - $dateArFirst[1];
    $result['d'] = $dateArSecond[2] - $dateArFirst[2];

    if ($dateArFirst[1] > $dateArSecond[1]) {
        $result['y'] -= 1;
        $result['m'] = 12 - $dateArFirst[1] + $dateArSecond[1];
    }

    if ($dateArSecond[2] < $dateArFirst[2]) {
        $index = $dateArFirst[1] - 1;
        $result['d'] = $monthArr[$index] - $dateArFirst[2] + $dateArSecond[2];
        $result['m'] -= 1;
        if ($result['m'] == -1) {
            $result['m'] = 11;
            $result['y'] -= 1;
        }
    }

    $counter = 0;
    for ($j = $dateArFirst[0]; $j <= $dateArSecond[0]; $j++) {

        if (isLeap($j) == 1) {
            $monthArr[1] = 29;
            $counter += 1;
        }
    }

    $dayCount = $result['d'];
    $yearInDay = $result['y'] * 365;
    $firstMonth = $dateArSecond[1] - 1;
    $secondMonth = $dateArFirst[1] - 1;
    $monthInDay = 0;

    if ($dateArFirst[1] > $dateArSecond[1]) {
        $monthInDay = fullSumInvert($monthArr, $firstMonth, $secondMonth);
        $monthInDay += $counter;
        if ($dateArSecond[1] <= 2) {
            $monthInDay += 1;
        }
    }
    elseif ($dateArFirst[1] < $dateArSecond[1]) {
        $monthInDay = sum($monthArr, $firstMonth, $secondMonth);

        $monthInDay +=$counter;
            if ($dateArSecond[1] <= 2) {
                $monthInDay += 1;
            }

        }else{
        $monthInDay = sum($monthArr, $firstMonth, $secondMonth);
        $monthInDay +=$counter;
        $allDays = $yearInDay + $monthInDay + $dayCount;
    }

    if ($result['m'] >= 1) {
        $allDays = $yearInDay + $monthInDay + $dayCount;
    }
    if ($dateArSecond[2] == $dateArFirst[2]) {
        $allDays = $yearInDay + $monthInDay + $dayCount;
    } elseif ($dateArSecond[2] < $dateArFirst[2]) {
        $index = $monthArr[$firstMonth];
        $index2 = $monthArr[$secondMonth];
        $difference = $index - $index2;
        $dayCount = $monthArr[$firstMonth] - $dateArFirst[2] + $dateArSecond[2] - $difference;
        $result['d'] = $dayCount;
        $allDays = $yearInDay + $monthInDay + $dayCount;
    }

    echo "<br />". $allDays . " - days sum" ."<br />";

}
function isLeap($y)
{
    if ($y % 400 == 0 || ($y % 100 != 0 and $y % 4 == 0)) {
        return 1;
    }
    return 0;
}
function fullSumInvert($monthArr, $start, $finish)
{
    $sum = 0;
    for ($i = 0; $i <= 11; $i++) {
        if ($i <= $start or $i > $finish) {
            $sum += $monthArr[$i];
        }
    }
    return $sum;
}

function sum($monthArr, $start, $finish)
{
    $sum = 0;
    for ($i = 0; $i <= 11; $i++) {
        if ($i < $start and $i >= $finish) {
            $sum += $monthArr[$i];
        }
    }
    return $sum;
}
echo "Difference between two dates:";
print_r($result);
