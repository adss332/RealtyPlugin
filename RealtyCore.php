<?php
/**
 * Plugin Name:     Custom Realty
 * Plugin URI:      none
 * Description:     Custom Realty
 * Author:          Nik Nyn
 * Author URI:      none
 * Text Domain:     realty
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Realty
 */

// Автолоадер для плагина по psr-4, чтобы пользоваться пространством имен (настройки в composer.json)
// для перегенерации используется composer dump-autoload
if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
	require_once dirname(__FILE__) . '/vendor/autoload.php';
}

use RealtyCore\Post_Types\Realty\RealtyInitializator;

// Эта проверка нужна для безопасности и предотвращения выполнения скрипта за пределами директории WordPress.
if (!defined('ABSPATH')) {
	die;
}

class MyRealtyCore
{
	public function __construct(
		public RealtyInitializator $realtyPostType,
	)
	{
		// небольшая фича, разрешает использовать тип файла svg в медиафайлах
		add_filter('upload_mimes', [$this, 'svg_upload_allow']);
	}

	public function taxonomy_template($template)
	{
		// подключает шаблон, если используется страница таксономии, либо buy|rent
		if (is_tax() || is_page('buy') || is_page('rent')) {
			return plugin_dir_path(__FILE__) . 'templates/taxonomy.php';
		}
		return $template;
	}

	public function svg_upload_allow($mimes)
	{
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}

	static function activation(): void
	{
		// Массив данных для создания страниц buy|rent (но это все равно термины таксономии type_deal)
		$pages = array(
			array(
				'post_title' => 'Buy', // Название страницы
				'post_name' => 'buy', // Слаг страницы
				'post_status' => 'publish', // Статус опубликованной страницы
				'post_type' => 'page', // Тип записи - страница
			),
			array(
				'post_title' => 'Rent', // Название страницы
				'post_name' => 'rent', // Слаг страницы
				'post_status' => 'publish', // Статус опубликованной страницы
				'post_type' => 'page', // Тип записи - страница
			),
		);

		// Цикл для создания страниц
		foreach ($pages as $page) {
			// Проверяем, существует ли страница с таким же слагом
			$page_exists = get_page_by_path($page['post_name']);
			// Если страницы с таким же слагом нет, создаем новую страницу
			if (!$page_exists) {
				// Вставляем новую страницу в базу данных
				$page_id = wp_insert_post($page);
			}
		}

		// перезаписывает permalinks
		flush_rewrite_rules();
	}

	static function deactivation(): void
	{
		// перезаписывает permalinks
		flush_rewrite_rules();
	}
}

if (class_exists("MyRealtyCore")) {
	// процесс инициализации основного класса при активации плагина
	$myRealtyCore = new MyRealtyCore(
		new RealtyInitializator(),
	);
	// хуки хелперы
	add_filter('template_include', [$myRealtyCore, 'taxonomy_template']);
	register_activation_hook(__FILE__, [$myRealtyCore, 'activation']);
	register_deactivation_hook(__FILE__, [$myRealtyCore, 'deactivation']);
}

