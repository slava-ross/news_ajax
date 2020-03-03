<?php
	/**
	*	-D- Класс @items - операции с товарами: добавление, удаление, получение списка;
	*/
	class items {
		/**
		*	-V- @error{ array }: массив сообщений об ошибках, передаваемых в шаблон для отображения;
		*	-V- @fileName{ string }: путь и имя файла с информацией о товарах в формате JSON;
		*	-V- @itemsArr{ array }: массив с информацией о товарах, получаемой из файлов и передаваемый для дальнейших операций в другие объекты/методы приложения;
		*	-V- @returnArray{ array }: массив с возвращаемой методами класса информацией, который содержит как рабочую информацию, так и сообщения об ошибках;
		*	-V- @writeResult{ integer/boolean }: результат записи в файл: false - в случае возникновения ошибок, кол-во байт записанной информации - при успешном завершении;
		*/
		private $fileName = 'files/items.json';
		/**
		*	-D- @addItem - Метод выполняющий валидацию ввода полей описания товара и добавляющий информацию о товаре в файл;
		*
		*/
		public function addItem ( $itemName, $itemDescr, $itemAuthor, $itemDate ) {

			$errors = array();
			$itemsArr = array();
			$returnArray = array();
			$writeResult = NULL;

			if( empty( $itemName ) ) {
				$errors[] = "Укажите наименование товара!";
			}
			if( empty( $itemDescr ) ) {
				$errors[] = "Укажите описание товара!";
			}
			if( empty( $itemAuthor ) ) {
				$errors[] = "Укажите автора товара!";
			}
			if( empty( $itemDate ) ) {
				$errors[] = "Укажите дату создания товара!";
			}
			
			if( count( $errors )==0 ) {
				$item = array(
					"itemName" => $itemName,
					"itemDescr" => $itemDescr,
					"itemAuthor" => $itemAuthor,
					"itemDate" => $itemDate
				);
				$json = file_get_contents( $this->fileName );
				if ( !empty( $json ) ) {
					$itemsArr = json_decode( $json, true );
				}
				$itemsArr[] = $item;
				$writeResult = file_put_contents( $this->fileName, json_encode( $itemsArr ) );
				if ( $writeResult === false ) {
					$errors[] = "Ошибка записи в файл!";
				}
			}
			$returnArray['returnErrors'] = $errors;
			return $returnArray;
		}
		/**
		*	-D- @editItem - Метод выполняющий изменение информации о товаре;
		*
		*/
		public function editItem ( $itemId, $itemName, $itemDescr, $itemAuthor ) {

			$errors = array();
			$itemsArr = array();
			$returnArray = array();
			$writeResult = NULL;

			$json = file_get_contents( $this->fileName );
			if ( $json === false ) {
				$errors[] = "Ошибка чтения файла!";
			}
			else {
				$itemsArr = json_decode( $json, true );	
			}

			$itemsArr[ $itemId ]["itemName"] = $itemName;
			$itemsArr[ $itemId ]["itemDescr"] = $itemDescr;
			$itemsArr[ $itemId ]["itemAuthor"] = $itemAuthor;

			$writeResult = file_put_contents( $this->fileName, json_encode( $itemsArr ) );
			if ( $writeResult === false ) {
				$errors[] = "Ошибка записи в файл!";
			}
			$returnArray['returnErrors'] = $errors;
			return $returnArray;
		}
		/**
		*	-D- @delItem - Метод выполняющий удаление выбранного товара из файла;
		*
		*/
		public function delItem ( $itemIndex ) {

			$errors = array();
			$itemsArr = array();
			$returnArray = array();
			$writeResult = NULL;

			$json = file_get_contents( $this->fileName );
			$itemsArr = json_decode( $json, true );
			array_splice( $itemsArr, $itemIndex, 1 );
			$writeResult = file_put_contents( $this->fileName, json_encode( $itemsArr ) );
			if ( $writeResult === false ) {
				$errors[] = "Ошибка записи в файл!";
			}
			$returnArray['returnErrors'] = $errors;
			$returnArray['returnResult'] = $itemsArr;
			return $returnArray;
		}
		/**
		*	-D- @getItems - Метод для получения списка товаров из файла в массив;
		*
		*/
		public function getItems () {

			$errors = array();
			$itemsArr = array();
			$returnArray = array();

			$json = file_get_contents( $this->fileName );
			if ( $json === false ) {
				$errors[] = "Ошибка чтения файла!";
			}
			else {
				$itemsArr = json_decode( $json, true );	
			}
			$returnArray['returnErrors'] = $errors;
			$returnArray['returnResult'] = $itemsArr;
			return $returnArray;
		}
	}
?>