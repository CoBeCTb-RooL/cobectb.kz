<?


function login_form()
{
	
	
	//echo md5(123);
	echo '
	<form name="login_form" action="" method="post">
	<table >
		<tr>
			<td>логин:</td>
			<td><input type="text" name="login"></td>
		</tr>
		<tr>
			<td>пароль:</td>
			<td><input type="password" name="password"></td>
		</tr>
		<tr>
			<td colspan="2" ><input type="submit" class="btn" name="login_btn" value="войти"></td>
		</tr>
	</table>
	</form>
	';
}




function authorized()
{
	if($_POST['logout_btn'])
	{
		unset($_SESSION['auth']);
		unset($_SESSION['id']);
		unset($_SESSION['name']);
		unset($_SESSION['login']);
		
	}
	
	if($_SESSION['auth'])
		return true;
	
	if($_POST['login_btn'])
	{
		$login=mysql_real_escape_string($_POST['login']);
		$password=mysql_real_escape_string($_POST['password']);
		
		$sql="select * from admin where login='".$login."' and password='".md5($password)."'";
		$qr=mysql_query($sql);
		$next=mysql_fetch_array($qr, MYSQL_ASSOC);
//		vd($next);
		if(mysql_num_rows($qr))
		{
			$_SESSION['auth']=true;
			$_SESSION['id']=$next['id'];
			$_SESSION['name']=$next['name'];
			$_SESSION['login']=$next['login'];
			return true;
		}
	}
	
}





?>