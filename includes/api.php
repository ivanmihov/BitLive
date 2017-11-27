<?php
/*
 *
 * Copyright (c) 2017 Ivan Mihov mihovim@gmail.com
 *
 */

require_once('data.class.php');

$data = new Data();
$currency = $_GET['currency'];

$bitcoin_price = $data->getPrice($currency);

echo json_encode($bitcoin_price);
