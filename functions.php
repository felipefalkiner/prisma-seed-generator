<?php

function returnBoolean($value){ 
    if($value == 1)
        return "true";
    else
        return "false";
}

function returnDate($date) {
    $dateTimeObj = new DateTime($date);

    $iso8601Format = $dateTimeObj->format('Y-m-d\TH:i:s.u\Z');

    return $iso8601Format;
}