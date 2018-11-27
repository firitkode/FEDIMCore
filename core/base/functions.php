<?php
function cleanifyN($NUM,$DECIMALS = 2){
	if(@$NUM>=0 && @$NUM<999){@$NUMBER=number_format(@$NUM,$DECIMALS);}						
	if($NUM>=1000 && $NUM<9999){$NUMBER=number_format(($NUM / 1000),$DECIMALS) ."K";}	 
	if($NUM>=10000 && $NUM<99999){$NUMBER=number_format(($NUM / 1000),$DECIMALS)."K";}	
	if($NUM>=100000 && $NUM<999999){$NUMBER=number_format(($NUM / 1000),$DECIMALS)."K";}
	if($NUM>=1000000 && $NUM<9999999){$NUMBER=number_format(($NUM / 1000000),$DECIMALS)."M";}
	if($NUM>=10000000 && $NUM<99999999){$NUMBER=number_format(($NUM / 1000000),$DECIMALS)."M";}
	if($NUM>=100000000 && $NUM<999999999){$NUMBER=number_format(($NUM / 1000000),$DECIMALS)."M";}
	if($NUM>=1000000000 && $NUM<9999999999){$NUMBER=number_format(($NUM / 1000000000),$DECIMALS)."B";}
	if($NUM>=10000000000 && $NUM<99999999999){$NUMBER=number_format(($NUM / 1000000000),$DECIMALS)."B";}
	if($NUM>=100000000000 && $NUM<999999999999){$NUMBER=number_format(($NUM / 1000000000),$DECIMALS)."B";}
	if($NUM>=1000000000000 && $NUM<9999999999999){$NUMBER=number_format(($NUM / 1000000000000),$DECIMALS)."T";}
	if($NUM>=10000000000000 && $NUM<99999999999999){$NUMBER=number_format(($NUM / 1000000000000),$DECIMALS)."T";}
	if($NUM>=100000000000000 && $NUM<99999999999999){$NUMBER=number_format(($NUM / 1000000000000),$DECIMALS)."T";}
	if($NUM>=1000000000000000 && $NUM<9999999999999999){$NUMBER=number_format(($NUM / 1000000000000000),$DECIMALS)."Qd";}
	if($NUM>=10000000000000000 && $NUM<99999999999999999){$NUMBER=number_format(($NUM / 1000000000000000),$DECIMALS)."Qd";}
	if($NUM>=100000000000000000 && $NUM<999999999999999999){$NUMBER=number_format(($NUM / 1000000000000000),$DECIMALS)."Qd";}
	if($NUM>=1000000000000000000 && $NUM<9999999999999999999){$NUMBER=number_format(($NUM / 1000000000000000000),$DECIMALS)."Qn";}
	if($NUM>=10000000000000000000 && $NUM<99999999999999999999){$NUMBER=number_format(($NUM / 1000000000000000000),$DECIMALS)."Qn";}
	if($NUM>=100000000000000000000 && $NUM<999999999999999999999){$NUMBER=number_format(($NUM / 1000000000000000000),$DECIMALS)."Qn";}
	if($NUM>=1000000000000000000000 && $NUM<9999999999999999999999){$NUMBER=number_format(($NUM / 1000000000000000000000),$DECIMALS)."X";}
	if($NUM>=10000000000000000000000 && $NUM<99999999999999999999999){$NUMBER=number_format(($NUM / 1000000000000000000000),$DECIMALS)."X";}
	if($NUM>=100000000000000000000000 && $NUM<999999999999999999999999){$NUMBER=number_format(($NUM / 1000000000000000000000),$DECIMALS)."X";}
	if($NUM>=1000000000000000000000000 && $NUM<9999999999999999999999999){$NUMBER=number_format(($NUM / 1000000000000000000000000),$DECIMALS)."P";}
	if($NUM>=10000000000000000000000000 && $NUM<99999999999999999999999999){$NUMBER=number_format(($NUM / 1000000000000000000000000),$DECIMALS)."P";}
	if($NUM>=100000000000000000000000000 && $NUM<999999999999999999999999999){$NUMBER=number_format(($NUM / 1000000000000000000000000),$DECIMALS)."P";}
	if ($NUM>999990000000000000000000000){$NUMBER="<span style=\"font-size: 25px !important;\">Astronomical # of</span>";}
	return $NUMBER;
}

function CheckActiveBot($WHAT,$MEMBERSHIP)
{
	global $DB_PREFIX;
	// Set up variables
	$DB_WHERECLAUSE 		= "membership,status,";
	$DB_WHERECLAUSEEQUALTO 	= " = '{$MEMBERSHIP}', = 'active',";
	
	// Do get
	$GET = query_db("SELECT",DB_PREFIX."users",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$WHAT,NULL,NULL,NULL,NULL);
	
	// Explode into array
	$GET = explode(",", $GET);
	
	// There can be only one
	$GET = $GET[0];
	
	// Return
	return $GET;
}

function CheckMatchAid($AID,$WHAT = null)
{
	// -- AID is encrypted; find the true AID
	$DBAIDS = GetAllAds("id","id",null,null,null);
	
	$RAID = 0;
	
	if (count($DBAIDS) - 1 < 1)
	{
		/* NONE FOUND; THIS IS WEIRD */
	}
	else
	{
		/* FOUND ADS; LOOP THROUGH THEM TO FIND THE ID */
		for ($i = 0; $i < count($DBAIDS) - 1; $i++)
		{
			// Add the necessary things to the AID
			if ($WHAT == "OUTER")
			{
				$MATCHID = "AD-CONTAINER-".$DBAIDS[$i];
				// Encrypt to find out if a match
				$MATCHID = sha1(md5($MATCHID));
			}
			else
			{
				$MATCHID = "AD-".$DBAIDS[$i];
				// Encrypt to find out if a match
				$MATCHID = md5(sha1($MATCHID));
			}
			
			// Compare the two AIDs
			if ($MATCHID == $AID)
			{
				// Found a match
				$RAID = $DBAIDS[$i];
				break;
			}
		}
	}
	
	return $RAID;
}

