<?php
/**
 * DotBoost Technologies Inc.
* DotKernel Application Framework
*
* @category   DotKernel
* @package    DotLibrary
* @copyright  Copyright (c) 2009-2015 DotBoost Technologies Inc. (http://www.dotboost.com)
* @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
* @version    $Id: Factory.php 5 2015-05-13 14:11:17Z gabi $
*/

/**
 * Alternate SMTP and default server mail() class
* @category   DotKernel
* @package    DotPlugin
* @subpackage Smtp_Mailer 
* @author     DotKernel Team <team@dotkernel.com>
*/
class Plugin_DotKernel_MailTransporter_Factory
{
	/**
	 * Transporter creator
	 * 
	 * If $smtpActive is true, a SMTP server data from db will be returned 
	 * If the $smtpActive is false or the SMTP wasn't found, a SendMail Transporter will be returned
	 * 
	 * @param bool   $smtpActive
	 * @param string $fromEmail
	 * @param array  $smtpData [optional] 
	 * @throws Zend_Mail_Transport_Exception
	 * @return Zend_Mail_Transport_Abstract|bool
	 */
	public static function createTransporter($smtpActive, $fromEmail, $smtpData = array())
	{
		if($smtpActive)
		{
			if(count($smtpData)>0)
			{
				$mailConfig = array(
					'auth' => 'login',
					'username' => $smtpData['username'],
					'password' => $smtpData['password'],
					'port' => $smtpData['port'],
					'ssl' => $smtpData['ssl']
				);
				return new Zend_Mail_Transport_Smtp($smtpData['server'], $mailConfig);
			}
			$smtpData = self::_getSmtp();
			if(!empty($smtpData))
			{
				$mailConfig = array(
					'auth' => 'login',
					'username' => $smtpData['smtpUsername'],
					'password' => $smtpData['smtpPassword'],
					'port' => $smtpData['smtpPort'],
					'ssl' => $smtpData['smtpSsl']
				);
				self::_updateSmtpCounter($smtpData['id']);
				return new Zend_Mail_Transport_Smtp($smtpData['smtpServer'], $mailConfig);
			}
		}
		return new Zend_Mail_Transport_Sendmail($fromEmail);
	}
}
