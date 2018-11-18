$(document).ready(function() {
    console.log('Tick tock');

    displayTime();

    function displayTime() {
        var time = moment().format('HH:mm:ss');
        $('#admin-clock').html(time);
        setTimeout(displayTime, 1000);
    }
    

})