function CountActiveBots($WHAT,$MEMBERSHIP)
{
	global $DB_PREFIX;
	// Set up variables
	$DB_WHERECLAUSE 		= "membership,status,";
	$DB_WHERECLAUSEEQUALTO 	= " = '{$MEMBERSHIP}', = 'active',";
	
	// Do get
	$GET = query_db("SELECT",DB_PREFIX."users",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$WHAT,NULL,NULL,NULL,NULL);
	
	// Explode into array
	$GET = explode(",", $GET);
	
	// There can be only one
	//$GET = $GET[0];
	
	// Return
	return $GET;
}

function GetADInfo($WHAT,$ADID)
{
	global $DB_PREFIX;
	// Set up variables
	$DB_WHERECLAUSE 		= "id,";
	$DB_WHERECLAUSEEQUALTO 	= " = '{$ADID}',";
	
	// Do get
	$GET = query_db("SELECT",DB_PREFIX."ads",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$WHAT,NULL,NULL,NULL,NULL);
	
	// Explode into array
	$GET = explode(",", $GET);
	
	// There can be only one
	$GET = $GET[0];
	
	// Return
	return $GET;
}

function GetAllAds($WHAT,$BY,$ID = null,$type = null,$status = null,$UID = null,$LIMIT = null)
{
	global $DB_PREFIX;
	// Set up variables
	if ($status != null && $status != "any" && $ID != null)
	{
		$DB_WHERECLAUSE 		= "id,status,";
		$DB_WHERECLAUSEEQUALTO 	= "= '{$ID}', = '{$status}',";
	}
	else if ($ID != null && $status != "any")
	{
		$DB_WHERECLAUSE 		= "status,id,";
		$DB_WHERECLAUSEEQUALTO 	= " = 'active', = '{$ID}',";
	}
	else if ($ID != null && $status == "any")
	{
		$DB_WHERECLAUSE 		= "status,id,";
		$DB_WHERECLAUSEEQUALTO 	= " != '', = '{$ID}',";
	}
	else if ($type != null && $status != "any")
	{
		$DB_WHERECLAUSE 		= "status,type,";
		$type = GetTypeIDFromCN($type);
		$DB_WHERECLAUSEEQUALTO 	= " = 'active', = '{$type}',";
	}
	else if ($type != null && $status == "any")
	{
		$DB_WHERECLAUSE 		= "status,type,";
		//$type = GetTypeIDFromCN($type);
		$DB_WHERECLAUSEEQUALTO 	= " != '', = '{$type}',";
	}
	else if ($status != null && $status != "any")
	{
		$DB_WHERECLAUSE 		= "status,";
		$DB_WHERECLAUSEEQUALTO 	= " = '{$status}',";
	}
	else if ($status == "any" && $UID == null)
	{
		$DB_WHERECLAUSE 		= "status,";
		$DB_WHERECLAUSEEQUALTO 	= " != '',";
	}
	else if ($status == "any" && $UID != null)
	{
		$DB_WHERECLAUSE 		= "status,";
		$DB_WHERECLAUSEEQUALTO 	= " != '',";
	}
	else
	{
		$DB_WHERECLAUSE 		= "status,";
		$DB_WHERECLAUSEEQUALTO 	= " = 'active',";
	}
	
	if ($UID != null)
	{
		$DB_WHERECLAUSE 		.= "owner_id,";
		$DB_WHERECLAUSEEQUALTO 	.= " = '{$UID}',";
	}
	
	// Do get
	if ($LIMIT != null)
	{
		$GET = query_db("SELECT",DB_PREFIX."ads",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$BY,NULL,NULL,NULL,$LIMIT);
	}
	else
	{
		$GET = query_db("SELECT",DB_PREFIX."ads",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$BY,NULL,NULL,NULL,NULL);
	}
	
	// Explode into array
	$GET = explode(",", $GET);
	
	if ($ID != null || $LIMIT != null)
	{
		$GET = $GET[0];
	}
	
	// Return
	return $GET;
}

function GetADURL($ID)
{
	global $DB_PREFIX;
	// Set up variables
	$DB_WHERECLAUSE 		= "id,";
	$DB_WHERECLAUSEEQUALTO 	= " = '{$ID}',";
	
	// Do get
	$GET = query_db("SELECT",DB_PREFIX."ads",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,"url","url",NULL,NULL,NULL,NULL);
	
	// Explode into array
	$GET = explode(",", $GET);
	
	// There can be only one
	$GET = $GET[0];
	
	// Return
	return $GET;
}

function GetDepartmentInfoByID($WHAT,$ID)
{
	global $DB_PREFIX;
	// Set up variables
	$DB_WHERECLAUSE 		= "id,";
	$DB_WHERECLAUSEEQUALTO 	= " = '{$ID}',";
	
	// Do get
	$GET = query_db("SELECT",DB_PREFIX."contact_departments",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$WHAT,NULL,NULL,NULL,NULL);
	
	// Explode into array
	$GET = explode(",", $GET);
	
	// There can be only one
	$GET = $GET[0];
	
	// Return
	return $GET;
}

function GetDepartmentInfoByName($WHAT,$NAME)
{
	global $DB_PREFIX;
	// Set up variables
	$DB_WHERECLAUSE 		= "name,";
	$DB_WHERECLAUSEEQUALTO 	= " = '{$NAME}',";
	
	// Do get
	$GET = query_db("SELECT",DB_PREFIX."contact_departments",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$WHAT,NULL,NULL,NULL,NULL);
	
	// Explode into array
	$GET = explode(",", $GET);
	
	// There can be only one
	$GET = $GET[0];
	
	// Return
	return $GET;
}

