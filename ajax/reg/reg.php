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
	case 'checkReg':
	{
		//vd($_REQUEST);
		//exit;
		foreach($_REQUEST as $key=>$val)
		{
			$_REQUEST[$key]=trim(mysql_real_escape_string($val));
		}

		$u=new User($_SESSION['user']['id']);
		
		
		if(!$_REQUEST['name'] || !$_REQUEST['email'] || (!$_SESSION['user'] && (!$_REQUEST['password'] || !$_REQUEST['password2'])))
		{
			$result='Еу, тыж братан не всё ввёл на...';
			echo'{
				result: "'.$result.'"
			}';
			return;
		}
		
		if(!$_SESSION['user'] &&  $_REQUEST['password'] != $_REQUEST['password2'])
		{
			$result='Е, пароли разные, же есть?';
			echo'{
				result: "'.$result.'"
			}';
			return;
		}
		
		
		if($_SESSION['user'] && !$_REQUEST['password'] && $_REQUEST['password_new'])
		{
			$result='Стары пароль тоже нужно братан..';
			echo'{
				result: "'.$result.'"
			}';
			return;
		}
		
		
		
		if($_SESSION['user'] && $_REQUEST['password'] && !$_REQUEST['password_new'])
		{
			$result='Ты новы пароль введи, е?';
			echo'{
				result: "'.$result.'"
			}';
			return;
		}
		
		if($_SESSION['user'] && $_REQUEST['password'] && $_REQUEST['password_new'] && md5($_REQUEST['password']) != $u->attrs['password'] )
		{
			$result='Е, старый же неправильный же ты ввёл же..';
			echo'{
				result: "'.$result.'"
			}';
			return;
		}
		
		
		if(!$_SESSION['user'])
		{
			$sql="select * from users where email='".$_REQUEST['email']."' AND active=1";
			$qr=mysql_query($sql);
			if(mysql_num_rows($qr))
			{
				$result='Мяяяя... такой ящик уже занят.. необессуть братан..';
				echo'{
					result: "'.$result.'"
				}';
				return;
			}
		}
		
		
		if($u->attrs)
		{
			$sql='update ';
		}
		$sql=($u->attrs?"update ":"insert into ")." users set ";
		
		$sql.=" 
		name='".$_REQUEST['name']."',
		surename='".$_REQUEST['surename']."',
		";
		if($_REQUEST['password'] || $_REQUEST['password_new'])
		{
			$sql.="	
				password='".($_REQUEST['password_new']?md5($_REQUEST['password_new']):md5($_REQUEST['password']))."',";
		}
		if(!$u->attrs)
		{
			$token=getToken();
			$sql.="
			date_of_reg=NOW(),
			activation_code='".$token."',
			";
		}
		$sql.="
		email='".$_REQUEST['email']."'";

		$sql.=($u->attrs?" where id=".$u->attrs['id']:"");

		mysql_query($sql);
		
		if($e=mysql_error())
		{
			$result='Ты, ошибка, братан... =(';
			echo'{
				result: "'.$result.'"
			}';
			return;
		}
		

		if($_SESSION['user'])
		{
			$u=new User($_SESSION['user']['id']);
			$_SESSION['user']=$u->attrs;
		}
		
		
		if($token)	//типа если узер новый
		{
			$headers  = "Content-type: text/html; charset=utf-8 \n"; 
			$headers .= "From: cobectb.kZ <robot@cobectb.kz>\n";
			$msg='<h4>Салемет, '.$_REQUEST['name'].' '.$_REQUEST['surename'].'</h4>';
			$msg.='Ты же щяс зарегился на cobectb.kz? э вот тебе ключ, зайди там на сайте , нажми ВВЕСТИ КЛЮЧ АКТИВАЦИИ, туда-суда..
			<p>
			Э вот ключ активации на:<p>
			<b>'.$token.'</b>
			<p>
			а, вот еси чё:
			логин: <b>'.$_REQUEST['email'].'</b><br>
			пароль: <b>'.$_REQUEST['password'].'</b>
			<p>
			э, ну ток сначала активируйся! 
			';
			
			$tema='Табро пажалуыт на cobectb.kz!!';
			$m=mail($u->attrs['email'], $tema, $msg, $headers);
		}

		$b=arrayToJSON($_SESSION['user']);
		
		
		$result='ok';
		
		echo'{
				result: "'.$result.'", 
				user: {'.join(', ', $b).'}
			}';
	};break;
	
	
	
	
	
	
	
	
	
	
	
	case 'activate':
	{
//		vd($_REQUEST);
		$code=trim(mysql_real_escape_string($_REQUEST['code']));
		
		if(!$code)
		{
			$result='ключ не ввёл ты чё е ))';
			echo'{
				result: "'.$result.'", 
			}';
			return;
		}
		
		$sql="select * from users where activation_code='".$code."'";
		$qr=mysql_query($sql);
		$next=mysql_fetch_array($qr, MYSQL_ASSOC);
		
		//vd($next);
		
		if($next)
		{
			$result='ok';
			$sql="update users set activation_code='', active=1 where id=".$next['id']."";
			mysql_query($sql);
		}
		else
		{
			$result='Э нет такого ключа...';
		}
		
		echo'{
				result: "'.$result.'", 
			}';
	};break;

	
	
	
	
	
	

}







?>