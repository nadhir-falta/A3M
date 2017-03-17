<?php
    $errors = array();  // array to hold validation errors
    $info = array();        // array to pass back data
    // $jsondata = file_get_contents("php://input");
    // $data = json_decode($jsondata, true);
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $spouse = $_POST["spouse"];
    $address1 = $_POST["address1"];
    $address2 = $_POST["address2"];
    $city =  $_POST["city"];
    $state = $_POST["state"];
    $zip =   $_POST["zip"];
    $phone =   $_POST["phone"];
    $email =   $_POST["email"];
    $occupation =   $_POST["occupation"];
    $employer =   $_POST["employer"];
    $membership =   $_POST["membership"];
    $password =   $_POST["password"];
    // validate the variables ========
    // if (!ctype_alpha(str_replace(array("'", "-"), "",$fname))) { 
    //    $errors['fnameAlph'] = true;
    // }
    // if (!ctype_alpha(str_replace(array("'", "-"), "", $lname))) { 
    //     $errors['lnameAlph'] = true;
    // }
    // if (empty($addr1)) { 
    //     $errors['addr1Empty'] = true;
    // }
    // if (empty($city)) { 
    //     $errors['cityEmpty'] = true;
    // }
    // if (empty($state)) { 
    //     $errors['stateEmpty'] = true;
    // }
    // if (empty($zip)) { 
    //     $errors['zipEmpty'] = true;
    // }
     echo "heeeeeeeeeeeeere";
    // response if there are errors
    if (empty($errors)) {
        echo "yaaaaaaaaaaaw";
        $info['success'] = true;
        $info['message'] = 'Success!';
        // $con = mysql_connect("localhost", "root", "Zb121788n@d") or die('Could not connect: ' . mysql_error());

        $servername = "localhost";
        $username = "nfalta";
        $password = "Zb121788n@d";
        $dbname = "a3m-db";

        echo "**** $fname $lname $spouse $address1 $address2 $city $state $zip $phone $email $occupation $employer $membership $password" ;
        // 1. Create a database connection
        $connection = mysqli_connect($servername,$username,$password);
        if (!$connection) {
            die("Database connection failed: " . mysqli_error());
        }
        else {
            echo "----------------------";
        }
        // 2. Select a database to use 
        $db_select = mysqli_select_db($connection, $dbname);
        if (!$db_select) {
            die("Database selection failed: " . mysqli_error());
        }
        else {
            echo "****************";
        }

        // mysqli_query($connection,"INSERT INTO `users` (`fname`, `lname`, `spouse`, `address1`, `address2`, `city`, `state`, `zipcode`, `phone`, `email`, `occupation`, `employer`, `membership`) VALUES ('$fname', '$lname', '$spouse', '$address1', '$address2', '$city', '$state', '$zip' , '$phone', '$email', '$occupation', '$employer', '$membership')") or die(mysqli_error($connection));
        $sql = "INSERT INTO `users` (`fname`, `lname`, `spouse`, `address1`, `address2`, `city`, `state`, `zipcode`, `phone`, `email`, `occupation`, `employer`, `membership`, `password`) VALUES
                                    ('$fname', '$lname', '$spouse', '$address1', '$address2', '$city', '$state', '$zip' , '$phone', '$email', '$occupation', '$employer', '$membership', '$password')";


        if(!mysqli_query($connection,$sql)) {
            $errors['duplicate'] = true;
            $info['success'] = false;
            $info['errors']  = $errors;
            echo ''.mysqli_error($connection);
            // echo json_encode($info);
            // die('Error : ' . mysql_error());
        } else {
            echo "yaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaay";
        }
        // Print "Your information has been successfully added to the database.";
        // mysql_close($sql_connection);
    } else {
      // if there are items in our errors array, return those errors
      $info['success'] = false;
      $info['errors']  = $errors;
    }
    // return all our data to an AJAX call
    echo json_encode($info);
?>