function GetUserRRs($WHAT,$UID)
{
	global $DB_PREFIX;
	// Set up variables
	$DB_WHERECLAUSE 		= "owner_id,";
	$DB_WHERECLAUSEEQUALTO 	= " = '{$UID}', = 'active',";
	
	// Do get
	$GET = query_db("SELECT",DB_PREFIX."users",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$WHAT,NULL,NULL,NULL,NULL);
	
	// Explode into array
	$GET = explode(",", $GET);
	
	// There can be only one
	//$GET = $GET[0];
	
	// Return
	return $GET;
}

function GetLogInfo($WHAT,$ID)
{
	global $DB_PREFIX;
	// Set up variables
	$DB_WHERECLAUSE 		= "id,";
	$DB_WHERECLAUSEEQUALTO 	= " = '{$ID}',";
	
	// Do get
	$GET = query_db("SELECT",DB_PREFIX."logs",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$WHAT,NULL,NULL,NULL,NULL);
	
	// Explode into array
	$GET = explode(",", $GET);
	
	// There can be only one
	$GET = $GET[0];
	
	// Return
	return $GET;
}

function GetKeyInfo($WHAT,$KEY)
{
	global $DB_PREFIX;
	// Set up variables
	$DB_WHERECLAUSE 		= "keycode,";
	$DB_WHERECLAUSEEQUALTO 	= " = '{$KEY}',";
	
	// Do get
	$GET = query_db("SELECT",DB_PREFIX."keys",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$WHAT,NULL,NULL,NULL,NULL);
	
	// Explode into array
	$GET = explode(",", $GET);
	
	// There can be only one
	$GET = $GET[0];
	
	// Return
	return $GET;
}

