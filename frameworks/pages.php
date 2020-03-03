<?php
	/**
	*	-D- @pages - Класс "сборщика страниц" (Page Controller);
	*
	*/
	class pages {
		/**
		*	-D- @getTemplate - Метод подключения шаблона с передачей ему необходимых для отображения страницы параметров;
		*
		*/
		public function getTemplate( $file, $vars=array() ) {
			include( $file );
		}
		/**
		*	-D- @router - Основной метод задающий "маршрут" приложения для генерации соответствующей страницы;
		*
		*/
		public function router( $page ) {
			
			include( 'frameworks/users.php' );
			/**
			*	-V- @users{ users }: экземпляр объекта, работающего с пользователями (регистрация, авторизация, создание сессии);
			*	-V- @authorized{ boolean }: флаг подтверждения авторизации;
			*	-V-,-D- @mainMessage{ string }: информация, отображаемая на главной странице (здесь происходит инициализация для последующего анализа и применения);
			*/
			$users = new users;
			$authorized = $users->isAuth();
			$mainMessage = '';
			/**
			*	-D- Основной механизм ветвления (выбора "пути" для генерации нужной страницы);
			*
			*/
			switch( $page ) {
				/**
				*	-D- Ветвь создания и отображения страницы "О компании";
				*
				*/
				case 'about':
					$this->getTemplate( 'templates/header.tpl',
						array(
							'title'=>'О нас',
							'styles'=>'css/about.css',
							'auth'=>$authorized
						)
					);
					$this->getTemplate( 'templates/about.tpl' );
					$this->getTemplate( 'templates/footer.tpl' );
				break;
				/**
				*	-D- Ветвь создания и отображения страницы "Новости";
				*
				*/
				case 'news':
					include ('frameworks/news.php');
					/**
					*	-V- @newsSource{ news }: экземпляр объекта новостей;
					*	-V- @result{ array }: массив с результатами работы методов объекта, содержащий как рабочую информацию, так и сообщения об ошибках;
					*/
					$newsSource = new news;
					$result = array();
					$result = $newsSource->getNews();
					//var_dump( $result );					
					$this->getTemplate( 'templates/header.tpl',
						array(
							'title'=>'Новости',
							'styles'=>'css/news.css',
							'auth'=>$authorized
						)
					);
					$this->getTemplate( 'templates/news.tpl',
						array(
							'newsArray' => $result['returnResult'],
							'errorMessages' => $result['returnErrors']
						)
					 );
					$this->getTemplate( 'templates/footer.tpl' );
				break;
				/**
				*	-D- Ветвь создания и отображения страницы "Товары";
				*	-D- Здесь же происходит отработка удаления товара из списка и последующее его отображение;
				*/
				case 'del_item':
				case 'get_items':
					/**
					*	-V- @itemsSource{ items }: экземпляр объекта, работающего с товарами (отображение списка, добавление, удаление);
					*	-V- @result{ array }: массив с результатами работы методов объекта, содержащий как рабочую информацию, так и сообщения об ошибках;
					*/
					include ('frameworks/items.php');
					$itemsSource = new items;
					$result = array();

					if ( isset( $_GET['item_id'] )) {
						$result = $itemsSource->delItem( $_GET['item_id'] );
					}
					else {
						$result = $itemsSource->getItems();
					}
					$this->getTemplate( 'templates/header.tpl',
						array(
							'title'=>'Список товаров',
							'styles'=>'css/get_items.css',
							'auth'=>$authorized
						)
					);
					$this->getTemplate( 'templates/get_items.tpl',
						array(
							'itemsArray' => $result['returnResult'],
							'errorMessages' => $result['returnErrors'],
							'auth'=>$authorized
						)
					);
					$this->getTemplate( 'templates/footer.tpl' );
				break;
				/**
				*	-D- Ветвь создания и отображения страницы "Добавить товар";
				*
				*/
				case 'add_item':
					include ('frameworks/items.php');
					$itemsSource = new items;
					$result = array();

					$this->getTemplate( 'templates/header.tpl',
						array(
							'title'=>'Добавление товара',
							'styles'=>'css/add_item.css',
							'auth'=>$authorized
						)
					);
					if( isset( $_POST['submit'] )) {
						if ( !isset( $_POST['gender'] )) $_POST['gender'] = '';
						if ( !isset( $_POST['city'] )) $_POST['city'] = '';
						$result = $itemsSource->addItem( $_POST['item_name'], $_POST['item_descr'], $_POST['item_author'], $_POST['item_date'] );

						$this->getTemplate( 'templates/add_item.tpl',
							array(
								'is_send' => true,
								'errorMessages' => $result['returnErrors']
							)
						);
					}
					else {
						$this->getTemplate( 'templates/add_item.tpl', array( 'is_send' => false ));
					}
					$this->getTemplate( 'templates/footer.tpl' );
				break;
				/**
				*	-D- Ветвь создания и отображения страницы "Регистрация";
				*
				*/
				case 'reg':
					$result = array();

					$this->getTemplate( 'templates/header.tpl',
						array(
							'title'=>'Регистрация',
							'styles'=>'css/reg.css',
							'auth'=>$authorized
						)
					);
					
					if( isset( $_POST['submit'] )) {
						$result = $users->reg( $_POST['firstname'], $_POST['lastname'], $_POST['patronymic'], $_POST['login'], $_POST['password'], $_POST['gender'], $_POST['city'] );
					
						$this->getTemplate('templates/reg.tpl',
							array(
								'is_send' => true,
								'errorMessages' => $result['returnErrors']
							)
						);
					}
					else {
						$this->getTemplate('templates/reg.tpl',	array( 'is_send' => false ));
					}
					$this->getTemplate( 'templates/footer.tpl' );
				break;
				/**
				*	-D- Ветвь создания и отображения страницы "Вход" (Авторизация);
				*
				*/
				case 'auth':
					/**
					*	-V- @templateVars{ array }: массив переменных, передаваемый в шаблон для генерации информации отображаемой на странице;
					*	-V- @result{ array }: массив с результатами работы методов объекта, содержащий как рабочую информацию, так и сообщения об ошибках;
					*/
					$templateVars = array();
					$result = array();
					
					if( isset($_POST['submit']) ) {
						$result = $users->auth( $_POST['login'], $_POST['password'] );
						$templateVars['is_send'] = true;
						$templateVars['errorMessages'] = $result['returnErrors'];
					}
					else {
						$templateVars['is_send'] = false;
					}

					$authorized = $users->isAuth();
					
					$this->getTemplate( 'templates/header.tpl',
						array(
							'title'=>'Вход',
							'styles'=>'css/auth.css',
							'auth'=>$authorized
						)
					);
					$this->getTemplate( 'templates/auth.tpl', $templateVars );
					$this->getTemplate( 'templates/footer.tpl' );
				break;
				/**
				*	-D- Ветвь выхода пользователя из авторизованного состояния (пункт меню "Выход");
				*
				*/
				case 'exit':
					$mainMessage = 'Goodbye, '.$users->logout().'!';
					$authorized = $users->isAuth();
				/**
				*	-D- Ветвь "по-умолчанию" - отображается главная страница сайта;
				*
				*/
				case 'main':
				default:
					$this->getTemplate( 'templates/header.tpl',
						array(
							'title'=>'Dharma Initiative - Home page',
							'styles'=>'css/main.css',
							'auth'=>$authorized
						)
					);
					$this->getTemplate( 'templates/main.tpl',
						array(
							'message'=>$mainMessage
						)
					);
					$this->getTemplate( 'templates/footer.tpl' );
			}
		}
	}
?>