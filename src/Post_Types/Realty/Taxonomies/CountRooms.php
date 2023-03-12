<?php

/**
 * Registers the `count_rooms` taxonomy,
 * for use with 'realty'.
 */

namespace RealtyCore\Post_Types\Realty\Taxonomies;

class CountRooms
{

	public function __construct()
	{
		add_action('init', [$this, 'count_rooms_init']);
	}

	public function count_rooms_init(): void
	{

		register_taxonomy('count_rooms', array('realty'), array(
			'labels' => array(
				'name' => 'Количество комнат',
				'singular_name' => 'Количество комнат',
				'search_items' => 'Search Количество комнат',
				'popular_items' => 'Popular Количество комнат',
				'all_items' => 'All Количество комнат',
				'parent_item' => 'Parent Количество комнат',
				'parent_item_colon' => 'Parent Количество комнат:',
				'edit_item' => 'Edit Количество комнат',
				'view_item' => 'View Количество комнат',
				'update_item' => 'Update Количество комнат',
				'add_new_item' => 'Add New Количество комнат',
				'new_item_name' => 'New Количество комнат Name',
				'separate_items_with_commas' => 'Separate Количество комнат with commas',
				'add_or_remove_items' => 'Add or remove Количество комнат',
				'choose_from_most_used' => 'Choose from the most used Количество комнат',
				'not_found' => 'No Количество комнат found.',
				'menu_name' => 'Количество комнат'
			),
			'public' => false,
			'rewrite' => false,
			'hierarchical' => true,
			'query_var' => true, // query_var, чтобы запрос на термин работал...
			'publicly_queryable' => true, // query_var, чтобы запрос на термин работал...
			'show_ui' => true,
			'show_in_quick_edit' => true,
			'show_tagcloud' => false,
			'show_admin_column' => false,
			'show_in_nav_menus' => false,
		));

	}

}
