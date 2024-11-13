<?php
namespace SDM\App\Controllers;

class Email {
    private $sendGridMailer;

    public function __construct()
    {
        $this->sendGridMailer = new SendGridMailer();
    }

    public function handleEmail()
    {
       
        $validation = [];
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $content = sanitize_textarea_field($_POST['content']);
    
        if (empty($name)) {
            $validation['name'] = ['required' => ['The name is required']];
        }
    
        if (empty($email)) {
            $validation['email'] = ['required' => ['The email field is required']];
        } elseif (!is_email($email)) {
            $validation['email'] = ['required' => ['Email is invalid']];
        }
    
        if (empty($content)) {
            $validation['content'] = ['required' => ['Content should not be empty']];
        }
    
        // Log validation errors for debugging
        if (!empty($validation)) {
            wp_send_json_error(['errors' => $validation], 422);
            return; 
        }
    
        // If validation passes, attempt to send the email
        if ($this->sendGridMailer->send($name, $email, $content)) {
            wp_send_json_success(__('Email sent successfully.', 'sendgrid-email-plugin'));
        } else {
            wp_send_json_error(__('Failed to send email.', 'sendgrid-email-plugin'));
        }
    }
}