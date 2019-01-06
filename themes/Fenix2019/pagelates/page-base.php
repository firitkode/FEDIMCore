<?php
// Load the nav
include("themes/".$THEME_NAME."/nav.php");

// Load the header
include("themes/".$THEME_NAME."/pageheader.php");
?>

<div class="main">
    <?php
    // No errors - do page load
    // Determine if a page is trying to be loaded
    if ($PAGE != "")
    {
        /* -- BEGIN PAGE LOADING -- */
        if ($Parent == "")
        {
            $Parent = $PageString;
        }

        PageLoad($Parent,$ChildNode,$PageType);
        /* -- END PAGE LOADING -- */
    }
    else
    {
        if ($FRONTPAGE_TYPE == "DB")
        {
            PageLoad(FRONTPAGE_DB,null,"DB");
        }
        else if ($FRONTPAGE_TYPE == "FILE")
        {
            PageLoad(FRONTPAGE_FILE,null,"FILE");
        }
    }
    ?>
</div>

<?php
// Load the footer
include("themes/".$THEME_NAME."/pagefooter.php");
?>
