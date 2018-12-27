<?php
global $ErrorType;
global $ErrorMessage;
global $MSet;
?>

<div id="notfound">
  <div class="notfound-bg"></div>
  <div class="notfound">
    <div class="notfound-<?php echo $ErrorType;?>">
      <h1><?php echo $ErrorType;?> Error</h1>
    </div>
    <h2><?php echo $ErrorMessage;?></h2>
    <!--<form class="notfound-search">
      <input type="text" placeholder="Search...">
      <button type="button">Search</button>
    </form>
  -->
    <?php
    if ($MSet)
    {
        ?>
        <div class="notfound-social">
          <?php
          echo (FACEBOOK_HANDLE != "") ? "<a href=\"https://www.facebook.com/".FACEBOOK_HANDLE."\" target=\"_blank\"><i class=\"fa fa-facebook\"></i></a>"  : "" ;
          echo (GOOGLEPLUS_HANDLE != "") ? "<a href=\"https://plus.google.com/u/0/".GOOGLEPLUS_HANDLE."\" target=\"_blank\"><i class=\"fa fa-google-plus\"></i></a>"  : "" ;
          echo (PINTEREST_HANDLE != "") ? "<a href=\"https://www.pinterest.com/".PINTEREST_HANDLE."\" target=\"_blank\"><i class=\"fa fa-pinterest\"></i></a>"  : "" ;
          echo (TWITTER_HANDLE != "") ? "<a href=\"https://www.twitter.com/".TWITTER_HANDLE."\" target=\"_blank\"><i class=\"fa fa-twitter\"></i></a>"  : "" ;
          ?>
        </div>
        <?php
    }
    ?>

    <?php
    if (!$MSet)
    {
        ?>
        <a href="<?php echo ABSPATH;?>">Back To Homepage</a>
        <?php
    }
    ?>
  </div>
</div>
