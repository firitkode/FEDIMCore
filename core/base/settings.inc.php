<?php
// Base
define("FRAMEWORK_NAME", "FEDIMCore");
define("VERSION", "2.0.3");
define("ABSPATH", "http://localhost/projects/FEDIMCore/");                      // The absolute path of your website
define("FrameworkLocation", "core/paperkit2/");                                 // The framework location that FEDIMCore is built on; usually a folder placed under the /core/
                                                                                // folder; contains the framework assets
define("THEME_NAME", "Fenix2019");
define("FRONTPAGE_FILE", "FrontPage.php");                                      // Define the name of the FrontPage found in pages/
define("FRONTPAGE_DB", "FrontPage");                                            // Define the name of the FrontPage found in Database

// --- Database - Notice: This is does not set the database constants rather it sets both local and remote
// Database - local - leave blank if not using a local server
define("DBHostLocal", "localhost");
define("DBUserLocal", "firitkodemaster");
define("DBPassLocal", "AudioMelon2020");
define("DBNameLocal", "ferimcore_master");
define("DBPrefixLocal", "fc_");

// Database - remote - fill in details of your server
define("DBHostRemote", "");
define("DBUserRemote", "");
define("DBPassRemote", "");
define("DBNameRemote", "");
define("DBPrefixRemote", "");

// Socials
define("FACEBOOK_HANDLE", "kingnosson");
define("GOOGLEPLUS_HANDLE", "115627941458176754542");
define("PINTEREST_HANDLE", "");
define("TWITTER_HANDLE", "firittv");
// --------------------------------------------------------------------------------------------------------------------------------------------------------------------------

// -- Non-Constants Variables
$FRONTPAGE_TYPE = "FILE";                                                       // Define which type of frontpage it is
                                                                                // Options:
                                                                                //            DB
                                                                                //            FILE

// --------------------------------------------------------------------------------------------------------------------------------------------------------------------------
?>
