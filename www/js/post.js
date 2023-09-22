$(document).ready(function() {
    $(document).on('click', '#create', function(e) {
        e.preventDefault();
        $('#post_popup').popup('show');
        $('#caption').val('')
        $('#post_id').val('')
        $('#content').html('')
        $('#form').attr('action', 'public.php');
        $('#submit_form').html('create')
    })

    $(document).on('click', '#close', function(e) {
        e.preventDefault();
        $('#post_popup').popup('hide');
    })

    $(document).on('click', '#edit', function(e) {
        e.preventDefault();
        $('#post_popup').popup('show');
        $('#form').attr('action', 'edit.php');
        $('#post_id').val($(this).attr('data-id'))
        $('#submit_form').html('update')

        const id = $(this).attr('data-id')
        $.ajax({
            url: "edit.php",
            data: {'id': id},
            dataType: 'json',
            success: function (data) {
                if (data) {
                    $('#caption').val(data.caption)
                    $('#content').html(data.content)
                }
            }
        })
    })

    $(document).on('click', '#submit_form', function(e) {
        e.preventDefault();

        const caption = $('#caption').val()
        const content = $('#content').val()
        $.ajax({
            url: "public.php",
            data: {'caption': caption, 'content': content},
            dataType: 'html',
            method: 'POST',
            success: function (data) {
                if (data === 'Empty fields exist') {
                    $('#notice').html(data).removeClass('hide');
                } else {
                    window.location.href = 'http://localhost/post.php';
                }
            }
        })
    })
})
