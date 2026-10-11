$(document).ready(function() {
    $(".timepicker").pDatepicker({
        "initialValue":false,
        "format":"DD MMMM YYYY",
        "autoClose": true,
    });
    $('.show-calendar').on('click', function (){
        let calendar = $('#caledar');
        let calendarError = $('#calendar-fetch-error');
        calendar.html('');
        calendarError.html('');

        $.ajax({
            url: $(this).attr('data-url'),
            type:"GET",
            data:{
                'starts_at': $('#starts-at').val(),
                'ends_at':$('#ends-at').val(),
            },
            success: function(response) {
                if (response.status === 'success') {
                    response.data.days.map((day) => {
                        let card = '<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><div class="card"><div class="header"><h2>' + day.verta + '</h2></div><div class="body"><div class="demo-masked-input"><div><div class="demo-switch-title">تعطیل</div><div class="switch"><label><input class="holyday-checkbox" type="checkbox" id="' + day.date + '-checkbox" data-date="' + day.date + '" name="days[' + day.date + '][holyday]" ' + (day.is_holyday ? 'checked' : '') + '><span class="lever switch-col-red"></span></label></div></div><div class="m-t-20"><b>ساعت موظفی</b><div class="input-group"><span class="input-group-addon"><i class="material-icons">access_time</i></span><div class="form-line"><input type="text" class="form-control mandatoryHours" placeholder="مثل: 08:50" id="' + day.date + '-mandatory_hours" data-date="' + day.date + '" name="days[' + day.date + '][mandatory_hours]" value="' + day.mandatory_hours + '" required></div><label id="' + day.date + '-mandatory_hours_error" class="error" for="' + day.date + '-mandatory_hours" data-date="' + day.date + '"></label></div></div></div></div></div></div>';
                        calendar.append(card);
                    })
                    $('#form-submit').removeClass('hide');
                    $('.mandatoryHours').inputmask('99:99', {
                        placeholder: '__:__',
                        alias: 'mandatoryHours',
                        hourFormat: '24'
                    });
                }
                else {
                    calendarError.html('<div class="card"><div class="header"><div class="body"><p class="text-center"  style="color: #f44336; font-size: 15px; width: 100%">'+ response.data.error +'</p></div></div></div>');
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log(XMLHttpRequest);
                console.log(textStatus);
                console.log(errorThrown);
            },
        });
    });
    $('#caledar').on('click', '.holyday-checkbox', function () {
        let mandatoryHours = $('#'+$(this).attr('data-date')+'-mandatory_hours');
        if ($(this).prop('checked')) {
            mandatoryHours.val('00:00');
        }
        else {
            mandatoryHours.val('08:50');
        }
    })

    $('#starts-at, #ends-at').on('click', function () {
        $('#caledar').html('');
        $('#form-submit').removeClass('hide').addClass('hide');
    });

});
