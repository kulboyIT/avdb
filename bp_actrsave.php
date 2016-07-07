<?php
  require_once("bp_header.noout.inc.php");

  if($_POST['submit']=='SAVE'){
    $birthdate = empty($_POST['birthdate'])?'1990-01-01':$_POST['birthdate'];
		$sql = "update $cfg->tbacts set ".
				"fname='$_POST[fname]', ".
				"lname='$_POST[lname]', ".
        "jname='$_POST[jname]', ".
        "javlibcode='$_POST[javlibcode]', ".
        "birthdate='$birthdate',".
				"nation='$_POST[nation]', ".
				"size='$_POST[size]', ".
        "score='$_POST[score]', ".
        "follow='$_POST[follow]', ".
				"edit_date=NOW() where id='$_GET[id]'";
		echo $sql;
    $db = new Database($cfg->dbhost,$cfg->dbuser,$cfg->dbpass,$cfg->dbname);

		if($db->query($sql)){
			echo "<script>alert('SAVE SUCCESS')</script>";
		}else{
			echo "<script>alert('SAVE FAIL')</script>";
		}

	}

?>