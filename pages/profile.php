<!DOCTYPE html>
<html lang="">
<head>
    <title>A3MICHIGAN</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
    <link href="../layout/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
    <link href="../layout/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" media="all">
    <script type='text/javascript' src='../js/gen_validatorv31.js'></script>
    <style>
        .error {
            color: red;
            font-style: italic;
        }
    </style>
</head>
<body id="top">
<!-- Top Background Image Wrapper -->
<div class="bgded overlay" style="background-image:url('../img/backgrounds/6.jpg');">
    <div class="wrapper row1">
        <header id="header" class="hoc clear">
            <div id="logo" class="fl_left">
                <h1><a href="index.html"></a>A3M</h1>
            </div>
            <nav id="mainav" class="fl_right">
                <ul class="clear">
                    <li><a href="../index.html">Home</a></li>
                    <li><a class="drop" href="#">ABOUT</a>
                        <ul>
                            <li><a href="../index.html#whatwedo">WHAT WE DO</a></li>
                            <li><a href="feedback.php">FEEDBACK</a></li>
                        </ul>
                    </li>
                    <li><a href="survey.html">SURVEY</a></li>
                    <li><a class="drop" href="#">FORMS</a>
                        <ul>
                            <li><a href="membership.php">MEMBERSHIP</a></li>
                            <li><a href="bylaws.html">BYLAWS</a></li>
                        </ul>
                    </li>
                    <li><a href="donation.php">DONATE</a></li>
                    <li><a class="drop" href="#">GALLERY</a>
                        <ul>
                            <li><a href="algeria.html">ALGERIA</a></li>
                            <li><a href="usa.html">USA</a></li>
                            <li><a href="michigan.html">MICHIAGN</a></li>
                        </ul>
                    </li>
                    <li><a href="news.html">NEWS</a></li>
                    <li><a href="#contact">CONTACT</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span class="caret"> </span>
                            Login</a>
                        <ul id="login-dp" class="dropdown-menu">
                            <li>
                                <div class="row">
                                    <div class="col-md-12">
                                        <form class="form" action="../php/login.php" method="POST" id="login-nav"
                                              style="display: block">
                                            <div class="form-group">
                                                <label class="sr-only" for="email">Email address</label>
                                                <input type="email" class="form-control" name="email" id="email"
                                                       placeholder="Email address" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" for="password">Password</label>
                                                <input type="password" class="form-control" name="password"
                                                       id="password" placeholder="Password" required>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li><a href="./membership.php">Register</a></li>
                </ul>
            </nav>
        </header>
    </div>

    <section id="breadcrumb" class="hoc clear">
        <h6 class="heading">Profile</h6>
        <ul>
            <li><a href="../index.html">Home</a></li>
            <li><a href="#">Profile</a></li>
        </ul>
    </section>

</div>
<div class="wrapper row3">
    <main class="hoc container clear">
        <!-- main body -->
        <?php
            $userID = $_GET['id'];

            $servername = "localhost";
            $username = "root";
            $dbpassword = "Zb121788n@d";
            $dbname = "a3m-members";

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
                $childrenTable =  $childrenTable . '<table class="table table-user-information">
                        <tbody>
                            <tr>
                                <td>Name:</td>
                                <td>'. $row[1] . ' ' . $row[2] . '</td>
                            </tr>
                            <tr>
                                <td>Age:</td>
                                <td>'. $row[3] .'</td>
                            </tr>
                            <tr>
                                <td>Gender:</td>
                                <td>'. $row[4] .'</td>
                            </tr>
                        </tbody>
                    </table>';
            }
        if(isset($_POST['submit'])){
            $parentID = $_GET['id'];
            $childFname = $_POST["childFname"];
            $childLname = $_POST["childLname"];
            $age = $_POST["age"];
            $gender = $_POST["gender"];
            $servername = "localhost";
            $username = "root";
            $dbpassword = "Zb121788n@d";
            $dbname = "a3m-members";
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
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6" >
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?= $parent_row[1] . ' ' . $parent_row[2] ?></h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="../img/avatar.png" class="img-circle img-responsive"> </div>

                            <div class=" col-md-9 col-lg-9 ">
                                <table class="table table-user-information">
                                    <tbody>
                                    <tr>
                                        <td>Spouse:</td>
                                        <td><?php echo $parent_row[3]; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Address:</td>
                                        <td><?= $parent_row[4] . ' ' . $parent_row[5] . '<br>' . $parent_row[6] . ' ' . $parent_row[7] . ' ' . $parent_row[8]?></td>
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
                                <img alt="User Pic" src="../img/baby-avatar.jpg" class="img-circle img-responsive">
                            </div>
                            <div class=" col-md-9 col-lg-9 ">
                                <?= $childrenTable ?>
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
        <!-- / main body -->
        <div class="clear"></div>
    </main>
</div>

<!-- ################################################## Footer ################################# -->
<div class="wrapper row4 bgded overlay footerbg" id="contact">
    <footer id="footer" class="hoc clear">
        <div class="one_third first">
            <h6 class="heading">A3M</h6>
            <p>A3m is an Algerian/American organization....etc</p>
            <p class="btmspace-50">This is just a descriptive text you can ignore it if you want</p>
            <nav>
                <ul class="nospace">
                    <li><a href="index.html"><i class="fa fa-lg fa-home"></i></a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Donate</a></li>
                    <li><a href="#">Membership</a></li>
                    <li><a href="#">Feedback</a></li>
                    <li><a href="#">Bylaws</a></li>
                    <li><a href="#">Survey</a></li>
                    <li><a href="#">News</a></li>
                    <li><a href="#">Gallery Algeria</a></li>
                    <li><a href="#">Gallery USA</a></li>
                    <li><a href="#">Gallery Michigan</a></li>
                </ul>
            </nav>
        </div>
        <div class="one_third">
            <h6 class="heading">Address and Phone Numbers</h6>
            <ul class="nospace btmspace-30 linklist contact">
                <li><i class="fa fa-map-marker"></i>
                    <address>
                        Street Name &amp; Number, Town, Postcode/Zip
                    </address>
                </li>
                <li><i class="fa fa-phone"></i> +00 (123) 456 7890</li>
                <li><i class="fa fa-fax"></i> +00 (123) 456 7890</li>
                <li><i class="fa fa-envelope-o"></i> info@domain.com</li>
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
            <div style='overflow:hidden;height:335px;width:436px;'>
                <div id='gmap_canvas' style='height:335px;width:436px;'></div>
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
<!-- JAVASCRIPTS -->
<script src="../layout/scripts/jquery.min.js"></script>
<script src="../layout/scripts/jquery.backtotop.js"></script>
<script src="../layout/scripts/jquery.mobilemenu.js"></script>
<script src="../layout/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>