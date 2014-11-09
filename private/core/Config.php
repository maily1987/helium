<?php

/**
 * Config Manager
 *
 * @category  	core
 * @author    	Judicaël Paquet <judicael.paquet@gmail.com>
 * @copyright 	Copyright (c) 2013-2014 PAQUET Judicaël FR Inc. (https://github.com/las93)
 * @license   	https://github.com/las93/venus/blob/master/LICENSE.md Tout droit réservé à PAQUET Judicaël
 * @version   	Release: 1.0.0
 * @filesource	https://github.com/las93/venus
 * @link      	https://github.com/las93
 * @since     	1.0
 */

namespace Venus\core;

/**
 * Config Manager
 *
 * @category  	core
 * @author    	Judicaël Paquet <judicael.paquet@gmail.com>
 * @copyright 	Copyright (c) 2013-2014 PAQUET Judicaël FR Inc. (https://github.com/las93)
 * @license   	https://github.com/las93/venus/blob/master/LICENSE.md Tout droit réservé à PAQUET Judicaël
 * @version   	Release: 1.0.0
 * @filesource	https://github.com/las93/venus
 * @link      	https://github.com/las93
 * @since     	1.0
 */

class Config {

	/**
	 * conf in a cache array
	 *
	 * @access private
	 * @var    array
	 */

	private static $_aConfCache = array();

	/**
	 * get a configuration
	 *
	 * @access public
	 * @param  string sName name of the configuration
	 * @param  string $sPortal portal name if you specify it
	 * @return void
	 */

