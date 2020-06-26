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
	case 'showSchedule':
	{
		$result='ok';	
		
		$arr=array(
			array('time'=>'11-30', 'status'=>'open', 'message'=>'Вставааай! '),
			array('time'=>'14-00', 'status'=>'open', 'message'=>'Жрать! '),
		);
		
		
		
		foreach($arr as $key=>$val)
		{
			$b[]='
			{
				time: "'.$val['time'].'", 
				status: "'.$val['status'].'",
				message: "'.$val['message'].'"
			}';
		}
		
		
		echo'
			{
				result: "'.$result.'", 
				schedule: ['.join(', ', $b).']
			}';
	};break;

	
	
}
?>