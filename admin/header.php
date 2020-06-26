<?
include ("../config.php");
include ("../func.php");
include ("func.php");
//include ("header.php");

error_reporting(E_ERROR | E_PARSE);
db_connect($db_login, $db_pass, $db_host, $db_name);
session_start();



?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
<title>админка:: </title>
<script src="/js/jquery-1.3.2.min.js" type="text/javascript"></script>
<link href="style.css" rel="stylesheet" type="text/css" >
</head>
<body>
	<div style="margin: 15px; padding: 20px; border: 1px dashed black">
<?
if(!authorized())
{
	die(login_form());
}

?>

<?
	$top_menu=array(
				array("link"=>"pesenki.php", "title"=>"Песенки на"),
			
				);
?>
<div style="position: absolute; top: 20px; right: 120px; ">
<img src="/admin/slonik.gif" width="70" alt="" onMouseOver="$('#slonne').fadeIn(); $('#tsop').fadeIn(); " onMouseOut="$('#slonne').fadeOut(); $('#tsop').fadeOut()">
</div>

<div  style="position: absolute; top: 80px; right: 80px;  width :120px ; height: 80px ; display: none " id="slonne">
<img src="/admin/slonne.gif" alt="">
</div>

<div  style="position: absolute; top: 0px; right: 80px;  width :174px ; height: 27px ; display: none " id="tsop">
<img src="/admin/tsop.tya.gif" alt="">
</div>

<div style=" background: #eee; border-bottom: 3px solid #ccc;  padding: 10px 15px; ">
<?
	echo '
	<div style="display:inline; float: left">|&nbsp;&nbsp;';
	foreach($top_menu as $key=>$val)
	{
		//vd($_SERVER['PHP_SELF']);
		echo '<a href="'.$val['link'].'" '.($_SERVER['PHP_SELF']=='/admin/'.$val['link']?' style="font-weight: bold"':'').'>'.$val['title'].'</a>&nbsp;&nbsp;|&nbsp;&nbsp;';
	}
	echo '
	</div>';
	
	
	echo '
	<div style="display: inline; float: right">
	<form name="logout_form" method="post" action="" style="margin: 0; padding: 0">
		<input type="hidden" name="logout_btn" value="1">
	</form>
	
	<a href="javascript:void(0)" onclick="if(confirm(\'Уверены?\'))document.forms.logout_form.submit();">Выйти</a>
	</div>
	';
?>
<div style="clear: both"></div>

</div>