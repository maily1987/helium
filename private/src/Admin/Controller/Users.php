<?php

/**
 * Controller to Users
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

use \Venus\src\Admin\common\Controller as Controller;
use \Venus\src\Helium\Entity\user_merchant as UserMerchant;
use \Venus\src\Helium\Entity\user_right as UserRight;
use \Venus\src\Helium\Model\merchant as Merchant;
use \Venus\src\Helium\Model\right as Right;
use \Venus\src\Helium\Model\user as User;

/**
 * Controller to Users
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

class Users extends Controller {

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
	 * The page of the users manager (list)
	 *
	 * @access public
	 * @return void
	 */

	public function index() {

		if (isset($_GET) && isset($_GET['remove'])) {

			$oUser = new User;
			$oUserEntity = $oUser->findOneByid($_GET['remove']);
			$oUserEntity->remove();
		}
		
		$oUser = new User;
		$aUsers = $oUser->findAll();
		
		$this->layout
			 ->assign('users', $aUsers)
			 ->display();
	}

	/**
	 * The page of the users manager (add)
	 *
	 * @access public
	 * @return void
	 */

	public function add() {
		
		$oMerchant = new Merchant;
		$aMerchants = $oMerchant->findAll();

		$aFinalMerchant = array();
		
		foreach ($aMerchants as $oOneMerchant) {
			
			$aFinalMerchant[$oOneMerchant->get_id()] = $oOneMerchant->get_name();
		}
		
		$oRight = new Right;
		$aRights = $oRight->findAll();

		$aFinalRight = array();
		
		foreach ($aRights as $oOneRight) {
			
			$aFinalRight[$oOneRight->get_id()] = $oOneRight->get_name();
		}
		
		$sForm = $this->form
					  ->add('name', 'text', 'Name')
					  ->add('firstname', 'text', 'Firstname')
					  ->add('email', 'text', 'Email')
					  ->add('password', 'password', 'Password')
					  ->add('id_merchant', 'list_checkbox', 'Merchants', $aFinalMerchant)
					  ->add('id_right', 'list_checkbox', 'Rights', $aFinalRight)
					  ->add('validate', 'submit')
					  ->synchronizeEntity('Venus\src\Helium\Entity\user')
					  ->getForm();
		
		$iIdUser = $this->form
						->getIdEntityCreated();
		
		if (isset($_POST['id_merchant'])) {
			
			foreach ($_POST['id_merchant'] as $iIdMerchant) {
				
				$oUserMerchant = new UserMerchant;
				
				$oUserMerchant->set_id_merchant($iIdMerchant)
							  ->set_id_user($iIdUser);
			}
		}
		
		if (isset($_POST['id_right'])) {
			
			foreach ($_POST['id_right'] as $iIdRight) {
				
				$oUserRight = new UserRight;
				
				$oUserRight->set_id_right($iIdRight)
						   ->set_id_user($iIdUser);
			}
		}

		$this->layout
			 ->assign('form', $sForm)
			 ->assign('model', '/src/Admin/View/UsersAdd.tpl')
			 ->display();
	}

	/**
	 * The page of the users manager (update)
	 *
	 * @access public
	 * @return void
	 */

	public function update() {
		
		$sForm = $this->form
					  ->add('name', 'text', 'Name')
					  ->add('validate', 'submit')
					  ->synchronizeEntity('Venus\src\Helium\Entity\user', $_GET['update'])
					  ->getForm();

		$this->layout
			 ->assign('form', $sForm)
			 ->assign('model', '/src/Admin/View/UsersAdd.tpl')
			 ->display();
	}
}