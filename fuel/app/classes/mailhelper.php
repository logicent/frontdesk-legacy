<?php

class Mailhelper
{
    public static $subjects = [];

    public static function send($recipient_name, $recipient_address,$subject, $message)
    {
        $email_settings = Model_Email_Setting::find('first');

        $config['smtp'] =  [
             'driver' => 'smtp',
             'host' => $email_settings->smtp_host,
	         'port'=> $email_settings->smtp_port,
			 'username'	=>$email_settings->smtp_username,
			 'password'	=> $email_settings->smtp_password,
			 'timeout'	=> 5,
		];
        // Create an instance
        $email = Email::forge('my_defaults', $config);

        // Set the from address
        $email->from($email_settings->smtp_username, 'My App Name'); // FCB email here

        if (is_array($recipient_address)) {
            // Set multiple to addresses
            $email->to($recipient_address);
        }
        else
            $email->to($recipient_address, $recipient_name);

        // Set a subject
        $email->subject(self::$subjects[$subject]); // add to setting or get mail subject

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

    }
}
