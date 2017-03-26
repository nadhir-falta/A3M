<?php

if ($_POST) {
    $servername = "localhost";
    $username = "nfalta";
    $dbpassword = "Zb121788n@d";
    $dbname = "a3m-db";

// 1. Create a database connection
    $connection = mysqli_connect($servername, $username, $dbpassword);
    if (!$connection) {
        die("Database connection failed: " . mysqli_error($connection));
    }
// 2. Select a database to use
    $db_select = mysqli_select_db($connection, $dbname);

    $email = $_POST["logEmail"];
    $password = $_POST["logPassword"];

    echo 'email: ' . $email;
    echo 'password' . $password;
    $result = mysqli_query($connection, "SELECT * FROM users WHERE email='$email' and password='$password'");

//    if($result)
//    {
//        echo "Successfully Logged In";
//    }
//    else
//    {
//        echo "Wrong Id Or Password";
//    }

    $row = mysqli_fetch_array($result, MYSQLI_NUM);
//    echo 'rooooow'.$row[0];
//    printf ("%s (%s)\n", $row[0], $row[1]);
    if($row[0]) {
        header("Location: http://www.a3michigan.org/pages/profile.php?id=$row[0]", TRUE, 302);
        exit();
//        throw new Exception("A member with that first and last name already exist in our database. No payment has been made yet");
    }



//$dologin = "select id,pass from user where id = $id and pass = $pass ";
//$result = mysql_query( $dologin );
//
//if($result)
//{
//    echo "Successfully Logged In";
//}
//else
//{
//    echo "Wrong Id Or Password";
//}
}

?>