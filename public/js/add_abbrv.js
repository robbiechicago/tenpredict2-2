$(document).ready(function() {
    console.log('Add Abbrv JS');

    $('.save-abbrv').click(function() {

        //THIS DOESN'T ENTIRELY WORK DUE TO SPACES IN IDS IN THE HTML
        //GGRRRRR

        var self = $(this);

        var full_name = this.id;
        var abbrv = $('#abbrv_' + full_name).val();
        var csrf = $('#add-abbrv-title').data('csrf');

        //CHECK FOR THREE LETTER ABBRV
        var pattern = RegExp('^[A-Za-z]{3}$');
        if (!pattern.test(abbrv)) {
            //PATTERN DOES NOT MATCH
            $('#error_' + full_name).text('Abbrv must be 3 letters. Try again, chump.')
        } else {

            $('#error_' + full_name).text('');

            $.ajax({
                method: 'POST',
                url: '/admin/add_abbrv',
                data: {
                    '_token' : csrf,
                    'full_name' : full_name,
                    'abbrv' : abbrv
                },
                success: function(result) {
                    var res = JSON.parse(result)
                    console.log(res)
                    if (res == 'true') {
                        $('#tick_' + full_name).show();
                        $('#error_' + full_name).hide();
                        $('#abbrv_' + full_name).hide();
                        self.hide();
                        $('#show_abbrv_' + full_name).text(abbrv.toUpperCase());
                    } else 
                },
                error: function(jqXHR, textStatus, errorThrown) { 
                    console.log(JSON.stringify(jqXHR));
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                }
            });

        }

    })

})