<?php

namespace SDM\App\Controllers;

use SendGrid;
use SendGrid\Mail\Mail;

class SendGridMailer
{
    private $sendGrid;

    public function __construct()
    {
        $apiKey = \SENDGRID_API_KEY; 
        $this->sendGrid = new SendGrid($apiKey);
    }
    public function send($name, $email,$content)
    {
        
        $emailMessage = new Mail();
        
        $emailMessage->setFrom('sivashiva122@gmail.com', 'Siva Subramanian'); 
       
        $emailMessage->setSubject('This Email is generated from the Sendgrid API ' . $name);
        
        $emailMessage->addTo($email, $name);
        
        $emailMessage->addContent("text/plain", "Name: $name\nEmail: $email\nContent: $content");
        
        $emailMessage->addContent("text/html", "<h2>Name:</h2> $name<br><h2>Content:</h2><p>$content</p>");

        $response = $this->sendGrid->send($emailMessage);

        if ($response->statusCode() >= 200 && $response->statusCode() < 300) {
            return true; 
        } else {
            error_log('Failed to send email. Status code: ' . $response->statusCode());
            return false; 
        }
    }
}