<?php
/*
 *
 * Copyright (c) 2017 Ivan Mihov mihovim@gmail.com
 *
 */

class Data
{
    public function getPrice($currency)
    {
        $ticker = 'BTC';
        $string = 'https://cex.io/api/ticker/' . strtoupper($ticker) .'/' . strtoupper($currency);
        $raw = file_get_contents($string);
        $json_data = json_decode($raw, true);
        return $json_data;
    }
}
