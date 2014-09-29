<?php

function displayPageHeader( $pageTitle ) {
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Decision Point Simulation Creator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/jquery.rating.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

  </head>

  <body>

    <div class="container">
    <div class="row"><!-- start header -->
      <div class="span5 logo">
      <a href="index.html">
        <h1>Decision Point Simulation Creator</h1>
      </a>
      </div>
      <div class="span7">
        <div class="row" style="padding-top:20px;">
          <div class="links pull-right">
            <a href="index.html">Home</a> |
            <a href="about.php">About the Project</a> |
            <a href="resources.php">Resources</a><br/>
            <form class="navbar-search pull-right" action="">
                <input type="text" placeholder="Search Contributed Simulations" style="margin-top:5px;">
                <button class="btn btn-primary btn-small search_btn" type="submit" style="margin-bottom:5px;">Go</button>
              </form>
          </div>
          
        </div>
      </div>
    </div><!-- end header -->
    
    <div class="row"><!-- start nav -->
      <div class="span12">
        <div class="navbar">
          <div class="navbar-inner">
            <div class="container" style="width: auto;">
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>

              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </a>
            <div class="nav-collapse">
              <ul class="nav">
                <li class="dropdown">
                <a href="editor.php" >Decision Point Editor <b class="caret"></b></a>
              </li>
              <ul class="nav">
                <li class="dropdown">
                <a href="controller.php?NewTree" >Add Simulations / Tree <b class="caret"></b></a>
              </li>
              <ul class="nav">
                <li class="dropdown">
                <a href="help.php" >Instructions and Help <b class="caret"></b></a>
              </li>
              <ul class="nav">
                <li class="dropdown">
                <a href="resources.php" >Supplemental Tools and Resources <b class="caret"></b></a>
              </li>
              <ul class="nav pull-right">
                        
              </ul>
            </div><!-- /.nav-collapse -->
            </div>
          </div><!-- /navbar-inner -->
        </div><!-- /navbar -->
      </div>
    </div><!-- end nav -->  <div class="row">
    <div class="span3" style="height:900px;">
    <!-- start sidebar -->
    <h3>Administration Options</span></h3><br />

    <div class="span3 menu_list">
      <ul class="nav">
        <li><a href="editor.php">View list of trees</a></li>
        <li><a href="controller.php?NewTree">Add a new tree</a></li>
        <li><a href="help.php">Help &amp; Support</a></li>
        <li><a href="resources.php">Available Resources</a></li>
      </ul>
    </div><!-- end sidebar -->    </div>

<div class="span9">
    <?php
    }

function displayPageFooter() {
?>
</div></div>
  <footer>
  <hr />
  <div class="row well no_margin_left">

  <div class="span9">
      <p>This version of the Decision Point Creator was developed for IDIA 618 - Dynamic Websites, Professor Bridget Blodgett</p>
    <p><a href="#">Home</a> | <a href="about.php">About the Project</a> | <a href="resources.php">Resources</a> | <a href="help.php">Help &amp; Support</a></p>
</footer>

</div> <!-- /container -->

</body>
</html>

<?php
}
?>
