<? include('header.php');?>

<?

echo '
<h1>Песенки на</h1>';
//$label='поиск по товарам...';
//$s_word=trim($_GET['s_word']);	



echo '
<div style="margin: 0px 0px 30px 0px">

</div>';




$action=$_REQUEST['action'];
//vd($action);
switch($action)
{
	case 'edit':
		echo edit();
	break;
	
	case 'save':
		echo save();
		echo tape();
	break;
	
	case 'delete':
		echo delete();
		echo tape();
	break;
	
	case 'tape':default:
		echo tape();
	break;
	
}


//echo $_POST['main'];

function tape()
{	
	global $s_word;
	
	if($_POST['save_btn'])
	{
//		vd($_POST);
		
	}
	
	if($_POST['save_btn'])
	{
		foreach($_POST['idx'] as $key=>$val)
		{
//			vd($key);
			$sql="update pesenki set idx='".($val!=''?intval($val):'')."' where id=".$key;
			mysql_query($sql);
			echo mysql_error();
			//vd($sql);
		}
		echo '<div class="notice">Изменения сохранены!</div>';
		
		
		foreach($_POST['del'] as $key=>$val)
		{
			$sql="select * from pesenki where id=".$key;
			$qr=mysql_query($sql);
			if(mysql_num_rows($qr))
			{
				$next=mysql_fetch_array($qr, MYSQL_ASSOC);
				
				$sql_primary="delete from pesenki where id=".$key;
				if(mysql_query($sql_primary))
				{
					for($i=1; $i<=1; $i++)
					{
						$pic=$_SERVER['DOCUMENT_ROOT'].'/upload/images/'.$next['pic'.$i];
						if(file_exists($pic))
						{
							unlink($pic);
						}
					}	
				}
			}
		}
		echo '<div class="notice">Выделенные площадки удалены</div>';
		
		
		
		
		foreach($_POST['clear_after'] as $key=>$val)
		{
//			vd($key);
			$sql="update pesenki set clear_after='".($val!=''?intval($val):'')."' where id=".$key;
			mysql_query($sql);
			echo mysql_error();
			//vd($sql);
		}
		echo '<div class="notice">Изменения сохранены!</div>';
		
		
	}
	
	$onepage = 30;
	$pg=$_REQUEST['pg']?$_REQUEST['pg']-1:0;
	$limit=" LIMIT ".$pg*$onepage.",".$onepage."";
	
	$order=$_REQUEST['order'];
	$desc=isset($_REQUEST['desc']);
	
	$sql_order="idx";
	if($order=='title')
		$sql_order="title";
	elseif($order=='idx')
		$sql_order="idx";
	elseif($order=='date')
		$sql_order="date";
	
	
	
	$new_btn='
	<p>
	<input type="button" class="btn green" value="Добавить площадку" onclick="location.href=\'?action=edit\'">';
	
	
	$sql="select * from pesenki  order by ".$sql_order.($desc?' desc ':'')."";
//	vd($sql);
	$qr=mysql_query($sql);
	$total_elements=mysql_num_rows(mysql_query($sql));
	$get_params=array( 'order', );
	if($desc) 
		$get_params[]='desc';
	
	$qr=mysql_query($sql.$limit);
	
	$ret.=$new_btn;
	$ret.=draw_pages($total_elements, $pg, $onepage, $get_params);
		
	if($total_elements)
	{
	
		$ret.='
		<form name="del_selected_form" method="post" action="?" onsubmit="if(confirm(\'Вы уверены?\'))return true; else return false;">
		<table width="50%" style="border-collapse: collapse" border="1">
			<tr class="header_tr">
				<td align="center" ><a href="?order=title'.($order=='title'&&!$desc?'&desc':'').'">Название</a></td>
				<td width="10" style="width: 10px;"><a href="?order=idx'.($order=='idx'&&!$desc?'&desc':'').'">idx</a></td>
				<td width="10" align="center" >КлиарАфтэр</td>
				<td width="10" align="center" >удалить?</td>
			</tr>
		';
		while($next=mysql_fetch_array($qr, MYSQL_ASSOC))
		{
			$ret.='
			<tr>
				<td >
			<div style="margin: 10px"><a href="?action=edit&id='.$next['id'].'">'.$next['title'].'</a></div>
				</td>
				
				<td><input type="text" size="3" name="idx['.$next['id'].']" value="'.$next['idx'].'"></td>
				<td><input type="text" size="3" name="clear_after['.$next['id'].']" value="'.$next['clear_after'].'"></td>
				<td align="center"><input type="checkbox" name="del['.$next['id'].']"></td>
			</tr>
			';
		}
		$ret.='
			<tr>
				<td colspan="4" align="right"><input type="submit" class="btn green" name="save_btn" value="сохранить изменения"></td>
			</tr>
		</table>
		</form>';
		$ret.=draw_pages($total_elements, $pg, $onepage, $get_params);
	}
	else
	{
		echo 'Ничего не найдено.';
	}

	$ret.= $new_btn;
	
	$ret.='
	<div style="margin-top: 25px;"> <a href="?">Все площадки</div>';
	return $ret;
}






