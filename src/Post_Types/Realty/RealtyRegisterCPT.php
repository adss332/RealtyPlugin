<?php

/**
 * Registers the `realty` post type.
 */

namespace RealtyCore\Post_Types\Realty;

class RealtyRegisterCPT
{

	public function __construct()
	{
		add_action('init', [$this, 'realty_init']);
	}

	public function realty_init(): void
	{
		// post_type realty
		register_post_type('realty', array(
			'description' => 'Объявления о продаже недвижимости за рубежом.',
			'labels' => array(
				'name' => 'Объявления',
				'singular_name' => 'Объявление',
				'add_new' => 'Добавить новое',
				'add_new_item' => 'Добавить объявление',
				'edit_item' => 'Изменить объявление',
				'new_item' => 'Новое объявление',
				'view_item' => 'Посмотреть объявления',
				'search_items' => 'Поиск объявлений',
				'not_found' => 'Не найдено ни одного объявления',
				'not_found_in_trash' => 'Объявлений в корзине не найдено',
				'parent_item_colon' => 'Parent Объявление:',
				'all_items' => 'Все объявления',
				'menu_name' => 'Объявления'
			),
			'taxonomies' => array('type_deal', 'type_realty', 'count_rooms'),
			'public' => true,
			'query_var' => true,
			'rewrite' => false,
			'show_in_menu' => true,
			'has_archive' => false,
			'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields', 'revisions'),
			'show_ui' => true,
			'show_in_nav_menus' => false,
		));
	}

}
