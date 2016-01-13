<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PetHelp</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

    <link href="http://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">


    <!-- jQuery -->
    <script src="js/jquery.js"></script>
    <script src="js/jquery_ui.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">

<!-- Navigation -->
<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand page-scroll" href="#page-top">
                <i class="fa fa-play-circle"></i> <span class="light">PetHelp</span>
            </a>
        </div>


        <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
            <ul class="nav navbar-nav">
                <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                <li class="hidden active">
                    <a href="#page-top"></a>
                </li>
                <li class="">
                    <a id="login-page-scroll" class="page-scroll" href="#login">Login</a>
                </li>
                <li class="">
                    <a class="page-scroll" href="#about">About</a>
                </li>
                <li class="">
                    <a class="page-scroll" href="#contact">Contact</a>
                </li>
                <li class="">
                    <a class="page-scroll hidden" id="logout-page-scroll" href="/ProiectBD">Logout</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- Intro Header -->
<header class="intro">
    <div class="intro-body">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <h1 class="brand-heading">PetHelp</h1>

                    <p class="intro-text">Worried about your pet ? Need some practical advice?
                        PetHelp will take care of your needs.
                    </p>
                    <a href="#login" class="btn btn-circle page-scroll">
                        <i class="fa fa-angle-double-down animated"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>


<!-- Login Section -->
<section id="login" class="content-section text-center">
    <div class="login-section">


        <div id="login-container" class="container">
            <div id="login-inner-container" class="col-lg-4 col-lg-offset-4 col-xs-8 col-xs-offset-2">
                <h2>Login</h2>

                <form id="loginForm" action="php/checkLogin.php" method="POST">
                    <div class="form-group">
                        <input id="usernameInput" class="form-control" name="usernameInput" placeholder="Username"
                               type="text">
                    </div>

                    <div class="form-group">
                        <input id="passwordInput" class="form-control" name="passwordInput" placeholder="Password"
                               type="password">
                    </div>

                    <div class="form-group">
                        <button id="loginButton" type="submit" class="btn btn-default pull-left marginRight">Login
                        </button>
                        <span id="notRegistered" class="btn btn-default pull-left">Not Registered?</span>
                    </div>
                    <br>
                    <br>

                    <div class="form-group">
                        <div id="loginValidationErrors"></div>
                        <div id="postOutput"></div>
                    </div>
                </form>
            </div>


            <div id="register-inner-container" class="col-lg-4 col-lg-offset-4 col-xs-8 col-xs-offset-2">
                <h2>Register</h2>

                <form id="registerForm" action="php/register.php" method="POST">

                    <div class="form-group">
                        <input type="text" id="firstNameInputRegister" name="firstNameInputRegister"
                               class="form-control"
                               placeholder="Your First Name">
                    </div>

                    <div class="form-group">
                        <input type="text" id="lastNameInputRegister" name="lastNameInputRegister" class="form-control"
                               placeholder="Your Last Name">
                    </div>

                    <div class="form-group">
                        <input type="text" id="userInputRegister" name="userInputRegister" class="form-control"
                               placeholder="Pick an Username">
                    </div>

                    <div class="form-group">
                        <input type="password" id="passwordInputRegister1" name="passwordInputRegister1"
                               class="form-control"
                               placeholder="Choose a Password">
                    </div>

                    <div class="form-group">
                        <input type="password" id="passwordInputRegister2" name="passwordInputRegister2"
                               class="form-control"
                               placeholder="Re-enter Password">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-default pull-left">Register</button>
                    </div>
                </form>
            </div>


        </div>
    </div>


    </div>
    </div>
</section>


<!-- About Section -->
<section id="about" class="container content-section text-center">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <h2 class="somePaddingTop">About PetHelp</h2>

            <p>Our mission is to help you provide the best care and attention to your pet, by cutting through the noise
                and offering you direct advice from verified vets, trainers and other pet experts.

                Ask questions about your pet's health, nutrition, or any other topic, and receive reliable answers for
                free!

                Your pet wouldn't google it, why would you?
            </p></div>
    </div>
</section>


<!-- Contact Section -->
<section id="contact" class="container content-section text-center col-lg-12">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
            <h2>Contact Pet Help</h2>

            <p>Have Pet Questions? The Pet Help team provides free advice for whatever animal issues you are
                experiencing.</p>
            <ul class="list-inline banner-social-buttons">
                <li>
                    <a href="#Twitter" class="btn btn-default btn-lg"><i class="fa fa-twitter fa-fw"></i> <span
                            class="network-name">Twitter</span></a>
                </li>
                <li>
                    <a href="#Facebook" class="btn btn-default btn-lg"><i class="fa fa-facebook fa-fw"></i> <span
                            class="network-name">Facebook</span></a>
                </li>
                <li>
                    <a href="#GooglePlus" class="btn btn-default btn-lg"><i class="fa fa-google-plus fa-fw"></i> <span
                            class="network-name">Google+</span></a>
                </li>
            </ul>
        </div>
    </div>
</section>


<!-- Footer -->
<footer>
    <div class="container text-center">
        <p>Copyright © Panaite Andrei - Silviu 2016</p>
</footer>


<script type="text/html" id="buttonsTemplate">
    <a href="#" class="btn btn-xs btn-default edit_btn glyphicon glyphicon-edit">&#x270E</a>
    <a href="#" class="btn btn-xs btn-default remove_btn glyphicon glyphicon-remove">&#x2716</a>
</script>

<script type="text/html" id="registerTemplate">
    <div class="col-lg-4 col-lg-offset-4 col-xs-8 col-xs-offset-2">
        <h2>Register</h2>

        <form id="registerForm" action="php/register.php" method="POST">

            <div class="form-group">
                <input type="text" id="firstNameInputRegister" name="firstNameInputRegister" class="form-control"
                       placeholder="Your First Name">
            </div>

            <div class="form-group">
                <input type="text" id="lastNameInputRegister" name="lastNameInputRegister" class="form-control"
                       placeholder="Your Last Name">
            </div>

            <div class="form-group">
                <input type="text" id="userInputRegister" name="userInputRegister" class="form-control"
                       placeholder="Pick an Username">
            </div>

            <div class="form-group">
                <input type="password" id="passwordInputRegister1" name="passwordInputRegister1" class="form-control"
                       placeholder="Choose a Password">
            </div>

            <div class="form-group">
                <input type="password" id="passwordInputRegister2" name="passwordInputRegister2" class="form-control"
                       placeholder="Re-enter Password">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-default pull-left">Register</button>
            </div>
        </form>
    </div>
</script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Plugin JavaScript -->
<script src="js/jquery.easing.min.js"></script>

<script src="js/scrollEffect.js"></script>
<!--
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.jsc"></script>
-->

<script src="js/main.js"></script>

<script src="js/template-engine.js"></script>

</body>

<?php include 'php/databaseConnect.php'; ?>

</html>
