$(document).ready(function(){
    $(document).on('click', '#submit', function (e) {
        e.preventDefault();

        const login = $('#login').val()
        const pass = $('#pass').val()
        $.ajax({
            url: "log.php",
            data: {'login': login, 'pass': pass},
            dataType: 'html',
            method: 'POST',
            success: function (data) {
                if (data === 'Success') {
                    window.location.href = 'http://localhost/post.php';
                } else {
                    $('#notice').html(data).removeClass('hide');
                }
            }
        })
    })

    $(document).on('change', '#show', function (e) {
        e.preventDefault();
        const pass = document.querySelector('#pass');
        if (pass.type === "password") {
            pass.type = "text";
        } else {
            pass.type = "password";
        }
    })

    $(document).on('focus', '.input', function (e) {
        e.preventDefault();
        $('#notice').addClass('hide')
    })
})
