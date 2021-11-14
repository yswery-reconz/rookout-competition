require('./bootstrap');
require('datatables.net-bs4');

$( document ).ready(function() {
    $('#leaderboard').DataTable({
        "paging":    false,
        "ordering":  false,
        "info":      false,
        "searching": false
    });


    function get_elapsed_time_string(total_seconds) {
        function pretty_time_string(num) {
            return ( num < 10 ? "0" : "" ) + num;
        }

        var hours = Math.floor(total_seconds / 3600);
        total_seconds = total_seconds % 3600;

        var minutes = Math.floor(total_seconds / 60);
        total_seconds = total_seconds % 60;

        var seconds = Math.floor(total_seconds);

        // Pad the minutes and seconds with leading zeros, if required
        hours = pretty_time_string(hours);
        minutes = pretty_time_string(minutes);
        seconds = pretty_time_string(seconds);
        var currentTimeString = seconds + ' sec';

        // Compose the string for display

        if (minutes > 0) {
            currentTimeString = minutes + ' min ' + currentTimeString
        }

        if (hours > 0) {
            currentTimeString = hours + ' hr ' + currentTimeString
        }

        return 'Time elapsed: ' + currentTimeString;
    }

    // Display the timerZ
    if ($('.elapsed-time').data('seconds') > 0) {
        $('.elapsed-time').toggleClass('d-none')
        let elapsed_seconds = $('.elapsed-time').data('seconds');
        elapsed_seconds = elapsed_seconds + 1;
        $('.elapsed-time').text(get_elapsed_time_string(elapsed_seconds));

        setInterval(function() {
            elapsed_seconds = elapsed_seconds + 1;
            $('.elapsed-time').text(get_elapsed_time_string(elapsed_seconds));
        }, 1000);
    }
});

