<?php

/**
 * Registers the `type_realty` taxonomy,
 * for use with 'realty'.
 */

namespace RealtyCore\Post_Types\Realty;

class RealtyRewrite
{

	public function __construct()
	{
		add_filter('type_deal' . '_rewrite_rules', [$this, 'add_more_country_rewrite_rules']);
		add_filter('pre_handle_404', [$this, 'realty_404_test']);
	}

	public function type_deal_elements(): array
	{
		$realty_terms = get_terms(array('taxonomy' => 'type_deal', 'hide_empty' => 0, 'fields' => 'id=>slug'));

		return $realty_terms;
	}

	public function add_more_country_rewrite_rules(array $rules): array
	{
		$language_slug = '';
		if (defined('ICL_LANGUAGE_CODE')) {
			$language_slug = ICL_LANGUAGE_CODE !== ICL_LANGUAGE_CODE_DEFAULT ? ICL_LANGUAGE_CODE . '/' : '';
		}

		$_first_part = $language_slug . '(' . implode('|', $this->type_deal_elements()) . ')/(.+?)';
		$_pade_part = 'page/?([0-9]{1,})';
		$more_riles = array(
			"$_first_part/(.+?)/$_pade_part/?$" => 'index.php?type_deal=$matches[1]&type_realty=$matches[2]&count_rooms=$matches[3]&paged=$matches[4]',
			"$_first_part/$_pade_part/?$" => 'index.php?type_deal=$matches[1]&type_realty=$matches[2]&paged=$matches[3]',
			"$_first_part/(.+?)/?$" => 'index.php?type_deal=$matches[1]&type_realty=$matches[2]&count_rooms=$matches[3]',
			"$_first_part/?$" => 'index.php?type_deal=$matches[1]&type_realty=$matches[2]',
		);

		$rules = array_merge($more_riles, $rules);

		return $rules;
	}

	public function realty_404_test($false): bool
	{
		if (!get_queried_object()) return $false; // ничего не делает...
		$_404 = false;

		if (is_tax(['type_deal', 'type_realty', 'count_rooms'])) {
			if (!$_404 && ($term_name = get_query_var('type_deal')) && !get_term_by('slug', $term_name, 'type_deal'))
				$_404 = 1;

			if (!$_404 && ($term_name = get_query_var('type_realty')) && !get_term_by('slug', $term_name, 'type_realty'))
				$_404 = 1;

			if (!$_404 && ($term_name = get_query_var('count_rooms')) && !get_term_by('slug', $term_name, 'count_rooms'))
				$_404 = 1;
		}

		if ($_404) {
			global $wp_query;

			$wp_query->set_404();
			status_header(404);
			nocache_headers();

			return 1; // обрываем следующие проверки
		}

		return $false; // ничего не делает...
	}

}
