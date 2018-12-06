$(document).ready(function() {
    console.log('Sudden Death');

    $('.sd_option').on('click', function() {
        var selected_button = $(this);
        var team = selected_button.val();
        var csrf = $('#sd-title').data('csrf');

        $.ajax({
            method: 'POST',
                url: '/suddendeathpicks/store',
                data: {
                    '_token' : csrf,
                    'team' : team,
                },
                success: function(res) {
                    // console.log(res)
                    if (res == 1) {
                        $('#dropdownMenuButton').text(team);
                        $('.sd-button-text').each(function() {
                            $(this).removeClass('sd-selected-team');
                            $(this).find('.sd-icon').removeClass('fas fa-check');
                            if ($(this).parent().val() == team) {
                                $(this).addClass('sd-selected-team');
                                $(this).find('.sd-icon').addClass('fas fa-check');
                            }
                        })
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) { 
                    // console.log(JSON.stringify(jqXHR));
                    // console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                }
        });
    })

})