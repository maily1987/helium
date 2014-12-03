<?php
	
	/**
	 * Model to attribute_category
	 *
	 * @category  	src
	 * @package   	src\Helium\Model
	 * @author    	Judicaël Paquet <judicael.paquet@gmail.com>
	 * @copyright 	Copyright (c) 2013-2014 Judicaël Paquet (https://github.com/las93)
	 * @license   	https://github.com/las93/helium/blob/master/LICENSE.md Tout droit réservé à Judicaël Paquet
	 * @version   	Release: 1.0.0
	 * @filesource	https://github.com/las93/helium
	 * @link      	https://github.com/las93
	 * @since     	1.0
	 */
	
	namespace Venus\src\Helium\Model;
	
	use \Venus\core\Model as Model;
	
	/**
	 * Model to attribute_category
	 *
	 * @category  	src
	 * @package   	src\Helium\Model
	 * @author    	Judicaël Paquet <judicael.paquet@gmail.com>
	 * @copyright 	Copyright (c) 2013-2014 Judicaël Paquet (https://github.com/las93)
	 * @license   	https://github.com/las93/helium/blob/master/LICENSE.md Tout droit réservé à Judicaël Paquet
	 * @version   	Release: 1.0.0
	 * @filesource	https://github.com/las93/helium
	 * @link      	https://github.com/las93
	 * @since     	1.0
	 */
	
	class attribute_category extends Model {
		
		/**
		 * get all attributes values for one category
		 * 
		 * @access public
		 * @param  int $iIdCategory
		 * @return array
		 */
		
		public function getAttributesValuesForOneCategory($iIdCategory) {
		
			$aResult = array();

			$aJoin = [
				[
					'type' => 'right',
					'table' => 'attribute',
					'as' => 'a',
					'left_field' => 'a.id',
					'right_field' => 'ac.id_attribute'
				],
				[
					'type' => 'right',
					'table' => 'attribute_value',
					'as' => 'av',
					'left_field' => 'a.id',
					'right_field' => 'av.id_attribute'
				]
			];
				
			$aResult = $this->orm
				 			->select(array('*'))
				 			->from($this->_sTableName, 'ac')
				 			->join($aJoin)
				 			->where($this->where->whereEqual('ac.id_category', $iIdCategory))
							->load();
			
			return $aResult;
		}
	}
