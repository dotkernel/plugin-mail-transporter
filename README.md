# plugin-mail-transporter
Plugin for dotkernel mail Transporter (v1.0.1)

To install you should:

1. Add the Mail Transporter settings from this configs/plugins.ini to your configs/plugins.ini
 
2. Merge de library/Plugin folder with yours

3. Replace the Dot_Email Constructor with the one found in /library/Dot/Email.php or uncomment the plugin usage in your Dot_Email Constructor (works only for LTS versions)

4. Add missing methods from LTS version (if your version is not LTS)


* Security notice:
 - In order to protect your SMTP transporters, or any sensible plugin data make sure a .htaccess file exists at least in the /config directory
  The .htaccess file must contain these two lines:
```
   Order Deny,Allow
   Deny from all
```
 DotKernel comes with this file within the /configs/ directory, but if you don't have it, it must be created.
 

* Make sure plugin settings are valid:
 - plugin.DotKernel.MailTransporter.enable = true
 - plugin.DotKernel.MailTransporter.config_file[config] = /path/to/config.xml
 - plugin.DotKernel.MailTransporter.config_file[transporter_list] = /path/to/transporter.xml
 - the files exist

And if you want to use smtp mail make sure:
 
 - Your config.xml contains "<smtpActive>true</smtpActive>" at least within the production tag
 - The mail server accepts connections 
 - You are able to send mail from that server

 
 E-mail now works as a plugin, but the limit cannot be set 
 
 You can set more transporters and disable the ones you don't want to use
 
 If no available SMTP Transport was found, the plugin will create a Send_Mail Transporter (see Zend_Mail_Transport)
 
 Details about Zend SendMail Transport : http://framework.zend.com/manual/1.12/en/zend.mail.introduction.html
 Details about Zend SMTP Transport: 
 * http://framework.zend.com/manual/1.12/en/zend.mail.sending.html
 * http://framework.zend.com/manual/1.12/en/zend.mail.smtp-authentication.html
 * http://framework.zend.com/manual/1.12/en/zend.mail.smtp-secure.html

 
 
 For more support or suggestions visit: www.dotkernel.com 
  or contact us here: http://www.dotkernel.com/contact/