function CheckUserLog($WHAT,$type,$aid,$uid,$NO_LIMIT = null,$LID = null,$GETDATETIME = false,$STATUS = null,$ORDERBY = null,$GUESTSESSION = null,$LIMIT = null)
{
	global $DB_PREFIX;
	// Set up variables
	if ($GETDATETIME == true)
	{
		$DB_WHERECLAUSE 		= "type,uid,";
		$DB_WHERECLAUSEEQUALTO 	= " = '{$type}', = '{$uid}',";
	}
	else if ($type == null && $LID != null && $aid == null)
	{
		$DB_WHERECLAUSE 		= "id,";
		$DB_WHERECLAUSEEQUALTO 	= " = '{$LID}',";
		//$RETURN = "hmm";
	}
	else if ($type != null && $LID != null && $aid == null)
	{
		$DB_WHERECLAUSE 		= "id,";
		$DB_WHERECLAUSEEQUALTO 	= " = '{$LID}',";
		//$RETURN = "hmm";
	}
	else if ($aid == null && $uid != null && $ORDERBY == null && $GUESTSESSION == null && $type != "all")
	{
		$DB_WHERECLAUSE 		= "type,uid,";
		$DB_WHERECLAUSEEQUALTO 	= " = '{$type}', = '{$uid}',";
	}
	else if ($aid == null && $uid == null && $ORDERBY == null && $GUESTSESSION == null && $LID != null)
	{
		$DB_WHERECLAUSE 		= "id,type,";
		$DB_WHERECLAUSEEQUALTO 	= " = '{$LID}', = '{$type}',";
	}
	else if ($aid == null && $uid == null && $ORDERBY == null && $GUESTSESSION == null)
	{
		$DB_WHERECLAUSE 		= "type,";
		$DB_WHERECLAUSEEQUALTO 	= " = '{$type}',";
	}
	else if ($aid == null && $LIMIT != null)
	{
		$DB_WHERECLAUSE 		= "type,";
		$DB_WHERECLAUSEEQUALTO 	= " = '{$type}',";
	}
	else if ($aid == null && $ORDERBY != null && $type == null)
	{
		$DB_WHERECLAUSE 		= "uid,";
		$DB_WHERECLAUSEEQUALTO 	= " = '{$uid}',";
	}
	else if ($aid == null && $ORDERBY != null && $type != null)
	{
		$DB_WHERECLAUSE 		= "uid,type,";
		$DB_WHERECLAUSEEQUALTO 	= " = '{$uid}', = '{$type}',";
	}
	else if ($GUESTSESSION != null)
	{
		$DB_WHERECLAUSE 		= "guest_session,";
		$DB_WHERECLAUSEEQUALTO 	= " = '{$GUESTSESSION}',";
	}
	else 
	{
		if ($type == "all")
		{
			$DB_WHERECLAUSE 		= "uid,";
			$DB_WHERECLAUSEEQUALTO 	= " = '{$uid}',";
			//$RETURN = "hmm";
		}
		else
		{
			$DB_WHERECLAUSE 		= "type,uid,aid,";
			$DB_WHERECLAUSEEQUALTO 	= " = '{$type}', = '{$uid}', = '{$aid}',";
		}
	}
	
	if ($STATUS != null)
	{
		$DB_WHERECLAUSE 		.= "status,";
		$DB_WHERECLAUSEEQUALTO 	.= " = '{$STATUS}',";
	}
	
	// Do get
	if ($GETDATETIME == true)
	{
		if ($LIMIT == null)
		{
			$GET = query_db("SELECT",DB_PREFIX."logs",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$WHAT,NULL,NULL,NULL,NULL);
		}
		else 
		{
			$GET = query_db("SELECT",DB_PREFIX."logs",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$WHAT,NULL,NULL,NULL,"ASC LIMIT 1");
		}
	}
	
	if ($NO_LIMIT == "SPECIAL")
	{
		$GET = query_db("SELECT",DB_PREFIX."logs",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$WHAT,NULL,NULL,NULL,NULL);
	}
	else if ($NO_LIMIT != null && $ORDERBY != null && $LIMIT != null)
	{
		$GET = query_db("SELECT",DB_PREFIX."logs",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$ORDERBY,NULL,NULL,NULL,$LIMIT);
	}
	else if ($NO_LIMIT != null && $ORDERBY == null)
	{
		$GET = query_db("SELECT",DB_PREFIX."logs",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$WHAT,NULL,NULL,NULL,NULL);
	}
	else 
	{
		$GET = query_db("SELECT",DB_PREFIX."logs",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$WHAT,NULL,NULL,NULL,"DESC LIMIT 1");
	}
	
	// Explode into array
	$GET = explode(",", $GET);
	
	if (count($GET) - 1 < 1)
	{
		/* NO LOG */
		$RETURN = 0;
	}
	else
	{
		if ($NO_LIMIT != null && $ORDERBY == null)
		{
			/* NO LIMIT */
		}
		else
		{
			// There can be only one
			$GET = $GET[0];
			
			//$RETURN = $GET;
		}
		
		switch ($WHAT)
		{
			case 'datetime':
				// Checks whether the current datetime is not within 24 hours of the viewed advertisement datetime
				
				// Get current datetime
				$current_datetime = date("Y-m-d H:i:s");
				
				if ($GETDATETIME)
				{
					$GET = query_db("SELECT",DB_PREFIX."logs",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$WHAT,NULL,NULL,NULL,NULL);
				
					// Explode into array
					$GET = explode(",", $GET);
					
					$RETURN = $GET[0];
				}
				else 
				{
					if ($NO_LIMIT != null)
					{
						if ($ORDERBY != null)
						{
							$GET = query_db("SELECT",DB_PREFIX."logs",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$ORDERBY,NULL,NULL,NULL,NULL);
						}
						else
						{
							$GET = query_db("SELECT",DB_PREFIX."logs",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$WHAT,NULL,NULL,NULL,NULL);
						}
				
						// Explode into array
						$GET = explode(",", $GET);
						
						$RETURN = $GET;
					}
					else 
					{
						$seconds = strtotime($current_datetime) - strtotime($GET);
						$RETURN = $seconds;
					}
				}
			break;
			
			case 'guest_session':
				$GET = query_db("SELECT",DB_PREFIX."logs",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$WHAT,NULL,NULL,NULL,NULL);
				
				// Explode into array
				$GET = explode(",", $GET);
				
				$GET = $GET[0];
				
				$RETURN = $GET;
			break;
			
			case 'id':
				if ($ORDERBY != null && $LIMIT != null)
				{
					$GET = query_db("SELECT",DB_PREFIX."logs",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$ORDERBY,NULL,NULL,NULL,$LIMIT);
				}
				else if ($ORDERBY != null)
				{
					$GET = query_db("SELECT",DB_PREFIX."logs",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$ORDERBY,NULL,NULL,NULL,NULL);
				}
				else
				{
					$GET = query_db("SELECT",DB_PREFIX."logs",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$WHAT,NULL,NULL,NULL,NULL);
				}
				
				// Explode into array
				$GET = explode(",", $GET);
				
				if ($LID != null)
				{
					$GET = $GET[0];
				}
				
				$RETURN = $GET;
			break;
			
			case 'transaction_id':
				$GET = query_db("SELECT",DB_PREFIX."logs",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$WHAT,NULL,NULL,NULL,NULL);
				
				// Explode into array
				$GET = explode(",", $GET);
				
				if ($NO_LIMIT != null)
				{
					$RETURN = $GET;
				}
				else 
				{
					$RETURN = $GET[0];
				}	
				
			break;
			
			case 'clicks_credited':
				$GET = query_db("SELECT",DB_PREFIX."logs",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$WHAT,NULL,NULL,NULL,NULL);
				
				// Explode into array
				$GET = explode(",", $GET);
				
				if ($NO_LIMIT != null)
				{
					$RETURN = $GET;
				}
				else 
				{
					$RETURN = $GET[0];
				}	
				
			break;
			
			case 'amount_paid':
				$GET = query_db("SELECT",DB_PREFIX."logs",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$WHAT,NULL,NULL,NULL,NULL);
				
				// Explode into array
				$GET = explode(",", $GET);
				
				if ($NO_LIMIT != null)
				{
					$RETURN = $GET;
				}
				else 
				{
					$RETURN = $GET[0];
				}	
				
			break;
			
			case 'rrpackid':
				$GET = query_db("SELECT",DB_PREFIX."logs",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$WHAT,NULL,NULL,NULL,NULL);
				
				// Explode into array
				$GET = explode(",", $GET);
				
				if ($NO_LIMIT != null)
				{
					$RETURN = $GET;
				}
				else 
				{
					$RETURN = $GET[0];
				}	
				
			break;
			
			case 'pendingrrs':
				$GET = query_db("SELECT",DB_PREFIX."logs",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$WHAT,NULL,NULL,NULL,NULL);
				
				// Explode into array
				$GET = explode(",", $GET);
				
				if ($NO_LIMIT != null)
				{
					$RETURN = $GET;
				}
				else 
				{
					$RETURN = $GET[0];
				}	
				
			break;
			
			default:
				$GET = query_db("SELECT",DB_PREFIX."logs",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$WHAT,NULL,NULL,NULL,NULL);
				
				// Explode into array
				$GET = explode(",", $GET);
				
				$RETURN = $GET;
			break;
		}
	}
	
	// Return
	return $RETURN;
	//return $DB_WHERECLAUSE;
}

function secondsToHuman($seconds)
{
    $ret = '';
    $divs = array(86400, 3600, 60, 1);

    for ($d = 0; $d < 4; $d++)
    {
        $q = (int)($seconds / $divs[$d]);
        $r = $seconds % $divs[$d];
        $ret .= sprintf("%d%s", $q, substr('dhms', $d, 1)) . " ";
        $seconds = $r;
    }

    return $ret;
}

