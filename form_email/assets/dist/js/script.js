$(document).ready(function () {
    
    $('.input-group.date').datepicker({});

    $('input[type="radio"]').on('click', function() {
        if ($(this).attr('id') == 'other') {
            return;
        }
        $('.other-text').css('display', 'none');
    });
    $('#other').on('click', function() {
        $('.other-text').css('display', 'inline-block');
    });

    $('#explanationCode').on('change', function() {
        if ($(this).val() == '09') {
            $('#otherExplanationCode').css('display', 'block');
        }
        else {
            $('#otherExplanationCode').css('display', 'none');
        }
    });

    $('#payPeriodEnd').datepicker().on('show', function(e){
        let selectedDay = new Date(e.date).getDay();
        if (selectedDay != 5) {
            $('#payPeriodEnd').parent().find('.invalid-feedback').css('display', 'block');
            $('#payPeriodEnd').css('border-right', '0');
            $('#payPeriodEnd').css('border-color', '#dc3545');
            $('#payPeriodEnd').css('background', 'none');
        }
        else {
            $('#payPeriodEnd').parent().find('.invalid-feedback').css('display', 'none');
            $('#payPeriodEnd').css('border-right', '0');
            $('#payPeriodEnd').css('border-color', 'unset');
            $('#payPeriodEnd').css('background', 'none');
        }
    });

});