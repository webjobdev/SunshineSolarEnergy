@push('scripts')
<script>
    // Additional form validation
    (function() {
        'use strict';
        
        var forms = document.querySelectorAll('#contactForm');
        
        Array.prototype.slice.call(forms).forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                    
                    // Highlight invalid fields
                    var invalidFields = form.querySelectorAll(':invalid');
                    invalidFields.forEach(function(field) {
                        field.classList.add('is-invalid');
                    });
                    
                    // Scroll to first invalid field
                    if (invalidFields.length > 0) {
                        invalidFields[0].scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                        invalidFields[0].focus();
                    }
                }
                
                form.classList.add('was-validated');
            }, false);
        });
    })();
    
    // Phone number formatting (optional)
    document.addEventListener('DOMContentLoaded', function() {
        var phoneInput = document.getElementById('phone');
        if (phoneInput) {
            phoneInput.addEventListener('input', function(e) {
                var value = this.value.replace(/\D/g, '');
                if (value.length > 10) {
                    value = value.slice(0, 10);
                }
                if (value.length > 0) {
                    value = '(' + value.slice(0, 3) + ') ' + value.slice(3, 6) + '-' + value.slice(6, 10);
                }
                this.value = value;
            });
        }
    });
</script>
@endpush