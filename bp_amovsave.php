<?php
  require_once("bp_header.noout.inc.php");

  if($_POST['submit']=='SAVE'){
		if(!empty($_POST['actress'])){
			foreach($_POST['actress'] as  $v){
				$actrs .= "[$v],";
			}
			$actrs = substr($actrs,0,-1);
		}
    $title = addslashes($_POST['title']);
    $title2 = addslashes($_POST['title2']);
    $reldate = empty($_POST['reldate'])?'2000-01-01':$_POST['reldate'];
    $detail = addslashes($_POST['detail']);
    echo $detail;
		$sql = "update $cfg->tbamov set ".
				"title='$title', ".
				"title2='$title2', ".
        "genre='$_POST[genre]',".
				"region='$_POST[region]', ".
				"reldate='$reldate', ".
        "studio='$_POST[studio]', ".
        "label='$_POST[label]', ".
				"actress='$actrs', ".
        "score='$_POST[score]', ".
				"detail='$_POST[detail]',".
				"have='$_POST[have]',".
				"edit_date=NOW() where id='$_POST[id]'";
		echo $sql;
    $db = new Database($cfg->dbhost,$cfg->dbuser,$cfg->dbpass,$cfg->dbname);

		if($db->query($sql)){
			echo "<script>alert('SAVE SUCCESS');</script>";
		}else{
			echo "<script>alert('SAVE FAIL');</script>";
		}
    
	}

?>