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

<div class="backstretchOverlay">
    <section id="breadcrumb" class="hoc clear">
        <div class="bread-headder">RSVP</div>
        <ul>
            <li><a href="./index.html">Home</a></li>
            <li><a href="./recoverPassword.php">RSVP</a></li>
        </ul>
    </section>
</div>
<div class="wrapper row3">
    <main class="hoc container clear">
        <div class="col-xs-12 col-sm-10 col-md-8 col-sm-offset-2 col-md-offset-2">
            <h4 style="text-transform: none">The favor of an attendance confirmation is requested.  <br>
                Please fill out this form and submit by July 9th, 2017
            </h4>

            <br>
            <div class="row" >
                <div class="col-md-12">
                    <form name="frmForgot" action="" id="frmForgot" method="post">
                        <?php
                        if ($_POST) {
                            $user_email = $_POST["email"];
                            $to = $_POST["email"];
                            $subject = "A3M Event Attendance Confirmation";
                            $body = '<h3>Dear friend,</h3> <br>
                                    <h4>Thank you for accepting our invitation to the 2017 Summer Picnic. <br>
                                    We look forward to seeing you on Sunday July 16th. </h4>
                             <br/>--<br>Thank You<br>Sincerely,<br>A3M Steering Committee<br>Algerian -American Association of Michigan<br> www.a3michigan.org';
                            $headers = "From: events@a3michigan.org\r\n";
                            $headers .= "MIME-Version: 1.0\r\n";
                            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                            if (mail($to, $subject, $body, $headers)) {
                                echo '<script> $(document).ready(function(){       $("#myModal").modal("show"); }); </script>';
                            }

                            $body1 = '
                                    <h4>The following person has confirmed his attendance for the July 16th event.
                                        <br>Last Name: ' .$_POST["lname"]. ' <br>
                                        <br>First Name: ' .$_POST["fname"]. ' <br>
                                        <br>Email: ' .$_POST["email"].' <br>
                                        <br>Number of Adults: ' .$_POST["nadults"]. ' <br>
                                        <br>Number of Kids: ' .$_POST["nkids"]. ' <br>
                                    </h4>';
                           mail('slim23000@yahoo.com', $subject, $body1, $headers);



                        }
                        ?>
                        <div class="form-group">
                            <input class="form-control input-lg" placeholder="First Name" name="fname" id="fname" type="text" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control input-lg" placeholder="Last Name" name="lname" id="lname" type="text" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control input-lg" placeholder="Email" name="email" id="email" type="email" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control input-lg" placeholder="Number of Adults" name="nadults" id="nadults" type="text" required>
                        </div>
                        <div class="form-group">
                            <input class="form-control input-lg" placeholder="Number of Kids" name="nkids" id="nkids" type="text" required>
                        </div>
                        <input class="btn btn-lg btn-primary btn-block" value="Submit" type="submit" name="event" id="event">
                    </form>
                </div>
            </div>
        </div>
    </main>
</div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="alert alert-success">
                    <strong>Success!</strong>
                    <p>Thank you!</p>
                    <p>Your attendance has been confirmed<br>
                        You will receive a confirmation email shortly</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
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