function d_h_m_s__string2($seconds)
{
    if ($seconds == 0) return '0s';

    $can_print = false; // to skip 0d, 0d0m ....
    $ret = '';
    $divs = array(86400, 3600, 60, 1);

    for ($d = 0; $d < 4; $d++)
    {
        $q = (int)($seconds / $divs[$d]);
        $r = $seconds % $divs[$d];
        if ($q != 0) $can_print = true;
        if ($can_print) $ret .= sprintf("%d%s", $q, substr('dhms', $d, 1));
        $seconds = $r;
    }

    return $ret;
}

function d_h_m_s__array($seconds)
{
    $ret = array();

    $divs = array(86400, 3600, 60, 1);

    for ($d = 0; $d < 4; $d++)
    {
        $q = $seconds / $divs[$d];
        $r = $seconds % $divs[$d];
        $ret[substr('dhms', $d, 1)] = $q;

        $seconds = $r;
    }

    return $ret;
}

/**
 * multi-purpose function to calculate the time elapsed between $start and optional $end
 * @param string|null $start the date string to start calculation
 * @param string|null $end the date string to end calculation
 * @param string $suffix the suffix string to include in the calculated string
 * @param string $format the format of the resulting date if limit is reached or no periods were found
 * @param string $separator the separator between periods to use when filter is not true
 * @param null|string $limit date string to stop calculations on and display the date if reached - ex: 1 month
 * @param bool|array $filter false to display all periods, true to display first period matching the minimum, or array of periods to display ['year', 'month']
 * @param int $minimum the minimum value needed to include a period
 * @return string
 */

function elapsedTimeString($start, $end = null, $limit = null, $filter = true, $suffix = 'ago', $format = 'Y-m-d H:i:s', $separator = ' ', $minimum = 1)
{
    $dates = (object) array(
        'start' => new DateTime($start ? : 'now'),
        'end' => new DateTime($end ? : 'now'),
        'intervals' => array('y' => 'year', 'm' => 'month', 'd' => 'day', 'h' => 'hour', 'i' => 'minute', 's' => 'second'),
        'periods' => array()
    );
    $elapsed = (object) array(
        'interval' => $dates->start->diff($dates->end),
        'unknown' => 'unknown'
    );
    if ($elapsed->interval->invert === 1) {
        return trim('0 seconds ' . $suffix);
    }
    if (false === empty($limit)) {
        $dates->limit = new DateTime($limit);
        if (date_create()->add($elapsed->interval) > $dates->limit) {
            return $dates->start->format($format) ? : $elapsed->unknown;
        }
    }
    if (true === is_array($filter)) {
        $dates->intervals = array_intersect($dates->intervals, $filter);
        $filter = false;
    }
    foreach ($dates->intervals as $period => $name) {
        $value = $elapsed->interval->$period;
        if ($value >= $minimum) {
            $dates->periods[] = vsprintf('%1$s %2$s%3$s', array($value, $name, ($value !== 1 ? 's' : '')));
            if (true === $filter) {
                break;
            }
        }
    }
    if (false === empty($dates->periods)) {
        return trim(vsprintf('%1$s %2$s', array(implode($separator, $dates->periods), $suffix)));
    }

    return $dates->start->format($format) ? : $elapsed->unknown;
}

function getRandomWord($len = 10) {
    $word = array_merge(range('a', 'z'), range('A', 'Z'));
    shuffle($word);
    return substr(implode($word), 0, $len);
}

function GetBotBy($WHAT,$ID)
{
	global $DB_PREFIX;
	// Set up variables
	$DB_WHERECLAUSE 		= "id,";
	$DB_WHERECLAUSEEQUALTO 	= " = '{$ID}',";
	
	// Do get
	$GET = query_db("SELECT",DB_PREFIX."users",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$WHAT,NULL,NULL,NULL,NULL);
	
	// Explode into array
	$GET = explode(",", $GET);
	
	// There can be only one
	$GET = $GET[0];
	
	// Return
	return $GET;
}

function GetLoggedSession()
{
	global $DB_PREFIX;
	
	if (isset($_COOKIE[''.COOKIENAME."loggedsession".'']))
	{
		$SESSION = $_COOKIE[''.COOKIENAME."loggedsession".''];
		// Session found;
		// Set up variables
		$DB_WHERECLAUSE 		= "logged_session,";
		$DB_WHERECLAUSEEQUALTO 	= " = '{$SESSION}',";
		
		// Do get
		$GET = query_db("SELECT",DB_PREFIX."users",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,"id","id",NULL,NULL,NULL,NULL);
		
		// Explode into array
		$GET = explode(",", $GET);
		
		// There can be only one
		$GET = $GET[0];
		
		if ($GET == null || $GET == "" || $GET == 0)
		{
			/* SESSION DOES NOT MATCH USER; EITHER TAMPERED OR NOT LOGGED CORRECTLY */
			$logged_session = "";
		}
		else 
		{
			// Set up variables
			$DB_WHERECLAUSE 		= "id,";
			$DB_WHERECLAUSEEQUALTO 	= " = '{$GET}',";
			
			// Do get
			$GET = query_db("SELECT",DB_PREFIX."users",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,"logged_session","logged_session",NULL,NULL,NULL,NULL);
			
			// Explode into array
			$GET = explode(",", $GET);
			
			// There can be only one
			$GET = $GET[0];
			$logged_session = $GET;
		}
	}
	else 
	{
		$logged_session = "";
	}
	
	return $logged_session;
}

function GetMemberships($WHAT = null, $SINGLE = false, $ID = null)
{
	global $DB_PREFIX;
	// Set up variables
	
	if ($ID != null)
	{
		$DB_WHERECLAUSE 		= "id,";
		$DB_WHERECLAUSEEQUALTO 	= " = '".$ID."',";
	}
	else 
	{
		$DB_WHERECLAUSE 		= "status,";
		$DB_WHERECLAUSEEQUALTO 	= " = 'active',";
	}
	
	// Do get
	$GET = query_db("SELECT",DB_PREFIX."memberships",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$WHAT,NULL,NULL,NULL,NULL);
	
	// Explode into array
	$GET = explode(",", $GET);
	
	if ($SINGLE)
	{
		// There can be only one
		$GET = $GET[0];
	}
	
	// Return
	return $GET;
}

