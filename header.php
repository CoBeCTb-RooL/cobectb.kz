<?
include ($_SERVER['DOCUMENT_ROOT']."/config.php");
include ($_SERVER['DOCUMENT_ROOT']."/func.php");

include ($_SERVER['DOCUMENT_ROOT']."/classes/User.php");

error_reporting(E_ERROR | E_PARSE);
db_connect($db_login, $db_pass, $db_host, $db_name);
session_start();




if(strstr($_SERVER['HTTP_USER_AGENT'], 'Firefox'))
	define('_browser_', 'firefox');
elseif(strstr($_SERVER['HTTP_USER_AGENT'], 'MSIE'))
	define('_browser_', 'ie');
elseif(strstr($_SERVER['HTTP_USER_AGENT'], 'Opera'))
	define('_browser_', 'opera');
else define('_browser_', 'other');






/*

$top_menu=array(
				array("title"=>"Площадки", "link"=>"/modules/sites.php"),
				array("title"=>"Носители", "link"=>"/modules/media.php"),
				//array("title"=>"Заказать", "link"=>"/modules/order.php"),
				array("title"=>"Услуги", "link"=>"/modules/services.php"),
			);*/



$pics=array(
			65=>array('pic'=>'/images/mans_i_dimon.png', 'ox'=>'right', 'ox_val'=>'-230', 'oy'=>'top', 'oy_val'=>'-100', 'z-index'=>1),
			74=>array('pic'=>'/images/tashila_v_incom.png', 'ox'=>'right', 'ox_val'=>'-256', 'oy'=>'top', 'oy_val'=>'-60', 'z-index'=>2),
			75=>array('pic'=>'/images/drunk_mans.png', 'ox'=>'right', 'ox_val'=>'116', 'oy'=>'bottom', 'oy_val'=>'-60', 'z-index'=>1),
			116=>array('pic'=>'/images/mans_nose.png', 'ox'=>'right', 'ox_val'=>'-120', 'oy'=>'top', 'oy_val'=>'-30', 'z-index'=>1),
		);





//vd($_SERVER['PHP_SELF']);
if(!strpos($_SERVER['PHP_SELF'], 'ajax'))
	include ($_SERVER['DOCUMENT_ROOT']."/template_header.php");

//vd($_SESSION);
?>