<div class="wrap">
    <h1><?php _e('Send Email via SendGrid', 'sendgrid-email-plugin'); ?></h1>
    
    <form id="sendgrid-email-form" method="post">
        <div class="form-group">
            <label for="name"><?php _e('Your Name', 'sendgrid-email-plugin'); ?></label>
            <input type="text" name="name" id="name" >
        </div>
        <div class="form-group">
            <label for="email"><?php _e('Your Email', 'sendgrid-email-plugin'); ?></label>
            <input type="email" name="email" id="email" >
        </div>
        <div class="form-group">
            <label for="content"><?php _e('Content', 'sendgrid-email-plugin'); ?></label>
            <textarea name="content" id="content" ></textarea>
        </div>
        <div class="form-group">
            <button type="submit"><?php _e('Send Email', 'sendgrid-email-plugin'); ?></button>
        </div>
    </form>
</div>

