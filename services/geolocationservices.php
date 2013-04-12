<?php

$address = urlencode("technopark, Trivandrun, kerala,India");
$region = "IND";
$json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false®ion=$region");

echo $json;

$decoded = json_decode($json);

print_r($decoded);


$json = json_decode($json);

$lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
$long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};

?>