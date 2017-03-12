<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>A3Michigan</title>
    <link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
    <link rel="stylesheet" href="../css/bootstrap-min.css">
    <link rel="stylesheet" href="../css/bootstrap-formhelpers-min.css" media="screen">
    <link rel="stylesheet" href="../css/bootstrapValidator-min.css"/>
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css"/>
    <link rel="stylesheet" href="../css/bootstrap-side-notes.css"/>
    <style type="text/css">
        .col-centered {
            display: inline-block;
            float: none;
            text-align: left;
            margin-right: -4px;
        }

        .row-centered {
            margin-left: 9px;
            margin-right: 9px;
        }
    </style>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="../js/bootstrap-min.js"></script>
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
                submitHandler: function (validator, form, submitButton) {
                    // createToken returns immediately - the supplied callback submits the form if there are no errors
                    Stripe.card.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val(),
                        name: $('.card-holder-name').val(),
                        address_line1: $('.address').val(),
                        address_city: $('.city').val(),
                        address_zip: $('.zip').val(),
                        address_state: $('.state').val(),
                        address_country: $('.country').val()
                    }, stripeResponseHandler);
                    return false; // submit from callback
                },
                fields: {
                    street: {
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
                                message: 'The email address is required and can\'t be empty'
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
                    cardholdername: {
                        validators: {
                            notEmpty: {
                                message: 'The card holder name is required and can\'t be empty'
                            },
                            stringLength: {
                                min: 6,
                                max: 70,
                                message: 'The card holder name must be more than 6 and less than 70 characters long'
                            }
                        }
                    },
                    cardnumber: {
                        selector: '#cardnumber',
                        validators: {
                            notEmpty: {
                                message: 'The credit card number is required and can\'t be empty'
                            },
                            creditCard: {
                                message: 'The credit card number is invalid'
                            },
                        }
                    },
                    expMonth: {
                        selector: '[data-stripe="exp-month"]',
                        validators: {
                            notEmpty: {
                                message: 'The expiration month is required'
                            },
                            digits: {
                                message: 'The expiration month can contain digits only'
                            },
                            callback: {
                                message: 'Expired',
                                callback: function (value, validator) {
                                    value = parseInt(value, 10);
                                    var year = validator.getFieldElements('expYear').val(),
                                        currentMonth = new Date().getMonth() + 1,
                                        currentYear = new Date().getFullYear();
                                    if (value < 0 || value > 12) {
                                        return false;
                                    }
                                    if (year == '') {
                                        return true;
                                    }
                                    year = parseInt(year, 10);
                                    if (year > currentYear || (year == currentYear && value > currentMonth)) {
                                        validator.updateStatus('expYear', 'VALID');
                                        return true;
                                    } else {
                                        return false;
                                    }
                                }
                            }
                        }
                    },
                    expYear: {
                        selector: '[data-stripe="exp-year"]',
                        validators: {
                            notEmpty: {
                                message: 'The expiration year is required'
                            },
                            digits: {
                                message: 'The expiration year can contain digits only'
                            },
                            callback: {
                                message: 'Expired',
                                callback: function (value, validator) {
                                    value = parseInt(value, 10);
                                    var month = validator.getFieldElements('expMonth').val(),
                                        currentMonth = new Date().getMonth() + 1,
                                        currentYear = new Date().getFullYear();
                                    if (value < currentYear || value > currentYear + 100) {
                                        return false;
                                    }
                                    if (month == '') {
                                        return false;
                                    }
                                    month = parseInt(month, 10);
                                    if (value > currentYear || (value == currentYear && month > currentMonth)) {
                                        validator.updateStatus('expMonth', 'VALID');
                                        return true;
                                    } else {
                                        return false;
                                    }
                                }
                            }
                        }
                    },
                    cvv: {
                        selector: '#cvv',
                        validators: {
                            notEmpty: {
                                message: 'The cvv is required and can\'t be empty'
                            },
                            cvv: {
                                message: 'The value is not a valid CVV',
                                creditCardField: 'cardnumber'
                            }
                        },
                    },
                    amount: {
                        selector: '#amount',
                        validators: {
                            notEmpty: {
                                message: 'The amount is required and can\'t be empty'
                            },
                            amount: {
                                message: 'The amount is not a valid',
                            }
                        }
                    }
                }
            });
        });
    </script>
    <script type="text/javascript">
        // this identifies your website in the createToken call below
        Stripe.setPublishableKey('pk_test_tuEsC3Zxra0MUICLhxZDrwI7');

        function stripeResponseHandler(status, response) {
            if (response.error) {
                // re-enable the submit button
                $('.submit-button').removeAttr("disabled");
                // show hidden div
                document.getElementById('a_x200').style.display = 'block';
                // show the errors on the form
                $(".payment-errors").html(response.error.message);
            } else {
                var form$ = $("#payment-form");
                // token contains id, last4, and card type
                var token = response['id'];
                // insert the token into the form so it gets submitted to the server
                form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
                // and submit
                form$.get(0).submit();
            }
        }


    </script>