function GetMembershipInfo($WHAT,$MEMBERSHIP,$WHEREWHAT = null,$WHERE = null)
{
	global $DB_PREFIX;
	// Set up variables
	if ($WHERE != null)
	{
		$DB_WHERECLAUSE 		= "{$WHEREWHAT},";
		$DB_WHERECLAUSEEQUALTO 	= " = '{$WHERE}',";
	}
	else
	{
		$DB_WHERECLAUSE 		= "id,";
		$DB_WHERECLAUSEEQUALTO 	= " = '{$MEMBERSHIP}',";
	}
	
	// Do get
	$GET = query_db("SELECT",DB_PREFIX."memberships",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$WHAT,NULL,NULL,NULL,NULL);
	
	// Explode into array
	$GET = explode(",", $GET);
	
	// There can be only one
	$GET = $GET[0];
	
	// Return
	return $GET;
}

function GetPackInfo($WHAT,$FORTYPE,$ID = null,$SINGLE = null)
{
	global $DB_PREFIX;
	// Set up variables
	if ($ID != null)
	{
		$DB_WHERECLAUSE 		= "id,";
		$DB_WHERECLAUSEEQUALTO 	= " = '{$ID}',";
	}
	else
	{
		$DB_WHERECLAUSE 		= "for_type,status,";
		$DB_WHERECLAUSEEQUALTO 	= " = '{$FORTYPE}', = 'active',";
	}
	
	// Do get
	$GET = query_db("SELECT",DB_PREFIX."clickpacks",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$WHAT,NULL,NULL,NULL,NULL);
	
	// Explode into array
	$GET = explode(",", $GET);
	
	if ($SINGLE != null)
	{
		// There can be only one
		$GET = $GET[0];
	}
		
	// Return
	return $GET;
}

function GetPHPFileName()
{
	return pathinfo(__FILE__, PATHINFO_FILENAME);
}

function GetRRPackInfo($WHAT,$ID = null,$SINGLE = null)
{
	global $DB_PREFIX;
	// Set up variables
	if ($ID != null)
	{
		$DB_WHERECLAUSE 		= "id,status,";
		$DB_WHERECLAUSEEQUALTO 	= " = '{$ID}', = 'active',";
	}
	
	// Do get
	$GET = query_db("SELECT",DB_PREFIX."rrpacks",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$WHAT,NULL,NULL,NULL,NULL);
	
	// Explode into array
	$GET = explode(",", $GET);
	
	if ($SINGLE != null)
	{
		// There can be only one
		$GET = $GET[0];
	}
		
	// Return
	return $GET;
}

function GetTypes($WHAT = null,$STATUS = null,$ORDERBY = null)
{
	global $DB_PREFIX;
	// Set up variables
	if ($STATUS != null && $STATUS == "any")
	{
		$DB_WHERECLAUSE 		= "status,";
		$DB_WHERECLAUSEEQUALTO 	= " != '',";
	}
	else 
	{
		$DB_WHERECLAUSE 		= "status,";
		$DB_WHERECLAUSEEQUALTO 	= " = 'active',";
	}
	
	// Do get
	if ($WHAT != null)
	{
		if ($ORDERBY != null)
		{
			$GET = query_db("SELECT",DB_PREFIX."types",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$ORDERBY,NULL,NULL,NULL,NULL);
		}
		else 
		{
			$GET = query_db("SELECT",DB_PREFIX."types",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$WHAT,NULL,NULL,NULL,NULL);
		}
	}
	else 
	{
		$GET = query_db("SELECT",DB_PREFIX."types",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,"clean_name","clean_name",NULL,NULL,NULL,NULL);
	}
	
	// Explode into array
	$GET = explode(",", $GET);
	
	// There can be only one
	//$GET = $GET[0];
	
	// Return
	return $GET;
}
function GetTypesInfo($CN,$WHAT,$ATYPE = null,$N = null)
{
	global $DB_PREFIX;
	// Set up variables
	if ($ATYPE != null)
	{
		$DB_WHERECLAUSE 		= "id,";
		$DB_WHERECLAUSEEQUALTO 	= " = '{$ATYPE}',";
	}
	else if ($N != null)
	{
		$DB_WHERECLAUSE 		= "name,";
		$DB_WHERECLAUSEEQUALTO 	= " = '{$N}',";
	}
	else
	{
		$DB_WHERECLAUSE 		= "clean_name,";
		$DB_WHERECLAUSEEQUALTO 	= " = '{$CN}',";
	}
	
	// Do get
	$GET = query_db("SELECT",DB_PREFIX."types",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$WHAT,NULL,NULL,NULL,NULL);
	
	// Explode into array
	$GET = explode(",", $GET);
	
	// There can be only one
	$GET = $GET[0];
	
	// Return
	return $GET;
}

function GetTypeIDFromCN($CLEANNAME)
{
	global $DB_PREFIX;
	// Set up variables
	$DB_WHERECLAUSE 		= "clean_name,";
	$DB_WHERECLAUSEEQUALTO 	= " = '{$CLEANNAME}',";
	
	// Do get
	$GET = query_db("SELECT",DB_PREFIX."types",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,"id","id",NULL,NULL,NULL,NULL);
	
	// Explode into array
	$GET = explode(",", $GET);
	
	// There can be only one
	$GET = $GET[0];
	
	// Return
	return $GET;
}

function GetUserClicks($UID,$TYPE,$WHAT)
{
	global $DB_PREFIX;
	$DB_WHERECLAUSE 		= "uid,type,";
	$DB_WHERECLAUSEEQUALTO 	= " = '{$UID}', = '{$TYPE}',";
	
	// Do get
	$GET = query_db("SELECT",DB_PREFIX."clicks",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$WHAT,NULL,NULL,NULL,NULL);
	
	// Explode into array
	$GET = explode(",", $GET);
	
	// There can be only one
	$GET = $GET[0];
	
	// Return
	return $GET;
}

