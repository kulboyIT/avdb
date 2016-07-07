<?php
  include('_header.inc.php');

  $sql = "select id,fname,lname from $cfg->tbacts order by id";
  $actrs_result = $db->query($sql);
  while($row = $db->fetch_assoc($actrs_result)){
    $aid = $row['id'];
    $sql = "select code from $cfg->tbamov where actress like '%[$aid]%'";
    $amov_result = $db->query($sql);
    $movies = $db->affected_rows();

    $sql = "update $cfg->tbacts set movies = '$movies' where id = '$aid'";
    echo "ID:$aid $row[fname] $row[lname] [$movies Movie(s)] => ";
    if($db->query($sql)){
      echo "<span style='color: blue'>Updated.</span><br/>";
    }else{
      echo "<span style='color: red; background-color: #999999'>Update FAIL.</span><br/>";
    }
  }

  include('_footer.inc.php');
?>