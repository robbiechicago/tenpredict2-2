$(document).ready(function() {
    console.log('Poll');

    $('.poll-radio').change(function() {
        $('.poll-submit').css('visibility', 'visible');
    })

    $('#poll-submit').click(function() {
        var poll_id_text = $('.poll-radio:checked').attr('name');
        var poll_id = poll_id_text.substring(5);
        var poll_val = $('.poll-radio:checked').val();
        var csrf = $('#poll-title').data('csrf');

        $.ajax({
            method: 'POST',
                url: '/pollvotes/store',
                data: {
                    '_token' : csrf,
                    'poll_id' : poll_id,
                    'poll_val' : poll_val,
                },
                success: function(res) {
                    location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) { 
                    // console.log(JSON.stringify(jqXHR));
                    // console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                }
        });
    })

})