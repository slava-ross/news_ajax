<main>
	<div class="forms">
		<form method="post">
			<p><label><b>Логин:</b><br>
				<input type="text" name="login" value="<?php if( isset($_POST['login']) ) print $_POST['login']?>">
			</label></p>
			<p><label><b>Пароль:</b><br>
				<input type="password" name="password">
			</label></p>
			<p><input type="submit" name="submit" value="Вход"></p>
			<p>
				<?php
					if ( $vars['is_send'] == true ) {
						if ( count( $vars['errorMessages'] ) == 0 ) {
							print('<p class="message">Добро пожаловать, '.$_SESSION['login'].'!</p>');
						}
						else {
							foreach ( $vars['errorMessages'] as $errorMsg ) {
								print('<p class="error_msg">'.$errorMsg.'</p>'); 
							}
						}
					}
				?>
			</p>
		</form>
	</div>
</main>