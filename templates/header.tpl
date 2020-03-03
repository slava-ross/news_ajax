<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<title><?php print $vars['title']; ?></title>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="<?php print $vars['styles']; ?>">
		<script src="js/jquery-3.4.1.min.js"></script>
	    <script type="text/javascript" src="js/main.js"></script>
	</head>
	<body>
		<header>
			<ul class="main_menu">
				<li><a href="index.php?page=main">Главная</a></li>
				<li><a href="index.php?page=about">О компании</a></li>
				<li><a href="index.php?page=news">Новости</a></li>
				<li><a href="index.php?page=get_items">Товары</a></li>
				<?php if( $vars['auth'] ): ?> <li><a href="index.php?page=add_item">Добавить товар</a></li> <?php endif; ?>
				<?php if( !$vars['auth'] ): ?> <li><a href="index.php?page=reg">Регистрация</a></li> <?php endif; ?>
				<?php if( !$vars['auth'] ): ?> <li><a href="index.php?page=auth">Вход</a></li> <?php endif; ?>
				<?php if( $vars['auth'] ): ?> <li><a href="index.php?page=exit">Выход</a></li> <?php endif; ?>
			</ul>
			<?php if( $vars['auth'] ) {print( '<div id="signed_in_user">User: '.$_SESSION['login'].'</div>' );} ?>
		</header>