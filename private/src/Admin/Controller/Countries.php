<?php

/**
 * Controller to Countries
 *
 * @category  	src
 * @package   	src\Admin\Controller
 * @author    	Judicaël Paquet <judicael.paquet@gmail.com>
 * @copyright 	Copyright (c) 2013-2014 PAQUET Judicaël FR Inc. (https://github.com/las93)
 * @license   	https://github.com/las93/helium/blob/master/LICENSE.md Tout droit réservé à PAQUET Judicaël
 * @version   	Release: 1.0.0
 * @filesource	https://github.com/las93/helium
 * @link      	https://github.com/las93
 * @since     	1.0
 */

namespace Venus\src\Admin\Controller;

use \Venus\src\Admin\common\Controller as Controller;
use \Venus\src\Helium\Model\country as CountriesModel;

/**
 * Controller to Countries
 *
 * @category  	src
 * @package   	src\Admin\Controller
 * @author    	Judicaël Paquet <judicael.paquet@gmail.com>
 * @copyright 	Copyright (c) 2013-2014 PAQUET Judicaël FR Inc. (https://github.com/las93)
 * @license   	https://github.com/las93/helium/blob/master/LICENSE.md Tout droit réservé à PAQUET Judicaël
 * @version   	Release: 1.0.0
 * @filesource	https://github.com/las93/helium
 * @link      	https://github.com/las93
 * @since     	1.0
 */

class Countries extends Controller {

	/**
	 * Constructor
	 *
	 * @access public
	 * @return object
	 */

	public function __construct() {

		parent::__construct();
	}

	/**
	 * The page of the Countries manager (list)
	 *
	 * @access public
	 * @return void
	 */

	public function index() {

		$this->_checkRight(8);

		if (isset($_GET) && isset($_GET['remove'])) {

			$oCountries = new CountriesModel;
			$oCountryEntity = $oCountries->findOneByid($_GET['remove']);
			$oCountryEntity->remove();
		}
		
		$oCountries = new CountriesModel;
		$aCountries = $oCountries->findAll();
		
		$this->layout
			 ->assign('countries', $aCountries)
			 ->display();
	}

	/**
	 * The page of the Countries manager (add)
	 *
	 * @access public
	 * @return void
	 */

	public function add() {

		$this->_checkRight(8);
		
		$sForm = $this->form
					  ->add('name', 'text', 'Name')
					  ->add('validate', 'submit')
					  ->synchronizeEntity('Venus\src\Helium\Entity\country')
					  ->getForm();

		$this->layout
			 ->assign('form', $sForm)
			 ->assign('model', '/src/Admin/View/CountriesAdd.tpl')
			 ->display();
	}

	/**
	 * The page of the Countries manager (update)
	 *
	 * @access public
	 * @return void
	 */

	public function update() {

		$this->_checkRight(8);
		
		$sForm = $this->form
					  ->add('name', 'text', 'Name')
					  ->add('validate', 'submit')
					  ->synchronizeEntity('Venus\src\Helium\Entity\country', $_GET['update'])
					  ->getForm();

		$this->layout
			 ->assign('form', $sForm)
			 ->assign('model', '/src/Admin/View/CountriesAdd.tpl')
			 ->display();
	}
}