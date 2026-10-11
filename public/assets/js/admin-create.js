function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#uploaded_image').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}

$("#select_file").change(function () {
    readURL(this);
});

function hideShowBox(username, password) {
    document.getElementById('enable').onchange = function () {
        if (document.getElementById('enable').checked) {
            $("#username-box").fadeIn();
            $("#password-box").fadeIn();
            $("#username").val(username);
            $("#password").val(password);
            $('#username').prop('required', true);
            $('#password').prop('required', true);
        } else {
            $("#username").val('');
            $("#password").val('');
            $('#username').prop('required', false);
            $('#password').prop('required', false);
            $("#username-box").fadeOut();
            $("#password-box").fadeOut();
        }
    };
}

$("#money").inputmask({ 'alias': 'decimal', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': false});

