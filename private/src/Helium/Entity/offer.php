<?php
	
	/**
	 * Entity to offer
	 *
	 * @category  	src
	 * @package   	src\Helium\Entity
	 * @author    	Judicaël Paquet <judicael.paquet@gmail.com>
	 * @copyright 	Copyright (c) 2013-2014 Judicaël Paquet (https://github.com/las93)
	 * @license   	https://github.com/las93/helium/LICENSE.md Tout droit réservé à Judicaël Paquet
	 * @version   	Release: 1.0.0
	 * @filesource	https://github.com/las93/helium
	 * @link      	https://github.com/las93
	 * @since     	1.0
	 */
	
	namespace Venus\src\Helium\Entity;
	
	use \Venus\core\Entity as Entity;
	use \Venus\lib\Orm as Orm;
	
	/**
	 * Entity to offer
	 *
	 * @category  	src
	 * @package   	src\Helium\Entity
	 * @author    	Judicaël Paquet <judicael.paquet@gmail.com>
	 * @copyright 	Copyright (c) 2013-2014 Judicaël Paquet (https://github.com/las93)
	 * @license   	https://github.com/las93/helium/LICENSE.md Tout droit réservé à Judicaël Paquet
	 * @version   	Release: 1.0.0
	 * @filesource	https://github.com/las93/helium
	 * @link      	https://github.com/las93
	 * @since     	1.0
	 */
	
	class offer extends Entity {

		/**
		 * id
		 *
		 * @access private
		 * @var    int
		 *
		 * @primary_key
	 */
	
		private $id = null;
	
	
	
		/**
		 * id_product
		 *
		 * @access private
		 * @var    int
		 *
		 */
	
		private $id_product = null;
	
	
	
		/**
		 * id_merchant
		 *
		 * @access private
		 * @var    int
		 *
		 */
	
		private $id_merchant = null;
	
	
	
		/**
		 * id_offer_status
		 *
		 * @access private
		 * @var    int
		 *
		 */
	
		private $id_offer_status = null;
	
	
	
		/**
		 * enable
		 *
		 * @access private
		 * @var    int
		 *
		 */
	
		private $enable = null;
	
	
	
		/**
		 * offer_type
		 *
		 * @access private
		 * @var    string
		 *
		 */
	
		private $offer_type = null;
	
	
	
		/**
		 * date_create
		 *
		 * @access private
		 * @var    string
		 *
		 */
	
		private $date_create = null;
	
	
	
		/**
		 * date_update
		 *
		 * @access private
		 * @var    string
		 *
		 */
	
		private $date_update = null;
	
	
	
		/**
		 * quantity_public
		 *
		 * @access private
		 * @var    int
		 *
		 */
	
		private $quantity_public = null;
	
	
	
		/**
		 * quantity_reserved
		 *
		 * @access private
		 * @var    int
		 *
		 */
	
		private $quantity_reserved = null;
	
	
	
		/**
		 * quantity_confirmed
		 *
		 * @access private
		 * @var    int
		 *
		 */
	
		private $quantity_confirmed = null;
	
	
	
		/**
		 * name
		 *
		 * @access private
		 * @var    string
		 *
		 */
	
		private $name = null;
	
	
	
		/**
		 * description
		 *
		 * @access private
		 * @var    string
		 *
		 */
	
		private $description = null;
	
	
	
		/**
		 * get id of offer
		 *
		 * @access public
		 * @return int
		 */
	
		public function get_id() {
	
			return $this->id;
		}
	
		/**
		 * set id of offer
		 *
		 * @access public
		 * @param  int $id id of offer
		 * @return \Venus\src\Helium\Entity\offer
		 */
	
		public function set_id($id) {
	
			$this->id = $id;
			return $this;
		}
	
		/**
		 * get id_product of offer
		 *
		 * @access public
		 * @return int
		 */
	
		public function get_id_product() {
	
			return $this->id_product;
		}
	
		/**
		 * set id_product of offer
		 *
		 * @access public
		 * @param  int $id_product id_product of offer
		 * @return \Venus\src\Helium\Entity\offer
		 */
	
		public function set_id_product($id_product) {
	
			$this->id_product = $id_product;
			return $this;
		}
	
		/**
		 * get id_merchant of offer
		 *
		 * @access public
		 * @return int
		 */
	
		public function get_id_merchant() {
	
			return $this->id_merchant;
		}
	
		/**
		 * set id_merchant of offer
		 *
		 * @access public
		 * @param  int $id_merchant id_merchant of offer
		 * @return \Venus\src\Helium\Entity\offer
		 */
	
		public function set_id_merchant($id_merchant) {
	
			$this->id_merchant = $id_merchant;
			return $this;
		}
	
		/**
		 * get id_offer_status of offer
		 *
		 * @access public
		 * @return int
		 */
	
		public function get_id_offer_status() {
	
			return $this->id_offer_status;
		}
	
		/**
		 * set id_offer_status of offer
		 *
		 * @access public
		 * @param  int $id_offer_status id_offer_status of offer
		 * @return \Venus\src\Helium\Entity\offer
		 */
	
		public function set_id_offer_status($id_offer_status) {
	
			$this->id_offer_status = $id_offer_status;
			return $this;
		}
	
		/**
		 * get enable of offer
		 *
		 * @access public
		 * @return int
		 */
	
		public function get_enable() {
	
			return $this->enable;
		}
	
		/**
		 * set enable of offer
		 *
		 * @access public
		 * @param  int $enable enable of offer
		 * @return \Venus\src\Helium\Entity\offer
		 */
	
		public function set_enable($enable) {
	
			$this->enable = $enable;
			return $this;
		}
	
		/**
		 * get offer_type of offer
		 *
		 * @access public
		 * @return string
		 */
	
		public function get_offer_type() {
	
			return $this->offer_type;
		}
	
		/**
		 * set offer_type of offer
		 *
		 * @access public
		 * @param  string $offer_type offer_type of offer
		 * @return \Venus\src\Helium\Entity\offer
		 */
	
		public function set_offer_type($offer_type) {
	
			$this->offer_type = $offer_type;
			return $this;
		}
	
		/**
		 * get date_create of offer
		 *
		 * @access public
		 * @return string
		 */
	
		public function get_date_create() {
	
			return $this->date_create;
		}
	
		/**
		 * set date_create of offer
		 *
		 * @access public
		 * @param  string $date_create date_create of offer
		 * @return \Venus\src\Helium\Entity\offer
		 */
	
		public function set_date_create($date_create) {
	
			$this->date_create = $date_create;
			return $this;
		}
	
		/**
		 * get date_update of offer
		 *
		 * @access public
		 * @return string
		 */
	
		public function get_date_update() {
	
			return $this->date_update;
		}
	
		/**
		 * set date_update of offer
		 *
		 * @access public
		 * @param  string $date_update date_update of offer
		 * @return \Venus\src\Helium\Entity\offer
		 */
	
		public function set_date_update($date_update) {
	
			$this->date_update = $date_update;
			return $this;
		}
	
		/**
		 * get quantity_public of offer
		 *
		 * @access public
		 * @return int
		 */
	
		public function get_quantity_public() {
	
			return $this->quantity_public;
		}
	
		/**
		 * set quantity_public of offer
		 *
		 * @access public
		 * @param  int $quantity_public quantity_public of offer
		 * @return \Venus\src\Helium\Entity\offer
		 */
	
		public function set_quantity_public($quantity_public) {
	
			$this->quantity_public = $quantity_public;
			return $this;
		}
	
		/**
		 * get quantity_reserved of offer
		 *
		 * @access public
		 * @return int
		 */
	
		public function get_quantity_reserved() {
	
			return $this->quantity_reserved;
		}
	
		/**
		 * set quantity_reserved of offer
		 *
		 * @access public
		 * @param  int $quantity_reserved quantity_reserved of offer
		 * @return \Venus\src\Helium\Entity\offer
		 */
	
		public function set_quantity_reserved($quantity_reserved) {
	
			$this->quantity_reserved = $quantity_reserved;
			return $this;
		}
	
		/**
		 * get quantity_confirmed of offer
		 *
		 * @access public
		 * @return int
		 */
	
		public function get_quantity_confirmed() {
	
			return $this->quantity_confirmed;
		}
	
		/**
		 * set quantity_confirmed of offer
		 *
		 * @access public
		 * @param  int $quantity_confirmed quantity_confirmed of offer
		 * @return \Venus\src\Helium\Entity\offer
		 */
	
		public function set_quantity_confirmed($quantity_confirmed) {
	
			$this->quantity_confirmed = $quantity_confirmed;
			return $this;
		}
	
		/**
		 * get name of offer
		 *
		 * @access public
		 * @return string
		 */
	
		public function get_name() {
	
			return $this->name;
		}
	
		/**
		 * set name of offer
		 *
		 * @access public
		 * @param  string $name name of offer
		 * @return \Venus\src\Helium\Entity\offer
		 */
	
		public function set_name($name) {
	
			$this->name = $name;
			return $this;
		}
	
		/**
		 * get description of offer
		 *
		 * @access public
		 * @return string
		 */
	
		public function get_description() {
	
			return $this->description;
		}
	
		/**
		 * set description of offer
		 *
		 * @access public
		 * @param  string $description description of offer
		 * @return \Venus\src\Helium\Entity\offer
		 */
	
		public function set_description($description) {
	
			$this->description = $description;
			return $this;
		}
	}