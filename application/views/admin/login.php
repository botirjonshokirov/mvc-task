<?php 

if(!empty($vars['loginError'])){
	echo '<div class="alert alert-danger" role="alert">'. $vars['loginError']. '</div>';
}

?>

<div class="m-4 row justify-content-center">
<form  method="POST">
	<div class="form-group">
		<label>Login</label>
		<input type="text" name="login" class="form-control">
	</div>
	<div class="form-group">
		<label>Password</label>
		<input type="text" name="password" class="form-control">
	</div>
	<div class="form-group">
		<button type="submit" name="check_login" class="btn btn-primary">Enter</button>
	</div>
</form>
</div>