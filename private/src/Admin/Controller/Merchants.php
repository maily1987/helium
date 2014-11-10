<?php

/**
 * Controller Merchants
 *
 * @category  	src
 * @package   	src\Admin\Controller
 * @author    	Judicaël Paquet <judicael.paquet@gmail.com>
 * @copyright 	Copyright (c) 2013-2014 PAQUET Judicaël FR Inc. (https://github.com/las93)
 * @license   	https://github.com/las93/helium/LICENSE.md Tout droit réservé à PAQUET Judicaël
 * @version   	Release: 1.0.0
 * @filesource	https://github.com/las93/helium
 * @link      	https://github.com/las93
 * @since     	1.0
 */

namespace Venus\src\Admin\Controller;

use \Venus\core\Config as Config;
use \Venus\src\Admin\common\Controller as Controller;
use \Venus\src\Helium\Model\merchant as Merchant;

/**
 * Controller Merchants
 *
 * @category  	src
 * @package   	src\Admin\Controller
 * @author    	Judicaël Paquet <judicael.paquet@gmail.com>
 * @copyright 	Copyright (c) 2013-2014 PAQUET Judicaël FR Inc. (https://github.com/las93)
 * @license   	https://github.com/las93/helium/LICENSE.md Tout droit réservé à PAQUET Judicaël
 * @version   	Release: 1.0.0
 * @filesource	https://github.com/las93/helium
 * @link      	https://github.com/las93
 * @since     	1.0
 */

class Merchants extends Controller {

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
	 * the home page of the Site
	 *
	 * @access public
	 * @return void
	 */

	public function index() {

		
		
		if (isset($_GET) && isset($_GET['remove'])) {

			$oMerchant = new Merchant;
			$oMerchantEntity = $oMerchant->findOneByid($_GET['remove']);
			$oMerchantEntity->remove();
		}
		
		$oMerchant = new Merchant;
		$aMerchants = $oMerchant->findAll();
		
		$this->layout
			 ->assign('merchants', $aMerchants)
			 ->display();
	}

	/**
	 * the home page of the Site
	 *
	 * @access public
	 * @return void
	 */

	public function add() {
		
		$sForm = $this->form
					  ->add('name', 'text', 'Name')
					  ->add('legal_form', 'text', 'Legal Form')	// SARL SAS EURL
					  ->add('store_capital_account', 'text', 'Capital Account')
					  ->add('store_rcs_certificate', 'text', 'RCS Certificate')
					  ->add('store_vat_certificate', 'text', 'Vat Certificate')
					  ->add('store_cnil_certificate', 'text', 'CNIL Certificate')
					  ->add('store_url', 'text', 'Url of Store')
					  ->add('contact_civ', 'text', 'Civ of contact')
					  ->add('contact_firstname', 'text', 'Firstname of contact')
					  ->add('contact_lastname', 'text', 'Lastname of contact')
					  ->add('contact_function', 'text', 'Function of contact')
					  ->add('contact_address', 'text', 'Address of contact')
					  ->add('contact_address2', 'text', 'Address 2 of contact')
					  ->add('contact_zip', 'text', 'Zip code of contact')
					  ->add('contact_city', 'text', 'City of contact')
					  ->add('contact_country', 'text', 'Country of contact')
					  ->add('contact_phone', 'text', 'Phone of contact')
					  ->add('contact_fax', 'text', 'Fax of contact')
					  ->add('contact_email', 'text', 'Email of contact')
					  ->add('store_cgv', 'text', 'Conditions of Use & Sale Url')
					  ->add('store_phone_taxed', 'text', 'Phone Number taxed')
					  ->add('validate', 'submit')
					  ->synchronizeEntity('Venus\src\Helium\Entity\merchant')
					  ->getForm();

		$this->layout
			 ->assign('form', $sForm)
			 ->assign('model', '/src/Admin/View/MerchantsAdd.tpl')
			 ->display();
	}

	/**
	 * the home page of the Site
	 *
	 * @access public
	 * @return void
	 */

	public function update() {
		
		$sForm = $this->form
					  ->add('name', 'text', 'Name')
					  ->add('legal_form', 'text', 'Legal Form')	// SARL SAS EURL
					  ->add('store_capital_account', 'text', 'Capital Account')
					  ->add('store_rcs_certificate', 'text', 'RCS Certificate')
					  ->add('store_vat_certificate', 'text', 'Vat Certificate')
					  ->add('store_cnil_certificate', 'text', 'CNIL Certificate')
					  ->add('store_url', 'text', 'Url of Store')
					  ->add('contact_civ', 'text', 'Civ of contact')
					  ->add('contact_firstname', 'text', 'Firstname of contact')
					  ->add('contact_lastname', 'text', 'Lastname of contact')
					  ->add('contact_function', 'text', 'Function of contact')
					  ->add('contact_address', 'text', 'Address of contact')
					  ->add('contact_address2', 'text', 'Address 2 of contact')
					  ->add('contact_zip', 'text', 'Zip code of contact')
					  ->add('contact_city', 'text', 'City of contact')
					  ->add('contact_country', 'text', 'Country of contact')
					  ->add('contact_phone', 'text', 'Phone of contact')
					  ->add('contact_fax', 'text', 'Fax of contact')
					  ->add('contact_email', 'text', 'Email of contact')
					  ->add('store_cgv', 'text', 'Conditions of Use & Sale Url')
					  ->add('store_phone_taxed', 'text', 'Phone Number taxed')
					  ->add('validate', 'submit')
					  ->synchronizeEntity('Venus\src\Helium\Entity\merchant', $_GET['update'])
					  ->getForm();

		$this->layout
			 ->assign('form', $sForm)
			 ->assign('model', '/src/Admin/View/MerchantsAdd.tpl')
			 ->display();
	}
}