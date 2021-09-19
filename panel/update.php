<?php

header("Content-Type: application/json; charset=UTF-8");
$obj = json_decode($_GET["data"]);
$objwithoutbs = stripslashes($obj);

$myfile = fopen("../live2d/message.json", "w") or die("Unable to open file!");
fwrite($myfile, $objwithoutbs);
fclose($myfile);

?>