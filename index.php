<?php
	/**
	*	-A- Автор - Ягодаров Ярослав Владимирович
	*	-D- WEB-приложение реализованное с помощью шаблона проектирования MVC (Model-Controller-View);
	*	-D- Состав приложения: Файлы фреймворка: pages.php - page-controller; items.php, news.php, users.php - модели;
	*	-D- about.tpl, add_item.tpl, auth.tpl, footer.tpl, get_items.tpl, header.tpl, main.tpl, news.tpl, reg.tpl - шаблоны представлений;
	*	-D- items.json - файл для хранения информации о товарах, кодированной в формате json;
	*	-D-	news.dat - файл новостей, каждая новость в отдельной строке, разделитель информационных полей - "/;/" ;
	*	-D- reg.dat - файл зарегистрированных пользователей, каждый пользователь в отдельной строке, разделитель информационных полей - ";" ;
	*	-D- Файлы CSS-оформления: style.css - файл общих свойств для всего приложения (всех страниц);
	*	-D- about.css, add_item.css, auth.css, get_items.css, main.css, news.css, reg.css - файлы для оформления соответствующих страниц;
	*	-Date- 2019.08.02
	*/
	header('Content-Type: text/html; charset=utf-8');
	session_start();
	include ('frameworks/pages.php');
	$pages = new pages;
	if ( !isset( $_GET['page'] )) {
	    $_GET['page'] = 'none';
	}
	$pages->router( $_GET['page'] );
?>