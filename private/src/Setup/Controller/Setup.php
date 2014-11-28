<?php

/**
 * Controller to install Helium on your hardware
 *
 * @category  	src
 * @package   	src\Setup\Controller
 * @author    	Judicaël Paquet <judicael.paquet@gmail.com>
 * @copyright 	Copyright (c) 2013-2014 PAQUET Judicaël FR Inc. (https://github.com/las93)
 * @license   	https://github.com/las93/helium/blob/master/LICENSE.md Tout droit réservé à PAQUET Judicaël
 * @version   	Release: 1.0.0
 * @filesource	https://github.com/las93/helium
 * @link      	https://github.com/las93
 * @since     	1.0
 */

namespace Venus\src\Setup\Controller;

use \Venus\src\Helium\Entity\category as Category;
use \Venus\src\Helium\Entity\right as Right;
use \Venus\src\Helium\Entity\user as User;
use \Venus\src\Helium\Entity\user_right as UserRight;
use \Venus\src\Setup\common\Controller as Controller;

/**
 * Controller to install Helium on your hardware
 *
 * @category  	src
 * @package   	src\Setup\Controller
 * @author    	Judicaël Paquet <judicael.paquet@gmail.com>
 * @copyright 	Copyright (c) 2013-2014 PAQUET Judicaël FR Inc. (https://github.com/las93)
 * @license   	https://github.com/las93/helium/blob/master/LICENSE.md Tout droit réservé à PAQUET Judicaël
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
			file_put_contents('../../private/src/Helium/conf/Db.conf', $sFileConf);
			
			$aOptions = array('p' => 'Helium', 'r' => 'yes', 'c' => true, 'f' => true);

			$oPdo = new \PDO('mysql:host='.$_POST['host'], $_POST['login'], $_POST['password'], array());
			$oPdo->query('CREATE DATABASE IF NOT EXISTS '.$_POST['name']);
			
			$oEntity = new \Venus\src\Batch\Controller\Entity;
			$oEntity->runScaffolding($aOptions);
			
			$oPdo->query('TRUNCATE user');
			$oPdo->query('TRUNCATE user_merchant');
			$oPdo->query('TRUNCATE user_right');
			
			$oUser = new User;
			
			$iIdUser = $oUser->set_name('admin')
							 ->set_email('admin@hotmail.fr')
				  			 ->set_password(md5('admin'))
				  			 ->save();
			
			$oRight = new Right;
			
			$oRight->set_id(1)
				   ->set_name('Access Setup')
				   ->set_description('Give access at the user at the Setup Manager')
				   ->save();
			
			$oUserRight = new UserRight;
			
			$oUserRight->set_id_user($iIdUser)
				   	   ->set_id_right(1)
				   	   ->save();
			
			$oRight = new Right;
			
			$oRight->set_id(2)
				   ->set_name('Access Merchant')
				   ->set_description('Give access at the user at the Merchant Manager')
				   ->save();
			
			$oUserRight = new UserRight;
			
			$oUserRight->set_id_user($iIdUser)
				   	   ->set_id_right(2)
				   	   ->save();
			
			$oRight = new Right;
			
			$oRight->set_id(3)
				   ->set_name('Access Brand')
				   ->set_description('Give access at the user at the Brand Manager')
				   ->save();
			
			$oUserRight = new UserRight;
			
			$oUserRight->set_id_user($iIdUser)
				   	   ->set_id_right(3)
				   	   ->save();
			
			$oRight = new Right;
			
			$oRight->set_id(4)
				   ->set_name('Access Product')
				   ->set_description('Give access at the user at the Product Manager')
				   ->save();
			
			$oUserRight = new UserRight;
			
			$oUserRight->set_id_user($iIdUser)
				   	   ->set_id_right(4)
				   	   ->save();
			
			$oRight = new Right;
			
			$oRight->set_id(5)
				   ->set_name('Access Offer')
				   ->set_description('Give access at the user at the Offer Manager')
				   ->save();
			
			$oUserRight = new UserRight;
			
			$oUserRight->set_id_user($iIdUser)
				   	   ->set_id_right(5)
				   	   ->save();
			
			$oRight = new Right;
			
			$oRight->set_id(6)
				   ->set_name('Access Vat')
				   ->set_description('Give access at the user at the Vat Manager')
				   ->save();
			
			$oUserRight = new UserRight;
			
			$oUserRight->set_id_user($iIdUser)
				   	   ->set_id_right(6)
				   	   ->save();
			
			$oRight = new Right;
			
			$oRight->set_id(7)
				   ->set_name('Access User')
				   ->set_description('Give access at the user at the User Manager')
				   ->save();
			
			$oUserRight = new UserRight;
			
			$oUserRight->set_id_user($iIdUser)
				   	   ->set_id_right(7)
				   	   ->save();
			
			$oRight = new Right;
			
			$oRight->set_id(8)
				   ->set_name('Access Country')
				   ->set_description('Give access at the user at the Country Manager')
				   ->save();
			
			$oUserRight = new UserRight;
			
			$oUserRight->set_id_user($iIdUser)
				   	   ->set_id_right(8)
				   	   ->save();
			
			$oRight->set_id(9)
				   ->set_name('Access Categories')
				   ->set_description('Give access at the user at the Categories Manager')
				   ->save();
			
			$oUserRight = new UserRight;
			
			$oUserRight->set_id_user($iIdUser)
				   	   ->set_id_right(9)
				   	   ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(0)
					  ->set_name('Musique, DVD, Blu-ray')
					  ->set_visible(1)
					  ->set_order(2)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(0)
					  ->set_name('Jeux vidéo et Consoles')
					  ->set_visible(1)
					  ->set_order(3)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(0)
					  ->set_name('High-Tech et Informatique')
					  ->set_visible(1)
					  ->set_order(4)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(0)
					  ->set_name('Jouets, Enfants et Bébés')
					  ->set_visible(1)
					  ->set_order(5)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(0)
					  ->set_name('Maison, Bricolage, Animalerie')
					  ->set_visible(1)
					  ->set_order(6)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(0)
					  ->set_name('Beauté, Santé, Alimentation')
					  ->set_visible(1)
					  ->set_order(7)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(0)
					  ->set_name('Vêtements et Chaussures')
					  ->set_visible(1)
					  ->set_order(8)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(0)
					  ->set_name('Montres et Bijoux')
					  ->set_visible(1)
					  ->set_order(9)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(0)
					  ->set_name('Sports et Loisirs')
					  ->set_visible(1)
					  ->set_order(10)
					  ->set_section(1)
					  ->save();

			$oCategory = new Category;
				
			$oCategory->set_enable(1)
					  ->set_id_category(0)
					  ->set_name('Auto et Moto')
					  ->set_visible(1)
					  ->set_order(11)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(0)
					  ->set_name('Livres')
					  ->set_visible(1)
					  ->set_order(1)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(11)
					  ->set_name('Tous les livres')
					  ->set_visible(1)
					  ->set_order(1)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(11)
					  ->set_name('Livres anglais et étrangers')
					  ->set_visible(1)
					  ->set_order(2)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(11)
					  ->set_name('Manuels scolaires et parascolaires')
					  ->set_visible(1)
					  ->set_order(3)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(11)
					  ->set_name('Livres audios')
					  ->set_visible(1)
					  ->set_order(4)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(1)
					  ->set_name('CD & Viniles')
					  ->set_visible(1)
					  ->set_order(1)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(1)
					  ->set_name('Musique classique')
					  ->set_visible(1)
					  ->set_order(2)
					  ->set_section(1)
					  ->save();		
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(1)
					  ->set_name('Téléchargement de musiques')
					  ->set_visible(1)
					  ->set_order(3)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(1)
					  ->set_name('Instruments de musiques & sono')
					  ->set_visible(1)
					  ->set_order(4)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(1)
					  ->set_name('DVD & Blu-ray')
					  ->set_visible(1)
					  ->set_order(5)
					  ->set_section(2)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(2)
					  ->set_name('Tous les jeux vidéos')
					  ->set_visible(1)
					  ->set_order(1)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(2)
					  ->set_name('Consoles et Accessoires')
					  ->set_visible(1)
					  ->set_order(1)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(2)
					  ->set_name('Jeux PC')
					  ->set_visible(1)
					  ->set_order(1)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(2)
					  ->set_name('Hélium rachète')
					  ->set_visible(1)
					  ->set_order(1)
					  ->set_section(2)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(1)
					  ->set_name('Séries TV')
					  ->set_visible(1)
					  ->set_order(6)
					  ->set_section(2)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(1)
					  ->set_name('Blu-ray')
					  ->set_visible(1)
					  ->set_order(7)
					  ->set_section(2)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(11)
					  ->set_name('Hélium rachète vos livres')
					  ->set_visible(1)
					  ->set_order(4)
					  ->set_section(2)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(3)
					  ->set_name('Téléphones portables & fixes')
					  ->set_visible(1)
					  ->set_order(1)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(3)
					  ->set_name('Photo & Caméscopes')
					  ->set_visible(1)
					  ->set_order(2)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(3)
					  ->set_name('TV & Home Cinéma')
					  ->set_visible(1)
					  ->set_order(3)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(3)
					  ->set_name('Audio & Hifi')
					  ->set_visible(1)
					  ->set_order(4)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(3)
					  ->set_name('GPS & Auto')
					  ->set_visible(1)
					  ->set_order(5)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(3)
					  ->set_name('Instruments de musique & Sono')
					  ->set_visible(1)
					  ->set_order(6)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(3)
					  ->set_name('Objets connectés')
					  ->set_visible(1)
					  ->set_order(7)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(3)
					  ->set_name('Tous les accessoires High-Tech')
					  ->set_visible(1)
					  ->set_order(8)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(3)
					  ->set_name('Tous l\'univers High-Tech')
					  ->set_visible(1)
					  ->set_order(9)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(3)
					  ->set_name('Ordinateurs portables & Tablettes')
					  ->set_visible(1)
					  ->set_order(10)
					  ->set_section(2)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(3)
					  ->set_name('Ordinateurs de bureaux & Ecrans')
					  ->set_visible(1)
					  ->set_order(11)
					  ->set_section(2)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(3)
					  ->set_name('Stockage & Réseaux')
					  ->set_visible(1)
					  ->set_order(12)
					  ->set_section(2)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(3)
					  ->set_name('Composants PC')
					  ->set_visible(1)
					  ->set_order(13)
					  ->set_section(2)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(3)
					  ->set_name('Imprimantes & Encres')
					  ->set_visible(1)
					  ->set_order(14)
					  ->set_section(2)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(3)
					  ->set_name('Logiciels')
					  ->set_visible(1)
					  ->set_order(15)
					  ->set_section(2)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(3)
					  ->set_name('Fournitures scolaires et de bureau')
					  ->set_visible(1)
					  ->set_order(16)
					  ->set_section(2)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(3)
					  ->set_name('Jeux PC')
					  ->set_visible(1)
					  ->set_order(17)
					  ->set_section(2)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(3)
					  ->set_name('Tous les accessoires informatiques')
					  ->set_visible(1)
					  ->set_order(18)
					  ->set_section(2)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(3)
					  ->set_name('Tous l\'univers informatique')
					  ->set_visible(1)
					  ->set_order(19)
					  ->set_section(2)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(4)
					  ->set_name('Jeux et jouets')
					  ->set_visible(1)
					  ->set_order(1)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(4)
					  ->set_name('Bébé & puériculture')
					  ->set_visible(1)
					  ->set_order(2)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(4)
					  ->set_name('Vêtements et Chaussures')
					  ->set_visible(1)
					  ->set_order(3)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(4)
					  ->set_name('Livres')
					  ->set_visible(1)
					  ->set_order(4)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(4)
					  ->set_name('DVD')
					  ->set_visible(1)
					  ->set_order(5)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(4)
					  ->set_name('Liste de naissance')
					  ->set_visible(1)
					  ->set_order(6)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(4)
					  ->set_name('Hélium famille')
					  ->set_visible(1)
					  ->set_order(7)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(5)
					  ->set_name('Petit électroménager')
					  ->set_visible(1)
					  ->set_order(1)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(5)
					  ->set_name('Gros électroménager')
					  ->set_visible(1)
					  ->set_order(2)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(5)
					  ->set_name('Arts culinéaires et Arts de la table')
					  ->set_visible(1)
					  ->set_order(3)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(5)
					  ->set_name('Ameublement et Décoration')
					  ->set_visible(1)
					  ->set_order(4)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(5)
					  ->set_name('Linge de maison')
					  ->set_visible(1)
					  ->set_order(5)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(5)
					  ->set_name('Luminaires & Eclairage')
					  ->set_visible(1)
					  ->set_order(6)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(5)
					  ->set_name('Jardin')
					  ->set_visible(1)
					  ->set_order(7)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(5)
					  ->set_name('Tous les produits Cuisine et Maison')
					  ->set_visible(1)
					  ->set_order(8)
					  ->set_section(1)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(5)
					  ->set_name('Outillage électroportatif')
					  ->set_visible(1)
					  ->set_order(9)
					  ->set_section(2)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(5)
					  ->set_name('Outillage à main')
					  ->set_visible(1)
					  ->set_order(10)
					  ->set_section(2)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(5)
					  ->set_name('Luminaires et Eclairage')
					  ->set_visible(1)
					  ->set_order(11)
					  ->set_section(2)
					  ->set_id_shortcuts_category(59)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(5)
					  ->set_name('Tous les produits Bricolage')
					  ->set_visible(1)
					  ->set_order(12)
					  ->set_section(2)
					  ->set_id_shortcuts_category(0)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(5)
					  ->set_name('Tous les animaux')
					  ->set_visible(1)
					  ->set_order(13)
					  ->set_section(3)
					  ->set_id_shortcuts_category(0)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(6)
					  ->set_name('Beautés et Parfum')
					  ->set_visible(1)
					  ->set_order(1)
					  ->set_section(1)
					  ->set_id_shortcuts_category(0)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(6)
					  ->set_name('Beauté prestige')
					  ->set_visible(1)
					  ->set_order(2)
					  ->set_section(1)
					  ->set_id_shortcuts_category(0)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(6)
					  ->set_name('Santé et Soin du corps')
					  ->set_visible(1)
					  ->set_order(3)
					  ->set_section(1)
					  ->set_id_shortcuts_category(0)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(6)
					  ->set_name('Entretien de la maison')
					  ->set_visible(1)
					  ->set_order(4)
					  ->set_section(1)
					  ->set_id_shortcuts_category(0)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(6)
					  ->set_name('Alimentation')
					  ->set_visible(1)
					  ->set_order(5)
					  ->set_section(1)
					  ->set_id_shortcuts_category(0)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(6)
					  ->set_name('Economisez en vous abonnant')
					  ->set_visible(1)
					  ->set_order(6)
					  ->set_section(2)
					  ->set_id_shortcuts_category(0)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(7)
					  ->set_name('Vêtements')
					  ->set_visible(1)
					  ->set_order(1)
					  ->set_section(1)
					  ->set_id_shortcuts_category(0)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(7)
					  ->set_name('Chaussures')
					  ->set_visible(1)
					  ->set_order(2)
					  ->set_section(1)
					  ->set_id_shortcuts_category(0)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(7)
					  ->set_name('Maroquinerie')
					  ->set_visible(1)
					  ->set_order(3)
					  ->set_section(1)
					  ->set_id_shortcuts_category(0)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(7)
					  ->set_name('Bagages')
					  ->set_visible(1)
					  ->set_order(4)
					  ->set_section(1)
					  ->set_id_shortcuts_category(0)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(8)
					  ->set_name('Montres')
					  ->set_visible(1)
					  ->set_order(1)
					  ->set_section(1)
					  ->set_id_shortcuts_category(0)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(8)
					  ->set_name('Bijoux')
					  ->set_visible(1)
					  ->set_order(2)
					  ->set_section(1)
					  ->set_id_shortcuts_category(0)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(9)
					  ->set_name('Fitness et Musculation')
					  ->set_visible(1)
					  ->set_order(1)
					  ->set_section(1)
					  ->set_id_shortcuts_category(0)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(9)
					  ->set_name('Football')
					  ->set_visible(1)
					  ->set_order(2)
					  ->set_section(1)
					  ->set_id_shortcuts_category(0)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(9)
					  ->set_name('Camping et Randonnée')
					  ->set_visible(1)
					  ->set_order(3)
					  ->set_section(1)
					  ->set_id_shortcuts_category(0)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(9)
					  ->set_name('Cyclisme')
					  ->set_visible(1)
					  ->set_order(4)
					  ->set_section(1)
					  ->set_id_shortcuts_category(0)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(9)
					  ->set_name('Vêtements de sport')
					  ->set_visible(1)
					  ->set_order(5)
					  ->set_section(1)
					  ->set_id_shortcuts_category(0)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(9)
					  ->set_name('Running')
					  ->set_visible(1)
					  ->set_order(6)
					  ->set_section(1)
					  ->set_id_shortcuts_category(0)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(9)
					  ->set_name('Electronique')
					  ->set_visible(1)
					  ->set_order(7)
					  ->set_section(1)
					  ->set_id_shortcuts_category(0)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(9)
					  ->set_name('Golf')
					  ->set_visible(1)
					  ->set_order(8)
					  ->set_section(1)
					  ->set_id_shortcuts_category(0)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(9)
					  ->set_name('Tous les Sports et Loisirs')
					  ->set_visible(1)
					  ->set_order(9)
					  ->set_section(1)
					  ->set_id_shortcuts_category(0)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(10)
					  ->set_name('Pièces et accessoires Auto')
					  ->set_visible(1)
					  ->set_order(1)
					  ->set_section(1)
					  ->set_id_shortcuts_category(0)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(10)
					  ->set_name('Outils et dépannage')
					  ->set_visible(1)
					  ->set_order(2)
					  ->set_section(1)
					  ->set_id_shortcuts_category(0)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(10)
					  ->set_name('Pièces et accessoires Auto')
					  ->set_visible(1)
					  ->set_order(3)
					  ->set_section(1)
					  ->set_id_shortcuts_category(0)
					  ->save();
			
			$oCategory = new Category;
			
			$oCategory->set_enable(1)
					  ->set_id_category(10)
					  ->set_name('GPS & Auto')
					  ->set_visible(1)
					  ->set_order(4)
					  ->set_section(1)
					  ->set_id_shortcuts_category(0)
					  ->save();
		}
		else {
			
			$this->redirect($this->url->getUrl('home'));
		}

		$this->layout
			 ->assign('model', '/src/Setup/View/Save.tpl')
			 ->display();
	}
}