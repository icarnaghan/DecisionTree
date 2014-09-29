<?php

    require_once( "common.inc.php" );
    require_once( "config.php" );


	if (isset($_POST["NewTree"])) {
		NewTreeForm();
	}
	if (isset($_POST["SaveTree"])) {
		SaveTree();
	}
	if (isset($_POST["NewDecision"])) {
		NewDecision();
	}
	if(isset($_POST["SaveDecision"])) {
		SaveDecision();
	}
	if(isset($_GET["NewTree"])) {
		NewTreeForm();
	}
	if(isset($_GET["DeleteTree"])) {
		DeleteTree($_GET["DeleteTree"]);
	}
	if(isset($_POST["DeleteTreeConfirmed"])) {
		DeleteTreeConfirmed();
	}

	function DbConnect() {
 		$con = mysql_connect('localhost', DB_USERNAME, DB_PASSWORD);
 		if(!$con){
  			trigger_error("Problem connecting to server");
 		}	
 		$db =  mysql_select_db(DB_NAME, $con);
  		if(!$db){
   			trigger_error("Problem selecting database");
 		}	
	return $con;
	}

	function DbDisconnect($con) {
		$discdb = mysql_close($con);
  		if(!$discdb){
   			trigger_error("Problem disconnecting database");
 		}	
	}

	function UpdateTreeForm($ParentId, $DecisionId, $LevelId) {
		$con = DbConnect();

		$tree = mysql_query("
			SELECT * 
			FROM tree 
			WHERE 
				parent_id = " . mysql_real_escape_string($ParentId) . " 
			AND
				decision_id = " . mysql_real_escape_string($DecisionId) . "
			AND
				level_id = " . mysql_real_escape_string($LevelId));

		while ($row = mysql_fetch_array($tree)) {
			$parent_id = $row['parent_id'];
			$decision_id = $row['decision_id'];
			$level_id = $row['level_id'];
			$name = $row['name'];
			$description = $row['description'];
		}
		?>
		<h3>Decision Content</h3>
		<br />
		<form method="post" action="controller.php">
			<input type="hidden" name="parent_id" value= "<?php echo $parent_id ?>">
			<input type="hidden" name="decision_id" value= "<?php echo $decision_id ?>">
			<input type="hidden" name="level_id" value= "<?php echo $level_id ?>">
			<div class="well">
			<label for="name">Name: </label>
			<input name = "name" id="name" value="<?php echo $name ?>" class="span8" /><br />
			<br />
			<label for="description">Description: </label>
			<textarea rows="6" cols="120" name="description" class="span8"><?php echo $description ?></textarea><br />
			</div>
			<br />
			<div class="well">
			<label for="tree_name">Decisions: </label><br />
			<?php DisplayBranches($decision_id, $level_id); ?>
		</div>
			<input type="submit" value="Update Tree" name="SaveTree" class="btn btn-primary" />
			<input type="submit" value="Add Decision" name="NewDecision" class="btn btn-success" />
			<a href="editor.php">Cancel</a>
		</form>
		<?php 
		displayPageFooter();
	}

	function NewTreeForm() {
		displayPageHeader( "Create a New Decision Tree" );
		?>
		<h3>Create New Decision Tree</h3>
		<br />
		<form method="post" action="controller.php" class="well">
			<label for="name">Name: </label>
			<input name = "name" id="name" class="span8" /><br />
			<br />
			<label for="description">Description: </label>
			<textarea rows="6" cols="60" name="description" class="span8"></textarea><br />
			<br />
			<input type="submit" value="Add Tree" name="SaveTree" class="btn btn-primary" />
			<a href="editor.php">Cancel</a>
		</form>
		<?php
    	displayPageFooter();
	}

	function DisplayBranches($decision_id, $level_id) {
		$level_id ++; // Need to increment to get the child level branches
		$con = DbConnect();
		mysql_select_db("decision_tree", $con);
		$trees = mysql_query("SELECT * FROM tree WHERE parent_id = $decision_id AND level_id = $level_id");
		while($row = mysql_fetch_array($trees)) { ?>
			<a href="view_tree.php?parent_id=<?php echo $row['parent_id'] ?>&amp;decision_id=<?php echo $row['decision_id'] ?>&amp;level_id=<?php echo $row['level_id'] ?>"><?php echo $row['name'] ?></a><br />
		<br />
		<?php
		}
	}

	function SaveTree() {
		// Need to implement - Check max ID of trees and then add new ID.
		// Format of tree will contain integer ID, branches will contain decimals based on tree ID
		displayPageHeader( "Save Decision Tree" );
		if (isset($_POST['parent_id']) and isset($_POST['decision_id']) and isset($_POST['level_id'])) {
			$validation_error = 0;
			echo"<h3>Add new decision tree</h3><br />";
			if (empty($_POST['name'])) {
				echo "You must enter a decision name to proceed. Please go back and complete the form correctly.<br /><br />";
				$validation_error=1;

			}
			if (empty($_POST['description'])) {
				echo "You must enter a decision description to proceed. Please go back and complete the form correctly.";
				$validation_error=1;
			}
			if ($validation_error==1) {
				return;
			}
			$con = DbConnect();

			mysql_select_db("decision_tree", $con);

			$sql="UPDATE tree SET name='$_POST[name]', description='$_POST[description]'
			WHERE 
				parent_id = " . $_POST['parent_id'] . " 
			AND
				decision_id = " . $_POST['decision_id'] . "
			AND
				level_id = " . $_POST['level_id'];

			if (!mysql_query($sql,$con)) {
				die('Error: ' . mysql_error());
			}
			?>
			<h3>Decision Updated</h3><br />
			<div class="well">
			<p>You're decision has been updated!</p>
			</div>
			<p><a href='editor.php'>View All Available Decision Trees</a></p>
			<?php
			mysql_close($con);
			displayPageFooter();
		}
		else {
			$validation_error=0;
			echo"<h3>Add new decision tree</h3><br />";
			if (empty($_POST['name'])) {
				echo "You must enter a decision name to proceed. Please go back and complete the form correctly.<br /><br />";
				$validation_error=1;

			}
			if (empty($_POST['description'])) {
				echo "You must enter a decision description to proceed. Please go back and complete the form correctly.";
				$validation_error=1;
			}
			if ($validation_error==1) {
				return;
			}
			$con = DbConnect();
			
			mysql_select_db("decision_tree", $con);

			// Find largest ID in database and create new parent ID
			$tree = mysql_query("SELECT IFNULL(MAX(decision_id),0) as decision_id FROM tree");
			$row = mysql_fetch_array($tree);

			$decision_id = $row['decision_id'];
			$new_decision_id = ++$decision_id;

			// Insert new record.  Note new trees will always have level and parent IDs of 0
			$sql="INSERT INTO tree (parent_id, decision_id, level_id, name, description)
			VALUES
			(0, $new_decision_id, 0, '$_POST[name]','$_POST[description]')";

			if (!mysql_query($sql,$con)) {
				die('Error: ' . mysql_error());
			}
			?>
			<h3>Tree Added</h3><br />
			<div class="well">
			<p>You're new tree has been added!</p>
			</div>
			<p><a href='editor.php'>View All Available Decision Trees</a></p>
			<?php
			mysql_close($con);
		}
	}

	function UpdateBranch($tree_id, $branch_id) {
		// Need to implement - Check current level based on ID and Tree
	}

	function NewDecision() {
		// Need to implement - Add new branches using the format x.x, x.x.x, x.x.x.x
		// Example Tree ID 1, Branches level 1 1.1, 1.2, Branches Level 2 1.1.1, 1.1.2 ...
		if (isset($_POST['parent_id']) and isset($_POST['decision_id']) and isset($_POST['level_id'])) {

			$parent_id = $_POST["parent_id"];
			$decision_id = $_POST["decision_id"];
			$new_level_id = $_POST["level_id"];
			++$new_level_id; // Increment level ID of posted decision to update to current level

			$con = DbConnect();
			mysql_select_db("decision_tree", $con);

			// Find largest ID in database and create new decision ID
			$tree = mysql_query("SELECT MAX(decision_id) FROM tree");
			$row = mysql_fetch_array($tree);

			$new_decision_id = $row['MAX(decision_id)'];
			$new_decision_id++;	

			displayPageHeader( "Create a New Decision Tree" );
			?>
			<h3>Create New Decision</h3>
			<br />
			<form method="post" action="controller.php" class="well">
				<input type="hidden" name="parent_id" value= "<?php echo $decision_id ?>">
				<input type="hidden" name="decision_id" value= "<?php echo $new_decision_id ?>">
				<input type="hidden" name="level_id" value= "<?php echo $new_level_id ?>">
				<label for="name">Name: </label><br />
				<input name = "name" id="name" class="span8" /><br />
				<br />
				<label for="description">Description: </label><br />
				<textarea rows="6" name="description" class="span8"></textarea><br />
				<br />
				<input type="submit" value="Add Decision" name="SaveDecision" class="btn btn-success" />
				<a href="editor.php">Cancel</a>
			</form>
			<?php
			displayPageFooter();
		}
	}

	function SaveDecision() {
		displayPageHeader( "Add Decision" );
			
		$validation_error = 0;
		echo"<h3>Add new decision tree</h3><br />";
		if (empty($_POST['name'])) {
			echo "You must enter a decision name to proceed. Please go back and complete the form correctly.<br /><br />";
			$validation_error=1;

		}
		if (empty($_POST['description'])) {
			echo "You must enter a decision description to proceed. Please go back and complete the form correctly.";
			$validation_error=1;
		}
		if ($validation_error==1) {
			return;
		}

		$con = DbConnect();
			
		mysql_select_db("decision_tree", $con);

		$sql="INSERT INTO tree (parent_id, decision_id, level_id, name, description)
		VALUES
		('$_POST[parent_id]','$_POST[decision_id]','$_POST[level_id]','$_POST[name]','$_POST[description]')";

		if (!mysql_query($sql,$con)) {
			die('Error: ' . mysql_error());
		}
		?>
		<h3>Decision Added</h3><br />
		<div class="well">
		<p>You're new decision has been added!</p>
		</div>
		<p><a href='editor.php'>View All Available Decision Trees</a></p>
		<?php
		displayPageFooter();
		mysql_close($con);
	}

	function DeleteTree($tree_id) {
		displayPageHeader( "Save Decision Tree" );
		$con = DbConnect();
		mysql_select_db("decision_tree", $con);

		$tree = mysql_query("
			SELECT * 
			FROM tree 
			WHERE 
				decision_id = " . $tree_id);

		while ($row = mysql_fetch_array($tree)) {
			$name = $row['name'];
			$description = $row['description'];
		}

		echo"<h3>Delete Tree and Decisions</h2>";
		echo "Are you sure you want to delete this tree:<br /><br />";
		?>
		<div class="well">
			<?php 
			echo "<p><strong>$name</strong></p>";
			echo "<p>$description</p>";
			echo "<p>&nbsp</p>";
			echo "<p><strong>All decisions / branches within this tree will also be deleted</p>";
			?>
		</div>
		<form method="post" action="controller.php" class="well">
			<input type="hidden" name="tree_id" value= "<?php echo $tree_id ?>">
			<input type="submit" value="Confirm Deletion of Tree and Decisions" name="DeleteTreeConfirmed" id="DeleteTreeConfirmed" class="btn btn-danger">
		</form>
		<?php
		displayPageFooter();
	}

	function DeleteTreeConfirmed () {
		displayPageHeader( "Delete Decision Tree" );
		?>
		<h3>Deleting Decision Tree and Branches</h2><br />
		<div class="well">
		<?php
			$tree_id = $_POST["tree_id"];

			$con = DbConnect();
			mysql_select_db("decision_tree", $con);

			mysql_query("DELETE FROM tree WHERE parent_id= " . $tree_id);
			echo "Deleting Decisions . . . Complete<br /><br />";

			mysql_query("DELETE FROM tree WHERE decision_id= " . $tree_id);
			echo "Deleting Root Tree . . . Complete";
		?>
		</div>
		<p><a href="editor.php">Return to list of Decision Trees</a></p>
		<?php
		mysql_close($con);
		displayPageFooter();
	}
?>