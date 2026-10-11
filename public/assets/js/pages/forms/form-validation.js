'use strict';
$(function () {
    $('#form_validation').validate({
        rules: {
            'checkbox': {
                required: true
            },
            'gender': {
                required: true
            }
        },
        highlight: function (input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.form-group').append(error);
        }
    });

    //Advanced Form Validation
    $('#form_advanced_validation').validate({
        rules: {
            'date': {
                customdate: true
            },
            'creditcard': {
                creditcard: true
            },
            'time24': {
                time24: true
            },
            'mandatoryHours': {
                mandatoryHours: true
            },
        },
        highlight: function (input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.form-group').append(error);
        }
    });

    //Custom Validations ===============================================================================
    //Date
    $.validator.addMethod('customdate', function (value, element) {
        return value.match(/^\d\d\d\d?-\d\d?-\d\d$/);
    },
        'Please enter a date in the format YYYY-MM-DD.'
    );

    //Credit card
    $.validator.addMethod('creditcard', function (value, element) {
        return value.match(/^\d\d\d\d?-\d\d\d\d?-\d\d\d\d?-\d\d\d\d$/);
    },
        'Please enter a credit card in the format XXXX-XXXX-XXXX-XXXX.'
    );

    //Time 24
    $.validator.addMethod('time24', function (value, element) {
            return value.match(/^(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/);
        },
        'زمان باید مانند "۰۸:۰۰" باشد!'
    );

    //Mandatory Hours
    $.validator.addMethod('mandatoryHours', function (value, element) {
            return value.match(/^(0[0-9]|1[0-1]):[0-5][0-9]$/);
        },
        'ساعت موظفی می‌تواند بین "00:00" الی "11:59" و با همین فرمت باشد!'
    );
    //==================================================================================================
});
