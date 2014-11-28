<?php

/**
 * Model to category
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
 * Model to category
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

class category extends Model {
	
	/**
	 * Get all categories in order for one parent category id
	 *
	 * @access public
	 * @param  integer $iParentCategoryId perent category id
	 * @return array
	 */
	
	public function getAllCategoriesInOrder($iParentCategoryId) {
	
		$aResult = array();
	
		$aResult = $this->orm
						->select(array('*'))
						->from($this->_sTableName)
						->where($this->where->whereEqual('id_category', $iParentCategoryId))
						->orderBy(['`order` DESC'])
						->load();

		return $aResult;
	}
}
