<?php
// Start the session
session_start();

$configs = include('./php/dbconf.php');
$servername = $configs->servername;
$username = $configs->username;
$dbpassword = $configs->dbpassword;
$dbname = $configs->dbname;
$dbSuccess = '';
// 1. Create a database connection
$connection = new mysqli($servername, $username, $dbpassword, $dbname);
if ($connection->connect_errno) {
    printf("Connect failed: %s\n", $connection->connect_error);
    exit();
}
// 2. Select a database to use
$db_select = mysqli_select_db($connection, $dbname);

if(isset ( $_GET["success"])) {
    $dbSuccess = '<br><div id="successReg" class="alert alert-success">
                    <strong>Success!</strong> 
                    Your application has been successfully submitted.
                    You can login to see your profile.
                  </div>';
}

$pp_hostname = "www.paypal.com";
//$pp_hostname = "www.sandbox.paypal.com";
$req = 'cmd=_notify-synch';
$tx_token = $_GET['tx'];
$auth_token = "RYLEdLyJl5aSHPEa8vHXEsso5tI-LLMjhGJMN_XxGLmRrT8sLE0jskDgu4G";
//$auth_token = "QMsNOGiyI4Bvt5lVLpa0eaC7nBxop19MAWUd6owXlUgYCxinHgyd-4NDVuu";

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
    //check that transaction id hasn't been used by another user before
    $transactionCheck = mysqli_query($connection, "SELECT * FROM users WHERE transactionId='$tx_token'");
    $transactionFound = mysqli_fetch_array($transactionCheck, MYSQLI_NUM);
    //if transaction used before throw an error and redirect to login
    if($transactionFound) {
        echo '<script type="text/javascript">window.location.href = "./login.php";</script>';
        exit();
    }
    else { //else parse transaction, make sure it was successfull, show success message, and add transactionID to that user row in db.
        $lines = explode("\n", trim($res));
        $keyarray = array();
        if (strcmp ($lines[0], "SUCCESS") == 0) {
            $payStatus = true;
            for ($i = 1; $i < count($lines); $i++) {

                $temp = explode("=", $lines[$i],2);
                $keyarray[urldecode($temp[0])] = urldecode($temp[1]);
            }

            $payerfirstname = $keyarray['first_name'];
            $payerlastname = $keyarray['last_name'];
            $payerEmail = $keyarray["payer_email"];
            $itemname = $keyarray['item_name'];
            $amount = $keyarray['payment_gross'];
            $membershipType = $keyarray['option_selection1'];
            $userId = $keyarray['option_selection2'];

            //set account as active and add transactionId to it
            $sql = "UPDATE users SET active='1', transactionId='$tx_token', membership='$membershipType' WHERE userID='$userId'";
            mysqli_query($connection, $sql);

            //send payment email
            $subject = "A3M Membership Fee";
            $body = 'Dear Community Member, <br/> 
                                <br/>We thank you for the payment of your membership fee and we welcome you to the A3M association. 
                                <br>We are very pleased that you have joined us and looking forward to your contribution and participation in all our activities. <br/>
                                
                                <br>Please click  <a href="https://www.a3michigan.org/donation.php">here</a> if you wish to donate and help the community.<br/>
                                
                                <br><br>Thank you again,
                                <br>The A3M Steering Committee.';

            $headers = "From: A3M <info@a3michigan.org>\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
            mail($payerEmail, $subject, $body, $headers);

            $paymentSuccesText = "<div class='alert alert-success'>
                                    <p>
                                        <h3>Thank you " . $payerfirstname . ' ' . $payerlastname . "</h3>
                                        <h4> for activating your A3M membership <br> You can login to see your profile</h4>
                                    </p>
                                  </div>";

        }
        else if (strcmp ($lines[0], "FAIL") == 0) {
            // log for manual investigation
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>A3Michigan</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="./layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" href="./css/bootstrap-min.css">
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
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
                <li><a href="./membership.php">REGISTER</a></li>
                <li class="dropdown active">
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
<div class="backstretchOverlay">
    <section id="breadcrumb" class="hoc clear">
        <div class="bread-headder">Login</div>
        <ul>
            <li><a href="./index.html">Home</a></li>
            <li><a href="./login.php">Login</a></li>
        </ul>
    </section>
</div>
<div class="wrapper row3">
    <main class="hoc container clear">
        <div class="col-xs-12 col-sm-10 col-md-8 col-sm-offset-2 col-md-offset-2">
            <div class="row" >
                <?php echo $paymentSuccesText; ?>
                <div class="col-md-12">
                    <form class="form" action="" method="POST" id="login-nav" style="display: block">
                        <?php
                        $errorMsg = '';
                        if ($_POST) {
                            $email = $_POST["logEmail"];
                            $password = $_POST["logPassword"];
                            $result = mysqli_query($connection, "SELECT * FROM users WHERE email='$email' and password='$password'");
                            $row = mysqli_fetch_array($result, MYSQLI_NUM);
                            if ($row[0]) {
                                $_SESSION['login_user']= $row[0];
                                $url = "./profile.php?id=" . $row[0];
                                echo '<script type="text/javascript">window.location.href = "' .$url. '";</script>';
                                exit();
                            } else {
                                ?>
                                <style type="text/css">#successReg{
                                        display:none;
                                    }</style>
                                <?php

                                $errorMsg = '<div class="alert alert-danger">
                                                <strong>Error!</strong> Something went wrong, <br> Please, make sure you have the right email and password.
                                              </div>';
                            }
                        }
                        ?>
                        <span>
                            <?= $errorMsg ?>
                        </span>
                        <br>
                        <span>
                            <?= $dbSuccess ?>
                        </span>
                        <div id="loginbox" style="margin-top:20px;" class="mainbox col-md-12 col-sm-8 ">
                            <div class="panel panel-info" >
                                <div class="panel-heading">
                                    <div class="panel-title">Login</div>
                                    <!--                                        <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div>-->
                                </div>
                                <div style="padding-top:30px" class="panel-body" >
                                    <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                                    <form id="loginform" class="form-horizontal" role="form">

                                        <div style="margin-bottom: 25px" class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                            <input type="text" class="form-control" name="logEmail" id="logEmail" value="" placeholder="Email address" required>
                                        </div>

                                        <div style="margin-bottom: 25px" class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                            <input type="password" class="form-control" name="logPassword" id="logPassword" placeholder="Password" required>
                                        </div>

                                        <div style="margin-top:10px" class="form-group">
                                            <button type="submit" id="btn-login" class="btn btn-primary btn-block">Login</button>
                                        </div>
                                        <div class="help-block text-right"><a href="./recoverPassword.php">Forget the password ?</a></div>
                                        <div class="help-block text-right"><a href="./membership.php">Not a Member yet ?</a></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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

