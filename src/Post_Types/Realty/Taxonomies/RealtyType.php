<?php

/**
 * Registers the `type_realty` taxonomy,
 * for use with 'realty'.
 */

namespace RealtyCore\Post_Types\Realty\Taxonomies;

class RealtyType
{

	public function __construct()
	{
		add_action('init', [$this, 'type_realty_init']);
	}

	public function type_realty_init(): void
	{

		register_taxonomy('type_realty', array('realty'), array(
			'labels' => array(
				'name' => 'Тип недвижимости',
				'singular_name' => 'Тип недвижимости',
				'search_items' => 'Search Тип недвижимости',
				'popular_items' => 'Popular Тип недвижимости',
				'all_items' => 'All Тип недвижимости',
				'parent_item' => 'Parent Тип недвижимости',
				'parent_item_colon' => 'Parent Тип недвижимости:',
				'edit_item' => 'Edit Тип недвижимости',
				'view_item' => 'View Тип недвижимости',
				'update_item' => 'Update Тип недвижимости',
				'add_new_item' => 'Add New Тип недвижимости',
				'new_item_name' => 'New Тип недвижимости Name',
				'separate_items_with_commas' => 'Separate Тип недвижимости with commas',
				'add_or_remove_items' => 'Add or remove Тип недвижимости',
				'choose_from_most_used' => 'Choose from the most used Тип недвижимости',
				'not_found' => 'No Тип недвижимости found.',
				'menu_name' => 'Тип недвижимости'
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
