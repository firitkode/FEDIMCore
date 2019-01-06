<?php
if ($PAGE != "")
{
    // Version 2.0.6 - Check for using header
    if (CheckPageInDB($PageString))
    {
        // DB Page
        if (GetPageInfo($ChildNode,"Use_Header",$Parent) == "yes")
        {
            ?>
            <div class="page-header" data-parallax="true" style="background-image: url('<?php echo ABSPATH;?>themes/<?php echo $THEME_NAME;?>/img/<?php echo GetPageInfo($ChildNode,'Header_Image',$Parent);?>');">
                <div class="filter"></div>
                    <div class="container">
                        <div class="motto text-center">
                            <h1>
                              <?php
                              echo GetPageInfo($ChildNode,"title",$Parent);
                              ?>
                            </h1>
                            <h3>
                              <?php
                                echo GetPageInfo($ChildNode,"PageDesc",$Parent);
                              ?>
                            </h3>
                            <br />
                            <!--<a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="btn btn-outline-neutral btn-round"><i class="fa fa-play"></i>Watch video</a>
                            <button type="button" class="btn btn-outline-neutral btn-round">Download</button>-->
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    else
    {
        // File Page
        if (PullFileInfo($PageString,"Use_Header"))
        {
            ?>
            <div class="page-header" data-parallax="true" style="background-image: url('<?php echo ABSPATH;?>themes/<?php echo $THEME_NAME;?>/img/<?php echo PullFileInfo($PageString,'Header_Image');?>');">
                <div class="filter"></div>
                    <div class="container">
                        <div class="motto text-center">
                            <h1>
                              <?php
                              // Pull title from the .php of the PageString
                              echo PullFileInfo($PageString,"PageName");
                              ?>
                            </h1>
                            <h3>
                              <?php
                              // Pull title from the .php of the PageString
                              echo PullFileInfo($PageString,"PageDesc");
                              ?>
                            </h3>
                            <br />
                            <!--<a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="btn btn-outline-neutral btn-round"><i class="fa fa-play"></i>Watch video</a>
                            <button type="button" class="btn btn-outline-neutral btn-round">Download</button>-->
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}
else if ($PAGE == "login")
{
    // login page
}
else
{
    ?>
    <div class="page-header section-dark" style="background-image: url('<?php echo ABSPATH;?>themes/<?php echo $THEME_NAME;?>/img/antoine-barres.jpg')">
        <div class="filter"></div>
        <div class="content-center">
            <div class="container">
                <div class="title-brand">
                    <h1 class="presentation-title"><?php echo GetSettings("site_name");?></h1>
                    <div class="fog-low">
                        <img src="<?php echo ABSPATH;?>themes/<?php echo $THEME_NAME;?>/img/fog-low.png" alt="">
                    </div>

                    <div class="fog-low right">
                        <img src="<?php echo ABSPATH;?>themes/<?php echo $THEME_NAME;?>/img/fog-low.png" alt="">
                    </div>
                </div>

                <h2 class="presentation-subtitle text-center"><?php echo GetSettings("site_slogan");?></h2>
            </div>
        </div>
        <div class="moving-clouds" style="background-image: url('<?php echo ABSPATH;?>themes/<?php echo $THEME_NAME;?>/img/clouds.png'); ">

        </div>
        <!--<h6 class="category category-absolute">Designed and coded by
        <a href="https://www.creative-tim.com" target="_blank">
        <img src="assets/img/creative-tim-white-slim2.png" class="creative-tim-logo">
        </a>
        </h6>-->
    </div>
    <?php
}
?>
