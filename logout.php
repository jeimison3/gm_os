<?php
header('Content-type: application/json');
include("./phlib/sec.php");
CookieLogoff();
echo json_encode(array('status'=>1,'msg'=>"OK"));

?>