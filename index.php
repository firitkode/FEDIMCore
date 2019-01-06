<?php
// Require the settings file
require("core/base/settings.inc.php");

// Require the functions file - necessary to use connect file
require("core/base/functions.inc.php");

// Get page levels
$PAGE = (isset($_GET['page'])) ? $_GET['page'] : "";
$SUBPAGE = (isset($_GET['subpage'])) ? $_GET['subpage'] : "";
$MINIPAGE = (isset($_GET['minipage'])) ? $_GET['minipage'] : "";
$TINYPAGE = (isset($_GET['tinypage'])) ? $_GET['tinypage'] : "";

// Check/Set the environment to determine which set of database settings to use, server settings properly set up, etc
$MSet = 0;
$ErrorMessage = "";
CheckSetEnvironment();

// Require the connect file in order to use database functionality
include("core/base/connect.inc.php");

// Build a PageString to be used for PageLoading
$PageString = "";
BuildPageStringFile();

// Version 2.0.6 - Get the theme name from DB
$THEME_NAME = GetSettings("theme_name");

// Run ErrorDetectionSystem
ErrorDetectionSystem();

// Set up the Parent and child for globals
SetParentChildFromString($PageString);
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="<?php echo ABSPATH;?><?php echo $THEME_NAME;?>/img/favicon.ico">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo ABSPATH;?><?php echo $THEME_NAME;?>/img/apple-icon.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title><?php echo FRAMEWORK_NAME;?> <?php echo VERSION;?><?php
        if ($PAGE != "")
        {
            // check to see if it's a DB page for FILE page
            if (CheckPageInDB($PageString))
            {
                if (isset($ChildNode))
                {
                    // child page
                    echo " - " . GetPageInfo($ChildNode,"title",$Parent);
                }
                else
                {
                    // single page
                    echo " - " . GetPageInfo($PageString,"title");
                }
            }
            else
            {
              // Pull from .ini file
                echo " - " . PullFileInfo($PageString,"PageName");
            }
        }
        ?></title>

        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />

        <!-- Bootstrap core CSS     -->
        <link href="<?php echo ABSPATH;?>core/base/includes/css/bootstrap.min.css" rel="stylesheet" />

        <?php
        include("themes/".$THEME_NAME."/includes/extras.top.js.inc.php");
        ?>

        <!--     Fonts and icons     -->
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,300,700' rel='stylesheet' type='text/css'>
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

        <!-- Error Page assets -->
        <!-- Google font -->
      	<link href="https://fonts.googleapis.com/css?family=Muli:400" rel="stylesheet">
      	<link href="https://fonts.googleapis.com/css?family=Passion+One" rel="stylesheet">

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
            include("themes/".$THEME_NAME."/pagelates/page-base.php");
        }
        else
        {
            // ERROR Found
            include("themes/".$THEME_NAME."/pagelates/error-base.php");
        }
        ?>
    </body>

    <!-- Core JS Files -->
    <script src="<?php echo ABSPATH;?>core/base/includes/js/jquery-3.2.1.js" type="text/javascript"></script>
    <script src="<?php echo ABSPATH;?>core/base/includes/js/jquery-ui-1.12.1.custom.min.js" type="text/javascript"></script>
    <script src="<?php echo ABSPATH;?>core/base/includes/js/popper.js" type="text/javascript"></script>
    <script src="<?php echo ABSPATH;?>core/base/includes/js/bootstrap.min.js" type="text/javascript"></script>

    <!-- Switches -->
    <script src="<?php echo ABSPATH;?>core/base/includes/js/bootstrap-switch.min.js"></script>

    <!--  Plugins for Slider -->
    <script src="<?php echo ABSPATH;?>core/base/includes/js/nouislider.js"></script>

    <!--  Plugins for DateTimePicker -->
    <script src="<?php echo ABSPATH;?>core/base/includes/js/moment.min.js"></script>
    <script src="<?php echo ABSPATH;?>core/base/includes/js/bootstrap-datetimepicker.min.js"></script>

    <?php
    if(!ErrorDetectionSystem())
    {
      include("themes/".$THEME_NAME."/includes/extras.bottom.js.inc.php");
    }
    ?>
</html>
