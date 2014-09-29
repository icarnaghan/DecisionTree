<?php
    require_once( "common.inc.php" );
    require_once( "config.php" );
    require_once( "controller.php");
    displayPageHeader( "Resources" );
?>
    <h3>About this Project</h3><br />
    
    <div class="well">
    	<h4>Background Information</h4>
    	<p>The Decision Point Creator is part of a Doctoral project aimed at creating an online system where faculty will be able to create and publish learning objects. The application will be rolled out in various stages. The first stage will be delivered as a final project for Dynamic Websites. Further versions will be develops over the next year. Anticipated release dates are displayed opposite.</p>
    </div>
    <div class="well">
    	<h4>Things to do</h4><br />
    	<h5>High Priority</h5>
    	<ul>
    		<li>Sanitization of form input</li>
            <li>Catch badly formed URLs / prevent guessing at tree ID's - rework how PHP queries are sent via URLS's</li>
    		<li>More comprehensive validation</li>
    		<li>Code refactoring - reduce re-use of code for example validation</li>
    		<li>Better navigation within the trees</li>
    		<li>Single deletion of branches - currently only deletion of entire trees supported</li>
    		<li>Better user interface for entering decisions and new trees</li>
    	</ul>
    	<h5>Broader Goals</h5>
    		<ul>
	    		<li>Integration of jQuery drag and drop for creation of trees / decisions</li>
	    		<li>Drupal Integration - creation of a contrib module for Drupal 7/8</li>
	    		<li>Integration of embedded media and more resources available to the user to increase interactivity</li>
    		</ul>
    </div>

<?php
    displayPageFooter();
?>