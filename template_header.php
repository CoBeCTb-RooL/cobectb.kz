<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?=$title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="/css/style.css" rel="stylesheet" type="text/css" >
<link rel="shortcut icon" href="/favicon.ico"  type="image/x-icon" />
<script src="/js/jquery-1.4.2.js" type="text/javascript"></script>
<script src="/js/php.js" type="text/javascript"></script>
<script src="/js/script.js" type="text/javascript"></script>


<script type="text/javascript" src="/ajax/schedule/schedule.js" ></script>
<script type="text/javascript" src="/ajax/auth/auth.js" ></script>
<script type="text/javascript" src="/ajax/reg/reg.js" ></script>
<script type="text/javascript" src="/ajax/gb/gb.js" ></script>
<script type="text/javascript" src="/ajax/comments/comments.js" ></script>


</head>
<body style=" background: url(/images/dima_kandali.png) no-repeat bottom right" >
<table style="height: 100%; width: 100%; background: url(/images/mans_incom.png) no-repeat bottom right; ">
	<tr>
		<td valign="top">



<?
/*
$person=trim($_GET['person']);
$debug=isset($_GET['debug']);

if($person)
	echo 'э, '.$person.'! Калайсын? ';
else echo 'е, орот, атын кiм?!';
*/





?>

<!--<img src="/images/think.gif" alt="" style="margin-bottom: -6px; margin-left: 20px;">-->
<p>
<div style="height: 10px;"></div>












<div id="top-cloud" style="position: absolute; top: 0; right: 0; width: 450px; height: 98px; background-image: url(/images/top_cloud.png);  text-align: right; color: #fff; font-size: 10px; font-weight: bold;  ">
<div style="margin: 10px 15px; text-shadow: 2px 2px 5px #000;" id="cloud-div">Счастье есть! Оно проще простого - это чьё-то лицо!)).</div>
</div>












<!--GB-->
<div id="gb-div" style="padding: 10px 50px ; width: 520px; height: 418px; position: fixed; top: 100px; left: 100px; background: url(/images/gb-bg.png); display: none ; z-index: 999999;">


	<!--ЗАКРЫТЬ -->
	<div  style="cursor: pointer;  position: absolute; top: 0px ; right: 0px;  width: 43px; height: 43px; background: url(/images/gb-bg.png); background-position: -620px 0px" onMouseOver="this.style.backgroundPosition='-663px 0px'; " onMouseOut="this.style.backgroundPosition='-620px 0px'; " onClick="showOrHideGB()">
	</div>

	<!--смайлик МОЛВИТЬ-->
	<div  style="cursor: pointer;  position: absolute; bottom: 30px ; right: 50px;  width: 48px; height: 45px; background: url(/images/gb-bg.png); background-position: -983px 0px; display: " onMouseOver="this.style.backgroundPosition='-1031px 0px'; " onMouseOut="this.style.backgroundPosition='-983px 0px'; " onClick="if($('#gb-form-cloud').is(':hidden')){gbShowCloud()}else{gbHideCloud()}">
	</div>


	<!--облачко с формой-->
	<div  style=" position: absolute; bottom: 0px ; right: -380px;  width: 389px; height: 261px;  background: url(/images/gb-bg.png); background-position: -618px -140px; display: none " id="gb-form-cloud" >

		<form method="post" action="" name="gb_form" id="gb_form">

		<!--gb текстовое поле сообщение -->
		<div style="position: relative; height: 261px;" >
			<div style="position: absolute; bottom: 50px; left:20px; width: 276px; height: 112px; background: url(/images/gb-bg.png); background-position: -707px 0px;  ">
				<textarea name="gb-msg" id="gb-msg"></textarea>
			</div>
			
			<!--gb красная кнопка-->
		<div  style="cursor: pointer;  position: absolute; bottom: 100px ; right: 50px;  width: 41px; height: 39px; background: url(/images/gb-bg.png); background-position: -1079px 0px" onMouseOver="this.style.backgroundPosition='-1120px 0px'; " onMouseOut="this.style.backgroundPosition='-1079px 0px'; "  onclick="gbSendMsg()">
		</div>
		
	</div>
	</form>
	
	<!--gb-загрузка-->
	<div id="loading-div" style="position: absolute; top: 20px; right: 70px;display:none ; "><img src="/images/ajax-loader.gif" alt="секундочку..."></div>

