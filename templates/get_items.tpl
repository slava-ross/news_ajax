<main>
	<div class="items" id="get_items_section">
		<h2>Товары</h2>
		<?php
			if ( count( $vars['errorMessages'] ) == 0 ) {
				if( is_array( $vars['itemsArray'] )) {
					foreach ( $vars['itemsArray'] as $i=>$item ) {
						print ('<div class="item_block" id="id-'.$i.'">');
						print ('<h3>'.$item['itemName'].'</h3>');
						print ('<p class="item_descr">'.$item['itemDescr'].'</p>'.'<p class="item_author">'.$item['itemAuthor'].'</p><p class="item_date">'.$item['itemDate'].'</p>');
						if ( $vars['auth'] ) {
							print ('<div>');
							print ('<p class="editing item_operation" attr-id="'.$i.'">Изменить</p>');
							print ('<p class="deleting item_operation" attr-id="'.$i.'">Удалить</p>');
							print ('</div>');
						}
						print ('</div>');
					}
				}
			}
			else {
				foreach ( $vars['errorMessages'] as $errorMsg ) {
					print('<p class="error_msg">'.$errorMsg.'</p>'); 
				}
			}
		?>
	</div>
	<div attr_id="" class="forms modal">
		<h2>Изменение товара</h2>
		<p><label>Наименование:<br>
			<input type="text" name="item_name" value="">
		</label></p>
		<p><label>Описание:<br>
			<textarea name="item_descr"></textarea>
		</label></p>
		<p><label>Автор:<br>
			<input type="text" name="item_author" value="">
		</label></p>
		<p><input type="submit" name="submit" value="Изменить"></p>
	</div>
</main>