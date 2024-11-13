<?php

namespace SDM\App\Controllers;

class Plugin
{
    /**
     * Add the admin menu page for the plugin.
     *
     * @return void
     */
    public function addAdminMenu()
    {
        add_menu_page(
            __('Send Email', 'sendgrid-email-plugin'), // Page title
            __('Send Email', 'sendgrid-email-plugin'), // Menu title
            'manage_options', // Capability required to access the menu
            'send-email', // Menu slug
            [$this, 'renderForm'], // Callback function
            'dashicons-email-alt' // Icon
        );

        // Optionally enqueue additional scripts or styles here for AJAX handling
    }

    /**
     * Enqueue scripts and styles for the admin pages.
     *
     * @return void
     */
    public function enqueueScripts()
    {
        // Enqueue the plugin's CSS stylesheet
        wp_enqueue_style(
            'sendgrid-email-style',
            plugin_dir_url(__DIR__) . 'assets/css/style.css'
        );

        // Enqueue the JavaScript file for handling AJAX requests
        wp_enqueue_script(
            'sendgrid-ajax-handler',
            plugin_dir_url(__DIR__) . 'assets/js/ajax-handler.js',
            ['jquery'], // Dependent on jQuery
            null, // No version
            true // Load script in footer
        );

        // Localize script to pass the AJAX URL to the JS file
        wp_localize_script('sendgrid-ajax-handler', 'ajax_object', [
            'ajaxurl' => admin_url('admin-ajax.php')
        ]);
    }

    /**
     * Render the form for sending email.
     *
     * @return void
     */
    public function renderForm()
    {
        // Include the view for the form
        include plugin_dir_path(__FILE__) . '../views/form-view.php';
    }
}
