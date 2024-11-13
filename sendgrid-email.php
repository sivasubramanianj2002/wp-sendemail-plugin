<?php

/**
 * Plugin Name: SendGrid Mailer
 * Description: It is a mailer which uses sendgrid api 
 * Author: Siva Subramanian
 * Version: 1.0
 * Slug: sendGridMailer
 */
defined('ABSPATH') ?: die('No Access');

if(file_exists(__DIR__.'/vendor/autoload.php'))
{
    require_once __DIR__ . '/vendor/autoload.php'; 
}


if(class_exists('SDM\App\Router'))
{
   $router= new SDM\App\Router();
   $router->init();
}else{
    error_log('class not found');
}

