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
	case 'getSchedule':
	{
		
		$months=array(1=>'Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь');
		$weekdays=array("Воскресенье", "Понедельник", "Вторник", "Среда", "Четверг", "Пятница", "Суббота");	
		
		if(!$date=$_REQUEST['date'])
		{
			$date=date("Y-m-d");
		}
			
		
		$tmp=explode('-', $date);
		
		
		$data['y']=$tmp[0];
		$data['mon']=$tmp[1];
		$data['d']=$tmp[2];
		
			
		$data['h']=date('H');
		$data['m']=date('i');
		$data['s']=date('s');
		
		$ts=mktime($data['h'], $data['m'], $data['s'], $data['mon'], $data['d'], $data['y']);
		//vd(date('H:i:s'));
		//vd($data);
		$data['weekday_name']=$weekdays[date('w', $ts)];
		$data['month_name']=$months[date('n', $ts)];
		$data['days_passed']=date('z', $ts)+1;
		$data['days_left']=( (365+(date('L', $ts)?1:0)) - $data['days_passed'] );
		
		
		
		
		
		
			
		$result='ok';	
		
		$sch=array(
			array('t'=>'11-30', 'st'=>'0', 'msg'=>'Вставааай! ', 'prt'=>2),
			array('t'=>'14-00', 'st'=>'0', 'msg'=>'Жрать! ', 'prt'=>1),
		);
		
		
		
	
		$arr=array('result'=>$result, 'schedule'=>$sch, 'date'=>$data);
		
		echo json_encode($arr);
	};break;

	
	
}
?>