function edit()
{
	$id=intval($_GET['id']);

	if($id)
	{
		$sql="select * from pesenki where id=".$id;
		$qr=mysql_query($sql);
		$next=mysql_fetch_array($qr, MYSQL_ASSOC);
	}
	
	
	
	$ret.= '
	<form name="delete_form" method="post" action="?action=delete">
			<input type="hidden" name="delete_btn" value="1">
			<input type="hidden" name="id" value="'.$id.'">
		</form>
	<form name="edit_form" action="?action=save" enctype="multipart/form-data" method="POST">
	<input type="hidden" name="id" value="'.$id.'">
	<table width="100%" border="1"  style="border-collapse: collapse" cellpadding="5">
		<tr>
			<td width="100">
				Название:
			</td>
			<td>
				<input type="text" name="title"  size="70" value="'.htmlspecialchars($next['title']).'">
			</td>
		</tr>
		
		
		
		
	
		<tr>
			<td width="100">
				Текест на:
			</td>
			<td>
			<div><input type="hidden" id="text" name="text" value="'.htmlspecialchars(stripslashes($next['text'])).'"><input type="hidden" id="FCKeditor1___Config" value=""><iframe id="FCKeditor1___Frame" src="../FCKeditor/editor/fckeditor.html?InstanceName=text&Toolbar=Default" width="100%" height="400px" frameborder="no" scrolling="no"></iframe></div>
			</td>
		</tr>
		
		
		
		
		
		
		<tr>
			<td width="100">
				реальное название:
			</td>
			<td>
				<input type="text" name="original_title"  size="70" value="'.htmlspecialchars($next['original_title']).'">
			</td>
		</tr>
		
		
		
		
	
		<tr>
			<td width="100">
				реальный Текест на:
			</td>
			<td>
			<div><input type="hidden" id="original_text" name="original_text" value="'.htmlspecialchars(stripslashes($next['original_text'])).'"><input type="hidden" id="FCKeditor1___Config" value=""><iframe id="FCKeditor1___Frame" src="../FCKeditor/editor/fckeditor.html?InstanceName=original_text&Toolbar=Default" width="100%" height="400px" frameborder="no" scrolling="no"></iframe></div>
			</td>
		</tr>
		
		
		
		
		
		
		<tr>
			<td width="100">
				Исполнитель:
			</td>
			<td>
				<input type="text" name="artist"  size="70" value="'.htmlspecialchars($next['artist']).'">
			</td>
		</tr>
		
		
		
		
		
		
		
		<tr>
			<td width="100">
				Цвет на:
			</td>
			<td>
				<input type="text" name="color"  size="70" value="'.htmlspecialchars($next['color']).'">
			</td>
		</tr>
		
		
		
		<tr>
			<td width="100">
				Ширина на:
			</td>
			<td>
				<input type="text" name="width"  size="70" value="'.htmlspecialchars($next['width']).'">
			</td>
		</tr>
		
		';
	
	
	
		
	
		
		
		$ret.='
		<tr>
			<td colspan="2" style="padding-top: 20px;">
				<input type="submit" name="go_btn"  class="btn green" value="Сохранить" >
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button"  class="btn red" onclick="if(confirm(\'Удалить &quot;'.$next['title'].'&quot;?\')) {document.forms.delete_form.id.value=\''.$next['id'].'\'; document.forms.delete_form.submit();}" value="удалить">
			</td>
		</tr>
		
		
	</table>
	</form> 
	';
	
	
	return $ret;
}









function save()
{
	$id=intval($_POST['id']);
	foreach($_POST as $key=>$val)
	{
		$_POST[$key]=mysql_real_escape_string($val);
	}
	
	
	if($id)
		$sql.='update pesenki set ';
	else 
		$sql.='insert into pesenki set ';
	
	$sql.=" title= '".$_POST['title']."', 
	original_title= '".$_POST['original_title']."', 
	artist= '".$_POST['artist']."', 
	color= '".$_POST['color']."', 
	width= '".$_POST['width']."', 
			
	text = '".$_POST['text']."',
	original_text = '".$_POST['original_text']."'
	";
	
	
	if($id)
	{
		$sql2="select * from pesenki where id=".$id;
		$qr2=mysql_query($sql2);
		$next=mysql_fetch_array($qr2, MYSQL_ASSOC);
		
	}
	
	
			
			
			


	if($id)
		$sql.=' where id='.$id;

	if(mysql_query($sql))
	{
		$ret.= '<div class="notice">сохранено!</div>';
	}
	else $ret.='<div class="error">не сохранено: '. mysql_error().'</div>';
	//vd($_POST);
	return $ret;
}







function delete()
{
	if($_POST['delete_btn'])
	{
		$id=intval($_POST['id']);
		$sql="select * from pesenki where id=".$id;
		$qr=mysql_query($sql);
		if(mysql_num_rows($qr))
		{
			
			$next=mysql_fetch_array($qr, MYSQL_ASSOC);
			//vd($game);
			
			$sql_primary="delete from pesenki where id=".$id;
			if(mysql_query($sql_primary))
			{
				for($i=1; $i<=1; $i++)
				{
					$pic=$_SERVER['DOCUMENT_ROOT'].'/upload/images/'.$next['pic'.$i];
					if(file_exists($pic))
					{
						unlink($pic);
					}
				}
				echo '<div class="notice">Площадка удалён!</div>';
			}
			else echo '<div class="error"><strong>Ошибка! </strong>Площадка не удалён!</div>';
		}
		else echo '<div class="error"><strong>Ошибка! </strong>Площадка не существует!</div>';
	}
	else echo '<div class="error"><strong>Ошибка! </strong>Площадка не задан!</div>';
	
	return $ret;
}








function process_file($file)
{
	if( $file['name'] )
	{

		$dot=strrpos($file['name'], '.');
		$name=(substr($file['name'], 0, $dot));
		$ext=strtolower(substr($file['name'],  $dot+1));
		
		$tmp_name=$file["tmp_name"];
		$allowed_pic_types=array('jpg', 'jpeg', 'gif', 'bmp', 'png');
		
		if (is_uploaded_file($file['tmp_name'])) 
		{

			if(in_array(strtolower($ext), $allowed_pic_types))
				$type='pic';
			
			
			if($type)
			{
				$token=substr(time(), 5).'_'.uniqid();
				$dest_filename=$_SERVER['DOCUMENT_ROOT'].'/upload/images/'.$token.'.'.$ext;
				
				//if(1)
				if( move_uploaded_file($tmp_name, $dest_filename))	
				{
					return $token.'.'.$ext;
				}
			}
		}
	}
}










?>



<? include('footer.php');?>