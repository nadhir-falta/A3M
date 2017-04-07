<?php
$pp_hostname = "www.sandbox.paypal.com";
$req = 'cmd=_notify-synch';

$configs = include('../php/dbconf.php');
$servername = $configs->servername;
$username = $configs->username;
$dbpassword = $configs->dbpassword;
$dbname = $configs->dbname;
// 1. Create a database connection
$connection = new mysqli($servername, $username, $dbpassword, $dbname);
if ($connection->connect_errno) {
    exit();
}
// 2. Select a database to use
$db_select = mysqli_select_db($connection, $dbname);

$tx_token = $_GET['tx'];
$auth_token = "QMsNOGiyI4Bvt5lVLpa0eaC7nBxop19MAWUd6owXlUgYCxinHgyd-4NDVuu";
$req .= "&tx=$tx_token&at=$auth_token";
$payStatus = false;
$membershipType = '';
$paymentSuccesText = '';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://$pp_hostname/cgi-bin/webscr");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Host: $pp_hostname"));
$res = curl_exec($ch);
curl_close($ch);

if(!$res){
    //HTTP ERROR
}else{
    // parse the data
    $lines = explode("\n", trim($res));
    $keyarray = array();
    if (strcmp ($lines[0], "SUCCESS") == 0) {
        $payStatus = true;
        for ($i = 1; $i < count($lines); $i++) {
//            echo '$lines[$i]'. $lines[$i];
//            echo '<br>';
            $temp = explode("=", $lines[$i],2);
            $keyarray[urldecode($temp[0])] = urldecode($temp[1]);
        }

        $payerfirstname = $keyarray['first_name'];
        $payerlastname = $keyarray['last_name'];
        $payerEmail = $keyarray["payer_email"];
        $itemname = $keyarray['item_name'];
        $amount = $keyarray['payment_gross'];
        $membershipType = $keyarray['option_selection1'];

        $paymentSuccesText = "<div class='alert alert-success'><p><h3>Thank you " . $payerfirstname . ' ' . $payerlastname . "</h3><h4> for your Interest in becoming a member of A3M</h4></p>" .
        "<b>Next Step:</b><br>\n".
        "<li>Fill out the form below to complete your application, once your application is approved, you will be notified by an email from our admin</li></div>";
//        "<li>Name:" .  $payerfirstname . ' ' . $payerlastname . "</li>\n".
//        "<li>Email:" .  $payerEmail . "</li>\n".
//        "<li>Item:" .  $itemname . "</li>\n".
//        "<li>Amount:" .  $amount . "</li>\n".
//        "<li>Membership:" .  $membershipType . "</li></div>";

    }
    else if (strcmp ($lines[0], "FAIL") == 0) {
        // log for manual investigation
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>A3Michigan</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" href="../css/bootstrap-min.css">
    <link rel="stylesheet" href="../css/bootstrap-formhelpers-min.css" media="screen">
    <link rel="stylesheet" href="../css/bootstrapValidator-min.css"/>
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css"/>
    <link rel="stylesheet" href="../css/bootstrap-side-notes.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="../js/bootstrap-formhelpers-min.js"></script>
    <script type="text/javascript" src="../js/bootstrapValidator-min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#payment-form').bootstrapValidator({
                message: 'This value is not valid',
                feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    fname: {
                        validators: {
                            notEmpty: {
                                message: 'First Name is required and cannot be empty'
                            }
                        }
                    },
                    lname: {
                        validators: {
                            notEmpty: {
                                message: 'Last Name is required and cannot be empty'
                            }
                        }
                    },
                    address1: {
                        validators: {
                            notEmpty: {
                                message: 'The street is required and cannot be empty'
                            },
                            stringLength: {
                                min: 6,
                                max: 96,
                                message: 'The street must be more than 6 and less than 96 characters long'
                            }
                        }
                    },
                    city: {
                        validators: {
                            notEmpty: {
                                message: 'The city is required and cannot be empty'
                            }
                        }
                    },
                    state: {
                        validators: {
                            notEmpty: {
                                message: 'The state is required and cannot be empty'
                            }
                        }
                    },
                    zip: {
                        validators: {
                            notEmpty: {
                                message: 'The zip is required and cannot be empty'
                            },
                            stringLength: {
                                min: 3,
                                max: 9,
                                message: 'The zip must be more than 3 and less than 9 characters long'
                            }
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: "The email address is required and can't be empty"
                            },
                            emailAddress: {
                                message: 'The input is not a valid email address'
                            },
                            stringLength: {
                                min: 6,
                                max: 65,
                                message: 'The email must be more than 6 and less than 65 characters long'
                            }
                        }
                    },
                    phone: {
                        selector: '#phone',
                        validators: {
                            notEmpty: {
                                message: "The phone number is required and can't be empty"
                            },
                            phone: {
                                message: 'The amount is not a valid',
                            }
                        }
                    },
                    occupation: {
                        selector: '#occupation',
                        validators: {
                            notEmpty: {
                                message: "The occupation is required and can't be empty"
                            },
                            occupation: {
                                message: 'The occupation is not a valid',
                            }
                        }
                    },
                    password: {
                        selector: '#password',
                        validators: {
                            notEmpty: {
                                message: "The password is required and can't be empty"
                            },
                            password: {
                                message: 'The password is not a valid',
                            },
                            identical: {
                                field: 'confirmPassword',
                                message: 'The password and its confirm are not the same'
                            }
                        }
                    },
                    confirmPassword: {
                        selector: '#confirmPassword',
                        validators: {
                            notEmpty: {
                                message: "The confirmPassword is required and can't be empty"
                            },
                            confirmPassword: {
                                message: 'The confirmPassword is not a valid',
                            },
                            identical: {
                                field: 'password',
                                message: 'The password and its confirm are not the same'
                            }
                        }
                    }
                }
            });
        });
    </script>
