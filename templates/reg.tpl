<main>
	<div class="forms">
		<form method="post">
			<p><label><b>Ваша фамилия:</b><br>
				<input type="text" name="lastname" placeholder="Фамилия" value="<?php if( isset( $_POST['lastname'] )) print $_POST['lastname'] ?>">
			</label></p>
			<p><label><b>Ваше имя:</b><br>
				<input type="text" name="firstname" placeholder="Имя" value="<?php if( isset( $_POST['firstname'] )) print $_POST['firstname'] ?>">
			</label></p>
			<p><label><b>Ваше отчество:</b><br>
				<input type="text" name="patronymic" placeholder="Отчество" value="<?php if( isset( $_POST['patronymic'] )) print $_POST['patronymic'] ?>">
			</label></p>
			<p><label><b>Логин:</b><br>
				<input type="text" name="login" placeholder="Логин" value="<?php if( isset( $_POST['login'] )) print $_POST['login'] ?>">
			</label></p>
			<p><label><b>Пароль:</b><br>
				<input type="password" name="password" placeholder="********">
			</label></p>
			<p><b>Ваш пол:</b><br>
				<label>Мужской:<input type="radio" name="gender" value="male" <?php if( isset( $_POST['gender'] )) { if( $_POST['gender']=='male' ) print( 'checked="checked"' ); } ?> ></label>
				<label>Женский:<input type="radio" name="gender" value="female" <?php if( isset( $_POST['gender'] )) { if( $_POST['gender']=='female' ) print( 'checked="checked"'); } ?> ></label>
			</p>
			<p><b>Ваш город:</b><br>
				<select size="3" name="city">
					<option value="Izhevsk" <?php if( isset( $_POST['city'] )) { if( $_POST['city']=='Izhevsk' ) print( 'selected="selected"' ); } ?>>Ижевск</option>
					<option value="Moscow" <?php if( isset( $_POST['city'] )) { if( $_POST['city']=='Moscow' ) print( 'selected="selected"' ); } ?>>Москва</option>
					<option value="SanktPetersburg" <?php if( isset( $_POST['city'] )) { if( $_POST['city']=='SanktPetersburg' ) print( 'selected="selected"' ); } ?>>С. Петербург</option>
				</select>
			</p>		
			<p><input type="submit" name="submit" value="Регистрация"></p>
			<p>
				<?php
					if ( $vars['is_send'] == true ) {
						if ( count( $vars['result'] ) == 0 ) {
							print('<p class="message">Спасибо за регистрацию!</p>');
						}
						else {
							$errorsArr = $vars['result'];
							foreach ($errorsArr as $errorMsg) {
								print('<p class="error_msg">'.$errorMsg.'</p>'); 
							}
						}
					}
				?>
			</p>
		</form>
	</div>
</main>