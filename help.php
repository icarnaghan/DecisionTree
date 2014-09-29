<?php
    require_once( "common.inc.php" );
    require_once( "config.php" );
    require_once( "controller.php");
    displayPageHeader( "Resources" );
?>
    <h3>Help / Support</h3><br />
    
    <div class="well">
    	<h4>Create a new decision tree</h4>
    	<p>Visit the <a href="controller.php?NewTree">Add A New Tree</a> page and give your tree a name and description. Once a tree has been added you will be able to return and begin adding new levels of decisions to it.</p>
    </div>
    <div class="well">
    	<h4>Manage and create decisions for your tree</h4>
    	<p>Visit the <a href="editor.php">Decision Tree Editor</a> page to see the list of available added trees.  Here you will be able to select the tree you wish to add new decisions to.  Each decision consists of a decision name <strong>(decision)</strong> and a description <strong>(outcome of the chosen decision)</strong>.  New decisions are added by selecting the add decision button within the current level of the tree.</p>
    	<p>Once decisions have been added, you will see them displayed in each level of the tree you visit.  Decisions as well as root trees can be edited by simply clicking on their link name and updating the form provided.</p>
    </div>
    <div class="well">
    	<h4>Deleting a Decision Tree</h4>
    	<p>In order to delete a tree, please visit the <a href="editor.php">Decision Tree Editor</a>.  In the table you will see a delete option beside each tree listed.  Please be careful when deleting a tree as all subsequent decisions belonging to that tree will also be purged.</p>
    </div>

<?php
    displayPageFooter();
?>