<?php
session_start();

if (isset($_SESSION['login_user']) && $_SESSION['login_user'] == true) {
    $userID = $_SESSION['login_user'];
}
else {
    echo '<script type="text/javascript">window.location.href = "./login.php";</script>';
    echo "Please log in first to see this page.";
}
if (isset($_GET['id'])) {
    $userID = $_GET['id'];
}

$servername = "localhost";
$username = "nfalta";
$dbpassword = "Zb121788n@d";
$dbname = "a3m-db";
$childrenTable = '';
$notActive = '';
$connection = mysqli_connect($servername, $username, $dbpassword);
if (!$connection) {
    die("Database connection failed: " . mysqli_error());
}
$db_select = mysqli_select_db($connection, $dbname);
$parent_result = mysqli_query($connection, "SELECT * FROM users WHERE userID='$userID'");
$children_result = mysqli_query($connection, "SELECT * FROM children WHERE parentID='$userID'");
$parent_row = mysqli_fetch_array($parent_result, MYSQLI_NUM);
if($parent_row[16] == 0) {//checking if membership is active
    $notActive = '<div class="alert alert-danger">
                    <strong>Reminder!</strong> Your membership is not active yet!. <br>
                                            Please Pay your membership in order to activate it.
                  </div>';
}
$children_row = mysqli_fetch_array($parent_result, MYSQLI_NUM);
while($row = mysqli_fetch_array($children_result)){
    $childrenTable =  $childrenTable . '<table class="table table-user-information"><tbody><tr><td>Name:</td><td>'. $row[1] . ' ' . $row[2] . '</td></tr><tr><td>Age:</td><td>'. $row[3] .'</td></tr><tr><td>Gender:</td><td>'. $row[4] .'</td></tr></tbody></table>';
}
if(isset($_POST['submit'])){
    $parentID = $_GET['id'];
    $childFname = $_POST["childFname"];
    $childLname = $_POST["childLname"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];
    $servername = "localhost";
    $username = "nfalta";
    $dbpassword = "Zb121788n@d";
    $dbname = "a3m-db";
    $connection = mysqli_connect($servername, $username, $dbpassword);
    if (!$connection) {
        die("Database connection failed: " . mysqli_error());
    }
    $db_select = mysqli_select_db($connection, $dbname);
    $sql = "INSERT INTO `children` (`childFname`, `childLname`, `age`, `gender`, `parentID`) VALUES
                                        ('$childFname', '$childLname', '$age', '$gender', '$parentID')";

    if (!mysqli_query($connection, $sql)) {
        $dbErrors['duplicate'] = true;
        $info['success'] = false;
        $info['errors'] = $dbErrors;
    } else {
        header('Location: '. $_SERVER['REQUEST_URI']);
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="">
<head>
    <title>A3MICHIGAN</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="./layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" href="./css/bootstrap-min.css">

    <script type='text/javascript' src='./js/gen_validatorv31.js'></script>
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

<!-- Top Background Image Wrapper-->
<div class="backstretchOverlay">
    <section id="breadcrumb" class="hoc clear">
        <div class="bread-headder">Profile</div>
        <ul>
            <li><a href="./index.html">Home</a></li>
            <li><a href="./profile.php">Profile</a></li>
        </ul>
    </section>
</div>

<div class="wrapper row3">
    <br>
    <main class="hoc container clear">
        <?php echo $notActive; ?>
        <?php if ($notActive){ ?>
            <main class="hoc container clear">
                <br>
                <!-- main body -->
                <div class="row">
                    <h2>
                        <small>Activate your Membership</small>
                    </h2>
                    <p>Please, Choose the Payment method that is convenient to you from the list below.</p>
                    <p><i> A3M is a nonprofit organization, its tax-exempt status is pending approval under section 501(c)(3) of the internal revenue code</i></p>

                    <hr class="colorgraph">
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 paymentOption">
                        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                            <input type="hidden" name="cmd" value="_s-xclick">
                            <input type="hidden" name="hosted_button_id" value="UZ6N7GUP3BC2E">
                            <div class="row">
                                <img src="./img/backgrounds/cc.jpg" style="width: 80%;">
                            </div>
                            <div class="row" style=" margin: 3px;">
                                <p>
                                    Choose the type of membership that better suits you from the dropdown below and proceed to checkout via paypal.
                                    After your successfull payment, you will be redirected back to finish your registration with A3M.</p>
                            </div>
                            <div class="row" style="margin: auto; max-width: 300px;">
                                <div class="form-group">
                                    <div>
                                        <input type="hidden" name="on0" value="membership"><label>Membership Type:</label>
                                    </div>
                                    <div>
                                        <div class="form-inline">
                                            <select name="os0" class="card-expiry-month stripe-sensitive required form-control">
                                                <option value="Student">Student $30.00 USD</option>
                                                <option value="Individual">Individual $40.00 USD</option>
                                                <option value="Family">Family $60.00 USD</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="on1" value="userId"><label>User ID</label>
                                <input type="hidden" name="os1" value="<?php echo $userID; ?>">userid</td>
                                <input type="hidden" name="currency_code" value="USD">
                                <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                                <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12" style="text-align: center; padding: 15px; font-weight: bold">OR</div>
                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 paymentOption">
                        <div style="margin: auto; max-width: 300px;">
                            <img src="./img/backgrounds/cash.png" style="width: 240px;">
                            <!--<h2 style="margin-top: 0px;">-->
                            <!--<small>Check or Cash:</small>-->
                            <!--</h2>-->
                            <br>
                            <br>
                            <p>If you are paying with check, please fill out the form available here
                                <a href="./membership-form.html"><i class="fa fa-external-link fa-2x" aria-hidden="true"></i></a>
                                and send it along with the check to:</p><br>
                            <b>Algerian American Association of Michigan</b><br>
                            <p>  3385 Buckingham Trl,<br> W Bloomfield, MI 48323</p>
                        </div>
                    </div>
                </div>
            </main>
        <?php } ?>
        <?php if (!$notActive){ ?>
            <div class="panel with-nav-tabs panel-primary">
                <div class="panel-heading">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#profile" data-toggle="tab">PROFILE</a></li>
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown">SCHOLARSHIP FORMS <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#flowChart" data-toggle="tab">Requirements</a></li>
                                <li><a href="#scholarshipForm" data-toggle="tab">Scholarship Form</a></li>
                                <li><a href="#enrollmentForm" data-toggle="tab">Enrollment Form</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" data-toggle="dropdown">PROGRAMS AND SERVICES<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#driving" data-toggle="tab">Driving School</a></li>
                                <li><a href="#legal" data-toggle="tab">Legal Representation</a></li>
                                <li><a href="#mentor" data-toggle="tab">Mentorship</a></li>
                            </ul>
                        </li>
                        <li><a href="logout.php">LOGOUT</a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="profile">
                            <div id="profile" class="tab-pane fade in active">
                                <div class="row">
                                    <br>
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" >
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <h3 class="panel-title"><?= $parent_row[1] . ' ' . $parent_row[2] ?></h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="./img/backgrounds/avatar.png" class="img-circle img-responsive"> </div>

                                                    <div class=" col-md-9 col-lg-9 ">
                                                        <table class="table table-user-information">
                                                            <tbody>
                                                            <tr>
                                                                <td>Spouse:</td>
                                                                <td><?php echo $parent_row[3]; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Address:</td>
                                                                <td><?php echo $parent_row[4] . ' ' . $parent_row[5] . '<br>' . $parent_row[6] . ' ' . $parent_row[7] . ' ' . $parent_row[8]?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Phone</td>
                                                                <td><?php echo $parent_row[9]; ?></td>
                                                            </tr>
                                                            <tr>
                                                            <tr>
                                                                <td>Email</td>
                                                                <td><?php echo $parent_row[10]; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Occupation</td>
                                                                <td><?php echo $parent_row[11]; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Employer</td>
                                                                <td><?php echo $parent_row[12]; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td>Type of Membership</td>
                                                                <td><?php echo $parent_row[13]; ?></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" >
                                        <div class="panel panel-info">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Children:</h3>
                                            </div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-md-3 col-lg-3 " align="center">
                                                        <img alt="User Pic" src="./img/backgrounds/baby-avatar.jpg" class="img-circle img-responsive">
                                                    </div>
                                                    <div class=" col-md-9 col-lg-9 ">
                                                        <?php echo $childrenTable ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <form action="" method="POST">
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label" for="textinput"></label>
                                                            <div class="col-sm-6 form-group">
                                                                <input type="text" name="childFname" maxlength="45" placeholder="First Name" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label" for="textinput"></label>
                                                            <div class="col-sm-6 form-group">
                                                                <input type="text" name="childLname" maxlength="45" placeholder="Last Name" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label" for="textinput"></label>
                                                            <div class="col-sm-6 form-group">
                                                                <input type="text" name="age" maxlength="2" placeholder="Age" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label" for="textinput"></label>
                                                            <div class="col-sm-6 form-group">
                                                                <select class="form-control" name="gender" id="gender" required>
                                                                    <option>Male</option>
                                                                    <option>Female</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-4 control-label" for="textinput"></label>
                                                            <div class="col-sm-6 form-group">
                                                                <button type="submit" name="submit" class="btn btn-primary btn-block btn-lg" style=" text-transform: none;font-size: 16px;">Add Children</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="flowChart" class="tab-pane fade">
                            <br>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <embed src="./assets/A3M_Scholarship_Flow_chart.pdf" style="width:100%; height:500px;" frameborder="0"></embed>
                                </div>
                            </div>
                        </div>
                        <div id="scholarshipForm" class="tab-pane fade">
                            <br>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <embed src="./assets/A3M_scholarship_Form.pdf" style="width:100%; height:500px;" frameborder="0"></embed>
                                </div>
                            </div>
                        </div>
                        <div id="enrollmentForm" class="tab-pane fade">
                            <br>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <embed src="./assets/scholarship_enrollment_form.pdf" style="width:100%; height:500px;" frameborder="0"></embed>
                                </div>
                            </div>
                        </div>




                        <div id="driving" class="tab-pane fade">
                            <br>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <p>Welcome to the Driving school partnership program,
                                       To receive special pricing and accommodations please send in a referral slip request by clicking on the request button below.<br>
                                       An email will be sent to you with an authorized referral  attachment.</p>

                                    <br>
                                    <form action="" method="post">
                                        <div class="col-md-4 col-md-offset-4">
                                            <button type="submit" name="referral_request1" id="referral_request1" class="btn btn-primary btn-block btn-md" style=" text-transform: none;font-size: 16px;">Referral Request</button>
                                        </div>
                                    </form>

                                    <?php

                                    if(isset($_POST['referral_request1']))
                                    {
                                        $to      = 'info@a3michigan.org';
                                        $subject = 'Driving School Referral Request';
                                        $body = 'The following person submitted a referral request for Driving School, <br><br> Last Name: ' . $parent_row[1] . ' <br> First Name:  ' . $parent_row[2]. '<br> Email: ' .$parent_row[10];
                                        $headers = "From: referral_request@a3michigan.org \r\n";
                                        $headers .= "MIME-Version: 1.0\r\n";
                                        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                                        if (mail($to, $subject, $body, $headers)) {
                                            $url = "./profile.php?id=" . $userID;
                                            echo '<script type="text/javascript">alert("Your request has been submitted successfully"); window.location.href = "' .$url. '";</script>';
                                            exit();
                                        }
                                        else {
                                            ?> <script> alert("Sorry, something went wrong, please try again")</script> <?php
                                        }

                                    }

                                    ?>

                                </div>
                            </div>
                        </div>
                        <div id="legal" class="tab-pane fade">
                            <br>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <p>Welcome to the legal representation  program,
                                        To receive the A3M discount and accommodations please send in a referral slip request by clicking on the request button below.<br>
                                        An email will be sent to you with an authorized referral  attachment</p>

                                    <br>
                                    <form action="" method="post">
                                        <div class="col-md-4 col-md-offset-4">
                                            <button type="submit" name="referral_request2" id="referral_request2" class="btn btn-primary btn-block btn-md" style=" text-transform: none;font-size: 16px;">Referral Request</button>
                                        </div>
                                    </form>

                                    <?php

                                    if(isset($_POST['referral_request2']))
                                    {
                                        $to      = 'info@a3michigan.org';
                                        $subject = 'Legal Presentation Referral Request';
                                        $body = 'The following person submitted a referral request for Legal Presentation, <br> Last Name: ' . $parent_row[1] . ' <br> First Name:  ' . $parent_row[2]. '<br> Email: ' .$parent_row[10];
                                        $headers = "From: referral_request@a3michigan.org \r\n";
                                        $headers .= "MIME-Version: 1.0\r\n";
                                        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                                        if (mail($to, $subject, $body, $headers)) {
                                            $url = "./profile.php?id=" . $userID;
                                            echo '<script type="text/javascript">alert("Your request has been submitted successfully"); window.location.href = "' .$url. '";</script>';
                                            exit();
                                        }
                                        else {
                                            ?> <script> alert("Sorry, something went wrong, please try again")</script> <?php
                                        }

                                    }

                                    ?>
                                </div>
                            </div>
                        </div>
                        <div id="mentor" class="tab-pane fade">
                            <br>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <p>More details about the mentorship program will be provided soon</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <!-- / main body -->
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
        <p class="fl_left">Copyright &copy; 2016 - All Rights Reserved - <a href="https://www.a3michigan">www.a3michigan.org</a>
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
<script src="./layout/scripts/jquery.min.js"></script>
<script src="./layout/scripts/jquery.backtotop.js"></script>
<script src="./layout/scripts/jquery.mobilemenu.js"></script>
<script src="./layout/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="./js/backstretch.js"></script>
<script type="text/javascript" src="./js/custom.js"></script>
<script type="text/javascript" src="./js/fitText.js"></script>
</body>
</html>