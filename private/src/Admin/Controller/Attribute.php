<?php

/**
 * Controller to Attribute
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
use \Venus\src\Helium\Model\attribute_category as AttributeCategory;
use \Venus\src\Helium\Model\category as ModelCategory;

/**
 * Controller to Attribute
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

class Attribute extends Controller {

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

		$this->_checkRight(10);

		$oCategory = new ModelCategory;
		
		$aCategories = $oCategory->getAllCategoriesInOrder($iCategory, true);
		
		$aAttributesCategories = array();
		
		foreach ($aCategories as $oCategory) {
		
			$oAttributeCategory = new AttributeCategory;
		
			$aAttributesCategories[$oCategory->get_id()] = array();
			$aAttributesCategories[$oCategory->get_id()]['attributes'] = $oAttributeCategory->getAttributesValuesForOneCategory();
			$aAttributesCategories[$oCategory->get_id()]['name'] = $oCategory->get_name();
		}
		
		$this->layout
			 ->assign('categories', $aCategories)
			 ->display();
	}

	/**
	 * The page of the Countries manager (add)
	 *
	 * @access public
	 * @return void
	 */

	public function add() {

		$this->_checkRight(10);
		
		$oCategory = new ModelCategory;
		$aCategories = $oCategory->findAll();
		$aFinalCategories = array('0' => '--None--');
		
		foreach ($aCategories as $aOneCategorie) {
		 
			$oCategory = new ModelCategory;
			$aFinalCategories[$aOneCategorie->get_id()] = $aOneCategorie->get_name();
		}
		
		$sForm = $this->form
					  ->add('name', 'text', 'Name')
					  ->add('id_category', 'select', 'Category parent', null, $aFinalCategories)
					  ->add('id_shortcuts_category', 'select', 'Category shortcut', null, $aFinalCategories)
					  ->add('Enable', 'label')
					  ->add('enable', 'radio', 'Yes', 1)
					  ->add('enable', 'radio', 'No', 0)
					  ->add('Visible', 'label')
					  ->add('visible', 'radio', 'Yes', 1)
					  ->add('visible', 'radio', 'No', 0)
					  ->add('section', 'text', 'Section')
					  ->add('route_alias', 'text', 'Route Alias')
					  ->add('validate', 'submit')
					  ->synchronizeEntity('Venus\src\Helium\Entity\category')
					  ->getForm();

		$this->layout
			 ->assign('form', $sForm)
			 ->assign('model', '/src/Admin/View/AttributeAdd.tpl')
			 ->display();
	}

	/**
	 * The page of the Countries manager (update)
	 *
	 * @access public
	 * @return void
	 */

	public function update() {

		$this->_checkRight(10);
		
		$oCategory = new ModelCategory;
		$aCategories = $oCategory->findAll();
		$aFinalCategories = array('0' => '--None--');
		
		foreach ($aCategories as $aOneCategorie) {
		 
			$oCategory = new Category;
			$aFinalCategories[$aOneCategorie->get_id()] = $aOneCategorie->get_name();
		}
		
		$sForm = $this->form
					  ->add('name', 'text', 'Name')
					  ->add('id_category', 'select', 'Category parent', null, $aFinalCategories)
					  ->add('id_shortcuts_category', 'select', 'Category shortcut', null, $aFinalCategories)
					  ->add('Enable', 'label')
					  ->add('enable', 'radio', 'Yes', 1)
					  ->add('enable', 'radio', 'No', 0)
					  ->add('Visible', 'label')
					  ->add('visible', 'radio', 'Yes', 1)
					  ->add('visible', 'radio', 'No', 0)
					  ->add('section', 'text', 'Section')
					  ->add('route_alias', 'text', 'Route Alias')
					  ->add('validate', 'submit')
					  ->synchronizeEntity('Venus\src\Helium\Entity\category', $_GET['update'])
					  ->getForm();

		$this->layout
			 ->assign('form', $sForm)
			 ->assign('model', '/src/Admin/View/AttributesAdd.tpl')
			 ->display();
	}
}