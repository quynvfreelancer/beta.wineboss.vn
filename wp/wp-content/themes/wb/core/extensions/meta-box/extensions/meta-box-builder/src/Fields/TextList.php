<?php
namespace MBB\Fields;

class TextList extends Base {
	public function register_fields() {
		$fields = [
			'options' => ['type' => 'custom', 'content' => mbb_get_attribute_content( 'text-list-options' )],
		];
		$this->basic = array_slice( $this->basic, 0, 3, true ) + $fields + array_slice( $this->basic, 3, null, true );

		unset( $this->appearance['size'] );
		unset( $this->appearance['placeholder'] );
	}
}
