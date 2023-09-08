<?php
echo "Connected successfully to UC3M SSL Cipher testing in container platforms";
echo "<br>";
echo "<br>";

echo "Number of students enrolled in courses grouped by subject";
echo "<br>";

$headers = apache_request_headers();        
foreach ($headers as $header => $value) {
 echo "<pre>";
 echo "$header : $value";
 echo "</pre>";
}

$headers =  getallheaders();
foreach($headers as $key=>$val){
  echo $key . ': ' . $val . '<br>';
}

?>

