		<main>
			<div class="main_section">
		        <div class="main_block">
					<?php 
						if ( $vars['message'] == '' ) {
							print ('<h2>Добро пожаловать на наш сайт!</h2>
								<p>В нашем магазине Вы можете приобрести уникальные высокотехнологичные товары. Для этого потребуется зарегистрироваться и авторизоваться на сайте.</p>'
							);
						}
						else print ( $vars['message'] );
					?>
				</div>
			</div>
		</main>
