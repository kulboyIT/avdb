<?php
  include('_header.inc.php');

  echo "START<br/>http://www.javlibrary.com/en/?v=javlioza7u<br/>";

  if(!empty($_GET['keyword'])){
    $keyword = urldecode($_GET['keyword']);
		//echo "KEYWORD: ".$keyword."<br/><br/>";
		if(!strpos($keyword,'www.javlibrary.com')){
			$keyword = strtoupper($keyword);
			$getfrom = "http://www.javlibrary.com/en/vl_searchbyid.php?keyword=$keyword";
		}else{
			$getfrom = $keyword;
		}
    
    //$getfrom = urldecode($_GET['keyword']);

    echo "GET URL: ".$getfrom."<br/><br/>";

		
    $mov = $fnc->getJavLib($getfrom);
    echo "<pre>";
    print_r($mov);
    echo "</pre>";
		
		/*
		$cont = file_get_contents($getfrom);
    $lines = explode(chr(13),$cont);
		echo "<pre><code>";
    foreach($lines as $line){
			if(strpos($line,'Start of Content')) $capture = true;
			if($capture) echo htmlentities($line);
			if(strpos($line,'User Comments')) break;
		}
		echo "</code></pre>";
		*/
  }

  echo "END";

  include('_footer.inc.php');
?>

<form action="test.php" method="get">
<input type="text" name="keyword" id="idsearchbox" value="<? echo $_GET['keyword'] ?>" size="50"/>
<input type="submit" value="GOOOOO" id="idsearchbutton" />
</form>