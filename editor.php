<?php
    require_once( "common.inc.php" );
    require_once( "config.php" );
    require_once( "controller.php");
    displayPageHeader( "View available decision trees" );
    $con = DbConnect();
?>
    <h3>Displaying available decision trees</h3>

<?php
    mysql_select_db("decision_tree", $con);

    $trees = mysql_query("SELECT * FROM tree WHERE level_id = 0");
?>
    <br />
    <table class="table">
    <tr>
    <th>Name</th>
    <th>Description</th>
    <th>Actions</th>
    </tr>
<?php
    while($row = mysql_fetch_array($trees))
      { 
?>
      <tr>
      <td><a href="view_tree.php?parent_id=<?php echo $row['parent_id'] ?>&amp;decision_id=<?php echo $row['decision_id'] ?>&amp;level_id=<?php echo $row['level_id'] ?>"><?php echo $row['name'] ?></a></td>
      <td><?php echo $row['description'] ?></td>
      <td><a href="controller.php?DeleteTree=<?php echo $row['decision_id'] ?>">Delete&nbsp;Tree</a>
      </tr>
      <?php } ?>
    </table>

    <?php DbDisconnect($con); ?>
    <br />
    <form method="post" action="controller.php">
        <input type="submit" value="Add Decision Tree" id="NewTree" name="NewTree" class="btn btn-primary" />
    </form>
<?php
    displayPageFooter();
?>