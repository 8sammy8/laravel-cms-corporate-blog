jQuery(document).ready(function ($) {
    $("#send-commit").click(function () {
        var error = false;
        if (typeof user_id == 'undefined') {
            var name = $('input#comment-name').val(); // get the value of the input field
            if (name == "" || name == " ") {
                $('#err-commit-name').show(500);
                $('#err-commit-name').delay(4000);
                $('#err-commit-name').animate({
                    height: 'toggle'
                }, 500, function () {
                    // Animation complete.
                });
                error = true; // change the error state to true
            }

            var emailCompare = /^([a-z0-9_.-]+)@([da-z.-]+).([a-z.]{2,6})$/; // Syntax to compare against input
            var email = $('input#comment-email').val().toLowerCase(); // get the value of the input field
            if (email == "" || email == " " || !emailCompare.test(email)) {
                $('#err-commit-email').show(500);
                $('#err-commit-email').delay(4000);
                $('#err-commit-email').animate({
                    height: 'toggle'
                }, 500, function () {
                    // Animation complete.
                });
                error = true; // change the error state to true
            }
        }

        var comment = $('textarea#comment-text').val(); // get the value of the input field
        if (comment == "" || comment == " ") {
            $('#err-commit-comment').show(500);
            $('#err-commit-comment').delay(4000);
            $('#err-commit-comment').animate({
                height: 'toggle'
            }, 500, function () {
                // Animation complete.
            });
            error = true; // change the error state to true
        }

        if (error == false) {
            var dataString = $('#comment-form').serialize(); // Collect data from form
            $.ajax({
                type: "POST",
                url: $('#comment-form').attr('action'),
                data: dataString,
                datatype: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                timeout: 6000,
                error: function (request, error) {
                    $('#comment-errorSend').show(500);
                    $('#comment-successSend').hide();
                    $('#comment-errorSend').delay(4000).fadeOut();
                },
                success: function (response) {
                    if (response.success) {
                        $('#comment-successSend').show(500);
                        $("#comment-name").val('');
                        $("#comment-email").val('');
                        $("#comment-text").val('');
                        $('#comment-errorSend').hide();
                        $('#comment-successSend').delay(4000).fadeOut();
                    } else {
                        $('#comment-errorSend').show(500);
                        $('#comment-successSend').hide();
                        $('#comment-errorSend').delay(4000).fadeOut();
                    }
                }
            });
            return false;
        }

        return false; // stops user browser being directed to the php file
    });

});
