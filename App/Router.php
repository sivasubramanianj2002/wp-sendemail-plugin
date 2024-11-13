<?php

namespace SDM\App;

use SDM\App\Controllers\Email;
use SDM\App\Controllers\Plugin;

class Router
{
    /**
     * Initialize the router by setting up the necessary WordPress hooks and actions.
     * @return void
     */
    public function init()
    {
        $plugin = new Plugin();
        $email = new Email();

        // Register the AJAX action for sending emails
        add_action('wp_ajax_send_email', [$email, 'handleEmail']);
        
        // Add the plugin admin menu
        add_action('admin_menu', [$plugin, 'addAdminMenu']);
        
        // Enqueue plugin-specific scripts and styles in the admin area
        add_action('admin_enqueue_scripts', [$plugin, 'enqueueScripts']);
        add_action('admin_enqueue_style', [$plugin, 'enqueueScripts']);
    }
}
