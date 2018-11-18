$(document).ready(function() {
    console.log('Sudden Death');

    $('.sd_option').on('click', function() {
        console.log('clicky');
        var team = $(this).text();
        var csrf = $('#sd-title').data('csrf');
        console.log(team);

        $.ajax({
            method: 'POST',
                url: '/suddendeathpicks/store',
                data: {
                    '_token' : csrf,
                    'team' : team,
                },
                success: function(res) {
                    console.log(res)
                    // location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) { 
                    // console.log(JSON.stringify(jqXHR));
                    // console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                }
        });
    })

})