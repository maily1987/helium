<?php

/**
 * Batch that create entity
 *
 * @category  	src
 * @package   	src\Batch\Controller
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 *
 * @tutorial    You could launch this Batch in /private/
 * 				php launch.php scaffolding -p [portal]
 * 				-p [portal] => it's the name where you want add your entities and models
 * 				-r [rewrite] => if we force rewrite file
 * 					by default, it's Batch
 */

namespace Venus\src\Batch\Controller;

use \Venus\lib\Db as Db;
use \Venus\core\Config as Config;
use \Venus\src\Batch\common\Controller as Controller;

/**
 * Batch that create entity
 *
 * @category  	src
 * @package   	src\Batch\Controller
 * @author    	Judicaël Paquet <paquet.judicael@iscreenway.com>
 * @copyright 	Copyright (c) 2013-2014 iScreenway FR/VN Inc. (http://www.iscreenway.com)
 * @license   	http://www.iscreenway.com/framework/licence.php Tout droit réservé à http://www.iscreenway.com
 * @version   	Release: 1.0.0
 * @filesource	http://www.iscreenway.com/framework/download.php
 * @link      	http://www.iscreenway.com
 * @since     	1.0
 */

class Entity extends Controller {

	/**
	 * run the batch to create entity
	 * @tutorial launch.php scaffolding
	 *
	 * @access public
	 * @param  array $aOptions options of script
	 * @param  string $sRewrite rewrite or not the file (no/yes)
	 * @return void
	 */

