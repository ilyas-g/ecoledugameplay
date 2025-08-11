<?php

namespace WPSpeedo_Team;

if ( ! defined('ABSPATH') ) exit;

class Control_Hidden extends Base_Data_Control {
	
	public function get_type() {
		return 'hidden';
	}

	public function get_value( $control, $settings ) {
		$value = parent::get_value( $control, $settings );
		if ( !empty($value['value']) ) {
			$value['value'] = sanitize_text_field( $value['value'] );
		}
		return $value;
	}
	
	protected function get_default_settings() {
		return [
			'input_type' => 'hidden'
		];
	}

}