<?php

function price_format($value, $shorten = false)
{
    if ($shorten) {
        if ($value >= 1000000000) {
            $value = number_format($value/1000000000, 2, '.', ' ') . 'B';
        } elseif ($value >= 1000000) {
            $value = number_format($value/1000000, 2, '.', ' ') . 'M';
        } elseif ($value >= 1000) {
            $value = number_format($value/1000, 2, '.', ' ') . 'K';
        }

        return 'R ' . $value;
    }

    return 'R ' . number_format($value, 2, '.', ' ');
}

function partition(array $list, $p)
{
    $listlen = count($list);
    $partlen = floor($listlen / $p);
    $partrem = $listlen % $p;
    $partition = array();
    $mark = 0;
    for ($px = 0; $px < $p; $px ++) {
        $incr = ($px < $partrem) ? $partlen + 1 : $partlen;
        $partition[$px] = array_slice($list, $mark, $incr);
        $mark += $incr;
    }
    return $partition;
}

function user_can($ability)
{
    abort_unless(Bouncer::allows($ability), 403);
}

function chartify($array)
{
    return "'" . implode("','", $array) . "'";
}
