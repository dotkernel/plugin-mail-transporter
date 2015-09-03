# plugin-mail-transporter
Plugin for dotkernel mail Transporter (v1.0.0)

To install you should:
1. Add the Mail Transporter settings from this configs/plugins.ini to your configs/plugins.ini 
2. Merge de library/Plugin folder with yours
3. Replace the Dot_Email Constructor with the one found in /library/Dot/Email.php or uncomment the plugin usage in your Dot_Email Constructor (works only for LTS versions)
4. Add missing methods (if your version is not LTS)

Make sure: 
 - plugin.DotKernel.MailTransporter.enable is set to TRUE
 - plugin.DotKernel.MailTransporter.transporter.X*.enable is set to true
 
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

 X* - the transporter number, starting with 1 (starting with 0 is also accepted but the key is not necessarily relevant)
 
 For more support or suggestions visit: www.dotkernel.com 
  or contact us here: http://www.dotkernel.com/contact/