	public function runScaffolding(array $aOptions = array()) {

		/**
		 * option -p [portail]
		 */

		if (isset($aOptions['p'])) { $sPortail = $aOptions['p']; }
		else { $sPortail = 'Batch'; }

		/**
		 * option -r [yes/no]
		 */

		if (isset($aOptions['r']) && $aOptions['r'] === 'yes') { $sRewrite = $aOptions['r']; }
		else { $sRewrite = 'no'; }

		/**
		 * option -c [create table]
		 */

		if (isset($aOptions['c'])) { $bCreate = true; }
		else { $bCreate = false; }

		/**
		 * option -e [create entity and models]
		 */

		if (isset($aOptions['e'])) { $bCreateEntity = true; }
		else { $bCreateEntity = false; }

		/**
		 * option -e [create models if not exists]
		 */

		if (isset($aOptions['f'])) { 
			
			$bCreateModelIfNotExists = true;
			$bCreateEntity = true;
		}
		else { 
			
			$bCreateModelIfNotExists = false;
		}

		/**
		 * option -d [drop table]
		 */

		if (isset($aOptions['d'])) { $bDropTable = true; }
		else { $bDropTable = false; }

		$oConfiguration = Config::get('Db', $sPortail)->configuration;

		foreach ($oConfiguration as $sConnectionName => $oConnection) {

			/**
			 * scaffolding of the database
			 */

			if ($bCreate === true) {

				$oPdo = Db::connect($sConnectionName);

				foreach ($oConnection->tables as $sTableName => $oOneTable) {

					if ($bDropTable === true) {
						
						$sQuery = 'DROP TABLE IF EXISTS `'.$sTableName.'`';
						$oPdo->query($sQuery);
					}
					
					$sQuery = 'CREATE TABLE IF NOT EXISTS `'.$sTableName.'` (';

					$aIndex = array();
					$aPrimaryKey = array();

					foreach ($oOneTable->fields as $sFieldName => $oOneField) {

						$sQuery .= '`'.$sFieldName.'` '.$oOneField->type;

						if (isset($oOneField->values) && $oOneField->type === 'enum' && is_array($oOneField->values)) {

							$sQuery .= '("'.implode('","', $oOneField->values).'") ';
						}
						else if (isset($oOneField->value) && is_int($oOneField->value)) {

							$sQuery .= '('.$oOneField->value.') ';
						}
						else if (in_array($oOneField->type, array('varchar', 'char', 'blob'))) {

							$sQuery .= '(250) ';
						}

						if (isset($oOneField->null) && $oOneField->null === true) { $sQuery .= ' NULL '; }
						else if (isset($oOneField->null) && $oOneField->null === false) { $sQuery .= ' NOT NULL '; }

						if (isset($oOneField->default) && is_string($oOneField->default)) {

							$sQuery .= ' DEFAULT "'.$oOneField->default.'" ';
						}
						else if (isset($oOneField->default)) {

							$sQuery .= ' DEFAULT '.$oOneField->default.' ';
						}

						if (isset($oOneField->unsigned) && $oOneField->unsigned === true) {

							$sQuery .= ' UNSIGNED ';
						}

						if (isset($oOneField->autoincrement) && $oOneField->autoincrement === true) {

							$sQuery .= ' AUTO_INCREMENT ';
						}

						$sQuery .= ', ';

						if (isset($oOneField->key) && $oOneField->key === 'primary') { $aPrimaryKey[] = $sFieldName; }
						else if (isset($oOneField->key) && $oOneField->key === 'index') { $aIndex[] = $sFieldName; }
					}

					if (count($aPrimaryKey) > 0) { $sQuery .= 'PRIMARY KEY('.implode(',', $aPrimaryKey).') , '; }
					if (count($aIndex) > 0) { $sQuery .= 'KEY('.implode(',', $aIndex).') , '; }

					if (isset($oOneTable->index)) {

						foreach ($oOneTable->index as $sIndexName => $aFields) {

							$sQuery .= 'KEY '.$sIndexName.' ('.implode(',', $aFields).') , ';
						}
					}

					$sQuery = substr($sQuery, 0, -2);
					$sQuery .= ')';

					$oPdo->query($sQuery);
				}
			}

			/**
			 * scaffolding of the entities
			 */

			if ($bCreateEntity) {
					
				foreach ($oConnection->tables as $sTableName => $oOneTable) {
	
					$sContentFile = '<?php
	
	/**
	 * Entity to '.$sTableName.'
	 *
	 * @category  	src
	 * @package   	src\\'.$sPortail.'\Entity
	 * @author    	'.AUTHOR.'
	 * @copyright 	'.COPYRIGHT.'
	 * @license   	'.LICENCE.'
	 * @version   	Release: '.VERSION.'
	 * @filesource	'.FILESOURCE.'
	 * @link      	'.LINK.'
	 * @since     	1.0
	 */
	
	namespace Venus\src\\'.$sPortail.'\Entity;
	
	use \Venus\core\Entity as Entity;
	use \Venus\lib\Orm as Orm;
	
	/**
	 * Entity to '.$sTableName.'
	 *
	 * @category  	src
	 * @package   	src\\'.$sPortail.'\Entity
	 * @author    	'.AUTHOR.'
	 * @copyright 	'.COPYRIGHT.'
	 * @license   	'.LICENCE.'
	 * @version   	Release: '.VERSION.'
	 * @filesource	'.FILESOURCE.'
	 * @link      	'.LINK.'
	 * @since     	1.0
	 */
	
	class '.$sTableName.' extends Entity {'."\n";
	
					foreach ($oOneTable->fields as $sFieldName => $oField) {
	
						if ($oField->type == 'enum' || $oField->type == 'char' || $oField->type == 'varchar' || $oField->type == 'text'
							|| $oField->type == 'date' || $oField->type == 'datetime' || $oField->type == 'time' || $oField->type == 'binary'
							|| $oField->type == 'varbinary' || $oField->type == 'blob' || $oField->type == 'tinyblob'
							|| $oField->type == 'tinytext' || $oField->type == 'mediumblob' || $oField->type == 'mediumtext'
							|| $oField->type == 'longblob' || $oField->type == 'longtext' || $oField->type == 'char varying'
							|| $oField->type == 'long varbinary' || $oField->type == 'long varchar' || $oField->type == 'long') {
	
							$sType = 'string';
						}
						else if ($oField->type == 'int' || $oField->type == 'smallint' || $oField->type == 'tinyint'
							|| $oField->type == 'bigint' || $oField->type == 'mediumint' || $oField->type == 'timestamp'
							|| $oField->type == 'year' || $oField->type == 'integer' || $oField->type == 'int1' || $oField->type == 'int2'
							|| $oField->type == 'int3' || $oField->type == 'int4' || $oField->type == 'int8' || $oField->type == 'middleint'
							|| $oField->type == 'bit' || $oField->type == 'bool' || $oField->type == 'boolean') {
	
							$sType = 'int';
						}
						else if ($oField->type == 'float' || $oField->type == 'decimal' || $oField->type == 'double'
							|| $oField->type == 'precision' || $oField->type == 'real' || $oField->type == 'float4'
							|| $oField->type == 'float8' || $oField->type == 'numeric') {
	
							$sType = 'float';
						}
						else if ($oField->type == 'set') {
	
							$sType = 'array';
						}
	
						$sContentFile .= '
		/**
		 * '.$sFieldName.'
		 *
		 * @access private
		 * @var    '.$sType.'
		 *
	';
	
						if (isset($oField->key) && $oField->key == 'primary') {
	
							$sContentFile .= '	 * @primary_key'."\n";
						}
	
						if (isset($oField->property)) {
	
							$sContentFile .= '	 * @map '.$oField->property.''."\n";
						}
	
						$sContentFile .= '	 */
	
		private $'.$sFieldName.' = null;
	
	
	';
						if (isset($oField->join)) {
	
							if (isset($oField->join_alias)) {
	
								$sContentFile .= '
		/**
		 * '.$oField->join_alias.' Entity
		 *
		 * @access private
		 * @var    '.$oField->join.'
		 *
		 */
	
		private $'.$oField->join_alias.' = null;
	
	
	';
							}
							else {
	
								$sContentFile .= '
		/**
		 * '.$oField->join.' Entity
		 *
		 * @access private
		 * @var    '.$oField->join.'
		 *
		 */
	
		private $'.$oField->join.' = null;
	
	
	';
							}
						}
					}
	
					foreach ($oOneTable->fields as $sFieldName => $oField) {
	
						if ($oField->type == 'enum' || $oField->type == 'char' || $oField->type == 'varchar' || $oField->type == 'text'
										|| $oField->type == 'date' || $oField->type == 'datetime' || $oField->type == 'time' || $oField->type == 'binary'
										|| $oField->type == 'varbinary' || $oField->type == 'blob' || $oField->type == 'tinyblob'
										|| $oField->type == 'tinytext' || $oField->type == 'mediumblob' || $oField->type == 'mediumtext'
										|| $oField->type == 'longblob' || $oField->type == 'longtext' || $oField->type == 'char varying'
										|| $oField->type == 'long varbinary' || $oField->type == 'long varchar' || $oField->type == 'long') {
	
							$sType = 'string';
						}
						else if ($oField->type == 'int' || $oField->type == 'smallint' || $oField->type == 'tinyint'
										|| $oField->type == 'bigint' || $oField->type == 'mediumint' || $oField->type == 'timestamp'
										|| $oField->type == 'year' || $oField->type == 'integer' || $oField->type == 'int1' || $oField->type == 'int2'
										|| $oField->type == 'int3' || $oField->type == 'int4' || $oField->type == 'int8' || $oField->type == 'middleint'
										|| $oField->type == 'bit' || $oField->type == 'bool' || $oField->type == 'boolean') {
	
							$sType = 'int';
						}
						else if ($oField->type == 'float' || $oField->type == 'decimal' || $oField->type == 'double'
										|| $oField->type == 'precision' || $oField->type == 'real' || $oField->type == 'float4'
										|| $oField->type == 'float8' || $oField->type == 'numeric') {
	
							$sType = 'float';
						}
						else if ($oField->type == 'set') {
	
							$sType = 'array';
						}
	
						$sContentFile .= '
		/**
		 * get '.$sFieldName.' of '.$sTableName.'
		 *
		 * @access public
		 * @return '.$sType.'
		 */
	
		public function get_'.$sFieldName.'() {
	
			return $this->'.$sFieldName.';
		}
	
		/**
		 * set '.$sFieldName.' of '.$sTableName.'
		 *
		 * @access public
		 * @param  '.$sType.' $'.$sFieldName.' '.$sFieldName.' of '.$sTableName.'
		 * @return \Venus\src\\'.$sPortail.'\Entity\\'.$sTableName.'
		 */
	
		public function set_'.$sFieldName.'($'.$sFieldName.') {
	
			$this->'.$sFieldName.' = $'.$sFieldName.';
			return $this;
		}
	';
						if (isset($oField->join)) {
	
							/**
							 * you could add join_by_field when you have a field name different in the join
							 * @example		ON menu1.id = menu2.parent_id
							 *
							 * if the left field and the right field have the same name, you could ignore this param.
							 */
	
							if (isset($oField->join_by_field)) { $sJoinByField = $oField->join_by_field; }
							else { $sJoinByField = $sFieldName; }
	
							if (isset($oField->join_alias)) {
	
								$sContentFile .= '
		/**
		 * get '.$oField->join_alias.' entity join by '.$sFieldName.' of '.$sTableName.'
		 *
		 * @access public
		 * @return \Venus\src\\'.$sPortail.'\Entity\\'.$oField->join.'
		 */
	
		public function get_'.$oField->join_alias.'() {
	
			if ($this->'.$oField->join_alias.' === null) {
	
				$oOrm = new Orm;
	
				$this->'.$oField->join_alias.' = $oOrm->select(\'*\')
													  ->from('.$oField->join.')
													  ->where(array(\''.$sJoinByField.'\' => $this->get_'.$sFieldName.'()))
													  ->limit(1)
													  ->load();
			}
	
			return $this->'.$oField->join_alias.';
		}
	
		/**
		 * set '.$oField->join_alias.' entity join by '.$sFieldName.' of '.$sTableName.'
		 *
		 * @access public
		 * @param  \Venus\src\\'.$sPortail.'\Entity\\'.$oField->join.'  $'.$oField->join_alias.' '.$oField->join.' entity
		 * @return \Venus\src\\'.$sPortail.'\Entity\\'.$sTableName.'
		 */
	
		public function set_'.$oField->join_alias.'(\src\\'.$sPortail.'\Entity\\'.$oField->join.' $'.$oField->join_alias.') {
	
			$this->'.$oField->join_alias.' = $'.$oField->join_alias.';
			return $this;
		}
	';
							}
							else {
	
								$sContentFile .= '
		/**
		 * get '.$oField->join.' entity join by '.$sFieldName.' of '.$sTableName.'
		 *
		 * @access public
		 * @return \Venus\src\\'.$sPortail.'\Entity\\'.$oField->join.'
		 */
	
		public function get_'.$oField->join.'() {
	
			if ($this->'.$oField->join.' === null) {
	
				$oOrm = new Orm;
	
				$this->'.$oField->join.' = $oOrm->select(\'*\')
												->from('.$oField->join.')
												->where(array(\''.$sJoinByField.'\' => $this->get_'.$sFieldName.'()))
												->limit(1)
												->load();
			}
	
			return $this->'.$oField->join.';
		}
	
		/**
		 * set '.$oField->join.' entity join by '.$sFieldName.' of '.$sTableName.'
		 *
		 * @access public
		 * @param  \Venus\src\\'.$sPortail.'\Entity\\'.$oField->join.'  $'.$oField->join.' '.$oField->join.' entity
		 * @return \Venus\src\\'.$sPortail.'\Entity\\'.$sTableName.'
		 */
	
		public function set_'.$oField->join.'(\src\\'.$sPortail.'\Entity\\'.$oField->join.' $'.$oField->join.') {
	
			$this->'.$oField->join.' = $'.$oField->join.';
			return $this;
		}
	';
							}
						}
					}
	
					$sContentFile .= '}';
	
					file_put_contents(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.$sPortail.DIRECTORY_SEPARATOR.'Entity'.DIRECTORY_SEPARATOR.$sTableName.'.php', $sContentFile);
	
					if ($bCreateModelIfNotExists === false || ($bCreateModelIfNotExists === true 
						&& !file_exists(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.$sPortail.DIRECTORY_SEPARATOR.'Model'.DIRECTORY_SEPARATOR.$sTableName.'.php'))) {
					
						$sContentFile = '<?php
	
	/**
	 * Model to '.$sTableName.'
	 *
	 * @category  	src
	 * @package   	src\\'.$sPortail.'\Model
	 * @author    	'.AUTHOR.'
	 * @copyright 	'.COPYRIGHT.'
	 * @license   	'.LICENCE.'
	 * @version   	Release: '.VERSION.'
	 * @filesource	'.FILESOURCE.'
	 * @link      	'.LINK.'
	 * @since     	1.0
	 */
	
	namespace Venus\src\\'.$sPortail.'\Model;
	
	use \Venus\core\Model as Model;
	
	/**
	 * Model to '.$sTableName.'
	 *
	 * @category  	src
	 * @package   	src\\'.$sPortail.'\Model
	 * @author    	'.AUTHOR.'
	 * @copyright 	'.COPYRIGHT.'
	 * @license   	'.LICENCE.'
	 * @version   	Release: '.VERSION.'
	 * @filesource	'.FILESOURCE.'
	 * @link      	'.LINK.'
	 * @since     	1.0
	 */
	
	class '.$sTableName.' extends Model {
	}'."\n";
	
						file_put_contents(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.$sPortail.DIRECTORY_SEPARATOR.'Model'.DIRECTORY_SEPARATOR.$sTableName.'.php', $sContentFile);
					}
				}
			}
		}
	}
}