</head>
<body id="top">
<div class="bgded overlay" style="background-image:url('../img/backgrounds/membership.jpg');">
    <div class="wrapper row1">
        <header id="header" class="hoc clear">
            <nav id="" class="navbar navbar-inverse bg-inverse">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="../index.html">A3M</a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li><a href="../index.html">HOME</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ABOUT<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="../index.html#whatwedo">WHAT WE DO</a></li>
                                    <li><a href="./feedback.php">FEEDBACK</a></li>
                                </ul>
                            </li>
                            <li><a href="./survey.html">SURVEY</a></li>
                            <li class="dropdown active">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">FORMS<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="./membership-form.html">MEMBERSHIP</a></li>
                                    <li><a href="./bylaws.html">BYLAWS</a></li>
                                </ul>
                            </li>
                            <li><a href="./donation.php">DONATE</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">GALLERIES<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="./algeria.html">ALGERIA</a></li>
                                    <li><a href="./usa.html">USA</a></li>
                                    <li><a href="./michigan.html">MICHIGAN</a></li>
                                </ul>
                            </li>
                            <li><a href="./news.html">NEWS</a></li>
                            <li><a href="../index.html#contact">CONTACT</a></li>
                            <li><a href="./register.html">REGISTER</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-user" aria-hidden="true"></i>  ACCOUNT  <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="profile.php">PROFILE</a></li>
                                    <li><a href="login.php">LOGIN</a></li>
                                    <li><a href="logout.php">LOGOUT</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
    </div>

    <section id="breadcrumb" class="hoc clear">
        <h6 class="heading" style="font-size: 3.0vw;">Membership</h6>
        <ul>
            <li><a href="../index.html">Home</a></li>
            <li><a href="./register.html">Membership</a></li>
        </ul>
    </section>
