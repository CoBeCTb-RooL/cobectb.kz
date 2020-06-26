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
	case 'addMessage':
	{
		//vd($_REQUEST);
		//sleep(1);
		$msg=trim(mysql_real_escape_string(stripslashes($_REQUEST['comments_msg'])));
		$msg=mysql_real_escape_string(htmlspecialchars(stripslashes($_REQUEST['comments_msg'])));
		//$msg=str_replace(array("\n", "\r"), '', nl2br(htmlspecialchars($_REQUEST['comments_msg'])));
		$msg=json_prepareToSave($_REQUEST['comments_msg']);
		$msg=mysql_real_escape_string((($_REQUEST['comments_msg'])));
	//vd($msg);
	//vd($_REQUEST['comments_msg']);
	//exit;
		$id=intval($_REQUEST['id']);
		
	//	vd($_SESSION);
		
		if(!$_SESSION['user'])
		{
			$error='Э, так ы так, авторизуйся пожалуйста.';	
		}
		elseif(!$msg)
		{
			$error='отсутствует мысль..';
			$error=$msg	;
		}
		elseif(!$id)
		{
			$error='Ошибка. Непонятно что комментим...';	
		}
		else
		{
			$sql="insert into song_comments set pid='".$id."', text='".$msg."', datetime=NOW(), user='".$_SESSION['user']['id']."'";
			//$error=$sql;
			mysql_query($sql);
			$e=mysql_error();
			if($e)
				$error=$e;
			else
			{
				$result='ok';
			}
		}
		
		
		echo'
			{
				result: "'.$result.'",
				error: "'.$error.'"
			}';
		
		/*foreach($arr as $key=>$val)
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
			}';*/
	};break;
	
	
	
	
	
	case 'getComments':
	{
		$result='ok';	
		
		$id=intval($_REQUEST['id']);
		if($id==0)
		{
			$error="Ошибка.. ээ.. не понял чё комментим то... ";
		}
		else
		{
			$sql="select * from song_comments where pid=".$id." order by id asc";
		//	vd($sql);
			$qr=mysql_query($sql);
			echo mysql_error();
			while($next=mysql_fetch_array($qr, MYSQL_ASSOC))
			{
		//		vd($next);
				$u=new User($next['user']);
				$b[]='
				{
					id: "'.$next['id'].'", 
					text: '.json_encode(nl2br(htmlspecialchars(stripslashes($next['text'])))).',
					datetime: "'.$next['datetime'].'",
					user: "'.$u->attrs['name'].' '.$u->attrs['surename'].'",
					user_id: "'.$u->attrs['id'].'"
				}';
			}
		}
		
		
		
		
		
		echo'
			{
				result: "'.$result.'", 
				error: "'.$error.'",
				messages: ['.join(', ', $b).']
			}';
	};break;

	
	
}
?>