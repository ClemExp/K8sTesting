<?php
    define("DB_SERVER", "35.241.227.23");
    define("DB_USERNAME", "root");
    define("DB_PASSWORD", getenv('DB_PASSWORD'));
    define("DB_DATABASE", "tfm");
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

// use usleep to delay execution in microseconds for reporting purposes
usleep(250000);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully to UC3M Secure Architecture Lab backend";
echo "<br>";
echo "<br>";

echo "Displaying list of stored subjects retrieved from database";
echo "<br>";

$sql = "SELECT title FROM subjects ORDER BY 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
        echo "**********************************************";
        echo "<br>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
                echo $row['title']."<br>";
        }
} else {
        echo "0 results";
}
$conn->close();

?>