</div>
<div class="wrapper row3">
    <main class="hoc container clear">
        <form action="" method="POST" id="payment-form">

            <?php
            $dbErrors = array();  // array to hold validation errors
            $dbSuccess = '';
            $duplicateError = '';
            $info = array();
            if ($_POST && $payStatus) {

                // data to pass to the database
                $fname = $_POST["fname"];
                $lname = $_POST["lname"];
                $spouse = $_POST["spouse"];
                $address1 = $_POST["address1"];
                $address2 = $_POST["address2"];
                $city = $_POST["city"];
                $state = $_POST["state"];
                $zip = $_POST["zip"];
                $phone = $_POST["phone"];
                $email = $_POST["email"];
                $occupation = $_POST["occupation"];
                $employer = $_POST["employer"];
                $membership = $membershipType;
                $password = $_POST["password"];

                //check if the a member with the same first name and last exist
                $result = mysqli_query($connection, "SELECT * FROM users WHERE email='$email' OR fname='$fname' and lname='$lname'");
                $row = mysqli_fetch_array($result, MYSQLI_NUM);

                if($row[0]) {
                    $duplicateError = '<div class="alert alert-danger">
                                        <strong>Error!</strong> A member with that email or first and last name already exist in our database.
                                      </div>';
                }

                if (!$duplicateError) {
                    $sql = "INSERT INTO `users` (`fname`, `lname`, `spouse`, `address1`, `address2`, `city`, `state`, `zipcode`, `phone`, `email`, `occupation`, `employer`, `membership`, `password`) VALUES
                                ('$fname', '$lname', '$spouse', '$address1', '$address2', '$city', '$state', '$zip' , '$phone', '$email', '$occupation', '$employer', '$membership', '$password')";

                    if (!mysqli_query($connection, $sql)) {
                        $dbErrors['duplicate'] = true;
                        $info['success'] = false;
                        $info['errors'] = $dbErrors;
                        echo '' . mysqli_error($connection);
                        echo '**************************************************************';
                    } else {
                        $dbSuccess = '<div class="alert alert-success">
                                        <strong>Success!</strong> 
                                        <p>Your application has been successfully submitted.</p><br>
                                        <p>You can login to complete your profile and access the members only section.</p>
                                      </div>';
                        echo '<script type="text/javascript">window.location.replace("http://www.a3michigan.org/pages/login.php?success=true");</script>';
                        exit();
                    }
                }
            }
            ?>
            <span class="payment-success" id="paymentSucc">
                <?= $paymentSuccesText ?>
            </span>
            <span class="payment-errors">
                <?= $duplicateError ?>
            </span>
            <span class="payment-success">
                <?= $dbSuccess ?>
            </span>
            <div class="row" id="registrationCont">
                <div class="col-xs-12 col-sm-10 col-md-8 col-sm-offset-2 col-md-offset-2">
                    <h2>Please Sign Up
                        <small> for A3M Membership.</small>
                    </h2>
                    <p>Full Membership is extended to persons and businesses who support our mission regardless of race,
                        national origin, sex, disability, or religion</p>
                    <hr class="colorgraph">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="form-group">
                                <input type="text" name="fname" id="fname" class="fname form-control input-sm"
                                       placeholder="First Name">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="form-group">
                                <input type="text" name="lname" id="lname" class="lname form-control input-sm"
                                       placeholder="Last Name">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="form-group">
                                <input type="text" name="spouse" id="spouse" class="spouse form-control input-sm"
                                       placeholder="Spouse">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-8">
                            <div class="form-group">
                                <input type="text" name="address1" id="address1" class="address form-control input-sm"
                                       placeholder="Address 1">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="form-group">
                                <input type="text" name="address2" id="address2" class="address2 form-control input-sm"
                                       placeholder="Address 2">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="form-group">
                                <input type="text" name="city" id="city" class="city form-control input-sm"
                                       placeholder="City">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="form-group">
                                <input type="text" name="state" id="state" class="state form-control input-sm"
                                       placeholder="State">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="form-group">
                                <input type="text" name="zip" id="zip" class="state form-control input-sm"
                                       placeholder="Zip Code">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="text" name="phone" id="phone" class="zip form-control input-sm"
                                       placeholder="Primary Phone">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="email" name="email" id="email" class="email form-control input-sm"
                                       placeholder="Email Address">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="text" name="occupation" id="occupation"
                                       class="occupation form-control input-sm" placeholder="Occupation">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="text" name="employer" id="employer" class="form-control input-sm"
                                       placeholder="Employer">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="password" name="password" id="password"
                                       class="password form-control input-sm" placeholder="Password">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="password" name="confirmPassword" id="confirmPassword"
                                       class="confirmPassword form-control input-sm" placeholder="Confirm Password">
                            </div>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <center>
                                <button type="submit" class="btn btn-primary btn-block btn-lg">Register</button>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!--#################################################### End Of Form  ####################################################-->
        <div class="clear"></div>
    </main>
