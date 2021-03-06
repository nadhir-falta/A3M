<!DOCTYPE html>
<html lang="">
<head>
    <title>A3MICHIGAN</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="./layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" href="./css/bootstrap-min.css">

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
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
                <li class="active"><a href="donation.php">DONATE</a></li>
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

<!-- Top Background Image Wrapper -->
<div class="backstretchOverlay">
    <section id="breadcrumb" class="hoc clear">
        <div class="bread-headder">Donation</div>
        <ul>
            <li><a href="./index.html">Home</a></li>
            <li><a href="./donation.php">Donation</a></li>
        </ul>
    </section>
</div>
<div class="wrapper row3">
    <main class="hoc container clear" style="padding-top: 0px;">
        <h2>
            <small>Donations</small>
        </h2>
        <p>Please, donate and help A3M achieve its mission. </p>
        <hr class="colorgraph">
        <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" style="margin: auto; max-width: 600px;">
            <input type="hidden" name="cmd" value="_s-xclick">
            <input type="hidden" name="hosted_button_id" value="RC6ERW2HE5KHW">
            <div class="row">
                <div class="form-group">
                    <div class="col-sm-12">
                        <input type="hidden" name="on0" value="Donation Type:"><label>Donation Type:</label>Donation allocation: To designate your donation to a specific fund, please check the boxes bellow.
                        To allow A3M to allocate your donation as needed, leave it unselected.
                    </div>
                </div>
            </div>
            <br>
            <div class="row" style="margin: auto; max-width: 200px;">
                <div class="form-group">
                    <div class="col-sm-6">
                        <div class="form-inline">
                            <select name="os0" class="card-expiry-month stripe-sensitive required form-control">
                                <option value="Unspecified">Select</option>
                                <option value="Emergency & Hardship Fund">Emergency & Hardship Fund</option>
                                <option value="Burial & Cemetery Fees Fund">Burial & Cemetery Fees Fund</option>
                                <option value="Activities & Social Events">Activities & Social Events</option>
                                <option value="Academics & Scholarships">Academics & Scholarships</option>
                                <option value="Not Specified">Not Specified</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="row" style="margin: auto; max-width: 100px;">
                <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
            </div>
        </form>

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