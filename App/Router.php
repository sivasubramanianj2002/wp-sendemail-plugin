<?php

namespace SDM\App;

use SDM\App\Controllers\Email;
use SDM\App\Controllers\Plugin;

class Router {
    
    public function init()
    {
        $plugin= new Plugin();
        $email = new Email();
        add_action('wp_ajax_send_email', [$email, 'handleEmail']);
        add_action('admin_menu', [$plugin, 'addAdminMenu']);
        add_action('admin_enqueue_scripts', [$plugin, 'enqueueScripts']);
        add_action('admin_enqueue_style',[$plugin, 'enqueueScripts']);
    }
   
}