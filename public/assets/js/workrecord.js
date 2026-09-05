const time = new RegExp('^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$');

function calculateDayTotal(start, end, remoteWork, subtract) {

    let hour = 0;
    let minute = 0;
    let isValid = true;

    let splitStart = start.split(':');
    let splitEnd = end.split(':');
    let splitRemoteWork = remoteWork.split(':');
    let splitSubtract = subtract.split(':');

    hour = parseInt(splitEnd[0])+parseInt(splitRemoteWork[0])-parseInt(splitStart[0])-parseInt(splitSubtract[0])-1;
    minute = parseInt(splitEnd[1])+parseInt(splitRemoteWork[1])-parseInt(splitStart[1])-parseInt(splitSubtract[1])+60;
    hour = hour + Math.floor(minute/60);
    minute = minute%60;

    if (hour < 0) {
        isValid = false;
    }

    hour = hour.toString();
    minute = minute.toString();
    if (hour.length < 2) hour = '0'+hour;
    if (minute.length < 2) minute = '0'+minute;

    return isValid ? hour+':'+minute : '00:00';
}

function calculateTotal(input, output) {

    let monthHour = 0;
    let monthMinute = 0;

    $('.'+input).each(function () {
        let splitTime = $(this).val().split(':');
        monthHour += parseInt(splitTime[0]);
        monthMinute += parseInt(splitTime[1]);
    });

    monthHour += Math.floor(monthMinute/60);
    monthMinute = monthMinute%60;

    monthHour = monthHour.toString();
    monthMinute = monthMinute.toString();
    if (monthHour.length < 2) monthHour = '0'+monthHour;
    if (monthMinute.length < 2) monthMinute = '0'+monthMinute;

    $('#'+output).html(monthHour+':'+monthMinute);
}

$('.leave-day').on('change', function () {
    let date = $(this).attr('data-date');
    let startTime = $('#'+date+'-start_time');
    let endTime = $('#'+date+'-end_time');
    let remoteWorkTime = $('#'+date+'-remote_work');
    let subtractTime = $('#'+date+'-subtract');
    let totalText = $('#'+date+'-total_text');
    let totalInput = $('#'+date+'-total_input');

    if ($(this).prop('checked')) {
        startTime.val('00:00').attr('disabled', 'disabled');
        endTime.val('00:00').attr('disabled', 'disabled');
        remoteWorkTime.val('00:00').attr('disabled', 'disabled');
        subtractTime.val('00:00').attr('disabled', 'disabled');
        totalInput.val('00:00').attr('disabled', 'disabled');
        totalText.html('00:00');
    }
    else {
        startTime.removeAttr('disabled');
        endTime.removeAttr('disabled');
        remoteWorkTime.removeAttr('disabled');
        subtractTime.removeAttr('disabled');
        totalInput.removeAttr('disabled');
    }
    calculateTotal('day-total', 'month-total');
    calculateTotal('day-remote-work', 'remote-work-total')
});

$(document).ready(function () {
    calculateTotal('day-total', 'month-total');
    calculateTotal('day-remote-work', 'remote-work-total');

    $('.time-range').on('keyup', function (){
        let date = $(this).attr('data-date');
        let startTime = $('#'+date+'-start_time').val();
        let endTime = $('#'+date+'-end_time').val();
        let remoteWorkTime = $('#'+date+'-remote_work').val();
        let subtractTime = $('#'+date+'-subtract').val();
        let totalText = $('#'+date+'-total_text');
        let totalInput = $('#'+date+'-total_input');

        if (time.test(startTime) && time.test(endTime) && time.test(remoteWorkTime) && time.test(subtractTime)) {
            let dayTotal = calculateDayTotal(startTime, endTime, remoteWorkTime, subtractTime);
            totalInput.val(dayTotal);
            totalText.html(dayTotal);
            calculateTotal('day-total', 'month-total');
            calculateTotal('day-remote-work', 'remote-work-total');
        }
    });
})
