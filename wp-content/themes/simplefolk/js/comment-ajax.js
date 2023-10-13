document.addEventListener('DOMContentLoaded', function () {
    var commentForm = document.getElementById('commentform');
    var responseContainer = document.getElementById('response-container');

    commentForm.addEventListener('submit', function (event) {
        event.preventDefault();
        if (ajax_params.current_user) {
            // User is logged in, you can access current_user.display_name and current_user.user_email
            var name = ajax_params.current_user.display_name;
            var email = ajax_params.current_user.user_email;
        } else {
            // User is not logged in
            var nameField = document.getElementById('author');
            var name = nameField ? nameField.value.trim() : null;
            var emailField = document.getElementById('email');
            var email = emailField ? emailField.value.trim() : null;
        }

        var messageField = document.getElementById('comment');
        var honeypotField = document.querySelector('.website-comment textarea');
        var submitButton = commentForm.querySelector('input[type="submit"]');


        if (!name) {
            // Display error message when name or message is empty
            responseContainer.innerHTML = 'Name and message are required fields.';
        } else if (honeypotField && honeypotField.value === '') {
            submitButton.setAttribute('disabled', 'disabled');



            var formData = new FormData(commentForm);
            formData.append('action', 'submit_comment_form');
            formData.append('nonce', ajax_params.nonce);
            formData.append('email', email);
            formData.append('author', name);


            var xhr = new XMLHttpRequest();
            xhr.open('POST', ajax_params.ajax_url, true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

            xhr.onload = function () {
                if (xhr.status >= 200 && xhr.status < 400) {
                    var response = JSON.parse(xhr.responseText);
                    console.log(response)
                    if (response.success) {
                        responseContainer.innerHTML = response.message;
                        commentForm.reset(); // Optionally, reset the form
                    } else {
                        responseContainer.innerHTML = response.message;
                    }
                } else {
                    // Handle other status codes (e.g., 404, 500)
                    responseContainer.innerHTML = 'Error occurred while processing your request.';
                }
                submitButton.removeAttribute('disabled');
            };

            xhr.onerror = function () {
                // Handle network errors
                responseContainer.innerHTML = 'Network error occurred.';
                submitButton.removeAttribute('disabled');
            };

            xhr.send(formData);
        } else {
            // Honeypot field has a value, likely a spam bot, do nothing.
            console.log('Potential spam detected, form not submitted.');
        }
    });
});
