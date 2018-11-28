<?php
function BuildPageStringFile()
{
    global $PAGE;
    global $SUBPAGE;
    global $MINIPAGE;
    global $TINYPAGE;
    global $PageString;

    if ($PAGE != "" && $SUBPAGE != "" && $MINIPAGE != "" && $TINYPAGE != "")
    {
        $PageString = $PAGE . "/" . $SUBPAGE . "/" . $MINIPAGE . "/" . $TINYPAGE.".php";
    }
    else if ($PAGE != "" && $SUBPAGE != "" && $MINIPAGE != "")
    {
        $PageString = $PAGE . "/" . $SUBPAGE . "/" . $MINIPAGE.".php";
    }
    else if ($PAGE != "" && $SUBPAGE != "")
    {
        $PageString = $PAGE . "/" . $SUBPAGE.".php";
    }
    else if ($PAGE != "")
    {
        $PageString = $PAGE.".php";
    }
    else
    {
        $PageString = "";
    }

    // Set up PageType
    $PageType = "";
}

function CheckINISettingsAttribute($attr)
{
    $check = ini_get($attr);

    if ($check == 1)
      return true;
    else
      return false;
}

function CheckPageInDB($tocheck)
{
    // There is a .php at the end of tocheck; we need to remove it
    $tocheck = str_replace(".php", "", $tocheck);

    // Add a last /
    $tocheckSlash = $tocheck;
    $tocheckSlash .= "/";

    // Are we checking for a page with a parent? IOW: Is the PageString like "page/subpage/minipage/tinypage"?
    // First take the PageString and break it apart
    $tocheckList = explode("/", $tocheckSlash);

    // Count how many levels there are
    $tocheckListNodes = count($tocheckList) - 1;

    if ($tocheckListNodes > 1)
    {
        // A parent has been detected
        $Parent = "";

        // Parent is first nodes; Child is last node
        $ChildNode = $tocheckList[$tocheckListNodes-1];

        // Get the key of the ChildNode
        $ChildNodeKey = array_search($ChildNode, $tocheckList); // say will return 3 in a 4 node array

        //echo "key : ".$ChildNodeKey;

        // Get the ParentNodes
        for ($i = 0; $i < $tocheckListNodes-1; $i++)
        {
            $Parent .= $tocheckList[$i]."/";
        }

        // query_db call
        $Query = query_db("SELECT",DB_PREFIX."pages","name,parent,"," = name, = parent,","id","id",NULL,NULL,NULL,NULL);

        if ($Query != "")
        {
            // Explode list
            $List = explode($Query, ",");

            // Select first one
            $Value = $List[0];

            if ($Value != null || $Value != "" || $Value != 0)
            {
                // found
                return true;
            }
            else
            {
                // not found
                return false;
            }
        }
        else
        {
            return false;
        }
    }
    else
    {
        // Not a parent page situation; single page
        // query_db call
        $Query = query_db("SELECT",DB_PREFIX."pages","name,"," = '{$tocheck}',","id","id",NULL,NULL,NULL,NULL);

        if ($Query != "")
        {
            // Explode list
            $List = explode($Query, ",");

            // Select first one
            $Value = $List[0];

            if ($Value != null || $Value != "" || $Value != 0)
            {
                // found
                return true;
            }
            else
            {
                // not found
                return false;
            }
        }
        else
        {
            return false;
        }
    }
}

function CheckSetEnvironment()
{
  global $ErrorMessage;

  // Database details set
  if (IsLocalhost()) {
    define("DB_HOST", DBHostLocal);
    define("DB_USER", DBUserLocal);
    define("DB_PASS", DBPassLocal);
    define("DB_NAME", DBNameLocal);
    define("DB_PREFIX", DBPrefixLocal);
  }
  else
  {
    define("DB_HOST", DBHostRemote);
    define("DB_USER", DBUserRemote);
    define("DB_PASS", DBPassRemote);
    define("DB_NAME", DBNameRemote);
    define("DB_PREFIX", DBPrefixRemote);
  }

  // -- php ini settings check
  // Setup var$ to capture some ini settings
  $allow_url_fopen = ini_get('allow_url_fopen');
  $allow_url_include = ini_get('allow_url_include');

  // Check to see if they are enabled
  define("INISettingsStatus", ($allow_url_fopen == 1 && $allow_url_include == 1) ? true : false);

  // Used for error message
  if (!CheckINISettingsAttribute('allow_url_fopen'))
  {
      $ErrorMessage = "allow_url_fopen is not enabled!";
  }

  if (!CheckINISettingsAttribute('allow_url_include'))
  {
      $ErrorMessage = "allow_url_include is not enabled!";
  }
  // -------------------------------------------------------------------------------------------------------------------------
}

