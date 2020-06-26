<?
session_start();

require_once($_SERVER['DOCUMENT_ROOT'].'/func.php');
require_once($_SERVER['DOCUMENT_ROOT'].'/config.php');
error_reporting(E_ERROR | E_PARSE);

/*
require_once('../../func.php');
require_once('../../config.php');
*/

db_connect($db_login, $db_pass, $db_host, $db_name);
//fix_magic_quotes_gpc();

$action=$_REQUEST['action'];
//sleep(1);

switch($action)
{
	case 'login':
	{
		$sql="select * from users where login='".mysql_real_escape_string($_POST['login'])."' AND pass = '".md5(mysql_real_escape_string($_POST['pass']))."'";
		vd($sql);
		$qr=mysql_query($sql);
		echo mysql_error();
		$next=mysql_fetch_array($qr, MYSQL_ASSOC);
		vd($next);
		
		$result='ok';
		echo'{result: "'.$result.'", objs: ['.join(',', $a).']}';
	};break;
	
	
	
	
	
	
	
	
	
	
}
























?>