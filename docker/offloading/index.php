<?php
    define("DB_SERVER", "35.241.227.23");
    define("DB_USERNAME", "root");
    define("DB_PASSWORD", getenv('DB_PASSWORD'));
    define("DB_DATABASE", "tfm");
    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

// use usleep to delay execution in microseconds for reporting purposes
//usleep(250000);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully to UC3M SSL Cipher testing in container platforms";
echo "<br>";
echo "<br>";

echo "Number of students enrolled in courses grouped by subject";
echo "<br>";

$sql = "SELECT su.title, COUNT(1) AS studentnum FROM subjects su LEFT JOIN students st ON su.subjectid = st.subject GROUP BY su.title";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
      $tableRows .= "<tr>";
      $tableRows .= "<td>" . $row['title'] . "</td>";
      $tableRows .= "<td>" . $row['studentnum'] . "</td>";
      $tableRows .= "</tr>";
  }
} else {
        echo "0 results";
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $motivational_letter = $_POST["motivational_letter"];

    // Insert data into the database
    $query = "INSERT INTO students (name, email, subject, motivational_letter) VALUES ('$name', '$email', '$subject', '$motivational_letter')";
    if ($conn->query($query) === TRUE) {
        echo "Data inserted successfully!";
        // Increment the count after successful insertion
        // $count++;
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Course Enrollment</title>
</head>
<body>
    <table border="1">
        <tr>
            <th>Title</th>
            <th>Number of Students Enrolled</th>
        </tr>
        <?php echo $tableRows; ?>
    </table>
    <h2>Enroll new student:</h2>
    <form method="post" action="">
        <table>
            <tr>
                <th>Name:</th>
                <td><input type="text" name="name"></td>
            </tr>
            <tr>
                <th>Email:</th>
                <td><input type="email" name="email"></td>
            </tr>
            <tr>
                <th>Subject:</th>
                <td>
                    <select name="subject">
                        <option value="1">Secure Architecture</option>
                        <option value="2">Cyber Attack</option>
                        <option value="3">Cyber Defence</option>
                        <option value="4">Data Protection</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Motivation Letter:</th>
                <td><input type="text" name="motivational_letter"></td>
            </tr>
        </table>
    </form>
</body>
</html>

