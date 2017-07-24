<?php

function price_format($value)
{
    return 'R ' . number_format($value, 2, '.', ' ');
}
