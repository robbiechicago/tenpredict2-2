$(document).ready(function() {
    console.log('Prediction form modal');

    $('#pred_form').on('show.bs.modal', function (event) {
        var modal = $(this);

        var button = $(event.relatedTarget) // Button that triggered the modal
        var game_id = button.data('gameid') // Extract info from data-* attributes

        console.log(game_id);

        $.ajax({
            method: 'GET',
            url: '/prediction/tot_points_week/' + game_id,
            success: function(res) {
                var tot_points = res;
            
                $.ajax({
                    method: 'GET',
                    url: '/game/' + game_id,
                    success: function(res) {
                        console.log(res);
                        console.log(res.predictions.length);
                        var home_team = res.home_team;
                        var away_team = res.away_team;

                        modal.find('#pred-form-title').html(home_team + ' <span id="pred-form-title-home-goals"></span> - <span id="pred-form-title-away-goals"></span> ' + away_team);
                        modal.find('#pred-form-title').attr('data-gameid', game_id);
                        modal.find('#pred-form-title-points-all').text(tot_points);
                        if (res.predictions.length > 0) {
                            modal.find('#pred-form-title-home-goals').text(res.predictions[0].home_goals);
                            modal.find('.home-num[data-value="' + res.predictions[0].home_goals + '"]').addClass('table-info')
                            modal.find('#pred-form-title-away-goals').text(res.predictions[0].away_goals);
                            modal.find('.away-num[data-value="' + res.predictions[0].away_goals + '"]').addClass('table-warning')
                            modal.find('#pred-form-title-points-res').text(res.predictions[0].result_points);
                            modal.find('.result-num[data-value="' + res.predictions[0].result_points + '"]').addClass('table-danger')
                            modal.find('#pred-form-title-points-scr').text(res.predictions[0].score_points);
                            modal.find('.score-num[data-value="' + res.predictions[0].score_points + '"]').addClass('table-success')
                        } else {
                            modal.find('#pred-form-title-points-res').text(1);
                            modal.find('#pred-form-title-points-scr').text(1);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                        console.log(JSON.stringify(jqXHR));
                        console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                    }
                });

            },
            error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
            }
        });
        
      })

    $('.home-num').click(function() {
        var vall = $(this).data('value');
        var self = $(this);
        if ($(this).hasClass('table-info')) {
            $(this).removeClass('table-info');
            $('#pred-form-title-home-goals').text('');
        } else {
            $('.home-num').each(function() {
                $(this).removeClass('table-info');
            })
            self.addClass('table-info');
            $('#pred-form-title-home-goals').text(vall);
        }
    })

    $('.away-num').click(function() {
        var vall = $(this).data('value');
        var self = $(this);
        if ($(this).hasClass('table-warning')) {
            $(this).removeClass('table-warning');
            $('#pred-form-title-away-goals').text('');
        } else {
            $('.away-num').each(function() {
                $(this).removeClass('table-warning');
            })
            self.addClass('table-warning');
            $('#pred-form-title-away-goals').text(vall);
        }
    })

    $('.result-num').click(function() {
        var vall = $(this).data('value');
        var self = $(this);
        if ($(this).hasClass('table-danger')) {
            // DO NOTHING
        } else {
            $('.result-num').each(function() {
                $(this).removeClass('table-danger');
            })
            self.addClass('table-danger');
            $('#pred-form-title-points-res').text(vall);
        }
    })

    $('.score-num').click(function() {
        var vall = $(this).data('value');
        var self = $(this);
        if ($(this).hasClass('table-success')) {
            // DO NOTHING
        } else {
            $('.score-num').each(function() {
                $(this).removeClass('table-success');
            })
            self.addClass('table-success');
            $('#pred-form-title-points-scr').text(vall);
        }
    })

    $('#pred-form-submit').click(function() {
        var game_id = $('#pred-form-title').data('gameid');
        var home_goals = $('td.home-num.table-info').data('value');
        var away_goals = $('td.away-num.table-warning').data('value');
        var res_points = $('td.result-num.table-danger').data('value');
        var scr_points = $('td.score-num.table-success').data('value');
        var csrf = $('#pred-form-title').data('csrf');

        $.ajax({
            method: 'POST',
            url: '/prediction/submit',
            data: {
                '_token' : csrf,
                'game_id' : game_id,
                'home_goals' : home_goals,
                'away_goals' : away_goals,
                'res_points' : res_points,
                'scr_points' : scr_points
            },
            success: function(res) {
                if (res == 'success') {
                    location.reload();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) { 
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
            }
        });


    })
})