function GetUsers($WHERE = null,$WHERE_WHAT = null,$WHAT,$SINGLE = null, $ORDERBY = null, $LIMIT = null)
{
	global $DB_PREFIX;
	if ($WHERE != null)
	{
		$DB_WHERECLAUSE 		= $WHERE.",";
		$DB_WHERECLAUSEEQUALTO 	= $WHERE_WHAT.",";
	}
	else
	{
		$DB_WHERECLAUSE 		= "";
		$DB_WHERECLAUSEEQUALTO 	= "";
	}
	
	// Do get
	if ($ORDERBY != null && $LIMIT != null)
	{
		$GET = query_db("SELECT",DB_PREFIX."users",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$ORDERBY,NULL,NULL,NULL,$LIMIT);
	}
	else 
	{
		$GET = query_db("SELECT",DB_PREFIX."users",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$WHAT,NULL,NULL,NULL,NULL);
	}
	
	// Explode into array
	$GET = explode(",", $GET);
	
	if ($SINGLE != null)
	{
		// There can be only one
		$GET = $GET[0];
	}
	
	// Return
	return $GET;
}

function GetUserLoggedInfo($LS,$WHAT)
{
	global $DB_PREFIX;
	$DB_WHERECLAUSE 		= "logged_session,";
	$DB_WHERECLAUSEEQUALTO 	= " = '{$LS}',";
	
	// Do get
	$GET = query_db("SELECT",DB_PREFIX."users",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$WHAT,NULL,NULL,NULL,NULL);
	
	// Explode into array
	$GET = explode(",", $GET);
	
	// There can be only one
	$GET = $GET[0];
	
	// Return
	return $GET;
}

function GetUserInfo($WHAT,$ID,$OTHER = NULL,$OTHER_EQUALTO = NULL)
{
	global $DB_PREFIX;
	if ($OTHER != NULL && $OTHER_EQUALTO != NULL)
	{
		$DB_WHERECLAUSE 		= "{$OTHER},";
		$DB_WHERECLAUSEEQUALTO 	= " = '{$OTHER_EQUALTO}',";
	}
	else
	{
		$DB_WHERECLAUSE 		= "id,";
		$DB_WHERECLAUSEEQUALTO 	= " = '{$ID}',";
	}
	
	// Do get
	$GET = query_db("SELECT",DB_PREFIX."users",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$WHAT,NULL,NULL,NULL,NULL);
	
	// Explode into array
	$GET = explode(",", $GET);
	
	// There can be only one
	$GET = $GET[0];
	
	// Return
	return $GET;
}

function GetUserLoggedLevelInfo($WHAT,$USER_EXP)
{
	global $DB_PREFIX;
	$DB_WHERECLAUSE 		= "";
	$DB_WHERECLAUSEEQUALTO 	= "";
	
	// Do get of all levels
	$GET = query_db("SELECT",DB_PREFIX."levels",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$WHAT,NULL,NULL,NULL,NULL);
	
	// Explode into array
	$GET = explode(",", $GET);
	
	if (count($GET) - 1 < 1)
	{
		/* NO LEVEL DATA */
		$GET = false;
	}
	else 
	{
		for ($i = 0; $i < count($GET) - 1; $i++)
		{
			// Get level data
			$ia = $i + 1;
			$DB_WHERECLAUSE 		= "id,";
			$DB_WHERECLAUSEEQUALTO 	= " = '{$ia}',";
			
			// -- Get the floor of the level
			$FLOOR = query_db("SELECT",DB_PREFIX."levels",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,"floor","id",NULL,NULL,NULL,NULL);
			
			// Explode into array
			$FLOOR = explode(",", $FLOOR);
			
			// There can be only one
			$FLOOR = $FLOOR[0];
			
			//----------------------------------------------------------------------
			
			// -- Get the ceiling of the level
			$CEIL = query_db("SELECT",DB_PREFIX."levels",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,"ceil","id",NULL,NULL,NULL,NULL);
			
			// Explode into array
			$CEIL = explode(",", $CEIL);
			
			// There can be only one
			$CEIL = $CEIL[0];
			
			//----------------------------------------------------------------------
			
			// Compare the user exp to the floor and ceiling
			if ($USER_EXP >= $FLOOR && $USER_EXP <= $CEIL)
			{
				// Found level
				// Get level info
				$DB_WHERECLAUSE 		= "id,";
				$DB_WHERECLAUSEEQUALTO 	= " = '{$ia}',";
				
				// -- Get the floor of the level
				$THE_INFO = query_db("SELECT",DB_PREFIX."levels",$DB_WHERECLAUSE,$DB_WHERECLAUSEEQUALTO,$WHAT,$WHAT,NULL,NULL,NULL,NULL);
				
				// Explode into array
				$THE_INFO = explode(",", $THE_INFO);
				
				// There can be only one
				$THE_INFO = $THE_INFO[0];
				break;
			}
			else
			{
				$THE_INFO = 0;
			}
		}
	}

	// Return
	return $THE_INFO;
}

function GetBetween($content,$start,$end)
{
    $r = explode($start, $content);
    if (isset($r[1])){
        $r = explode($end, $r[1]);
        return $r[0];
    }
    return '';
}


