<?
session_start();
require_once($_SERVER['DOCUMENT_ROOT'].'/func.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
db_connect($db_login, $db_pass, $db_host, $db_name);
//fix_magic_quotes_gpc();

$action=$_REQUEST['action'];
//sleep(1);

switch($action)
{

	
	
	case 'gb_send':
	{
		
		
		//sleep(1);
		//vd($_REQUEST);
		$msg=htmlspecialchars(/*nl2br*/(trim($_REQUEST['gb-msg'])));
		$msg=str_replace("\n", '', $msg);
		//vd($msg);
		
		$result='ok';
		echo'{result: "'.$result.'", msg: "'.$msg.'"}';
	};break;
	
}
























?>