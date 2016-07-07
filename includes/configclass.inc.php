<?php
  class Configure {

    var $debug = false;
		var $hidePicture = false;
    //var $debugTime = 'EXEC';  // EXEC = execute time, CURR = current time

    // Database config
  	//var $db_host = '192.168.1.30';
    var $db_host = 'localhost';
  	var $db_user = 'avdb';
  	var $db_pass = 'myavmov..';
  	var $db_name = 'avdb';

    // General config
    var $head_title = "MyDVD Database";
    var $web_title = "MyDVD";

    // item per page for thumb view
    var $ipp = 20;

    // Config table name
    var $tb_movie = "amov";
    var $tb_actress = "actrs";
    var $tb_video = "avideo";
    var $tb_picture = "picture";

    // Config picture type
		var $picType = array('cv'=>'Cover','ss'=>'Ss','pv'=>'Preview');
    var $mmeType = array('jpg'=>'image/jpeg','jpeg'=>'image/jpeg','jpe'=>'image/jpeg','png'=>'image/png');

    // Config option
    var $optStore = array("HDX01","HDX02","HDX03","HDX04","HDX05","HDX06","HDX07","HDX08","500GB");
    var $optHave = array(0=>"in Wish List","Censored","Uncensor","Banned");
    var $optUncen = array(0=>"Censored","Uncensor");
    var $optRegion = array("Unknow","Europe","Thai","Japan","Korea");
    var $optRegAbv = array("--","EN","TH","JP","KR");

		function Configure($host='',$user='',$pass='',$name=''){

		  $this->dbhost = empty($host)?$this->db_host:$host;
			$this->dbuser = empty($user)?$this->db_user:$user;
			$this->dbpass = empty($pass)?$this->db_pass:$pass;
			$this->dbname = empty($name)?$this->db_name:$name;

      $this->tbamov = $this->dbname.'.'.$this->tb_movie;
      $this->tbacts = $this->dbname.'.'.$this->tb_actress;
      $this->tbavdo = $this->dbname.'.'.$this->tb_video;
      $this->tbpic = $this->dbname.'.'.$this->tb_picture;

		}

	}
?>