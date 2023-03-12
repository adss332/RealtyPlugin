<?php

/**
 * Registers the `type_deal` taxonomy,
 * for use with 'realty'.
 */

namespace RealtyCore\Post_Types\Realty\Taxonomies;

class DealType
{

	public function __construct()
	{
		add_action('init', [$this, 'type_deal_init']);
	}

	public function type_deal_init(): void
	{

		register_taxonomy('type_deal', array('realty'), array(
			'labels' => array(
				'name' => 'Тип сделки',
				'singular_name' => 'Тип сделки',
				'search_items' => 'Search Тип сделки',
				'popular_items' => 'Popular Тип сделки',
				'all_items' => 'All Тип сделки',
				'parent_item' => 'Parent Тип сделки',
				'parent_item_colon' => 'Parent Тип сделки:',
				'edit_item' => 'Edit Тип сделки',
				'view_item' => 'View Тип сделки',
				'update_item' => 'Update Тип сделки',
				'add_new_item' => 'Add New Тип сделки',
				'new_item_name' => 'New Тип сделки Name',
				'separate_items_with_commas' => 'Separate Тип сделки with commas',
				'add_or_remove_items' => 'Add or remove Тип сделки',
				'choose_from_most_used' => 'Choose from the most used Тип сделки',
				'not_found' => 'No Тип сделки found.',
				'menu_name' => 'Тип сделки'
			),
			'public' => false,
			'hierarchical' => true, // для удобности выбора
			'query_var' => true, // query_var, чтобы запрос на термин работал...
			'publicly_queryable' => true, // query_var, чтобы запрос на термин работал...
			'rewrite' => array('slug' => 'estate', 'hierarchical' => false, 'with_front' => 0, 'feed' => 0),
			'show_ui' => true,
			'show_in_quick_edit' => true,
			'show_tagcloud' => false,
			'show_in_nav_menus' => false,
			'show_admin_column' => false,
		));

	}

}
