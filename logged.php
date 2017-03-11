<?php
header('Content-type: application/json');
include_once('./phlib/getdatastate.php');
echo json_encode(array('status'=>isLogged()));
?>