function ErrorDetectionSystem()
{
  global $Error;
  global $ErrorType;
  global $ErrorMessage;
  global $PageString;
  global $PageType;
  global $PAGE;

  // Set a base case
  $Error = 0;

  // -- Get/Check ini settings
  //
  if (!INISettingsStatus){$Error = 1;$ErrorType="INI";}
  // --------------------------------------------------------------------------------------------------------

  // Oops! Page Not Found
  // --------------------------------------------------------------------------------------------------------

  if ($PAGE != "")
  {
      // -- Page Check DB Errors - IF a DB page, check to see if:
      // 1. It exists in DB
      // 2. It is active
      //
      if (!CheckPageInDB($PageString))
      {
        $Error = 1;
        $ErrorType = "404";
      }
      else
      {
          $PageType = "DB";
      }
      // --------------------------------------------------------------------------------------------------------

      // -- Page Check File Errors - IF page is a FILE page, check to see if:
      // 1. It exists in pages/ directory
      //
      if ($PageString != "")
      {
          if (!file_exists("pages/".$PageString))
          {
              $Error = 1;
              $ErrorType = "404";
              $ErrorMessage = "Oops! Page not found";
          }
          else
          {
              // Page exists; set the type as 'FILE'
              $PageType = "FILE";
          }
      }
      // -------------------------------------------------------------------------------------------------------

      // -- Page from FILE contents length check
      if ($PageString != "")
      {
          $FILE = "pages/".$PageString.".php";
          if (file_exists($FILE))
          {
              $PageFile = fopen($FILE,"r");
              if (filesize($FILE) == 0)
              {
                  //$CONTENTS = fread($PageFile,filesize($FILE));
                  $Error = 1;
                  $ErrorType = 104;
                  $ErrorMessage = "This page has no contents!";
                  fclose($PageFile);
              }
          }
      }
  }
  else
  {
      // Check frontpage exist and not blank
      if (FRONTPAGE_TYPE == "FILE")
      {
          $FILE = "pages/".FRONTPAGE_FILE;
          if (file_exists($FILE))
          {
              $PageFile = fopen($FILE,"r");
              if (filesize($FILE) == 0)
              {
                  //$CONTENTS = fread($PageFile,filesize($FILE));
                  $Error = 1;
                  $ErrorType = 104;
                  $ErrorMessage = "Front Page has no content!";
                  fclose($PageFile);
              }
          }
          else
          {
            $Error = 1;
            $ErrorType = 404;
            $ErrorMessage = "Front Page does not exist!";
          }
      }
      else if (FRONTPAGE_TYPE == "DB")
      {
          if (CheckPageInDB(FRONTPAGE_DB))
          {
              // Get the content
              $PageContent = GetPageContent(FRONTPAGE_DB);

              if ($PageContent == "")
              {

                $Error = 1;
                $ErrorType = 104;
                $ErrorMessage = "Front Page has no content!";
              }
          }
          else
          {
            $Error = 1;
            $ErrorType = 404;
            $ErrorMessage = "Front Page does not exist!";
          }
      }
  }
  // -------------------------------------------------------------------------------------------------------

  // Don't need to return something
  // Do endcode
  /*if ($Error == 1)
  {
      return true;
  }
  else
  {
      return false;
  }*/
}

function GetPageContent($name)
{
    // query_db call
    $Query = query_db("SELECT",DB_PREFIX."pages","name,"," = '{$name}',","content","name",NULL,NULL,NULL,NULL);

    if ($Query != "")
    {
        // Explode list
        $List = explode(",", $Query);

        // Select first one
        $Value = $List[0];

        // found
        return $Value;
    }
}

function GetPageInfo($name,$item)
{
    // query_db call
    $Query = query_db("SELECT",DB_PREFIX."pages","name,"," = '{$name}',","{$item}","{$item}",NULL,NULL,NULL,NULL);

    if ($Query != "")
    {
        // Explode list
        $List = explode(",", $Query);

        // Select first one
        $Value = $List[0];

        // found
        return $Value;
    }
    else
    {
        return "no info";
    }
}

function IsLocalhost()
{
  $whitelist = array( '127.0.0.1', '::1', 'localhost' );
  if( in_array( $_SERVER['REMOTE_ADDR'], $whitelist) )
    return true;
}

