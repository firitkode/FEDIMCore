<?php
// Require the settings file
require("core/base/settings.inc.php");

// Require the functions file - necessary to use connect file
require("core/base/functions.inc.php");

// Check/Set the environment to determine which set of database settings to use, server settings properly set up, etc
CheckSetEnvironment();

// Require the connect file in order to use database functionality
include("core/base/connect.inc.php");

// Get page levels
$PAGE = (isset($_GET['page'])) ? $_GET['page'] : "";
$SUBPAGE = (isset($_GET['subpage'])) ? $_GET['subpage'] : "";
$MINIPAGE = (isset($_GET['minipage'])) ? $_GET['minipage'] : "";
$TINYPAGE = (isset($_GET['tinypage'])) ? $_GET['tinypage'] : "";

// Build a PageString to be used for PageLoading
$PageString = "";
BuildPageStringFile();

// Run ErrorDetectionSystem
$ErrorMessage = "";
ErrorDetectionSystem();
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="<?php echo ABSPATH;?><?php echo FrameworkLocation;?>assets/img/favicon.ico">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo ABSPATH;?><?php echo FrameworkLocation;?>assets/img/apple-icon.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title>FEDIM Core v1.0<?php
        if ($PAGE != "")
        {
          echo " - " . $PAGE;
        }

        if ($SUBPAGE != "")
        {
          echo " - " . $SUBPAGE;
        }

        if ($MINIPAGE != "")
        {
          echo " - " . $MINIPAGE;
        }

        if ($TINYPAGE != "")
        {
          echo " - " . $TINYPAGE;
        }
        ?></title>

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

        <!-- Error Page assets -->
        <!-- Google font -->
      	<link href="https://fonts.googleapis.com/css?family=Muli:400" rel="stylesheet">
      	<link href="https://fonts.googleapis.com/css?family=Passion+One" rel="stylesheet">

      	<!-- Font Awesome Icon -->
      	<link type="text/css" rel="stylesheet" href="<?php echo ABSPATH;?>themes/<?php echo THEME_NAME;?>/includes/errorpage/css/font-awesome.min.css" />

      	<!-- Custom stlylesheet -->
      	<link type="text/css" rel="stylesheet" href="<?php echo ABSPATH;?>themes/<?php echo THEME_NAME;?>/includes/errorpage/css/style.css" />

      	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
      	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      	<!--[if lt IE 9]>
      		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      		<![endif]-->
    </head>

    <body>
        <?php
        // Error Detection System
        if($Error == 0)
        {
            // No errors - do page load
            // Determine if a page is trying to be loaded
            if ($PAGE != "")
            {
                /* -- BEGIN PAGE LOADING -- */
                $PageName = $PageString;

                PageLoad($PageName,$PageType);
                /* -- END PAGE LOADING -- */
            }
            else
            {
                if (FRONTPAGE_TYPE == "DB")
                {
                    PageLoad(FRONTPAGE_DB,"DB");
                }
                else if (FRONTPAGE_TYPE == "FILE")
                {
                    PageLoad(FRONTPAGE_FILE,"FILE");
                }
            }
        }
        else
        {
            // ERROR Found
            include("themes/".THEME_NAME."/pagelates/error-base.php");
        }
        ?>
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
    if(!ErrorDetectionSystem())
    {
      include("core/base/extras.js.inc.php");
    }
    ?>
</html>
