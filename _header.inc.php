<?php
	ini_set('display_errors', 'On');
	SESSION_START();

	require_once (dirname(__FILE__)."/includes/configclass.inc.php");
	require_once (dirname(__FILE__)."/includes/function.inc.php");
	require_once (dirname(__FILE__)."/includes/database.inc.php");
  require_once (dirname(__FILE__)."/includes/picturedb.inc.php");
	require_once (dirname(__FILE__)."/Smarty/libs/Smarty.class.php");

	$cfg = new Configure();
  $fnc = new Functioner($cfg);
	$db = new Database($cfg->dbhost,$cfg->dbuser,$cfg->dbpass,$cfg->dbname);

	DEFINE ('HEAD_TITLE',$cfg->head_title);
	DEFINE ('WEB_TITLE',$cfg->web_title);
	
	DEFINE ('ROOT_PATH' , dirname(__FILE__));
	DEFINE ('CURRENT_PATH', dirname($_SERVER["SCRIPT_FILENAME"]));
	$df = substr(CURRENT_PATH, strlen(ROOT_PATH));
	$sc = substr_count($df, "/");
	for($sf='';$sc>0;$sc--){
			$sf = $sf . "../";
	}
	$sf = $sf ? $sf:'./';
	DEFINE ('ROOT' , $sf);
	DEFINE ('THEMES' , ROOT."themes");

	$debug_msg = "ROOT_PATH=".ROOT_PATH.", ";
	$debug_msg .= "CURRENT_PATH=".CURRENT_PATH.", ";
	$debug_msg .= "ROOT=".ROOT.", ";
	$debug_msg .= "THEMES=".THEMES."<br/>";
	
	function debug($msg) {
		global $debug_msg;
		$dbbt = debug_backtrace();
		if(is_array($msg)) $msg = var_dump($msg);
		$debug_msg .= date('H:i:s')." [line#".$dbbt[0]['line']."] $msg<br/>";
	}

	//Smarty for body content
	$sm = new Smarty();
	$sm->template_dir = "html/";
	$sm->config_dir = "html/";
	$sm->compile_check = false;
	$sm->force_compile = true;
	$sm->use_sub_dirs = true;
	$sm->compile_dir = ROOT."Smarty/templates_c/";
	$sm->cache_dir = ROOT."Smarty/cache/";
	$sm->left_delimiter = '<%';
	$sm->right_delimiter = '%>';
  
  //unlock session
  session_write_close();
	
	//start_buffer
	ob_start();
?>