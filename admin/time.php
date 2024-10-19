<?php
date_default_timezone_set('Asia/Colombo');
$currentDateTime = date('d-m-Y H:i:s');
echo json_encode($currentDateTime); // Return the date and time in JSON format
?>