function get_string_between($string, $start, $end){
    $string = " ".$string;
    $ini = strpos($string,$start);
    if ($ini == 0) return "";
    $ini += strlen($start);   
    $len = strpos($string,$end,$ini) - $ini;
    return substr($string,$ini,$len);
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

function CallPluginFunctions($ABSPATH)
{
	/*
	******************************************************************
	**** CALL FUNCTIONS FROM PLUGINS *********************************
	******************************************************************
	PURPOSE: 	To be able to modularly load in functions that may come with
			    plugins. 
				
	REASON: 	You may think "why don't you load them with the public function
			    stuff that comes with the plugin file itself?". Well, this proved
				to be a hassle and something that ultimately didn't work due to a 
				complication of loading the $plugins class which caused a weird issue to happen. So instead, I made a workaround to load in the functions that are stored in the plugins core/php/functions folder if found.
			
	UPDATES:    - 2016-08-01 : The function was born!
	
	USAGE: 	    When you need to load the function, use this syntax:
				
				CallPluginFunctions("");
				if (function_exists("HelloWorld"))
				{
					HelloWorld();
				}
				
				NOTE: The "" in the CallPluginFunctions(). This is used to tell the system how deep the file that is where the function is being called is. EX. If the function call is 4 levels deep, you would put "../../../../" in the quotes (without these actual quotes).
				
				The "HelloWorld" part is the name of the function being called that is stored in the function named file in the functions folder of the plugin. You can name it however you want, but keep it clean like this.
				
				Putting the "function_exists" conditional is required for when the plugin is disabled. 
				
				If you decide you don't want the function calling, just put the function file in the "disabled" folder or delete it. Sometimes you may want to keep things for later :)
	*/
	// -- MAIN PLUGIN FUNCTION CALLING
	// plugins folder
	$ppath = $ABSPATH."plugins";

	// scan the $path
	$pps = scandir($ppath);
		
	if (count($pps) - 2 < 1)
	{
		//$ERROR_CODE = 1;
		//$ERROR = "No plugins are found.";
	}
	else 
	{
		// for each
		for ($ipps = 0; $ipps < count($pps); $ipps++) 
		{
			// If . or .. or disabled, don't display
			if ($pps[$ipps] === '.' or $pps[$ipps] === '..' or $pps[$ipps] === 'disabled') continue;
			
			// If it's a directory only
			if (is_dir($ppath . '/' . $pps[$ipps])) 
			{
				//echo "Plugin: " . $ps[$ips] . "<br />";
				// Check to see an core/php/functions folder exist
				if (file_exists($ppath."/".$pps[$ipps]."/assets/php/functions"))
				{
					// There are functions to load
					// Get each file in the folder
					$fpath = $ppath."/".$pps[$ipps]."/assets/php/functions/";
					$fs = scandir($fpath);
					if (count($pps) - 2 < 1)
					{
						//$ERROR_CODE = 1;
						//$ERROR = "No functions found.";
					}
					else 
					{
						// for each
						for ($ifs = 0; $ifs < count($fs); $ifs++) 
						{
							// If . or .. or disabled, don't display
							if ($fs[$ifs] === '.' or $fs[$ifs] === '..' or $fs[$ifs] === 'disabled') continue;
							
							if (is_file($fpath.$fs[$ifs]))
							{
								if ($fs[$ifs] != "MainFunctions.php")
								{
									//echo "Function in file: " . $fs[$ifs] . "<br />";
									// include the file
									include($fpath.$fs[$ifs]);
								}
							}
						}
					}
				}
			}
		}
	}

	// --------------------------------------------------------------------------
}

function SetBanHammer($OFFENSE_TYPE,$OFFENSE_TIME)
{
	global $logged_id;
	global $DB_PREFIX;
	/* 
	*****************************************************************
	**************** NO NEED TO EDIT BELOW THIS LINE ****************
	********** Unless you are adding a case to the switch ***********
	*****************************************************************
	*/
	
	if (strpos($OFFENSE_TYPE,":") != "")
	{
		$OFFENSE_TYPE_PARAMETERS = explode(":",$OFFENSE_TYPE);
		
		$OFFENSE_TYPE		 = $OFFENSE_TYPE_PARAMETERS[0];
		$REVIEW 			 = $OFFENSE_TYPE_PARAMETERS[1];
	}
	
	// Fourth Offense
	switch ($OFFENSE_TYPE)
	{
		case 'suspension':
			// Update the status
			query_db("UPDATE",$DB_PREFIX."users","id,"," = '{$logged_id}',",NULL,NULL,NULL,"status","suspended",NULL);
			
			// Update the ban_review_by
			$REVIEW = str_replace("reviewby", "", $REVIEW);
			query_db("UPDATE",$DB_PREFIX."users","id,"," = '{$logged_id}',",NULL,NULL,NULL,"ban_review_by",$REVIEW,NULL);
			
			// Update the ban_time
			query_db("UPDATE",$DB_PREFIX."users","id,"," = '{$logged_id}',",NULL,NULL,NULL,"ban_time",$OFFENSE_TIME,NULL);
		break;
		
		case 'permaban':
			// Update the status
			query_db("UPDATE",$DB_PREFIX."users","id,"," = '{$logged_id}',",NULL,NULL,NULL,"status","permaban",NULL);
			
			// Update the ban_review_by
			$REVIEW = str_replace("reviewby", "", $REVIEW);
			query_db("UPDATE",$DB_PREFIX."users","id,"," = '{$logged_id}',",NULL,NULL,NULL,"ban_review_by",$REVIEW,NULL);
			
			// Update the ban_time
			query_db("UPDATE",$DB_PREFIX."users","id,"," = '{$logged_id}',",NULL,NULL,NULL,"ban_time",$OFFENSE_TIME,NULL);
		break;
		
		case 'time':
			// Update the status
			query_db("UPDATE",$DB_PREFIX."users","id,"," = '{$logged_id}',",NULL,NULL,NULL,"status","tempban",NULL);
			
			// Update the ban_time
			query_db("UPDATE",$DB_PREFIX."users","id,"," = '{$logged_id}',",NULL,NULL,NULL,"ban_time",$OFFENSE_TIME,NULL);
		break;
	}
	
	/* 
	*****************************************************************
	**************** NO NEED TO EDIT ABOVE THIS LINE ****************
	********** Unless you are adding a case to the switch ***********
	*****************************************************************
	*/
}
?>