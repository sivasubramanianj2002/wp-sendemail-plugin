<?php

namespace SDM\App\Controllers;

use SendGrid;
use SendGrid\Mail\Mail;

class SendGridMailer
{
    private $sendGrid;

    /**
     * SendGridMailer constructor.
     * Initializes the SendGrid API client with the provided API key.
     */
    public function __construct()
    {
        // It is recommended to load the API key from a secure configuration or environment variable
        $apiKey = \SENDGRID_API_KEY; // Use an environment variable for security
        $this->sendGrid = new SendGrid($apiKey);
    }

    /**
     * Sends an email using SendGrid API.
     *
     * @param string $name The name of the recipient.
     * @param string $email The recipient's email address.
     * @param string $content The content of the email.
     * @return bool True if email sent successfully, false otherwise.
     */
    public function send(string $name, string $email, string $content): bool
    {
        // Prepare the email content
        $emailMessage = new Mail();

        // Set up the sender information
        $emailMessage->setFrom('sivashiva122@gmail.com', 'Siva Subramanian');

        // Set the subject line
        $emailMessage->setSubject('This Email is generated from the Sendgrid API ' . $name);

        // Set the recipient email address and name
        $emailMessage->addTo($email, $name);

        // Add plain text content
        $emailMessage->addContent("text/plain", "Name: $name\nEmail: $email\nContent: $content");

        // Add HTML content
        $emailMessage->addContent("text/html", "<h2>Name:</h2> $name<br><h2>Content:</h2><p>$content</p>");

        // Send the email and check for success
        $response = $this->sendGrid->send($emailMessage);

        // Check if the email was successfully sent based on the response status code
        if ($response->statusCode() >= 200 && $response->statusCode() < 300) {
            return true; // Success
        } else {
            // Log the error with the status code for debugging
            error_log('Failed to send email. Status code: ' . $response->statusCode());
            return false; // Failure
        }
    }
}
