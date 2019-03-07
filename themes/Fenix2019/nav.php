<nav class="navbar navbar-expand-md fixed-top navbar-transparent" color-on-scroll="200">
    <div class="container">
        <div class="navbar-translate">
            <button class="navbar-toggler navbar-toggler-right navbar-burger" type="button" data-toggle="collapse" data-target="#navbarToggler" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-bar"></span>
                <span class="navbar-toggler-bar"></span>
                <span class="navbar-toggler-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo ABSPATH;?>"><?php echo GetSettings("site_name");?></a>
        </div>

        <div class="collapse navbar-collapse" id="navbarToggler">
            <ul class="navbar-nav ml-auto">
                <?php
                // -- Load the menu
                // First we need to check what menu ID we are using for the header
                // DEP'd : $HeaderMenuID = GetSettings("header_menu");

                // Version 2.0.6 - Changed get location menu id
                $HeaderMenuID = 1;

                // Now pull all the menu items from database for that menu
                $HeaderMenuItems = GetNavigationItems($HeaderMenuID);

                // Check if the menu has items
                if (count($HeaderMenuItems) > 1)
                {
                    // Display menu items
                    $ItemContent = "";
                    $HMICount = 1;
                    foreach ($HeaderMenuItems as $Item)
                    {
                        if ($HMICount == count($HeaderMenuItems))
                        {
                            break;
                        }
                        else
                        {
                            // Get the Item details
                            $HeaderMenu_ItemName = GetNavigationItemDetails($Item,"itemname");
                            $HeaderMenu_ItemURL = GetNavigationItemDetails($Item,"itemurl");
                            $HeaderMenu_ItemTarget = GetNavigationItemDetails($Item,"itemtarget");
                            $HeaderMenu_ItemClass = GetNavigationItemDetails($Item,"itemclass");
                            $HeaderMenu_ItemType = GetNavigationItemDetails($Item,"itemtype");

                            // parse ItemURL
                            $HeaderMenu_ItemURL = str_replace("<home>", ABSPATH, $HeaderMenu_ItemURL);

                            // determine type and do following
                            switch ($HeaderMenu_ItemType)
                            {
                                case 'inside';
                                    $FULLHeaderMenu_ItemURL = ABSPATH . $HeaderMenu_ItemURL;
                                break;

                                case 'outside':
                                    $FULLHeaderMenu_ItemURL = $HeaderMenu_ItemURL;
                                break;

                                default:
                                    $FULLHeaderMenu_ItemURL = $HeaderMenu_ItemURL;
                                break;
                            }

                            // Check for multi
                            if ($HeaderMenu_ItemType == "multi")
                            {
                                // Function to retrieve the multi inside items of the ItemID
                                $ItemContent .=
                                "
                                <li class=\"nav-item dropdown\">
                                    <a class=\"nav-link dropdown-toggle\" href=\"#\" id=\"navbarDropdown\" role=\"button\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">
                                      {$HeaderMenu_ItemName}
                                    </a>
                                    <div class=\"dropdown-menu\" aria-labelledby=\"navbarDropdown\">
                                      ";

                                      // Make list of all Multi Items of ItemID
                                      $MultiItems = GetNavigationItemMultiItems($Item);

                                      // Check for items
                                      if (count($MultiItems) > 0)
                                      {
                                          // Items found; display
                                          $MICount = 1;
                                          foreach ($MultiItems as $MItem)
                                          {
                                              if ($MICount == count($MultiItems))
                                              {
                                                  break;
                                              }
                                              else
                                              {
                                                  $HeaderMenuMulti_ItemName = GetNavigationItemMultiItemDetails($MItem,"itemname");
                                                  $HeaderMenuMulti_ItemURL = GetNavigationItemMultiItemDetails($MItem,"itemurl");
                                                  $HeaderMenuMulti_ItemTarget = GetNavigationItemMultiItemDetails($MItem,"itemtarget");
                                                  $HeaderMenuMulti_ItemClass = GetNavigationItemMultiItemDetails($MItem,"itemclass");
                                                  $HeaderMenuMulti_ItemType = GetNavigationItemMultiItemDetails($MItem,"itemtype");

                                                  // Plan for divider or header
                                                  if ($HeaderMenuMulti_ItemName == "[divider]")
                                                  {
                                                      $ItemContent .= "<div class=\"dropdown-divider\"></div>";
                                                  }
                                                  else if ($HeaderMenuMulti_ItemName == "[header]")
                                                  {
                                                      $ItemContent .= "<h6 class=\"dropdown-header\">{$HeaderMenuMulti_ItemURL}</h6>";
                                                  }
                                                  else
                                                  {
                                                      // Fix URL
                                                      $FULLHeaderMenuMulti_ItemURL = ABSPATH . $HeaderMenuMulti_ItemURL;

                                                      $ItemContent .= "<a class=\"dropdown-item\" href=\"{$FULLHeaderMenuMulti_ItemURL}\" target=\"{$HeaderMenuMulti_ItemTarget}\">{$HeaderMenuMulti_ItemName}</a>";
                                                  }

                                                  $MICount++;
                                              }
                                          }
                                      }
                                      else
                                      {
                                          // No items; shell
                                          $ItemContent .= "<a class=\"dropdown-item\" href=\"#\">No Items</a>";
                                      }

                                      $ItemContent .=
                                      "
                                    </div>
                                </li>
                                ";
                            }
                            else
                            {
                                // Version 2.0.6 - Fix for blanks in nav
                                if (!empty($HeaderMenu_ItemType))
                                {
                                    // Display the item
                                    $ItemContent .= "
                                        <li class=\"nav-item\">
                                            <a href=\"{$FULLHeaderMenu_ItemURL}\" class=\"nav-link\" target=\"{$HeaderMenu_ItemTarget}\"><i class=\"{$HeaderMenu_ItemClass}\"></i>{$HeaderMenu_ItemName}</a>
                                        </li>
                                    ";
                                }
                            }

                            $HMICount++;
                        }
                    }

                    echo $ItemContent;
                }
                else
                {
                    // No menu items
                    ?>
                    <li class="nav-item">
                        <a disabled="disabled" class="nav-link"><i class="fas fa-times"></i> Please login to the Admin Dashboard and add an item to this menu</a>
                    </li>
                    <?php
                }
                // ----------------------------------------------------------------------------------------------------
                ?>
            </ul>

            <?php
            // This can be a button assigned from the menu
            // <a href="https://" target="_blank" class="btn btn-danger btn-round">Download Today!</a>
            ?>
        </div>
    </div>
</nav>
