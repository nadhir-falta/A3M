<?php
$pp_hostname = "www.paypal.com";
$req = 'cmd=_notify-synch';

$configs = include('./php/dbconf.php');
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>A3Michigan</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="./layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" href="./css/bootstrap-min.css">
    <link rel="stylesheet" href="./css/bootstrap-formhelpers-min.css" media="screen">
    <link rel="stylesheet" href="./css/bootstrapValidator-min.css"/>
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css"/>
    <link rel="stylesheet" href="./css/bootstrap-side-notes.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="./js/bootstrap-formhelpers-min.js"></script>
    <script type="text/javascript" src="./js/bootstrapValidator-min.js"></script>
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

<div class="container">
    <nav id="" class="navbar navbar-inverse bg-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.html">A3M</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="index.html">HOME</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ABOUT<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="whatwedo.html">WHAT WE DO</a></li>
                        <li><a href="index.html#services">SERVICES</a></li>
                        <li><a href="feedback.php">FEEDBACK</a></li>
                    </ul>
                </li>
                <!--<li class="active"><a href="survey.html">SURVEY</a></li>-->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">FORMS<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="membership-form.html">MEMBERSHIP</a></li>
                        <li><a href="bylaws.html">BYLAWS</a></li>
                    </ul>
                </li>
                <li><a href="donation.php">DONATE</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">GALLERIES<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="algeria.html">ALGERIA</a></li>
                        <li><a href="usa.html">USA</a></li>
                        <li><a href="michigan.html">MICHIGAN</a></li>
                    </ul>
                </li>
                <li><a href="events.html">EVENTS</a></li>
                <li><a href="news.html">NEWS</a></li>
                <li><a href="#contact">CONTACT</a></li>
                <li class="active"><a href="./membership.php">REGISTER</a></li>
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
    </nav>
</div>

<!--<div class="backstretchOverlay">-->
<!--    <section id="breadcrumb" class="hoc clear">-->
<!--        <div class="bread-headder">Membership</div>-->
<!--        <ul>-->
<!--            <li><a href="./index.html">Home</a></li>-->
<!--            <li><a href="./membership.php">Membership</a></li>-->
<!--        </ul>-->
<!--    </section>-->
<!--</div>-->
<br>
<div class="wrapper row3">
    <br>
    <main class="hoc container clear">
        <form action="" method="POST" id="payment-form">

            <?php
            $dbErrors = array();  // array to hold validation errors
            $dbSuccess = '';
            $duplicateError = '';
            $info = array();
            if ($_POST) {

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
                $password = $_POST["password"];

                //check if the a member with the same first name and last exist
                $result = mysqli_query($connection, "SELECT * FROM users WHERE email='$email' OR fname='$fname' and lname='$lname'");
                $row = mysqli_fetch_array($result, MYSQLI_NUM);

                if($row[0]) {
                    $duplicateError = '<div class="alert alert-danger">
                                        <strong>Error!</strong> A member with that email or first and last name already exist in our database.
                                      </div>';
                    echo $duplicateError;
                }

                if (!$duplicateError) {
                    $sql = "INSERT INTO `users` (`fname`, `lname`, `spouse`, `address1`, `address2`, `city`, `state`, `zipcode`, `phone`, `email`, `occupation`, `employer`, `password`) VALUES
                                ('$fname', '$lname', '$spouse', '$address1', '$address2', '$city', '$state', '$zip' , '$phone', '$email', '$occupation', '$employer', '$password')";

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

                        $subject = "A3M Registration";
                        $body = 'Dear Community Member, <br/> 
                                <br/>We thank you for completing your membership registration and we welcome you to the A3M association.
                                <br>We are very pleased that you have joined us in our effort to make our community richer and more vibrant.<br/>
                                
                                <br>You can click <a href="https://www.a3michigan.org/login.php">here</a> to login and finish setting up your account.<br/>
                                <br>And you can always click <a href="https://www.a3michigan.org/donation.php">here</a> if you wish to donate and help the community.<br/>
                                
                                <br><br>Thank you again,
                                <br>The A3M Steering Committee.';

                        $headers = "From: A3M <info@a3michigan.org>\r\n";
                        $headers .= "MIME-Version: 1.0\r\n";
                        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                        mail($email, $subject, $body, $headers);
                        echo '<script type="text/javascript">window.location.href = "./login.php?success=true";</script>';
                        exit();
                    }
                }
            }
            ?>
            <div class="row" id="registrationCont">
                <br>
                <br>
                <div class="col-xs-12 col-sm-10 col-md-8 col-sm-offset-2 col-md-offset-2">
                    <h2>Please Sign Up
                        <small> for A3M Membership.</small>
                    </h2>
                    <br>
                    <p>Full Membership is extended to persons and businesses who support our mission regardless of race,
                        national origin, sex, disability, or religion</p>
                    <br>
					<p>To create an account, please fill out the form below. After completing the registration you'll be able to securely pay for the membership fee.</p>
                    <p>The annual membership fee is $60 for a family, $40 for an individual, and $30 for a student</p>
                    <hr class="colorgraph">
                    <div class="row">
                        <div class="requiredText">
                            *Required Fields
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="form-group">
                                <input type="text" name="fname" id="fname" class="fname form-control input-sm"
                                       placeholder="First Name*">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="form-group">
                                <input type="text" name="lname" id="lname" class="lname form-control input-sm"
                                       placeholder="Last Name*">
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
                                       placeholder="Address 1*">
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
                                       placeholder="City*">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="form-group">
                                <input type="text" name="state" id="state" class="state form-control input-sm"
                                       placeholder="State*">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <div class="form-group">
                                <input type="text" name="zip" id="zip" class="state form-control input-sm"
                                       placeholder="Zip Code*">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="text" name="occupation" id="occupation"
                                       class="occupation form-control input-sm" placeholder="Occupation*">
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
                                <input type="text" name="phone" id="phone" class="zip form-control input-sm"
                                       placeholder="Primary Phone*">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="email" name="email" id="email" class="email form-control input-sm"
                                       placeholder="Email Address*">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="password" name="password" id="password"
                                       class="password form-control input-sm" placeholder="Password*">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="form-group">
                                <input type="password" name="confirmPassword" id="confirmPassword"
                                       class="confirmPassword form-control input-sm" placeholder="Confirm Password*">
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
        <br>
        <!--#################################################### End Of Form  ####################################################-->
        <div class="clear"></div>
    </main>
