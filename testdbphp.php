<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Northland Analytics PHP/MySQL Test Page</title>
</head>
<body>
    <h1>Northland Analytics PHP/MySQL Test Page</h1>
    <p>Database Records Found</p>

    <?php
    //this is the php object-oriented style of creating a MySQL connection
    $conn = new mysqli('localhost', 'joeax', 'abc123', 'employees');

    //check for connection success
    if ($conn->connect_error) {
        die("MySQL Connection Failed: " . $conn->connect_error);
    }
    echo "<p>MySQL Connection Succeeded</p>";

    //create the SQL select statement, notice the funky string concat at the end 
    //based on using the GET attribute
    $sql = "SELECT first_name, last_name, hire_date FROM employees";

    //put the result set into a variable, again object-oriented way of doing things
    $result = $conn->query($sql);

    //if there were no records found say so, otherwise create a while loop that
    //echos each line to the screen. You do this by creating some crazy looking 
    //HTML in the form of HTMLText . row[column] . HTMLText . row[column] . etc...
    // the dot "." is PHP's string concatenator operator
    echo "<ul>";
    if ($result->num_rows > 0) {  
        while ($row = $result->fetch_assoc()) {
            echo "<li>Employee: " . $row['first_name'] . " " . $row['last_name'] . " - Hire Date: " . $row['hire_date'] . "</li>";
        }
    } else {
        echo "<li>No Records Found</li>";
    }
    echo "</ul>";

    //always close the connection to the DB, don't leave 'em hanging
    $conn->close();
    ?>

    <!-- Hyperlink to MySQLi documentation -->
    <p>For more information on connecting PHP to MySQL, <a href="https://www.php.net/manual/en/book.mysqli.php" target="_blank">click here</a>.</p>

</body>
</html>

