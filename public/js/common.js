$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(function() {
   $(document).on('click', '.js-send-stamp', (e)=> {
        const $this = $(e.target);
        const type = $this.data('type');
        const post_id = $this.closest('.js-post').data('post_id');

        var data = {
            type,
            post_id,
        };

        $.ajax({
            url: '/send-' + type,
            type: 'POST',
            dataType: 'json',
            data: data,
        })
        .done(function(result) {
            $('.alert').removeClass('hidden');
            console.log("success");
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });
   })
});