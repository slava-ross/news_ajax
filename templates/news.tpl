<main>
	<div class="news" id="news_section">
		<h2>Новости</h2>
		<?php
			if ( count( $vars['errorMessages'] ) == 0 ) {
				if( is_array( $vars['newsArray'] ))
					foreach ( $vars['newsArray'] as $newsItem ) {
						print ('<div class="news_block">');
						print ('<h3>'.$newsItem['title'].'</h3>');
						print ('<p>'.$newsItem['content'].'</p>'.'<b>'.$newsItem['author'].'</b><br>'.$newsItem['date']);
						print ('</div>');
					}
			}
			else {
				foreach ( $vars['errorMessages'] as $errorMsg ) {
					print('<p class="error_msg">'.$errorMsg.'</p>'); 
				}
			}
		?>	
	</div>
</main>

