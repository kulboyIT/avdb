<?php
  include('_header.inc.php');

  if($_POST['submit']){
    echo "<pre>";
    print_r($_POST);
    $id = $_GET['i'];

    if($_POST['upby'] == 'CODE'){
      $get = "http://www.javlibrary.com/en/vl_searchbyid.php?keyword=$_POST[code]";
    }
    if($_POST['upby'] == 'URL'){
      $get = $_POST['url'];
    }
    if($_POST['upby'] == 'FILE'){
      print_r($_FILES);
      $get = 'FILES/'.$_FILES["file"]["name"];
	    if (file_exists($get)) unlink($get);
      move_uploaded_file($_FILES["file"]["tmp_name"],$get);
    }

    debug("$_POST[upby]: $get \n");
    if($m = $fnc->getJavLib($get)){
      print_r($m);
      $sql = "select code,actress,cover from $cfg->tbamov where id='$id'";
      $rs = $db->query($sql);
      $mov = $db->fetch_assoc();
      if(!empty($m['actress'])){
        if(empty($mov['actress'])){
          $actress = $m['actress'];
        }else{
          $actress = $mov['actress'].','.$m['actress'];
          $actress = explode(',',$actress);
          $actress = implode(',',array_unique($actress));
        }
      }
			$code = $mov['code'];
			$cover_id = $mov['cover'];
			debug('in db cover id: '.$cover_id);
			if($cover_id === "1"){
				if(!empty($m['img_url'])){
					$exten = pathinfo($m['img_url'], PATHINFO_EXTENSION);
					list($width, $height) = getimagesize($m['img_url']);
					$content = addslashes(file_get_contents($m['img_url']));
					
					$sql = "insert into $cfg->tbpic (code,cate,type,width,height,picdata,editdate) values('$code','cv','$exten','$width','$height','$content',NOW())";
					if($db->query($sql)){
						debug('Insert New Cover.');
						$cover_id = $db->insert_id();
					}
				}
			}else{
				if($_POST['upcover'] == 'UPCOVER'){
					if(!empty($m['img_url'])){
						$exten = pathinfo($m['img_url'], PATHINFO_EXTENSION);
						list($width, $height) = getimagesize($m['img_url']);
						$content = addslashes(file_get_contents($m['img_url']));
						
						$sql = "update $cfg->tbpic set code='$code',type='$exten',width='$width',height='$height',picdata='$content',editdate=NOW() where id='$mov[cover]'";
						if($db->query($sql)){
							debug('Update Cover ID $mov[cover].');
						}
					}
				}
			}
			$sql = "update $cfg->tbamov set title='$m[title]',title2='$m[actress_name]',studio='$m[studio]',label='$m[label]',genre='$m[genre]',reldate='$m[reldate]',actress='$actress',javlib='$m[javlib]',cover='$cover_id',edit_date=NOW() where id='$id'";
      debug($sql);
      if($db->query($sql)){
        $result = 'UPDATE SUCCESS.';
      }else{
        $result = 'Update FAIL.';
      }
    }else{
      $result = 'NOT FOUND ON JAVLIB.';
    }

    echo "\n $result  <a href='amovedit.php?i=$id'>next</a>";
    //echo "<script>alert('$result');</script>";
    //header("location: amovedit.php?i=$id");
    echo "</pre>";
    $html = 'blank_page.html';
  }else{
    $id = $_GET['i'];
    $sql = "select id,code,javlib from $cfg->tbamov where id='$id'";

    $rs = $db->query($sql);
    $mov = $db->fetch_assoc($rs);
    if(empty($mov['javlib'])) $mov['javlib'] = "http://www.javlibrary.com/en/vl_searchbyid.php?keyword=$mov[code]";
    $sm->assign('mov',$mov);
    $html = 'amov_update.html';
  }

  $sm->display($html);

  include('_footer.inc.php');
?>