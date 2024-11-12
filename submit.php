<?php
    //Database Connection Details
    $host = 'localhost';
    $dbname = 'db2102';
    $username = 'root';
    $password = '';

    //Connect to the database - mysqli
    $conn = new mysqli($host,$username,$password,$dbname);

    //Check the Database Connection
    if($conn->connect_error)
    {   
         die("Connection failed" . $conn->connect_error);
    }
    //Check if form is being submitted
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $name = $_POST['name'];
        $password = $_POST['password'];

        //Prepare an SQL statement to prevent SQL injection
        $stmt = $conn->prepare("INSERT INTO dbauth (username, password) VALUES (?,?)");
        $stmt->bind_param("ss", $name, $password);

        //Execute the statement
        if($stmt->execute()){
            echo "Data inserted successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        //Close the statement and connection
        $stmt->close();
        $conn->close();
    }