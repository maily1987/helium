<?php
	
	/**
	 * Entity to order_status
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
	 * Entity to order_status
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
	
	class order_status extends Entity {

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
		 * name
		 *
		 * @access private
		 * @var    string
		 *
		 */
	
		private $name = null;
	
	
	
		/**
		 * get id of order_status
		 *
		 * @access public
		 * @return int
		 */
	
		public function get_id() {
	
			return $this->id;
		}
	
		/**
		 * set id of order_status
		 *
		 * @access public
		 * @param  int $id id of order_status
		 * @return \Venus\src\Helium\Entity\order_status
		 */
	
		public function set_id($id) {
	
			$this->id = $id;
			return $this;
		}
	
		/**
		 * get name of order_status
		 *
		 * @access public
		 * @return string
		 */
	
		public function get_name() {
	
			return $this->name;
		}
	
		/**
		 * set name of order_status
		 *
		 * @access public
		 * @param  string $name name of order_status
		 * @return \Venus\src\Helium\Entity\order_status
		 */
	
		public function set_name($name) {
	
			$this->name = $name;
			return $this;
		}
	}