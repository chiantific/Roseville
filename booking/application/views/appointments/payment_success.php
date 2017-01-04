<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#35A768">
    <title>Paiement</title>
</head>
<body>
<?php
echo "<h1>Process</h1>";
if($result == FALSE) {
    echo '<h4>Unexpected Error</h4>';
}
$result = str_replace('&', '&amp;', $result);
$result = str_replace('<', '&lt;', $result);
echo "<h4>START2</h4>";
echo "<pre>";
var_dump($result);
echo "</pre>";
echo "<h4>END</h4>";
?>
</body>
</html>