	public static function get($sName, $sPortal = null) {

		if ($sPortal === null || !is_string($sPortal)) { $sPortal = PORTAIL; }

		if (!isset(self::$_aConfCache[$sName])) {

			$aBase = new \StdClass;

			if (file_exists(str_replace('core', 'conf', __DIR__).DIRECTORY_SEPARATOR.$sName.'.conf-local')) {

				$aBase = self::_mergeAndGetConf(str_replace('core', 'conf', __DIR__).DIRECTORY_SEPARATOR.$sName.'.conf-local', $aBase);
			}
			else if (file_exists(str_replace('core', 'src'.DIRECTORY_SEPARATOR.$sPortal.DIRECTORY_SEPARATOR.'conf', __DIR__).DIRECTORY_SEPARATOR.$sName.'.conf-local')) {

				$aBase = self::_mergeAndGetConf(str_replace('core', 'src'.DIRECTORY_SEPARATOR.$sPortal.DIRECTORY_SEPARATOR.'conf', __DIR__).DIRECTORY_SEPARATOR.$sName.'.conf-local', $aBase);
			}
			else if (file_exists(str_replace('core', 'src'.DIRECTORY_SEPARATOR.$sPortal.DIRECTORY_SEPARATOR.'conf', __DIR__).DIRECTORY_SEPARATOR.$sName.'.conf-dev') && getenv('DEV') == 1) {

				$aBase = self::_mergeAndGetConf(str_replace('core', 'src'.DIRECTORY_SEPARATOR.$sPortal.DIRECTORY_SEPARATOR.'conf', __DIR__).DIRECTORY_SEPARATOR.$sName.'.conf-dev', $aBase);
			}
			else if (file_exists(str_replace('core', 'conf', __DIR__).DIRECTORY_SEPARATOR.$sName.'.conf-dev') && getenv('DEV') == 1) {

				$aBase = self::_mergeAndGetConf(str_replace('core', 'conf', __DIR__).DIRECTORY_SEPARATOR.$sName.'.conf-dev', $aBase);
			}
			else if (file_exists(str_replace('core', 'src'.DIRECTORY_SEPARATOR.$sPortal.DIRECTORY_SEPARATOR.'conf', __DIR__).DIRECTORY_SEPARATOR.$sName.'.conf-dev') && getenv('PROD') == 1) {

				$aBase = self::_mergeAndGetConf(str_replace('core', 'src'.DIRECTORY_SEPARATOR.$sPortal.DIRECTORY_SEPARATOR.'conf', __DIR__).DIRECTORY_SEPARATOR.$sName.'.conf-prod', $aBase);
			}
			else if (file_exists(str_replace('core', 'conf', __DIR__).DIRECTORY_SEPARATOR.$sName.'.conf-dev') && getenv('PROD') == 1) {

				$aBase = self::_mergeAndGetConf(str_replace('core', 'conf', __DIR__).DIRECTORY_SEPARATOR.$sName.'.conf-prod', $aBase);
			}
			else if (file_exists(str_replace('core', 'src'.DIRECTORY_SEPARATOR.$sPortal.DIRECTORY_SEPARATOR.'conf', __DIR__).DIRECTORY_SEPARATOR.$sName.'.conf-dev') && getenv('PREPROD') == 1) {

				$aBase = self::_mergeAndGetConf(str_replace('core', 'src'.DIRECTORY_SEPARATOR.$sPortal.DIRECTORY_SEPARATOR.'conf', __DIR__).DIRECTORY_SEPARATOR.$sName.'.conf-pprod', $aBase);
			}
			else if (file_exists(str_replace('core', 'conf', __DIR__).DIRECTORY_SEPARATOR.$sName.'.conf-dev') && getenv('PREPROD') == 1) {

				$aBase = self::_mergeAndGetConf(str_replace('core', 'conf', __DIR__).DIRECTORY_SEPARATOR.$sName.'.conf-pprod', $aBase);
			}
			else if (file_exists(str_replace('core', 'src'.DIRECTORY_SEPARATOR.$sPortal.DIRECTORY_SEPARATOR.'conf', __DIR__).DIRECTORY_SEPARATOR.$sName.'.conf-dev') && getenv('RECETTE') == 1) {

				$aBase = self::_mergeAndGetConf(str_replace('core', 'src'.DIRECTORY_SEPARATOR.$sPortal.DIRECTORY_SEPARATOR.'conf', __DIR__).DIRECTORY_SEPARATOR.$sName.'.conf-rec', $aBase);
			}
			else if (file_exists(str_replace('core', 'conf', __DIR__).DIRECTORY_SEPARATOR.$sName.'.conf-dev') && getenv('RECETTE') == 1) {

				$aBase = self::_mergeAndGetConf(str_replace('core', 'conf', __DIR__).DIRECTORY_SEPARATOR.$sName.'.conf-rec', $aBase);
			}
			else if (file_exists(str_replace('core', 'src'.DIRECTORY_SEPARATOR.$sPortal.DIRECTORY_SEPARATOR.'conf', __DIR__).DIRECTORY_SEPARATOR.$sName.'.conf-local')) {

				$aBase = self::_mergeAndGetConf(str_replace('core', 'src'.DIRECTORY_SEPARATOR.$sPortal.DIRECTORY_SEPARATOR.'conf', __DIR__).DIRECTORY_SEPARATOR.$sName.'.conf-local', $aBase);
			}
			else if (file_exists(str_replace('core', 'src'.DIRECTORY_SEPARATOR.$sPortal.DIRECTORY_SEPARATOR.'conf', __DIR__).DIRECTORY_SEPARATOR.$sName.'.conf')) {

				$aBase = self::_mergeAndGetConf(str_replace('core', 'src'.DIRECTORY_SEPARATOR.$sPortal.DIRECTORY_SEPARATOR.'conf', __DIR__).DIRECTORY_SEPARATOR.$sName.'.conf', $aBase);
			}
			else {

				$aBase = self::_mergeAndGetConf(str_replace('core', 'conf', __DIR__).DIRECTORY_SEPARATOR.$sName.'.conf', $aBase);
			}

			if ($aBase === '') {
				
				//@todo : Error à formater => Json mal formaté
			}
			
			self::$_aConfCache[$sName] = $aBase;
		}

		return self::$_aConfCache[$sName];
	}

	/**
	 * get file content and merge if not exists
	 *
	 * @access private
	 * @param  string $sFileToMerge file to get
	 * @param  array $aBase base
	 * @return array
	 */

	private static function  _mergeAndGetConf($sFileToMerge, $aBase) {

		$aConfFiles = json_decode(file_get_contents($sFileToMerge));
		list($aConfFiles, $aBase) = self::_recursiveGet($aConfFiles, $aBase);
		return $aBase;
	}

	/**
	 * recursive merge
	 *
	 * @access private
	 * @param  array $aConfFiles
	 * @param  array $aBase
	 * @return multitype:array multitype:array
	 */

	private static function _recursiveGet($aConfFiles, $aBase) {

		foreach ($aConfFiles as $sKey => $mOne) {

			if (!isset($aBase->$sKey)) {

				$aBase->$sKey =  $aConfFiles->$sKey;
			}
			else if (isset($aBase[$sKey]) && is_array($mOne)) {

				$aBase->$sKey = new \StdClass;
				list($aConfFiles, $aBase) = self::_recursiveGet($mOne, $aBase->$sKey);
			}
		}

		return array($aConfFiles, $aBase);
	}
}