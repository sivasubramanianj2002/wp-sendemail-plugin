<?php

namespace SDM\App\Controllers;

use SDM\App\Router;

class Plugin
{

    public function addAdminMenu()
    {
        add_menu_page(
            __('Send Email', 'sendgrid-email-plugin'), 
            __('Send Email', 'sendgrid-email-plugin'), 
            'manage_options', 
            'send-email', 
            [$this, 'renderForm'], 
            'dashicons-email-alt'
        );

        // Enqueue script for AJAX handling
    }

    public function enqueueScripts()
    {
        wp_enqueue_style(
            'sendgrid-email-style',
            plugin_dir_url(__DIR__). 'assets/css/style.css'
        );
        wp_enqueue_script(
            'sendgrid-ajax-handler',
            plugin_dir_url(__DIR__) . 'assets/js/ajax-handler.js',
            array('jquery'),
            null,
            true
        );
    
        wp_localize_script('sendgrid-ajax-handler', 'ajax_object', array(
            'ajaxurl' => admin_url('admin-ajax.php')
        ));
    }

    public function renderForm()
    {
        include plugin_dir_path(__FILE__) . '../views/form-view.php';
    }

   
}
