<?php

if(!defined('WP_UNINSTALL_PLUGIN')){
	die;
}

// Удаление страниц
$page_slugs = array( 'buy', 'rent' );

foreach ( $page_slugs as $slug ) {
	$page = get_page_by_path( $slug );
	if ( $page ) {
		wp_delete_post( $page->ID, true );
	}
}

// Удаление постов realty
$realties = get_posts(array('post_type'=>'realty','numberposts'=>-1));

foreach ($realties as $realty){
	wp_delete_post($realty->ID,true);
}

// Удаление таксономии type_deal
$dealTypes = get_terms( 'type_deal' );

foreach ($dealTypes as $dealType){
	wp_delete_term($dealType->ID,'type_deal');
}

// Удаление таксономии type_realty
$realtyTypes = get_terms( 'type_realty' );

foreach ($realtyTypes as $realtyType){
	wp_delete_term($realtyType->ID,'type_realty');
}

// Удаление таксономии count_rooms
$RoomsCounts = get_terms( 'count_rooms' );

foreach ($RoomsCounts as $RoomsCount){
	wp_delete_term($RoomsCount->ID,'count_rooms');
}
