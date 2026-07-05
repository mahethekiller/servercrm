$(document).ready(function() {
    $('#profileForm').on('submit', function(e) {
        e.preventDefault();
        const $form = $(this);
        let isValid = true;
        
        // Clear previous errors
        $('.is-invalid').removeClass('is-invalid');
        $('.invalid-feedback').remove();

        // Client-side validation
        if ($('#name').val().trim() === '') {
            $('#name').addClass('is-invalid')
                .after('<div class="invalid-feedback">Please enter your name</div>');
            isValid = false;
        }

        const email = $('#email').val().trim();
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            $('#email').addClass('is-invalid')
                .after('<div class="invalid-feedback">Please enter a valid email</div>');
            isValid = false;
        }

        const pass = $('#password').val();
        const confirmPass = $('#confirm_password').val();
        if (pass || confirmPass) {
            if (pass.length < 8) {
                $('#password').addClass('is-invalid')
                    .after('<div class="invalid-feedback">Password must be at least 8 characters</div>');
                isValid = false;
            }
            if (pass !== confirmPass) {
                $('#confirm_password').addClass('is-invalid')
                    .after('<div class="invalid-feedback">Passwords do not match</div>');
                isValid = false;
            }
        }

        if (!isValid) {
            $('html, body').animate({
                scrollTop: $('.is-invalid').first().offset().top - 100
            }, 500);
            return;
        }

        // AJAX submission
        const $submitBtn = $form.find('button[type="submit"]');
        $submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Saving...');

        $.ajax({
            url: $form.attr('action'),
            method: 'POST',
            data: $form.serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    toastr.success(response.message);
                    setTimeout(() => {
                        window.location.href = response.redirect;
                    }, 1500);
                } else {
                    toastr.error(response.message);
                    $submitBtn.prop('disabled', false).html('Save Changes');
                }
            },
            error: function(xhr) {
                toastr.error(xhr.responseJSON?.message || 'An error occurred');
                $submitBtn.prop('disabled', false).html('Save Changes');
            }
        });
    });
});
