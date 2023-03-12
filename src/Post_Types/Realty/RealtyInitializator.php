<?php

namespace RealtyCore\Post_Types\Realty;

use RealtyCore\Post_Types\Realty\Taxonomies\CountRooms;
use RealtyCore\Post_Types\Realty\Taxonomies\DealType;
use RealtyCore\Post_Types\Realty\Taxonomies\RealtyType;
use StoutLogic\AcfBuilder\FieldsBuilder;

/**
 * Initialize the Realty
 */
class RealtyInitializator
{

	public function __construct()
	{
		// здесь происходит процесс глобальной регистрации ядра по сущности (CPT)
		// используются внутренние методы
		$this->register_cpt();
		$this->add_acf_fields();
		$this->add_taxes();
		$this->add_rewrite_rules();
	}

	private function register_cpt(): void
	{
		new RealtyRegisterCPT();
	}

	private function add_taxes(): void
	{
		new CountRooms();
		new RealtyType();
		new DealType();
	}

	private function add_rewrite_rules(): void
	{
		// инициализирует класс перезаписи url
		new RealtyRewrite();
	}

	private function add_acf_fields(): void
	{
		// регистрирует acf поля (как раз по поводу вопроса из ТЗ)
		$banner = new FieldsBuilder('Additional info');
		$banner
			->addText('unit_ref', [
				'label' => 'Unit Reference',
				'default_value' => '',
				'placeholder' => 'Enter text here',
				'maxlength' => 50,
			])
			->addText('property_name', [
				'label' => 'Property Name',
				'default_value' => '',
				'placeholder' => 'Enter text here',
				'maxlength' => 50,
			])
			->addNumber('price', [
				'label' => 'Price (AED)',
				'placeholder' => 'Enter a number',
				'min' => 0,
				'max' => 1000000000,
			])
			->addNumber('bedrooms', [
				'label' => 'Bedrooms',
				'placeholder' => 'Enter a number',
				'min' => 0,
				'max' => 10,
			])
			->addNumber('baths', [
				'label' => 'Baths',
				'placeholder' => 'Enter a number',
				'min' => 0,
				'max' => 5,
			])
			->addNumber('square', [
				'label' => 'Square (ft)',
				'placeholder' => 'Enter a number',
				'min' => 0,
				'max' => 10000,
			])
			->addNumber('permit_number', [
				'label' => 'Permit Number',
				'placeholder' => '71383570558',
				'min' => 0,
				'max' => 1000000000,
			])
			->addSelect('parking', [
				'label' => 'Parking',
				'default_value' => 'option_1',
				'choices' => [
					'option_1' => 'Attached Garage',
					'option_2' => 'Something',
				],
				'return_format' => 'value',
			])
			->setLocation('post_type', '==', 'realty');

		add_action('acf/init', function () use ($banner) {
			acf_add_local_field_group($banner->build());
		});
	}

}
