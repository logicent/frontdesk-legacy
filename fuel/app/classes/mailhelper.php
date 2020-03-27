<?php

class Mailhelper
{
    public static $subjects = [];

    public static function send($recipient_name, $recipient_address, $subject, $message)
    {
        $email_settings = Model_Email_Setting::find('first');
        
        $config =  [
             'driver'   => 'smtp',
             'host'     => $email_settings->smtp_host,
	         'port'     => $email_settings->smtp_port,
			 'username'	=> $email_settings->smtp_username,
			 'password'	=> $email_settings->smtp_password,
			 'timeout'	=> 5,
        ];
        
        // Create an instance
        $email = Email::forge('my_domain_config', $config);
        
        // Set the from address
        $email->from($email_settings->from_address, $email_settings->from_name); // Customer EMail here

        if (is_array($recipient_address)) {
            // Set multiple to addresses
            $email->to($recipient_address);
        }
        else
            $email->to($recipient_address, $recipient_name);

        // Set a subject
        $email->subject($subject);

        // And set the body.
        $email->body($message);

        try
        {
            $email->send();

            Session::set_flash('success', e('Email message has been sent to '.$recipient_address));
        }
        catch(EmailValidationFailedException $e)
        {
            Session::set_flash('error', e('Email validation failed. Message could not be sent'));
        }
        catch(EmailSendingFailedException $e)
        {
            Session::set_flash('error', e('Email sending failed. Contact your System administrator'));
        }
         catch(SmtpConnectionException $e)
        {
            Session::set_flash('error', e('Could not connect to SMTP. Contact your System administrator'));
        }
        catch(Fuel\Core\FuelException $e)
        {
            Session::set_flash('error', e('Email message not sent: ' . $e->getMessage()));
        } 

    }

    public static function prepareMessageFormat($msg)
    {
        // Set a html body message
        $email->html_body(\View::forge('email/template', $msg));

        /** By default this will also generate an alt body from the html, and attach any inline files (not paths like http://...)       **/

        // Set an alt body, this is optional.
        $email->alt_body('This is my alt body, for non-html viewers.');
    }
}
