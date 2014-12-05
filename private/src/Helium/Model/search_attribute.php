<?php
	
	/**
	 * Model to search_attribute
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
	 * Model to search_attribute
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
	
	class search_attribute extends Model {

		/**
		 * get all attributes values for one category
		 *
		 * @access public
		 * @param  int $iIdSearchAttribute
		 * @return array
		 */
		
		public function getSearchAttributesRulesForOneSearchAttribute($iIdSearchAttribute) {
		
			$aResult = array();
		
			$aJoin = [
				[
					'type' => 'right',
					'table' => 'search_attribute_rule',
					'as' => 'asr',
					'left_field' => 'asr.id_search_attribute',
					'right_field' => 'sa.id'
				]
			];
		
			$aResult = $this->orm
							->select(array('*'))
							->from($this->_sTableName, 'sa')
							->join($aJoin)
							->where($this->where->whereEqual('sa.id', $iIdSearchAttribute))
							->load();
				
			return $aResult;
		}
	}
