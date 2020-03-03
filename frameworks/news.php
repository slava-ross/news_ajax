<?php
	/**
	*	-D- Класс @news - работа с новостями;
	*/
	class news {
		/**
		*	-D- @getNews - Метод чтения информации о новостях из файла и возврат её в виде массива;
		*
		*/
		public function getNews () {
			/**
			*	-V- @error{ array }: массив сообщений об ошибках, передаваемых в шаблон для отображения;
			*	-V- @fileName{ string }: путь и имя файла с информацией о товарах в формате JSON;
			*	-V- @newsArr{ array }: массив с информацией о новостях, получаемой из файлов и передаваемый для дальнейших операций в другие объекты/методы приложения;
			*	-V- @returnArray{ array }: массив с возвращаемой методами класса информацией, который содержит как рабочую информацию, так и сообщения об ошибках;
			*/
			$errors = array();
			$fileName = 'files/news.dat';
			$newsArr = array();
			$returnArray = array();

			$handle = fopen( $fileName, "r" );
			if ( $handle ) {
				while (( $line = fgets($handle) ) !== false ) {
					$newsLine = explode( "/;/",$line );
					$newsArr[] = array(
						'title' => $newsLine[0],
						'content' => $newsLine[3],
						'author' => $newsLine[2],
						'date' => $newsLine[1]						
					);
				}
				fclose( $handle );
				$returnArray['returnResult'] = $newsArr;
			} else {
				$errors[] = "Ошибка чтения файла!";
			}
			$returnArray['returnErrors'] = $errors;
			return $returnArray;
		}
	}