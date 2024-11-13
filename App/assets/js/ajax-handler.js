document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('sendgrid-email-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        
        var formData = new FormData(this);
        
        fetch(ajax_object.ajaxurl + '?action=send_email', {
            method: 'POST',
            body: formData,

        })
        .then(response => {
            return response.json().then(data => ({ status: response.status, data }));
        })
        .then(({ status, data }) => {
            if (status === 200 && data.success) {
                alert(data.data);
                form.reset(); 
            } else if (data.data && data.data.errors) { 
                let errorMessage = 'Errors:\n';
                for (const [field, messages] of Object.entries(data.data.errors)) {
                    if (messages.required) {
                        errorMessage += `${field}: ${messages.required.join(', ')}\n`;
                    }
                }
                alert(errorMessage); 
            } else {
                alert('An unknown error occurred.'); 
            }
        })
        .catch(error => console.error('Error:', error));
    });
});