<?php
require("core/base/settings.inc.php");

$PAGE = (isset($_GET['page'])) ? $_GET['page'] : "";
$SUBPAGE = (isset($_GET['subpage'])) ? $_GET['subpage'] : "";
$MINIPAGE = (isset($_GET['minipage'])) ? $_GET['minipage'] : "";
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="<?php echo ABSPATH;?><?php echo FrameworkLocation;?>assets/img/favicon.ico">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo ABSPATH;?><?php echo FrameworkLocation;?>assets/img/apple-icon.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>FEDIM Core v1.0</title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />

        <!-- Bootstrap core CSS     -->
        <link href="<?php echo ABSPATH;?><?php echo FrameworkLocation;?>assets/css/bootstrap.min.css" rel="stylesheet" />
        <link href="<?php echo ABSPATH;?><?php echo FrameworkLocation;?>assets/css/paper-kit.css?v=2.1.0" rel="stylesheet"/>

        <!--  CSS for Demo Purpose, don't include it in your project     -->
        <link href="<?php echo ABSPATH;?><?php echo FrameworkLocation;?>assets/css/demo.css" rel="stylesheet" />

        <!--     Fonts and icons     -->
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,300,700' rel='stylesheet' type='text/css'>
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo ABSPATH;?><?php echo FrameworkLocation;?>assets/css/nucleo-icons.css" rel="stylesheet" />
    </head>

    <body>
        <nav class="navbar navbar-expand-md fixed-top navbar-transparent" color-on-scroll="500">
            <div class="container">
                <div class="navbar-translate">
                    <button class="navbar-toggler navbar-toggler-right navbar-burger" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar"></span>
                        <span class="navbar-toggler-bar"></span>
                        <span class="navbar-toggler-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo ABSPATH;?>">FEDIM Core</a>
                </div>

                <div class="collapse navbar-collapse" id="navbarToggler">
                    <ul class="navbar-nav ml-auto">
                        <!--<li class="nav-item">
                            <a class="nav-link" rel="tooltip" title="Follow us on Twitter" data-placement="bottom" href="https://twitter.com/firitkode" target="_blank">
                                <i class="fa fa-twitter"></i>
                                    <p class="d-lg-none">Twitter</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" rel="tooltip" title="Like us on Facebook" data-placement="bottom" href="https://www.facebook.com/firitkode" target="_blank">
                                <i class="fa fa-facebook-square"></i>
                                  <p class="d-lg-none">Facebook</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" rel="tooltip" title="Follow us on Instagram" data-placement="bottom" href="https://www.instagram.com/firitkode" target="_blank">
                                <i class="fa fa-instagram"></i>
                                    <p class="d-lg-none">Instagram</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" rel="tooltip" title="Star on GitHub" data-placement="bottom" href="https://www.github.com/firitkode/FEDIM" target="_blank">
                                <i class="fa fa-github"></i>
                                    <p class="d-lg-none">GitHub</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="documentation/tutorial-components.html" target="_blank" class="nav-link"><i class="nc-icon nc-book-bookmark"></i> Documentation</a>
                        </li>-->

                        <li class="nav-item">
                            <a href="<?php echo ABSPATH;?>about" target="_blank" class="nav-link"><i class="nc-icon nc-touch-id"></i> About</a>
                        </li>
                    </ul>

                    <a href="https://" target="_blank" class="btn btn-danger btn-round">Download Today!</a>
                </div>
            </div>
        </nav>

        <div class="wrapper">
            <?php
            include("Themes/".THEME_NAME."/pageheader.php");
            ?>

            <div class="main">
                <div class="section section-buttons">
                    <div class="container">
                        <?php
                        /* -- BEGIN PAGE LOADING -- */
                        // Determine page to load
                        if ($PAGE != "")
                        {
                            if ($SUBPAGE != "")
                            {
                                if ($MINIPAGE != "")
                                {
                                    ?>
                                    <h1>A page/subpage/minipage has been loaded</h1>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <h1>A page/subpage has been loaded</h1>
                                    <?php
                                }
                            }
                            else
                            {
                                ?>
                                <h1>A page has been loaded</h1>
                                <?php
                            }
                        }
                        else
                        {
                            ?>
                            <h1>Front Page loaded</h1>
                            <?php
                        }

                        // Load it
                        /* -- END PAGE LOADING -- */
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <div class="row">
                    <nav class="footer-nav">
                        <ul>
                            <li><a href="http://firitkode.tumblr.com">FiritKode</a></li>
                            <li><a href="http://firitkode.tumblr.com">Blog</a></li>
                            <li><a href="http://firitkode.tumblr.com/license">Licenses</a></li>
                        </ul>
                    </nav>

                    <div class="credits ml-auto">
                        <span class="copyright">
                            © <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i> by FiritKode
                        </span>
                    </div>
                </div>
            </div>
        </footer>
    </body>

    <!-- Core JS Files -->
    <script src="<?php echo ABSPATH;?><?php echo FrameworkLocation;?>assets/js/jquery-3.2.1.js" type="text/javascript"></script>
    <script src="<?php echo ABSPATH;?><?php echo FrameworkLocation;?>assets/js/jquery-ui-1.12.1.custom.min.js" type="text/javascript"></script>
    <script src="<?php echo ABSPATH;?><?php echo FrameworkLocation;?>assets/js/popper.js" type="text/javascript"></script>
    <script src="<?php echo ABSPATH;?><?php echo FrameworkLocation;?>assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!-- Switches -->
    <script src="<?php echo ABSPATH;?><?php echo FrameworkLocation;?>assets/js/bootstrap-switch.min.js"></script>

    <!--  Plugins for Slider -->
    <script src="<?php echo ABSPATH;?><?php echo FrameworkLocation;?>assets/js/nouislider.js"></script>

    <!--  Plugins for DateTimePicker -->
    <script src="<?php echo ABSPATH;?><?php echo FrameworkLocation;?>assets/js/moment.min.js"></script>
    <script src="<?php echo ABSPATH;?><?php echo FrameworkLocation;?>assets/js/bootstrap-datetimepicker.min.js"></script>

    <?php
    include(ABSPATH."core/base/extras.js.inc.php");
    ?>
</html>
