<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<title>Login</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />	
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>styles/login.css">	
	<link href="images/favicon.ico" rel="SHORTCUT ICON" />
</head>
<body>
	<center>
	<div id="loginWrapper">
		<div id="loginBox">	
			<div id="loginBox-head">
				<h1>ADMINISTRATOR LOGIN </h1>
			</div>			
			<div id="loginBox-body">
				<?=form_open('', array('id' => 'form-login'));?>
					<label for="aid_username">Username</label>					
					<input type="text" id="aid_username" name="username"/>
					<br /><?=form_error('username')?>
					<label for="aid_password">Password</label>
					
					<input type="password" id="aid_password" name="password"/>
					<br /><?=form_error('password')?>
					<label> </label>
					<input type="submit" value="Login" class="button" />					
				<?=form_close();?>
			</div>
			<div id="loginBox-foot"></div>
		</div>
	</div>
	</center>
</body>
</html>
