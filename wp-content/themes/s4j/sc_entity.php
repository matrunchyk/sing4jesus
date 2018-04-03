<?php

/**
 * Class SC_Entity
 *
 * @method int getID()
 * @method void setID()
 * @author Sergii Matrunchyk
 */
class SC_Entity
{
	protected $type = 'entity';
	protected $data = array();

	public function load($source = array())
	{
		$pl = strlen($this->type . '_');
		foreach ( $source as $rk =>  $rv ) {
			if (strlen($rk) > $pl && substr($rk, 0, $pl - 1) == $this->type) {
				$fld = $rk;
				$this->data[$fld] = $rv;
			}
		}

		return $this;
	}

	public function __call($method, $args)
	{
		if (strlen($method) < 3) return false;
		$fld = $this->methodToField($method);

		switch (strtolower(substr($method, 0, 3)))
		{
			case 'get':
				return $this->data[$this->type . '_' . $fld];

			case 'set':
				if (empty($args) || empty($args[0])) return false;

				$this->data[$this->type . '_' . $fld] = $args[0];
				break;

			default:
				return false;
		}

		return $this;
	}

	public function __toString()
	{
		return $this->getShortName();
	}

	protected function getShortName()
	{
		return $this->type . '_' . date('Ymd');
	}

	protected function getData($fld = null)
	{
		if (isset($this->data[$fld]))
			return $this->data[$fld];
		elseif (isset($fld))
			return false;

		return $this->data;
	}

	public function save()
	{
		$valResult = $this->validate();

		if (is_wp_error($valResult))
			return $valResult;

		if (!$this->preSave())
			return false;

		$insRes = wp_insert_post(
			array(
				'comment_status'  => 'closed',
				'ping_status'   => 'closed',
				'post_author'   => 1,
				'post_name'   => $this->__toString(),
				'post_title'    => $this->__toString(),
				'post_status'   => 'publish',
				'post_type'   => $this->type
			)
		);

		if (is_wp_error($insRes))
			return false;

		$this->setID($insRes);

		$this->postSave($insRes);

		foreach ($this->getData() as $k => $v) {
			update_post_meta($insRes, $k, $v);
		}

		return $this;
	}

	protected function getEntityBy($key, $val)
	{
		$entities = $this->getEntitiesBy($key, $val);

		if (!count($entities))
			return null;

		return $entities[0];
	}

	protected function getEntitiesBy($key, $val)
	{
		$args = array(
			'post_type'		=>	$this->type,
			'post_status'   => 'publish',
			'meta_query'	=>	array(
				array(
					'key' => $key,
					'value'	=>	$val
				)
			)
		);
		/** @var WP_Query $getResult */
		$getResult = new WP_Query( $args );

		if (!$getResult->post_count)
			return null;

		return $getResult->get_posts();
	}



	protected function methodToField($method)
	{
		return strtolower(preg_replace('/([A-Z]{1}[a-z]+)([A-Z]{1}[a-z]+)/', '$1_$2', substr($method, 3)));
	}

	protected function preSave()
	{
		return true;
	}

	protected function postSave($id)
	{
		return true;
	}

	protected function validate()
	{
		foreach ($this->getValidationFields() as $f) {
			if (empty($this->getData($f))) {
				$WP_Error = new WP_Error();
				$WP_Error->add('validation_invalid', 'validation_invalid_' . $f);

				return $WP_Error;
			}
		}

		return true;
	}

	protected function getValidationFields()
	{
		return array();
	}

	protected function hasFilesToUpload($id)
	{
		return ( ! empty( $_FILES ) ) && isset( $_FILES[ $id ] );
	}

	protected function fetchClientPhoto($field_name)
	{
		if ($this->hasFilesToUpload($field_name)) {
			$file = wp_upload_bits( $_FILES[$field_name]['name'], null, @file_get_contents( $_FILES[$field_name]['tmp_name'] ) );
			if ( false === $file['error'] ) {
				var_dump($file);
				die();
			}
		}
		return false;
	}

	protected function applyAttachmentToPost($post_id, $file_name)
	{
		$filetype = wp_check_filetype( basename( $file_name ), null );
		$wp_upload_dir = wp_upload_dir();

		$attachment = array(
			'guid'           => $wp_upload_dir['url'] . '/' . basename( $file_name ),
			'post_mime_type' => $filetype['type'],
			'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $file_name ) ),
			'post_content'   => '',
			'post_status'    => 'inherit'
		);

		$attach_id = wp_insert_attachment( $attachment, $file_name, $post_id );

		require_once( ABSPATH . 'wp-admin/includes/image.php' );

		$attach_data = wp_generate_attachment_metadata( $attach_id, $file_name );
		wp_update_attachment_metadata( $attach_id, $attach_data );
	}

}