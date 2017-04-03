<?php
session_start();

if (isset($_SESSION['login_user']) && $_SESSION['login_user'] == true) {
    $userID = $_SESSION['login_user'];
} else {
    echo '<script type="text/javascript">window.location.replace("login.php");</script>';
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
$connection = mysqli_connect($servername, $username, $dbpassword);
if (!$connection) {
    die("Database connection failed: " . mysqli_error());
}
$db_select = mysqli_select_db($connection, $dbname);
$parent_result = mysqli_query($connection, "SELECT * FROM users WHERE userID='$userID'");
$children_result = mysqli_query($connection, "SELECT * FROM children WHERE parentID='$userID'");
$parent_row = mysqli_fetch_array($parent_result, MYSQLI_NUM);
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
    <link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" href="../css/bootstrap-min.css">

    <script type='text/javascript' src='../js/gen_validatorv31.js'></script>
</head>
<body id="top">
<!-- Top Background Image Wrapper -->
<div class="bgded overlay" style="background-image:url('../img/backgrounds/6.jpg');">
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
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">FORMS<span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <!--<li><a href="./register.html">MEMBERSHIP</a></li>-->
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
        <h6 class="heading" style="font-size: 3.0vw;">Profile</h6>
        <ul>
            <li><a href="../index.html">Home</a></li>
            <li><a href="#">Profile</a></li>
        </ul>
    </section>

</div>
<div class="wrapper row3">
    <main class="hoc container clear">
        <div class="panel with-nav-tabs panel-primary">
            <div class="panel-heading">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#profile" data-toggle="tab">PROFILE</a></li>
                    <li class="dropdown">
                        <a href="#" data-toggle="dropdown">SCHOLARSHIP FORMS <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#flowChart" data-toggle="tab">Flow Chart</a></li>
                            <li><a href="#scholarshipForm" data-toggle="tab">Scholarship Form</a></li>
                            <li><a href="#enrollmentForm" data-toggle="tab">Enrollment Form</a></li>
                        </ul>
                    </li>
                    <li><a href="#services" data-toggle="tab">SERVICES</a></li>
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
                                                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="../img/backgrounds/avatar.png" class="img-circle img-responsive"> </div>

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
                                                    <img alt="User Pic" src="../img/backgrounds/baby-avatar.jpg" class="img-circle img-responsive">
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
                        <iframe src="https://www.scribd.com/embeds/343838201/content?start_page=1&view_mode=scroll&access_key=key-3IQ1dpx2SjTR42krNxia&show_recommendations=true"
                               id="" width="100%" height="600" frameborder="0">
                        </iframe>
                    </div>
                    <div id="scholarshipForm" class="tab-pane fade">
                        <br>
                        <iframe src="https://www.scribd.com/embeds/343838337/content?start_page=1&view_mode=scroll&access_key=key-3IQ1dpx2SjTR42krNxia&show_recommendations=true"
                                id="" width="100%" height="600" frameborder="0">
                        </iframe>
                    </div>
                    <div id="enrollmentForm" class="tab-pane fade">
                        <br>
                        <iframe src="https://www.scribd.com/embeds/343838067/content?start_page=1&view_mode=scroll&access_key=key-3IQ1dpx2SjTR42krNxia&show_recommendations=true"
                                id="" width="100%" height="600" frameborder="0">
                        </iframe>
                    </div>
                    <div id="services" class="tab-pane fade">
                        <h3>Services</h3>
                        <p>Stay tuned for more services to come for our members.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- / main body -->
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
        <p class="fl_left">Copyright &copy; 2016 - All Rights Reserved - <a href="http://www.a3michigan">www.a3michigan.org</a>
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
<script src="../layout/scripts/jquery.min.js"></script>
<script src="../layout/scripts/jquery.backtotop.js"></script>
<script src="../layout/scripts/jquery.mobilemenu.js"></script>
<script src="../layout/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>