</div>

<!-- ################################################## Footer ################################# -->
<div class="wrapper row4 bgded overlay footerbg" id="contact">
    <footer id="footer" class="hoc clear">
        <div class="one_third first">
            <h6 class="heading">A3M</h6>
            <p>A3M is an Algerian American association that serves the needs of the Algerian American in Michigan</p>
            <nav>
                <ul class="nospace">
                    <li><a href="../index.html"><i class="fa fa-lg fa-home"></i></a></li>
                    <li><a href="./donation.php">Donate</a></li>
                    <li><a href="./register.html">Membership</a></li>
                    <li><a href="./feedback.php">Feedback</a></li>
                    <li><a href="./bylaws.html">Bylaws</a></li>
                    <li><a href="./survey.html">Survey</a></li>
                    <li><a href="./news.html">News</a></li>
                    <li><a href="./algeria.html">Gallery Algeria</a></li>
                    <li><a href="./usa.html">Gallery USA</a></li>
                    <li><a href="./michigan.html">Gallery Michigan</a></li>
                </ul>
            </nav>
        </div>
        <div class="one_third">
            <h6 class="heading">Address and Phone Numbers</h6>
            <ul class="nospace btmspace-30 linklist contact">
                <li><i class="fa fa-map-marker"></i>
                    <address>
                         Algerian-American Association
                           of Michigan
   <br>                          3385 Buckingham Trl
  <br>                          W Bloomfield, MI 48323
                    </address>
                </li>

                <li><i class="fa fa-envelope-o"></i> info@a3michigan.org</li>
            </ul>
            <ul class="faico clear">
                <li><a class="faicon-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a class="faicon-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a class="faicon-dribble" href="#"><i class="fa fa-dribbble"></i></a></li>
                <li><a class="faicon-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
                <li><a class="faicon-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
                <li><a class="faicon-vk" href="#"><i class="fa fa-vk"></i></a></li>
            </ul>
        </div>
        <div class="one_third">
            <h6 class="heading">Location</h6>
            <script src='https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyAz02yCRNu3uItDorLGL2s3tTJX6ye9DeU'></script>
            <div style='overflow:hidden;height:260px;width:80%;'>
                <div id='gmap_canvas' style='height:260px;width:80%;'></div>
                <style>#gmap_canvas img {
                        max-width: none !important;
                        background: none !important
                    }</style>
            </div>
            <a href='http://maps-generator.com/'>maps-generator.com</a>
            <script type='text/javascript'
                    src='https://embedmaps.com/google-maps-authorization/script.js?id=edb9cbe68b8845fb95f39b7df84c61d04cc2fbd7'></script>
            <script type='text/javascript'>function init_map() {
                    var myOptions = {
                        zoom: 12,
                        center: new google.maps.LatLng(42.331427, -83.0457538),
                        mapTypeId: google.maps.MapTypeId.ROADMAP
                    };
                    map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);
                    marker = new google.maps.Marker({
                        map: map,
                        position: new google.maps.LatLng(42.331427, -83.0457538)
                    });
                    infowindow = new google.maps.InfoWindow({content: '<strong></strong><br><br> Detroit<br>'});
                    google.maps.event.addListener(marker, 'click', function () {
                        infowindow.open(map, marker);
                    });
                    infowindow.open(map, marker);
                }
                google.maps.event.addDomListener(window, 'load', init_map);</script>

        </div>
        <!-- ################################################################################################ -->
    </footer>
</div>

<div class="wrapper row5">
    <div id="copyright" class="hoc clear">
        <p class="fl_left">Copyright &copy; 2016 - All Rights Reserved - <a href="http://www.a3michigan">www.a3michigan.com</a>
        </p>
    </div>
</div>

<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
<div style="z-index: 99999;position: fixed;bottom: 20px;left: 20px;">
    <a href="./donation.php">
        <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" alt="PayPal - The safer, easier way to pay online!">
    </a>
</div>
<!-- JAVASCRIPTS -->
<script src="../layout/scripts/jquery.backtotop.js"></script>
<script src="../layout/scripts/jquery.mobilemenu.js"></script>
<script src="../layout/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
