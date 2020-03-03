<main>
	<div class="forms">
		<h2>Новый товар</h2>
		<form method="post">
			<p><label>Наименование:<br>
				<input type="text" name="item_name" value="<?php if( isset( $_POST['item_name'] )) print $_POST['item_name'] ?>">
			</label></p>
			<p><label>Описание:<br>
				<textarea name="item_descr"><?php if( isset( $_POST['item_descr'] )) print $_POST['item_descr'] ?></textarea>
			</label></p>
			<p><label>Автор:<br>
				<input type="text" name="item_author" value="<?php if( isset( $_POST['item_author'] )) print $_POST['item_author'] ?>">
			</label></p>
			<p><label>Дата:<br>
				<input type="date" name="item_date" value="<?php if( isset( $_POST['item_date'] )) print $_POST['item_date'] ?>">
			</label></p>
			<p><input type="submit" name="submit" value="Создать"></p>
			<p>
				<?php
					if ( $vars['is_send'] == true ) {
						if ( count( $vars['errorMessages'] ) == 0 ) {
							print('<p class="message">Товар создан!</p>');
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