</div>
	

	
	<div style="overflow: auto; height: 378px; margin: 20px 0px; " id="gb-canvas">
	
<?
$str='
 working in progress... 
';

//echo $str;
//echo str2dim($str, 'brick');
?>

	</div>
</div>





<div style="  z-index: 9999999; cursor: pointer; position: fixed; top: 100px; right: 0; width: 35px; height: 98px;  background: url(/images/right-nav.png) " onMouseOver="this.style.backgroundPosition='-35px 0px'; show_or_hide('tough-stuff-inf', 1)" onMouseOut="this.style.backgroundPosition='0px 0px'; show_or_hide('tough-stuff-inf', 0)" onClick="location.href='/modules/songs.php'" >
<!--<a href="javascript:void(0)" onclick="showOrHideGB()" ><img   id="tough-stuff-btn"  src="/images/tough_stuff.png" alt="tough stuff" border="0"></a>-->
</div>

<div id="tough-stuff-inf" style=" position: fixed; top: 110px; right: 20px; width: 194px; height: 114px; display: none ; z-index: 9999999;">
<img src="/images/tough_stuff_inf.png" alt="tough stuff" >
</div>





<div style="  z-index: 9999999; cursor: pointer; position: fixed; top: 200px; right: 0; width: 27px; height: 98px;  background: url(/images/right-nav.png); background-position: -70px 0px " onMouseOver="this.style.backgroundPosition='-97px 0px'; " onMouseOut="this.style.backgroundPosition='-70px 0px'; " onClick="showOrHideGB()">
<!--<a href="javascript:void(0)" onclick="showOrHideGB()" ><img   id="tough-stuff-btn"  src="/images/tough_stuff.png" alt="tough stuff" border="0"></a>-->
</div>




<div style="position: fixed; bottom: 0px; left: 0; width: 40px; height: 27px;  " >
<a href="javascript:void(0)" onClick="$('.song div[id^=\'song-body\']').slideToggle()" ><img   id="bottom-left-btn"  src="/images/bottom-left.png" alt="скрыть сеее на#" border="0"></a>
</div>










<script>
<?
if($_SESSION['user'])
{?>
var user=<?='{'.join(', ', arrayToJSON($_SESSION['user'])).'}'?>
<?	
}
?>
</script>



<script>
Auth.drawDiv();
<?
if(!$_SESSION['user'])
{?>
Auth.loginForm();
<?
}
else
{?>
Auth.showGreeting(<?='{'.join(', ', arrayToJSON($_SESSION['user'])).'}'?>);
<?	
}
?>
</script>





<div style="height: 40px;"></div>






<script>
function gbShowCloud()
{
	$('#gb-form-cloud').fadeIn()
	//$('.song').fadeOut()
}





function gbHideCloud()
{
	$('#gb-form-cloud').fadeOut()
	//$('.song').fadeIn()
}






function showOrHideGB()
{
	if($('#gb-div').is(':hidden'))
	{
		$('#gb-div').fadeIn()
		//$('.song').fadeOut()
	}
	else
	{
		$('#gb-div').fadeOut();
		gbHideCloud()
		//$('.song').fadeIn()
		//alert(123)
	}
}





function gbSendMsg()
{
	if($('#gb-msg').val()=='')
	{
		alert('эЭ.. а написать что нибудь?!')
		return;
	}
		
	loading(1)
	var str = $("#gb_form").serializeArray();
	$.post('/ajax.php?action=gb_send', str, 
			function(str){
				//alert(str)
				//return;
				eval('data='+str);
				//return;
				if(data.result=='ok')
				{
					$('#gb-msg').val('')
					var str=$('#gb-canvas').html()
					$('#gb-canvas').html(str+'<p>'+str2dim(data.msg, 'brick'))
					
					//alert(lang)
				}
				else alert(data)
				loading(0)
	        });
			
}



function loading(a)
{
	if(a>0)
		$('#loading-div').fadeIn('medium')
	else
		$('#loading-div').fadeOut('fast')
		
}

</script>
<style>
#gb-msg{
	border: 0px solid black;
	width: 256px;
	height: 89px;
	background: transparent;
	margin: 15px 12px 8px 8px;
}
</style>