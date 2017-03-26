<!DOCTYPE html>
<html>
<head>
    <title>A3Michigan</title>
    <meta name="author" content="Ste Brennan - Code Computerlove - http://www.codecomputerlove.com/"/>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;" name="viewport"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <link href="../gallery/styles.css" type="text/css" rel="stylesheet"/>

    <link href="../gallery/photoswipe.css" type="text/css" rel="stylesheet"/>

    <script type="text/javascript" src="../gallery/lib/klass.min.js"></script>
    <script type="text/javascript" src="../gallery/code.photoswipe-3.0.5.min.js"></script>

    <link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" href="../css/bootstrap-min.css">
    <link rel="stylesheet" href="../css/bootstrap-formhelpers-min.css" media="screen">
    <link rel="stylesheet" href="../css/bootstrapValidator-min.css"/>
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css"/>
    <link rel="stylesheet" href="../css/bootstrap-side-notes.css"/>

    <script type="text/javascript">

        (function (window, PhotoSwipe) {

            document.addEventListener('DOMContentLoaded', function () {

                var
                    options = {},
                    instance = PhotoSwipe.attach(window.document.querySelectorAll('#Gallery a'), options);

            }, false);


        }(window, window.Code.PhotoSwipe));

    </script>

</head>
<body>
<div class="bgded overlay">

    <!--#################################################### Nav  ####################################################-->
    <div class="wrapper row1">
        <header id="header" class="hoc clear">
            <div id="logo" class="fl_left">
                <h1><a href="../index.html"></a>A3M</h1>
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
                            <li><a href="register.html">MEMBERSHIP</a></li>
                            <li><a href="bylaws.html">BYLAWS</a></li>
                        </ul>
                    </li>
                    <li><a href="donation.php">DONATE</a></li>
                    <li class="active"><a class="drop" href="#">GALLERIES</a>
                        <ul>
                            <li><a href="algeria.html">ALGERIA</a></li>
                            <li><a href="usa.html">USA</a></li>
                            <li><a href="michigan.html">MICHIGAN</a></li>
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
                                                <label class="sr-only" for="logEmail">Email address</label>
                                                <input type="email" class="form-control" name="logEmail" id="logEmail" placeholder="Email address" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" for="logPassword">Password</label>
                                                <input type="password" class="form-control" name="logPassword" id="logPassword" placeholder="Password" required>
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
                    <li><a href="./register.html">Register</a></li>
                </ul>
            </nav>
            <!-- ################################################################################################ -->
        </header>
    </div>
    <!--#################################################### End of Nav  ####################################################-->
    <!-- ########################################### end of breadcrumb ############################################### -->
</div>
<div class="wrapper row3">
    <main class="hoc container clear">

        <h4>A3M thank you for your feedback.</h4>

    </main>
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
                    <li><a href="../index.html"><i class="fa fa-lg fa-home"></i></a></li>

                    <li><a href="./donation.php">Donate</a></li>
                    <li><a href="./membership.php">Membership</a></li>
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
                    marker = new google.maps.Marker({map: map, position: new google.maps.LatLng(42.331427, -83.0457538)});
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