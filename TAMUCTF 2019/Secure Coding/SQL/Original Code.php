<?php
  ini_set('display_errors', 'On');
  error_reporting(E_ALL | E_STRICT);
  
  echo "<html>";
  
  //Check if the variables were sent
  if (isset($_POST["username"]) && isset($_POST["password"])) {
  
    $servername = "localhost";
    $username = "sqli-user";
    $password = 'AxU3a9w-azMC7LKzxrVJ^tu5qnM_98Eb';
    $dbname = "SqliDB";
    
    //create the connection object of MySql
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error)
        die("Connection failed: " . $conn->connect_error);
     
    // Vulnerable part 1: Not validated user input
    $user = $_POST['username'];
    $pass = $_POST['password'];
    
    //Vulnerable part 2: Put user data directly into sql statement
    $sql = "SELECT * FROM login WHERE User='$user' AND Password='$pass'";
    
    if ($result = $conn->query($sql))
    {
      //Check if it returned any row
      if ($result->num_rows >= 1)
      {
        $row = $result->fetch_assoc(); 
        echo "You logged in as " . $row["User"];
        $row = $result->fetch_assoc();
        echo "<html>You logged in as " . $row["User"] . "</html>\n";
      }
      //Otherwise wrong credentials error
      else {
        echo "Sorry to say, that's invalid login info!";
      }
    }
    //Close connection
    $conn->close();
  }
  else
    echo "Must supply username and password...";
  echo "</html>";
?>
