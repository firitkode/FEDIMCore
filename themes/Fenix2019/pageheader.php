<?php
if ($PAGE != "")
{
    ?>
    <div class="page-header" data-parallax="true" style="background-image: url('<?php echo ABSPATH;?><?php echo FrameworkLocation;?>assets/img/daniel-olahh.jpg');">
        <div class="filter"></div>
            <div class="container">
                <div class="motto text-center">
                    <h1><?php echo GetPageInfo($PAGE,"title");?></h1>
                    <h3><?php echo GetPageInfo($PAGE,"subtitle");?></h3>
                    <br />
                    <!--<a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" class="btn btn-outline-neutral btn-round"><i class="fa fa-play"></i>Watch video</a>
                    <button type="button" class="btn btn-outline-neutral btn-round">Download</button>-->
                </div>
            </div>
        </div>
    </div>
    <?php
}
else
{
    ?>
    <div class="page-header section-dark" style="background-image: url('<?php echo ABSPATH;?><?php echo FrameworkLocation;?>assets/img/antoine-barres.jpg')">
        <div class="filter"></div>
        <div class="content-center">
            <div class="container">
                <div class="title-brand">
                    <h1 class="presentation-title">FEDIM Core</h1>
                    <div class="fog-low">
                        <img src="<?php echo ABSPATH;?><?php echo FrameworkLocation;?>assets/img/fog-low.png" alt="">
                    </div>

                    <div class="fog-low right">
                        <img src="<?php echo ABSPATH;?><?php echo FrameworkLocation;?>assets/img/fog-low.png" alt="">
                    </div>
                </div>

                <h2 class="presentation-subtitle text-center">A content management system (CMS) designed to be one-of-a-kind. Stands for Fantastic Engine Designed In Magic</h2>
            </div>
        </div>
        <div class="moving-clouds" style="background-image: url('<?php echo ABSPATH;?><?php echo FrameworkLocation;?>assets/img/clouds.png'); ">

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
