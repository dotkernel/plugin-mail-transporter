 <?php
/**
 * DotBoost Technologies Inc.
* DotKernel Application Framework
*
* @category     DotKernel
* @copyright    Copyright (c) 2009-2015 DotBoost Technologies Inc. (http://www.dotboost.com)
* @license      http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
* @version      $Id: Email.php 872 2015-01-05 16:34:50Z gabi $
*/

/**
 * Alternate SMTP and default server mail() class
* @package    DotPlugin
* @subpackage Smtp_Mailer
* @author     DotKernel Team <team@dotkernel.com>
*/
class Plugin_DotKernel_MailTransporter extends Plugin_Abstract
{

	const PLUGIN_VENDOR = 'DotKernel';
	const PLUGIN_NAME = 'MailTransporter';
	const PLUGIN_VERSION = '1.0.0';
	
	/**
	 * @staticvar $messages - an array containing the messages 
	 */
	public static $messages = array('infos'=>array(),'warnings'=>array(), 'errors'=>array()) ;
	 
	/**
	 * Get plugin info
	 * @access public
	 * @return array $info
	 */
	public function getPluginInfo()
	{
		$info = array(
			'vendor'=>self::PLUGIN_VENDOR ,
			'name'=>self::PLUGIN_NAME,
			'version'=>self::PLUGIN_VERSION
		);
		return $info;
	}
	


	/**
	 * Load plugin instance with given settings
	 * @static
	 * @return object|bool $plugin - the plugin handler
	 */
	public static function load($options)
	{
		if(1 == $options['enable'])
		{
			return new self($options);
		}
		// if the plugin is disabled return false
		return false;
	}

	/**
	 * Gets the first enabled transporter from the factory
	 *
	 * This function also sets the from & reply-to values
	 * Theese values can be changed using Dot_Email -> setFrom setReplyTo
	 *
	 * @return Zend_Mail_Transport_Abstract
	 */
	public function getTransporter($skip = 0)
	{
		//	transporter_list - the key associated to transporter key 
		//	transporterList - the tag in which the transporters config are
		//	transporterConfig - each transporter tag within xml
		if(is_string($this->_config['transporter_list']['transporterList']))
		{
			// this means our transporter list is empty 
			// @todo: add message in session if something wrong happens 
			#$registry->session->pluginMessages = self::$messages;
			return false; 
		}
		$transporterList = $this->_config['transporter_list']['transporterList'];
		if(!array_key_exists('transporter', $transporterList))
		{
			$transporterList = array('transporter'=> array($transporterList)); 
		}
		// using the key transporter because the tag in xml is transporter
		foreach($transporterList['transporter'] as $transporterConfig)
		{
			if($transporterConfig['enable'] && $skip > 0 )
			{
				$skip--;
				continue;
			}
			if($transporterConfig['enable'] == true && $skip == 0)
			{
				// Here is a sample of how we link with the actual plugin
				// This is only a Plugin Handler Class
				$transporterObject = Plugin_DotKernel_MailTransporter_Factory::createTransporter(
										$this->_config['config']['smtpActive'], 
										$this->_config['config']['siteEmail'], 
										$transporterConfig
									);
				Zend_Mail::setDefaultFrom($this->_config['config']['siteEmail'], $this->_config['config']['fromName']);
				Zend_Mail::setDefaultReplyTo($this->_config['config']['siteEmail'], $this->_config['config']['fromName']);
				return $transporterObject;
			}
		}
		return false;
	}
}
