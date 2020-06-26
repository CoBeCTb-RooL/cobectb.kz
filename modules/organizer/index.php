<? 
$title="ай Салем! ";
include ($_SERVER['DOCUMENT_ROOT']."/header.php");
?>


<script>
function reg()
{
	 var str = $("#login_form").serializeArray();
	
	 $.post('ajax.php?action=login', str, 
			function(str){
				alert(str)
				
				
	        });
}
</script>

<div id="login-form">
	<form name="login_form" id="login_form" method="post" action="">
		логин? <input type="text" name="login" ><br>
		пароль? <input type="password" name="pass" ><br>
		<input type="button" id="go_btn" onclick="reg()" value="go!">
	</form>
</div>



<? include ($_SERVER['DOCUMENT_ROOT']."/template_footer.php");?>