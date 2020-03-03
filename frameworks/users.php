<?php 
	/**
	*	-D- Класс @users - работа с пользователями - регистрация, авторизация, выход;
	*/
	class users {
		/**
		*	-V- @fileName{ string }: путь и имя файла с информацией о пользователях;
		*/
		private $fileName = 'files/reg.dat';
		/**
		*	-D- @auth - Метод выполняющий валидацию ввода полей авторизации пользователя и стартующий механизм сессии;
		*
		*/
		public function auth( $login, $password ) {
			/**
			*	-V- @errors{ array }: массив сообщений об ошибках, передаваемых в шаблон для отображения;
			*	-V- @returnArray{ array }: массив с возвращаемой методами класса информацией, который содержит как рабочую информацию, так и сообщения об ошибках;
			*/
			 $errors = array();
			 $returnArray = array();

			if( empty( $login )) {
				$errors[] = "Укажите Ваш логин!";
			}
			if( empty( $password )) {
				$errors[] = "Укажите Ваш пароль!";
			}
			if( count( $errors ) == 0 ) {
				$userFound = false;
				$handle = fopen( $this->fileName, "r" );
				if ( $handle ) {
					while (( $line = fgets( $handle )) !== false ) {
						$arrUser = explode( ";",$line );
						if ( $login == $arrUser[3] ) {
							$userFound = true;
							if ( $password == $arrUser[4] ) {
								$_SESSION['login'] = $login;
								break;
							}
							else {
								$errors[] = "Неверный пароль!";
								break;
							}	
						}
					}
					fclose( $handle );
					if ( !$userFound ) {
						$errors[] = "Незарегистрированный пользователь!";
					}
				} else {
					$errors[] = "Ошибка чтения файла!";
				}
			}
			$returnArray['returnErrors'] = $errors;
			return $returnArray;
		}
		/**
		*	-D- @auth - Метод выполняющий проверку авторизации пользователя по сессионной переменной;
		*
		*/
		public function isAuth() {
			if ( !empty( $_SESSION['login'] )) return true;
			else return false;
		}
		/**
		*	-D- @auth - Метод прекращающий состояние авторизации пользователя и возвращающий его логин;
		*
		*/
		public function logout() {
			/**
			*	-V- @userName{ string }: логин пользователя возвращаемый в вызывающий класс;
			*/
			if ( isset( $_SESSION['login'] )) {
				$userName = $_SESSION['login'];
				unset ( $_SESSION['login'] );
				return $userName;	
			}
		}
		/**
		*	-D- @auth - Метод выполняющий валидацию ввода полей регистрации пользователя и записывающий информацию о пользователе в файл;
		*
		*/
		public function reg( $firstName, $lastName, $patronymic, $login, $password, $gender, $city ) {
			/**
			*	-V- @writeResult{ integer/boolean }: результат записи в файл: false - в случае возникновения ошибок, кол-во байт записанной информации - при успешном завершении;
			*/
			 $errors = array();
			 $returnArray = array();
			 $writeResult = NULL;

			if( empty( $firstName ) ) {
				$errors[] = "Укажите Ваше имя!";
			}
			if( empty( $login ) ) {
				$errors[] = "Укажите Ваш логин!";
			}
			if( empty( $password ) ) {
				$errors[] = "Укажите Ваш пароль!";
			}
			if( count( $errors )==0 ) {
				$data = $firstName.";".$lastName.";".$patronymic.";".$login.";".$password.";".$gender.";".$city.PHP_EOL;
				$writeResult = file_put_contents( $this->fileName, $data, FILE_APPEND | LOCK_EX );
				if ( $writeResult === false ) {
					$errors[] = "Ошибка записи в файл!";
				}
			}
			$returnArray['returnErrors'] = $errors;
			return $returnArray;
		}
	}  
?>