</div>

<!-- ################################################## Footer ################################# -->
<div class="footerbg" id="contact">
    <footer id="footer" class="hoc clear">
        <div class=" col-lg-4 col-md-4 col-sm-12">
            <h6 class="heading">A3M</h6>
            <p>A3M is an Algerian-American association that serves the needs of the Algerian-American Community  in Michigan.</p>
<!--            <ul class="faico clear">-->
<!--                <li><a class="faicon-facebook" href="#"><i class="fa fa-facebook"></i></a></li>-->
<!--                <li><a class="faicon-twitter" href="#"><i class="fa fa-twitter"></i></a></li>-->
<!--                <li><a class="faicon-dribble" href="#"><i class="fa fa-dribbble"></i></a></li>-->
<!--                <li><a class="faicon-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>-->
<!--                <li><a class="faicon-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>-->
<!--                <li><a class="faicon-vk" href="#"><i class="fa fa-vk"></i></a></li>-->
<!--            </ul>-->
        </div>
        <div class=" col-lg-4 col-md-4 col-sm-12">
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
        </div>
        <div class=" col-lg-4 col-md-4 col-sm-12">
            <h6 class="heading">Location</h6>
            <script src='https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyAz02yCRNu3uItDorLGL2s3tTJX6ye9DeU'></script>
            <div>
                <div id='gmap_canvas' style='height:335px;'></div>
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
                        map: map, position: new google.maps.LatLng(42.331427, -83.0457538)});
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
        <p class="fl_left">Copyright &copy; 2016 - All Rights Reserved - <a href="https://www.a3michigan">www.a3michigan.com</a>
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
<script src="./layout/scripts/jquery.backtotop.js"></script>
<script src="./layout/scripts/jquery.mobilemenu.js"></script>
<script src="./layout/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/backstretch.js"></script>
<script type="text/javascript" src="./js/custom.js"></script>
<script type="text/javascript" src="./js/fitText.js"></script>
</body>
</html>
