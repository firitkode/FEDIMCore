<?php
global $ErrorType;
global $ErrorMessage;
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
    <!--<div class="notfound-social">
      <a href="#"><i class="fa fa-facebook"></i></a>
      <a href="#"><i class="fa fa-twitter"></i></a>
      <a href="#"><i class="fa fa-pinterest"></i></a>
      <a href="#"><i class="fa fa-google-plus"></i></a>
    </div>
  -->
    <a href="<?php echo ABSPATH;?>">Back To Homepage</a>
  </div>
</div>
