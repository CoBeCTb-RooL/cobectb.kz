<?
include ($_SERVER['DOCUMENT_ROOT']."/header.php");

/*
ini_set('error_reporting', E_ERROR);
ini_set('display_errors', 1);
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Pragma: no-cache");
header("Last-Modified: ".gmdate("D, d M Y H:i:s")."GMT");
header("Content-Type: text/html; charset=utf-8");
session_start();

*/

$action=$_REQUEST['action'];


switch($action)
{
	case 'checkAuth':
	{
		checkAuth();
	};break;
	
	
	
	
	
	
	case 'exit1':
	{
		exit1();
	};break;

	

}







function checkAuth()
{
	$error="";
			
	ob_start();
	
	sleep(1);
	$email=mysql_real_escape_string($_REQUEST['email']);
	$pass=mysql_real_escape_string($_REQUEST['password']);
	
	$sql="select * from users where email='".$email."' AND password='".md5($pass)."' AND active=1";
	$qr=mysql_query($sql);
	if(!mysql_num_rows($qr))
	{
		//$result='Е, низнаю я такой - <b>'.$email.'</b>..';	
		$result='<img src="/images/skype_smiles/46.gif"> Е, низнаю я такой.';	
	}
	else
	{
		$result='ok';
		$next=mysql_fetch_array($qr, MYSQL_ASSOC);
		$b=arrayToJSON($next);
		
		$_SESSION['user']=$next;
	}
	
	echo $str;
	
	$html=ob_get_clean();
	
	$json['html'] = $html;
	$json['result'] = $result;
	$json['error'] = $error;
	$json['user'] = $next;
	
	echo json_encode($json);
}






function exit1()
{
	$error="";
			
	ob_start();
	
	$result='ok';
	$_SESSION['user']=NULL;
	
	echo $str;
	
	$html=ob_get_clean();
	
	$json['html'] = $html;
	$json['result'] = $result;
	$json['error'] = $error;
	
	echo json_encode($json);
}



?>