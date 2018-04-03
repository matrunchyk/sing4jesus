<?php

include_once 'sc_entity.php';

/**
 * Class SC_Guest
 *
 * @method string getID()
 * @method string getFullName()
 * @method datetime getBirthday()
 * @method string getEmail()
 * @method string getPhone()
 * @method string getAddress()
 * @method string getFellowship()
 * @method string getPaid()
 * @method string getTicket()
 *
 * @author Sergii Matrunchyk
 */
class SC_Guest extends SC_Entity
{
	protected $type = 'guest';

	public function load($source = array())
	{
		$pl = strlen($this->type . '_');
		foreach ( $source as $rk =>  $rv ) {
			if (strlen($rk) > $pl && substr($rk, 0, $pl - 1) == $this->type) {
				if ($rk == 'guest_nominations') {
					foreach ( $rv as $rrk => $rrv ) {
						$this->data[sprintf('guest_nominations_%s_nomination', $rrk)] = $rrv;
					}
					$this->data['guest_nominations'] = count($rv);
				} else {
					$this->data[$rk] = $rv;
				}
			}
		}

		return $this;
	}

	/**
	 * @return string
	 */
	public function getShortName()
	{
		return $this->getFullname();
	}

	public function saveUserMeta()
	{
		$data = array(
			'birthday'   => $this->getBirthday(),
		//	'address'    => $this->getAddress(),
			'church'     => $this->getChurch(),
		);

		foreach ( $data as $dk => $dv ) {
			if (!empty($dv)) {
				update_user_meta($this->getID(), $dk, $dv);
			} elseif( $dk == 'address' || $dk == 'birthday') {
				$WP_Error = new WP_Error();
				$WP_Error->add('address_birthday', '<strong>Помилка</strong>: Дата народження та Адреса проживання мають бути коректними.');

				return $WP_Error;
			}
		}

		return $this;
	}

	public function isEmailExists()
	{
		return !empty($this->getGuestBy( 'email', $this->getEmail() ));
	}

	public function isPhoneExists()
	{
		return !empty($this->getGuestBy( 'phone', $this->getPhone() ));
	}

	public function getGuestBy($key, $val)
	{
		return $this->getEntityBy($key, $val);
	}

	public function isPaid($by = 'email')
	{
		if ($by == 'email') {
			$key = 'guest_email';
			$value = $this->getEmail();
		} else {
			$key = 'guest_phone';
			$value = $this->getPhone();
		}

		$args = array(
			'post_type'		=>	$this->type,
			'post_status'   => 'publish',
			'meta_query'	=>	array(
				'relation'  => 'AND',
				array(
					'key' => $key,
					'value'	=>	$value
				),
				array(
					'key' => 'guest_paid',
					'operator' => 'NOT NULL',
				)
			)
		);
		/** @var WP_Query $getResult */
		$getResult = new WP_Query( $args );

		return $getResult->post_count;
	}

	protected function getValidationFields()
	{
		return array(
			'guest_fullname',
			'guest_email',
			'guest_phone',
			'guest_church',
			'guest_birthday',
		);
	}
}