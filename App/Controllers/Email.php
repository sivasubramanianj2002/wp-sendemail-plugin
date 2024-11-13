<?php

namespace SDM\App\Controllers;

use SDM\App\Controllers\SendGridMailer as SendGridMailerService;

class Email
{
    private $sendGridMailer;

    /**
     * Email constructor.
     *
     * Initializes the SendGridMailer service.
     */
    public function __construct()
    {
        $this->sendGridMailer= new SendGridMailerService();
    }

    /**
     * Handle the email sending process.
     *
     * Validates input and attempts to send an email using the SendGrid API.
     * 
     * @return void
     */
    public function handleEmail()
    {
        $validation = [];

        // Sanitize and validate input fields
        $name = sanitize_text_field($_POST['name'] ?? '');
        $email = sanitize_email($_POST['email'] ?? '');
        $content = sanitize_textarea_field($_POST['content'] ?? '');

        // Validation checks
        if (empty($name)) {
            $validation['name'] = ['required' => __('The name is required', 'sendgrid-email-plugin')];
        }

        if (empty($email)) {
            $validation['email'] = ['required' => __('The email field is required', 'sendgrid-email-plugin')];
        } elseif (!is_email($email)) {
            $validation['email'] = ['invalid' => __('Email is invalid', 'sendgrid-email-plugin')];
        }

        if (empty($content)) {
            $validation['content'] = ['required' => __('Content should not be empty', 'sendgrid-email-plugin')];
        }

        // If there are validation errors, return a failure response
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
