<?php
require_once './db.php';

$identity_string = $_GET['ref'];

$stmt = $conn->prepare("SELECT * FROM tbl_time WHERE identity = '" . $identity_string . "'");
$stmt->execute();

$result     = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$results    = $stmt->fetchAll();
$data       = $results[0];

$employee_no     = $data['employee_no'];
$employee_name   = $data['employee_name'];
$supervisor      = $data['supervisor'];
$pay_end         = $data['pay_end'];
$type            = $data['type'];
$begin_date      = $data['begin_date'];
$end_date        = $data['end_date'];
$total_hours     = $data['total_hours'];
$approve         = $data['approve'];
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
    <title>Form email</title>

    <!-- <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/checkout/">-->

    <!-- Bootstrap core CSS -->
    <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/dist/css/bootstrap-datepicker3.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .input-group-addon {
        padding: 10px 12px;
        font-size: 14px;
        font-weight: 400;
        line-height: 1;
        color: #555;
        text-align: center;
        background-color: #eee;
        border: 1px solid #ccc;
        border-radius: 4px;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    <div class="container pt-5">
    
      <h4 class="mb-3 mt-5">Time Off Request</h4>
      <form class="needs-validation" action="./control.php" method="post" novalidate>
        <input type="hidden" name="submit_type" value="time-off-request-approve">
        <input type="hidden" name="identity" value="<?php echo $identity_string; ?>">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="employeeNo">Employee No: <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="employeeNo" name="employeeNoRequest" placeholder="" value="<?php echo $employee_no; ?>" required>
            <div class="invalid-feedback">
              Valid Employee No is required.
            </div>
          </div>
          <div class="col-md-6 mb-3">
            <label for="employeeName">Employee Name: <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="employeeName" name="employeeNameRequest" placeholder="" value="<?php echo $employee_name; ?>" required>
            <div class="invalid-feedback">
              Valid Employee Name is required.
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label for="supervisor">Select your Supervisor: <span class="text-danger">*</span></label>
          <select class="custom-select d-block w-100" id="supervisor" name="supervisorRequest" required>
            <option value="">Choose...</option>
            <option value="johndoe123456@gmail.com" <?php echo $supervisor == 'johndoe123456@gmail.com' ? 'selected="selected"' : '' ?>>John Doe</option>
          </select>
          <div class="invalid-feedback">
            Please select a valid supervisor.
          </div>
        </div>

        <div class="mb-3">
          <label for="payPeriodEnd">For pay period Ending <span class="text-danger">*</span></label>
          <div class="row">
            <div class="col-md-4 mb-3">
              <div class="input-group date">
                <input id="payPeriodEnd" name="payPeriodEnd" type="text" class="form-control" style="border-right: 0;" value="<?php echo $pay_end; ?>" required><span class="input-group-addon"><i class='fas fa-calendar-alt'></i></span>
                <div class="invalid-feedback">
                  Select the Friday of the pay week that this request is for
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="d-block my-3">
          <label for="requestType">Time Off Request Type: <span class="text-danger">*</span></label>
          <div class="custom-control custom-radio">
            <input id="vacation" name="requestType" type="radio" class="custom-control-input" <?php echo $type == 'vacation' ? 'checked': '' ?> required>
            <label class="custom-control-label" for="vacation">Vacation</label>
          </div>
          <div class="custom-control custom-radio">
            <input id="sick" name="requestType" type="radio" class="custom-control-input" <?php echo $type == 'sick' ? 'checked': '' ?> required>
            <label class="custom-control-label" for="sick">Sick</label>
          </div>
          <div class="custom-control custom-radio">
            <input id="other" name="requestType" type="radio" class="custom-control-input" <?php echo $type != 'sick' && $type != 'vacation' ? 'checked': '' ?> required>
            <label class="custom-control-label" for="other">Other</label>
            <!-- <input name="requestTypeOther" type="text" class="form-control other-text" style="display: <?php echo $type != 'sick' && $type != 'vacation' ? 'inline-block': 'none' ?>; margin: -5px 20px; width: 20%;" value="<?php echo $type; ?>">-->
            <textarea name="requestTypeOther" id="" class="form-control other-text" style="display: <?php echo $type != 'sick' && $type != 'vacation' ? 'block': 'none' ?>; width: 100%;"><?php echo $type; ?></textarea>
          </div>
        </div>

        <div class="mb-3">
          
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="beginDate">Time Off Beginning Date: </label>
              <div class="input-group date">
                <input name="beginDate" type="text" class="form-control" style="border-right: 0;" value="<?php echo $begin_date; ?>"><span class="input-group-addon"><i class="fas fa-calendar-alt"></i></span>
              </div>
            </div>
            <div class="col-md-6 mb-3">
              <label for="endDate">Time Off Ending Date: </label>
              <div class="input-group date">
                <input name="endDate" type="text" class="form-control" style="border-right: 0;" value="<?php echo $end_date; ?>"><span class="input-group-addon"><i class="fas fa-calendar-alt"></i></span>
              </div>
            </div>
          </div>
          
          <div class="invalid-feedback">
            Please enter a valid period.
          </div>
        </div>

        <div class="mb-3">
          <label for="totalHr">Time Off Total Hrs Requested: <span class="text-danger">*</span></label>
          <input type="number" class="form-control" id="totalHr" name="totalHr" placeholder=""  value="<?php echo $total_hours; ?>" required>
          <div class="invalid-feedback">
            Please enter a valid request.
          </div>
        </div>

        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit" style="display: <?php echo $approve == 1 ? 'block;' : 'none;' ?>" >Approve</button>
      </form>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="../assets/js/vendor/jquery.slim.min.js"><\/script>')</script>
  <script src="./assets/dist/js/bootstrap.bundle.min.js"></script>
  <script src="form-validation.js"></script>
  <script src="./assets/dist/js/bootstrap-datepicker.min.js"></script>
  <script src="./assets/dist/js/script.js"></script>
  <script>
  var approve = <?php echo $approve;?>;
  if (approve == 0) {
    $('input').prop('disabled', true);
    $('select').prop('disabled', true);
    $('textarea').prop('disabled', true);
  }
  </script>
  </body>
</html>
