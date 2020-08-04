// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  window.addEventListener('load', function () {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation')

    // Loop over them and prevent submission
    Array.prototype.filter.call(forms, function (form) {
      form.addEventListener('submit', function (event) {

        // Check selected day of 
        let payPeriodEndDate = new Date($('#payPeriodEnd').val()).getDay()
        if (payPeriodEndDate != 5 && ($('input[name="submit_type"]').val() == 'time-off-request') || $('input[name="submit_type"]').val() == 'time-off-request-approve') {
          event.preventDefault()
          event.stopPropagation()
        }
        
        if (form.checkValidity() === false) {
          event.preventDefault()
          event.stopPropagation()
        }
        form.classList.add('was-validated')
        if (form.checkValidity() === true) {
          event.preventDefault()
          $.ajax({
              type: 'POST',
              url: './control.php',
              data: $(this).serialize(),
              datatype: 'json',
              beforeSend: function() {
                $('input').prop('disabled', true)
                $('select').prop('disabled', true)
                $('textarea').prop('disabled', true)
              }
          })
          .done(function(data) {
            let formType = $('input[name="submit_type"]').val();
            if (location.href.indexOf('approve') > 0) {
              if (formType == 'time-off-request-approve') {
                location.href = location.href.split('?')[0].replace('time-off-request-approve.php', '') + 'confirm.php?page=approved';
              }
              else {
                location.href = location.href.split('?')[0].replace('manual-time-entry-approve.php', '') + 'confirm.php?page=approved';
              }
            }
            else {
              if (formType == 'time-off-request') {
                location.href = location.href.replace('time-off-request.php', '') + 'confirm.php?page=submitted';
              }
              else {
                location.href = location.href.replace('manual-time-entry.php', '') + 'confirm.php?page=submitted';
              }
            }
          })
        }
      }, false)
    })
  }, false)
}())
