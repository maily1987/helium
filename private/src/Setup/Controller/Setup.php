<?php

/**
 * Controller to install Helium on your hardware
 *
 * @category  	src
 * @package   	src\Setup\Controller
 * @author    	Judicaël Paquet <judicael.paquet@gmail.com>
 * @copyright 	Copyright (c) 2013-2014 PAQUET Judicaël FR Inc. (https://github.com/las93)
 * @license   	https://github.com/las93/helium/LICENSE.md Tout droit réservé à PAQUET Judicaël
 * @version   	Release: 1.0.0
 * @filesource	https://github.com/las93/helium
 * @link      	https://github.com/las93
 * @since     	1.0
 */

namespace Venus\src\Setup\Controller;

use \Venus\src\Setup\common\Controller as Controller;

/**
 * Controller to install Helium on your hardware
 *
 * @category  	src
 * @package   	src\Setup\Controller
 * @author    	Judicaël Paquet <judicael.paquet@gmail.com>
 * @copyright 	Copyright (c) 2013-2014 PAQUET Judicaël FR Inc. (https://github.com/las93)
 * @license   	https://github.com/las93/helium/LICENSE.md Tout droit réservé à PAQUET Judicaël
 * @version   	Release: 1.0.0
 * @filesource	https://github.com/las93/helium
 * @link      	https://github.com/las93
 * @since     	1.0
 */

class Setup extends Controller {

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
	 * the main page
	 *
	 * @access public
	 * @return void
	 */

	public function index() {

		$aVerification = array();
		$aVerification['count_error'] = 0;

		if (is_writable('../../private/src/Helium/conf/Db.conf') === true) { 
			
			$aVerification['db_conf']['img'] = 'green'; 
			$aVerification['db_conf']['text'] = 'Db.conf is writable!'; 
		}
		else { 
			
			$aVerification['db_conf']['img'] = 'red'; 
			$aVerification['db_conf']['text'] = 'file /private/src/Helium/conf/Db.conf must have write permission!'; 
			$aVerification['count_error']++;
		}
		
		if (class_exists('PDO')) {
			
			$aVerification['pdo']['img'] = 'green'; 
			$aVerification['pdo']['text'] = 'PDO is activated!'; 
		}
		else { 
			
			$aVerification['pdo']['img'] = 'red'; 
			$aVerification['pdo']['text'] = 'PDO must be activated!'; 
			$aVerification['count_error']++;
		}
		
		if (function_exists('mysql_connect')) {
			
			$aVerification['mysql']['img'] = 'green'; 
			$aVerification['mysql']['text'] = 'Mysql library is activated!'; 
		}
		else { 
			
			$aVerification['mysql']['img'] = 'red'; 
			$aVerification['mysql']['text'] = 'Mysql library must be activated!'; 
			$aVerification['count_error']++;
		}
		
		$this->layout
			 ->assign('setup', $aVerification)
			 ->display();
	}

	/**
	 * the configuration page
	 *
	 * @access public
	 * @return void
	 */

	public function configuration() {

		$this->layout
			 ->assign('model', '/src/Setup/View/Configuration.tpl')
			 ->assign('setup', $aVerification)
			 ->display();
	}

	/**
	 * the save page
	 *
	 * @access public
	 * @return void
	 */

	public function save() {

		if (is_writable('../../private/src/Helium/conf/Db.conf') === true) {
				
			$sFileConf = file_get_contents('../../private/src/Helium/conf/Db.conf');
			$sFileConf = preg_replace('/"host": "localhost",/', '"host": "'.$_POST['host'].'",', $sFileConf);
			$sFileConf = preg_replace('/"db": "helium",/', '"db": "'.$_POST['name'].'",', $sFileConf);
			$sFileConf = preg_replace('/"user": "root",/', '"user": "'.$_POST['login'].'",', $sFileConf);
			$sFileConf = preg_replace('/"password": "test",/', '"password": "'.$_POST['password'].'",', $sFileConf);
			file_put_contents('../../private/Helium/conf/Db.conf', $sFileConf);
			
			$aOptions = array('p' => 'Helium', 'r' => 'yes', 'c' => true);

			$oPdo = new \PDO('mysql:host='.$_POST['localhost'], $_POST['login'], $_POST['password'], array());
			$oPdo->query('CREATE DATABASE IF NOT EXISTS '.$_POST['name']);
			
			$oEntity = new \Venus\src\Batch\Controller\Entity;
			$oEntity->runScaffolding($aOptions);
		}
		else {
			
			$this->redirect($this->url->getUrl('home'));
		}

		$this->layout
			 ->assign('model', '/src/Setup/View/Save.tpl')
			 ->display();
	}
}