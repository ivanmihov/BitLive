<?php

require_once('data.class.php');

$data = new Data();
$currency = $_GET['currency'];

$bitcoin_price = $data->getPrice($currency);

echo json_encode($bitcoin_price);
