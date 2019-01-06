<?php
// Base
define("FRAMEWORK_NAME", "FEDIMCore");
define("VERSION", "2.0.6");
define("ABSPATH", "http://fedimcore.local/");                                   // The absolute path of your website

define("FRONTPAGE_FILE", "FrontPage.php");                                      // Define the name of the FrontPage found in pages/
define("FRONTPAGE_DB", "FrontPage");                                            // Define the name of the FrontPage found in Database

// --- Database - Notice: This is does not set the database constants rather it sets both local and remote
// Database - local - leave blank if not using a local server
define("DBHostLocal", "localhost");
define("DBUserLocal", "firitkodemaster");
define("DBPassLocal", "AudioMelon2020");
define("DBNameLocal", "fedimcore_master");
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