</head>
<body>
<div class="wrapper row1" style="position: fixed;display: block;height: 75px;z-index: 9999;width: 100%;">
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
                <li class="active"><a href="donation.php">DONATE</a></li>
                <li><a class="drop" href="#">GALLERY</a>
                    <ul>
                        <li><a href="algeria.html">ALGERIA</a></li>
                        <li><a href="usa.html">USA</a></li>
                        <li><a href="michigan.html">MICHIAGN</a></li>
                    </ul>
                </li>
                <li><a href="news.html">NEWS</a></li>
                <li><a href="#contact"">CONTACT</a></li>
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
        <!-- ################################################################################################ -->
    </header>
</div>
<div class="bgded overlay">
    <img src="../img/backgrounds/donations.jpg" style="height: 450px; width: 100%;">;
</div>
<main class="hoc container clear" style="padding-top: 0px;">
    <!--#################################################### Form  ####################################################-->
    <form action="" method="POST" id="payment-form" class="form-horizontal">
        <div class="row row-centered">
            <div class="">
                <div class="page-header">
                    <h2 class="gdfg">Secure Donation Form</h2>
                </div>
                <noscript>
                    <div class="bs-callout bs-callout-danger">
                        <h4>JavaScript is not enabled!</h4>
                        <p>This payment form requires your browser to have JavaScript enabled. Please activate
                            JavaScript and reload this page. Check <a href="http://enable-javascript.com"
                                                                      target="_blank">enable-javascript.com</a> for more
                            informations.</p>
                    </div>
                </noscript>
                <?php
                require '../lib/Stripe.php';

                $error = '';
                $success = '';
                $donationTypes = '';

                if ($_POST) {
                    Stripe::setApiKey("sk_test_i79GJLb0WhkVSWqj1AbYh0bq");

                    try {
                        if (empty($_POST['street']) || empty($_POST['city']) || empty($_POST['zip']))
                            throw new Exception("Fill out all required fields.");
                        if (!isset($_POST['stripeToken']))
                            throw new Exception("The Stripe Token was not generated correctly, Please refresh the page");

                        $name = $_POST['donationType'];
                        foreach ($name as $type) {
                            $donationTypes = $donationTypes . $type . ', ';
                        }
                        Stripe_Charge::create(array("amount" => $_POST['amount'] * 100, //is charged by centes so 100 cents make up a dollar
                                "currency" => "usd",
                                "card" => $_POST['stripeToken'],
                                "description" => '$' . $_POST['amount'] . ' donation for ' . $donationTypes
                            )
                        );
                        $success = '<div class="alert alert-success">
                      <strong>Success!</strong> Your payment was successful.
      				</div>';
                    } catch (Exception $e) {
                        $error = '<div class="alert alert-danger">
      			  <strong>Error!</strong> ' . $e->getMessage() . '
      			  </div>';
                    }
                }
                ?>
                <div class="alert alert-danger" id="a_x200" style="display: none;"><strong>Error!</strong> <span
                            class="payment-errors"></span></div>
                <span class="payment-success">
        <?= $success ?>
        <?= $error ?>
        </span>
                <fieldset>

                    <!-- Form Name -->
                    <legend>Billing Details</legend>

                    <!-- Street -->
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="textinput">Street</label>
                        <div class="col-sm-6">
                            <input type="text" name="street" placeholder="Street" class="address form-control">
                        </div>
                    </div>

                    <!-- City -->
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="textinput">City</label>
                        <div class="col-sm-6">
                            <input type="text" name="city" placeholder="City" class="city form-control">
                        </div>
                    </div>

                    <!-- State -->
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="textinput">State</label>
                        <div class="col-sm-6">
                            <input type="text" name="state" maxlength="65" placeholder="State"
                                   class="state form-control">
                        </div>
                    </div>

                    <!-- Postcal Code -->
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="textinput">Postal Code</label>
                        <div class="col-sm-6">
                            <input type="text" name="zip" maxlength="9" placeholder="Postal Code"
                                   class="zip form-control">
                        </div>
                    </div>

                    <!-- Country -->
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="textinput">Country</label>
                        <div class="col-sm-6">
                            <!--input type="text" name="country" placeholder="Country" class="country form-control"-->
                            <div class="country bfh-selectbox bfh-countries" name="country" placeholder="Select Country"
                                 data-flags="true" data-filter="true"></div>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="textinput">Email</label>
                        <div class="col-sm-6">
                            <input type="text" name="email" maxlength="65" placeholder="Email"
                                   class="email form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="textinput"></label>
                        <div class="col-sm-8">
                            <label class="control-label" for="textinput"><b>Donation allocation:</b> To designate your
                                donation to a specific fund, please check the boxes bellow. To allow
                                A3M to allocate your donation as needed, leave all boxes unchecked.</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="donationType[]" value="Emergency">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    Emergency & Hardship Fund
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="donationType[]" value="Activities">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    Activities & Social Events
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="donationType[]" value="Burial">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    Burial & Cemetery Fees Fund
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="donationType[]" value="Scholarships">
                                    <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                                    Academics & Scholarships
                                </label>
                            </div>
                            <input type="checkbox" name="donationType[]" style="display: none">
                        </div>
                    </div>
                </fieldset>
                <fieldset>
                    <legend>Card Details</legend>

                    <!-- Card Holder Name -->
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="textinput">Card Holder's Name</label>
                        <div class="col-sm-6">
                            <input type="text" name="cardholdername" maxlength="70" placeholder="Card Holder Name"
                                   class="card-holder-name form-control">
                        </div>
                    </div>

                    <!-- Card Number -->
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="textinput">Card Number</label>
                        <div class="col-sm-6">
                            <input type="text" id="cardnumber" maxlength="19" placeholder="Card Number"
                                   class="card-number form-control">
                        </div>
                    </div>

                    <!-- Expiry-->
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="textinput">Card Expiry Date</label>
                        <div class="col-sm-6">
                            <div class="form-inline">
                                <select name="select2" data-stripe="exp-month"
                                        class="card-expiry-month stripe-sensitive required form-control">
                                    <option value="01" selected="selected">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                                <span> / </span>
                                <select name="select2" data-stripe="exp-year"
                                        class="card-expiry-year stripe-sensitive required form-control">
                                </select>
                                <script type="text/javascript">
                                    var select = $(".card-expiry-year"),
                                        year = new Date().getFullYear();

                                    for (var i = 0; i < 12; i++) {
                                        select.append($("<option value='" + (i + year) + "' " + (i === 0 ? "selected" : "") + ">" + (i + year) + "</option>"))
                                    }
                                </script>
                            </div>
                        </div>
                    </div>

                    <!-- CVV -->
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="textinput">CVV</label>
                        <div class="col-sm-3">
                            <input type="text" id="cvv" placeholder="CVV" maxlength="4" class="card-cvc form-control">
                        </div>
                    </div>

                    <!-- CVV -->
                    <div class="form-group">
                        <label class="col-sm-4 control-label" for="textinput">Amount</label>
                        <div class="col-sm-3">
                            <input type="numer" id="amount" name="amount" placeholder="Amount $" maxlength="10"
                                   class="amount form-control">
                        </div>
                    </div>

                    <!-- Important notice -->
                    <div class="form-group">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h3 class="panel-title">Important notice</h3>
                            </div>
                            <div class="panel-body">
                                <p>Your card will be charged with the amount shown above after submit.</p>
                                <!-- <p>Your account statement will show the following booking text:
                                  XXXXXXX </p> -->
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="control-group">
                            <div class="controls">
                                <center>
                                    <button class="btn btn-success" type="submit">Donate Now</button>
                                </center>
                            </div>
                        </div>
                </fieldset>
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
        <p class="fl_left">Copyright &copy; 2016 - All Rights Reserved - <a href="http://www.a3michigan">www.a3michigan.com</a>
        </p>
    </div>
</div>

<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
<script src="../layout/scripts/jquery.backtotop.js"></script>
<script src="../layout/scripts/jquery.mobilemenu.js"></script>
<script src="../layout/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
