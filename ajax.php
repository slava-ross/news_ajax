<?php
	include ('frameworks/items.php');
	$itemsSource = new items;
	$action = $_GET['action'];
	switch( $action ) {
		case 'del':
			$itemsSource->delItem( $_GET['item_id'] );
			print ( 'deleted' );
		break;
		case 'edit':
			$itemsSource->editItem( $_GET['item_id'], $_GET['item_name'], $_GET['item_descr'], $_GET['item_author']);
			print ( 'edited' );
		break;
		default:
			print ( 'nonexistent function' );
	}
?>