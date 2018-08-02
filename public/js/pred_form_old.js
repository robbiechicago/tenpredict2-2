$(document).ready(function() {
    console.log('Prediction form page');

    //ON PAGE LOAD
    get_result_points();
    get_score_points();
    get_total_points();
    get_implied_result_all();


    //ON FORM CHANGE
    $('[name*="result_points"]').change(function() {
        get_result_points();
        get_score_points();
        get_total_points();
    });

    $('[name*="score_points"]').change(function() {
        get_result_points();
        get_score_points();
        get_total_points();
    });

    $('[name*="home_goals"]').change(function() {
        get_implied_result();
    })

    $('[name*="away_goals"]').change(function() {
        get_implied_result();
    })
    
    //GET TOTAL RESULT POINTS
    function get_result_points() {
        var result_points = 0;
        $('[name*="result_points"]').each(function() {
            result_points += parseInt($(this).val());
        });
        $('.expired_res_points').each(function() {
            result_points += parseInt($(this).text());
        });
        $('#res_tot').text(result_points);
    }

    //GET TOTAL SCORE POINTS
    function get_score_points() {
        var score_points = 0;
        $('[name*="score_points"]').each(function() {
            score_points += parseInt($(this).val());
        });
        $('.expired_scr_points').each(function() {
            score_points += parseInt($(this).text());
        });
        $('#scr_tot').text(score_points);
    }

    //GET TOTAL POINTS
    function get_total_points() {
        var total_points = 0;
        $('[name*="score_points"]').each(function() {
            total_points += parseInt($(this).val());
        });
        $('[name*="result_points"]').each(function() {
            total_points += parseInt($(this).val());
        });
        $('#tot_points').text(total_points);

        if (total_points < 51) {
            $('#pred_submit').show();
            $('#pred_submit_disabled').hide();
            $('#tot_points_row').css('color', 'black');
        } else {
            $('#pred_submit').hide();
            $('#pred_submit_disabled').show();
            $('#tot_points_row').css('color', 'red');
        }
    }

    //GET IMPLIED RESULT
    function get_implied_result_single() {
        console.log('single');

        var game_num = $(this).attr('name').charAt(5);
        var home_goals = $('[name="game_' + game_num + '[home_goals]"]').val();
        var away_goals = $('[name="game_' + game_num + '[away_goals]"]').val()
        
        var implied_result;
        if (home_goals > away_goals) {
            implied_result = '(home win)';
        } else if(away_goals > home_goals) {
            implied_result = '(away win)';
        } else {
            implied_result = '(draw)';
        }
        console.log(implied_result)
        $('#implied_result_' + game_num).text(implied_result);
    }

    function get_implied_result_all() {
        console.log('all');

        var home_goals;
        var away_goals;
        var implied_result;

        for (let game_num = 1; game_num < 11; game_num++) {
            console.log($('[name="game_' + game_num + '[home_goals]"]'));
            home_goals = $('[name="game_' + game_num + '[home_goals]"]').val();
            away_goals = $('[name="game_' + game_num + '[away_goals]"]').val();
            
            if (home_goals > away_goals) {
                implied_result = '(home win)';
            } else if(away_goals > home_goals) {
                implied_result = '(away win)';
            } else {
                implied_result = '(draw)';
            }
            console.log(implied_result)
            $('#implied_result_' + game_num).text(implied_result);
        }
    }



})