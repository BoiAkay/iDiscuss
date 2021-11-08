<?php
$mac_adress = exec('getmac');
$mac_adress = strtok($mac_adress, ' ');
echo $mac_adress;
// string of length 17
?>