function PageLoad($name,$type)
{
    global $PAGE;
    // Load the nav
    include("themes/".THEME_NAME."/nav.php");

    // Load the header
    include("themes/".THEME_NAME."/pageheader.php");

    // Load the page structure
    switch ($type)
    {
        case 'DB':
            // Get the content
            $PageContent = GetPageContent($name);

            // Evaluate the content
            echo eval("?>".$PageContent."<?");
        break;

        case 'FILE':
            $FILE = "pages/".$name;

            if (filesize($FILE) != 0)
            {
                $PageFile = fopen($FILE,"r");
                $CONTENTS = fread($PageFile,filesize($FILE));

                echo eval("?>".$CONTENTS."<?");

                fclose($PageFile);
            }

        break;
    }
    // Load the footer
    include("themes/".THEME_NAME."/pagefooter.php");
}

function query_db($TYPE,$DB_TABLE,$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$TO_BE_FETCHED,$DB_ORDERBY,$DB_GROUPBY = NULL,$INSERT_ITEMS = NULL,$INSERT_VALUES = NULL,$DB_ORDERBY_ORDER = NULL)
{
	/*
	FUNCTION CREATED BY: Gavin Sao

	PURPOSE: To make querying the database easier and quicker without having to monotonously
			 display the code to query every single time.

	RETURNS: *If using SELECT: A comma separated list with trailing comma
			 *If using INSERT: Nothing
			 *If using UPDATE: Nothing
			 *If using DELETE: Nothing
			 *If using TRUNCATE: Nothing

	OPTIONS: TYPE 	  			   : The type of query
									 - can except:
												  INSERT
									              SELECT
												  UPDATE
												  DELETE
												  TRUNCATE

			 DB_TABLE 			   : The table to be queried
			 DB_WHERECLAUSE 	   : Optional: The where clause (leave blank to retrieve all info)
			 					   : Can Except multiple options (comma-separated)
			 DB_WHERECLAUSEEQUALTO : Optional: The where clause is equal to (ditto)
			 					   : Can Except multiple options (comma-separated)
			 TO_BE_FETCHED		   : The column name to be fetched from the database
			 DB_ORDERBY			   : What to order by
			 DB_GROUPBY			   : Will tack on the group by to the query
			 $INSERT_ITEMS		   : Used for INSERT to insert items (can be comma-separated for
									 multiple). Can be used for UPDATE or DELETE as well
			 $INSERT_VALUES		   : Used for INSERT to insert item values (can be comma-separated for
								     multiple). Can be used for UPDATE or DELETE as well

	USAGE: Using this function is very simple, just simply call to action this:

		"query_db($TYPE,$DB_TABLE,$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$TO_BE_FETCHED);"

		   while connecting it to a $variable (or else it won't really be of any use) and
		   replacing all the parameters with their respective items (see USAGE above for help).

	NOTES:
			* This function requires that you use mysqli (only one you can use; mysql was dep'd)
			* This function assumes your mysqli variable/object name is "dba". To use another name,
			  you must change "global $dba;" and anywhere else "$dba" is found to what you have.
			* If you would like to use a pre-made mysqli connect statement, you can head over to
			  mrgavinsao.com to checkout our snippets section and download the
			  snippet-php-connect.zip file.

	UPDATES:
				2016-08-14 : * Added TRUNCATE functionality

	            2016-01-07 : * Added UPDATE and DELETE functionality
							 * Updated comments

				2015-05-31 : * Added an order by parameter
							 * Added ability to have multiple WHERE options

				2015-05-27 : * Changed "case 'WHERE':" to "case 'SELECT':"
							 * Added INSERT, UPDATE, DELETE "shell" cases; will add support for
							   them later

				2015-05-26 : This script is born!
	*/
	global $dba;
	$return="";
	$FETCHED="";
	switch($TYPE){
		case 'INSERT':
			$sql = "INSERT INTO ".$DB_TABLE." (".$INSERT_ITEMS.")
VALUES (".$INSERT_VALUES.")";

			if(!$result = $dba->query($sql)){
				/* SOMETHING HAPPENED; QUERY WENT WONKY */
				$result = $dba->error." <br /><br /> SQL: ".$sql;
				echo $result;
			} else {

			}
		break;
		case 'SELECT':
			//check to see if WHERE clause is not blank
			if($DB_WHERECLAUSE!=""){
				// CHECKING FOR SPECIFICS
				// -- check to see if there are multiple where options
				// first explode the where
				$DB_WHERECLAUSE_LIST		= explode(",",$DB_WHERECLAUSE);
				$DB_WHERECLAUSEEQUALTO_LIST	= explode(",",$DB_WHERECLAUSEEQUALTO);

				//now check to see if there are more than 1
				if((count($DB_WHERECLAUSE_LIST) > 1) && (count($DB_WHERECLAUSEEQUALTO_LIST > 1))){
					/* MULTIPLE WHERES */
					$sql = "SELECT * FROM `".$DB_TABLE."`";
					for($i=0; $i<count($DB_WHERECLAUSE_LIST)-1; $i++){
						//first or extra? if first : WHERE ; else : AND
						if($i==0){$sql .= "WHERE ";}
						if($i>0){$sql .= " AND ";}

						// Find out if there is a :COMMA: found in the string
						$pos = strpos($DB_WHERECLAUSEEQUALTO_LIST[$i],":COMMA:");
						if ($pos != null)
						{
							// rewrite the where
							$THEWHERE = str_replace(":COMMA:",",",$DB_WHERECLAUSEEQUALTO_LIST[$i]);
						}
						else
						{
							$THEWHERE = $DB_WHERECLAUSEEQUALTO_LIST[$i];
						}
						$sql .= "`".$DB_WHERECLAUSE_LIST[$i]."` ".$THEWHERE."";
					}
					if($DB_ORDERBY_ORDER!=NULL){
						if($DB_GROUPBY!=NULL){$sql .= " GROUP BY ".$DB_GROUPBY." ORDER BY ".$DB_ORDERBY." ".$DB_ORDERBY_ORDER."";}else{$sql .= " ORDER BY ".$DB_ORDERBY." ".$DB_ORDERBY_ORDER."";}
					} else {
						if($DB_GROUPBY!=NULL){$sql .= " GROUP BY ".$DB_GROUPBY." ORDER BY ".$DB_ORDERBY." ASC";}else{$sql .= " ORDER BY ".$DB_ORDERBY." ASC";}
					}
				} else {
					/* SINGLE WHERE */
					if($DB_ORDERBY_ORDER!=NULL){
						$sql = "
							SELECT * FROM `".$DB_TABLE."`
							WHERE `".$DB_WHERECLAUSE_LIST[0]."` = '".$DB_WHERECLAUSEEQUALTO_LIST[0]."' ORDER BY ".$DB_ORDERBY." ".$DB_ORDERBY_ORDER."
						";
					} else {
						$sql = "
							SELECT * FROM `".$DB_TABLE."`
							WHERE `".$DB_WHERECLAUSE_LIST[0]."` = '".$DB_WHERECLAUSEEQUALTO_LIST[0]."' ORDER BY ".$DB_ORDERBY." ASC
						";
					}
				}
			} else {
				if($DB_ORDERBY_ORDER!=NULL){
					$sql = "
						SELECT * FROM `".$DB_TABLE."` ORDER BY ".$DB_ORDERBY." ".$DB_ORDERBY_ORDER."
					";
				} else {
					$sql = "
						SELECT * FROM `".$DB_TABLE."` ORDER BY ".$DB_ORDERBY." ASC
					";
				}
			}


			if(!$result = $dba->query($sql)){
				/* SOMETHING HAPPENED; QUERY WENT WONKY */
				$result = $dba->error." <br /><br /> SQL: ".$sql."<br /><br />WHERE CLAUSE: ".$DB_WHERECLAUSE."<br /><br />WHERE CLAUSE EQUAL TO: ".$DB_WHERECLAUSEEQUALTO;
				echo $result;
			} else {
				/* GOOD QUERY; DO SHIT */

				/* OH THIS IS ALL DEBUG SHIT...DO NOT UNCOMMENT THIS
				*/
				//echo "WHERE: ".$DB_WHERECLAUSE;
				//echo "<br />WHERE = TO: ".$DB_WHERECLAUSEEQUALTO;
				//echo "<br />TBF: ".$TO_BE_FETCHED;
				//echo "<br />SQL: ".$sql;

				while($FETCH=$result->fetch_assoc()){
					$FETCHED.=$FETCH[$TO_BE_FETCHED].",";
					$return=$FETCHED;
				}
			}

			@$result->free();
		break;
		case 'UPDATE':
			//check to see if WHERE clause is not blank
			if($DB_WHERECLAUSE!=""){
				// CHECKING FOR SPECIFICS
				// -- check to see if there are multiple where options
				// first explode the where
				$DB_WHERECLAUSE_LIST		= explode(",",$DB_WHERECLAUSE);
				$DB_WHERECLAUSEEQUALTO_LIST	= explode(",",$DB_WHERECLAUSEEQUALTO);

				//now check to see if there are more than 1
				if((count($DB_WHERECLAUSE_LIST) > 1) && (count($DB_WHERECLAUSEEQUALTO_LIST > 1))){
					/* MULTIPLE WHERES */
					$sql = "UPDATE `".$DB_TABLE."` SET ".$INSERT_ITEMS." = '".$INSERT_VALUES."' ";
					for($i=0; $i<count($DB_WHERECLAUSE_LIST)-1; $i++){
						//first or extra? if first : WHERE ; else : AND
						if($i==0){$sql .= "WHERE ";}
						if($i>0){$sql .= " AND ";}
						$sql .= "`".$DB_WHERECLAUSE_LIST[$i]."` ".$DB_WHERECLAUSEEQUALTO_LIST[$i]."";
					}
				} else {
					/* SINGLE WHERE */
					$sql = "
						UPDATE `".$DB_TABLE."` SET ".$INSERT_ITEMS." = '".$INSERT_VALUES."' WHERE `".$DB_WHERECLAUSE_LIST[0]."` = '".$DB_WHERECLAUSEEQUALTO_LIST[0]."'
					";
				}
			} else {
				$sql = "
					UPDATE `".$DB_TABLE."` SET ".$INSERT_ITEMS." = '".$INSERT_VALUES."'
				";
			}

			//MySqli Update Query
			$results = $dba->query($sql);

			//MySqli Delete Query
			//$results = $dba->query("DELETE FROM products WHERE ID=24");

			if($results){
				//echo 'Success! record updated / deleted';
			}else{
				echo 'Error : ('. $dba->errno .') '. $dba->error.'<br />';
				echo "WHERE: ".$DB_WHERECLAUSE;
				echo "<br />WHERE = TO: ".$DB_WHERECLAUSEEQUALTO;
			}
		break;
		case 'DELETE':
			//check to see if WHERE clause is not blank
			if($DB_WHERECLAUSE!=""){
				// CHECKING FOR SPECIFICS
				// -- check to see if there are multiple where options
				// first explode the where
				$DB_WHERECLAUSE_LIST		= explode(",",$DB_WHERECLAUSE);
				$DB_WHERECLAUSEEQUALTO_LIST	= explode(",",$DB_WHERECLAUSEEQUALTO);

				//now check to see if there are more than 1
				if((count($DB_WHERECLAUSE_LIST) > 1) && (count($DB_WHERECLAUSEEQUALTO_LIST > 1))){
					/* MULTIPLE WHERES */
					$sql = "DELETE FROM `".$DB_TABLE."`";
					for($i=0; $i<count($DB_WHERECLAUSE_LIST)-1; $i++){
						//first or extra? if first : WHERE ; else : AND
						if($i==0){$sql .= "WHERE ";}
						if($i>0){$sql .= " AND ";}
						$sql .= "`".$DB_WHERECLAUSE_LIST[$i]."` ".$DB_WHERECLAUSEEQUALTO_LIST[$i]."";
					}
				} else {
					/* SINGLE WHERE */
					$sql = "
						DELETE FROM `".$DB_TABLE."` WHERE `".$DB_WHERECLAUSE_LIST[0]."` = '".$DB_WHERECLAUSEEQUALTO_LIST[0]."'
					";
				}
			} else {
				$sql = "
					DELETE FROM `".$DB_TABLE."`
				";
			}

			//MySqli Update Query
			$results = $dba->query($sql);

			//MySqli Delete Query
			//$results = $dba->query("DELETE FROM products WHERE ID=24");

			if($results){
				//echo 'Success! record updated / deleted';
			}else{
				echo 'Error : ('. $dba->errno .') '. $dba->error.'<br />';
				echo "WHERE: ".$DB_WHERECLAUSE;
				echo "<br />WHERE = TO: ".$DB_WHERECLAUSEEQUALTO;
			}
		break;
		case 'TRUNCATE':
			$sql = "
				TRUNCATE TABLE `".$DB_TABLE."`
			";

			//MySqli Update Query
			$results = $dba->query($sql);

			//MySqli Delete Query
			//$results = $dba->query("DELETE FROM products WHERE ID=24");

			if($results){
				//echo 'Success! record updated / deleted';
			}else{
				echo 'Error : ('. $dba->errno .') '. $dba->error.'<br />';
				echo "WHERE: ".$DB_WHERECLAUSE;
				echo "<br />WHERE = TO: ".$DB_WHERECLAUSEEQUALTO;
			}
		break;
	}
	return $return;
}
?>