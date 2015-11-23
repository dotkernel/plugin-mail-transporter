# plugin-mail-transporter
Plugin for dotkernel mail Transporter (v1.0.1)

Installation steps:

1. Add the Mail Transporter settings from this configs/plugins.ini to your configs/plugins.ini

2. Create or copy the configuration files for this plugin. By default the files are: 
```
configs/plugin/DotKernel/MailTransporter/config.xml
configs/plugin/DotKernel/MailTransporter/transporters.xml
```

These files are also present in this repository  

 
3. Merge the library/Plugin folder with yours. If you have a pre 1.8.0 version of DotKernel you can simply copy the folder, but we recommend updating your DotKernel to the latest version

4. Make sure the following lines are uncommented in your Dot_Email class (/library/Dot/Email.php)
```php
		// Plugin Call for DotKernel MailTransporter
		$pluginLoader = Plugin_Loader::getInstance();
		$plugin = $pluginLoader->loadPlugin('DotKernel', 'MailTransporter');
		// if no enabled plugin was found go ahead without it
		if($plugin instanceof Plugin_Interface)
		{
			$this->_transport = $this->_getTransportFromPlugin($plugin);
		}
```
In case you are not sure we have added that file in this repository so you can simply copy it form here. 


Security notice:
-------
 - In order to protect your SMTP transporters, or any sensible plugin data make sure a .htaccess file exists at least in the <code>/configs</code> directory
  The .htaccess file must contain these two lines:
```
   Order Deny,Allow
   Deny from all
```
 DotKernel comes with this file within the /configs/ directory, but if you don't have it, it must be created.
 

* Make sure plugin.ini settings are valid:
```
 plugin.DotKernel.MailTransporter.enable = true
 plugin.DotKernel.MailTransporter.config_file[config] = /path/to/config.xml
 plugin.DotKernel.MailTransporter.config_file[transporter_list] = /path/to/transporter.xml
```
 And the files given are existing. You can use <code>APPLICATION_PATH</code> as a reference to the root DotKernel project folder
 

And if you want to use smtp mail make sure:
 
 - Your plugin's config.xml contains smtpActive is set to <code>true</code> at least within the production tag
 - The mail server accepts connections with the provided configuration 
 - You are able to send mail from that server


E-mail now works as a plugin, but the limit cannot be set 

You can set more transporters and disable the ones you don't want to use

Usage
-------

Add your transporters in the /configs/plugin/DotKernel/MailTransporter/transporters.xml
You can use the plugin with the Dot_Email class.
If you wish to use the plugin separately just add these lines where needed:
```php
    $skip = 0;
    $pluginLoader = Plugin_Loader::getInstance();
    $plugin = $pluginLoader->loadPlugin('DotKernel', 'MailTransporter');
    $transporter = $plugin->getTransporter($skip);
```

We have added the skip feature in case a transporter fails in sending emails . The $skip argument is optional
The plugin will return false if no other transporters are available



Support
-------

If no available SMTP Transport was found, the plugin will create a Send_Mail Transporter (see Zend_Mail_Transport)

Details about Zend SendMail Transport : http://framework.zend.com/manual/1.12/en/zend.mail.introduction.html
Details about Zend SMTP Transport: 
 * http://framework.zend.com/manual/1.12/en/zend.mail.sending.html
 * http://framework.zend.com/manual/1.12/en/zend.mail.smtp-authentication.html
 * http://framework.zend.com/manual/1.12/en/zend.mail.smtp-secure.html

 For more support or suggestions visit: www.dotkernel.com 
  or contact us here: http://www.dotkernel.com/contact/