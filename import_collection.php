<?php

$file = file_get_contents('public/docs/collection.csv');

$lines = explode(PHP_EOL, $file);
$collection = [];

foreach ($lines as $line) {
    $collection[] = str_getcsv($line);
}
var_dump($collection);