// Contact Form JavaScript - Smooth Open/Close

// Open popup function
function openContactForm() {
    const popup = document.getElementById('contactNSFormPopup');
    popup.classList.add('active');
    document.body.style.overflow = 'hidden';
}

// Close popup function
function closeContactForm() {
    const popup = document.getElementById('contactNSFormPopup');
    popup.classList.remove('active');
    document.body.style.overflow = 'auto';
    
    document.getElementById('contactNSForm').reset();
    document.getElementById('contactNSFormResponse').className = 'contactNSFormResponse';
    document.getElementById('contactNSFormResponse').textContent = '';
}

// Close on overlay click
document.addEventListener('DOMContentLoaded', function() {
    const overlay = document.getElementById('contactNSFormPopup');
    
    if (overlay) {
        overlay.addEventListener('click', function(e) {
            if (e.target === overlay) {
                closeContactForm();
            }
        });
    }
    
    // Handle form submission
    const form = document.getElementById('contactNSForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(form);
            const submitBtn = form.querySelector('.contactNSFormSubmitBtn');
            const responseDiv = document.getElementById('contactNSFormResponse');
            
            submitBtn.disabled = true;
            submitBtn.textContent = 'Sending...';
            
            fetch('process-contact.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                responseDiv.className = 'contactNSFormResponse ' + (data.success ? 'success' : 'error');
                responseDiv.textContent = data.message;
                
                if (data.success) {
                    form.reset();
                    setTimeout(function() {
                        closeContactForm();
                    }, 2000);
                }
            })
            .catch(error => {
                responseDiv.className = 'contactNSFormResponse error';
                responseDiv.textContent = 'An error occurred. Please try again.';
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Submit';
            });
        });
    }
});

// Close on ESC key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const popup = document.getElementById('contactNSFormPopup');
        if (popup && popup.classList.contains('active')) {
            closeContactForm();
        }
    }
});