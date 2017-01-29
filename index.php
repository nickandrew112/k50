<?php
include 'soch.php';


$combinator = new Combinator(3, 2);
$combinator->genSet(0);
$sets = $combinator->getSets();

foreach ($sets as $set)
{
    echo implode( ' ', $set) . PHP_EOL;
}
