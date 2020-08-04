<?php
require_once './db.php';
require_once './mail.php';
require_once 'pdf-generation.php';
$form = $_POST['submit_type'];
if ($form == 'time-off-request' || $form == 'time-off-request-approve') {
    $employee_no_request = $_POST['employeeNoRequest'];
    $employee_name_request = $_POST['employeeNameRequest'];
    $supervisor_request = $_POST['supervisorRequest'];
    $pay_end_request = $_POST['payPeriodEnd'];
    if ($_POST['requestType'] == 'on') {
        $type_request = $_POST['requestTypeOther'];
    }
    else {
        $type_request = $_POST['requestType'];
    }
    $begin_date_request = $_POST['beginDate'];
    $end_date_request = $_POST['endDate'];
    $total_request = $_POST['totalHr'];
}
else if ($form == 'manual-time-entry' || $form == 'manual-time-entry-approve') {
    $employee_no_entry = $_POST['employeeNo'];
    $employee_name_entry = $_POST['employeeName'];
    $supervisor_entry = $_POST['supervisor'];
    $occurrenceDate_entry = $_POST['occurrenceDate'];
    if ($_POST['explanationCode'] == '09') {
        $explanationCode_entry = $_POST['explanationCodeOther'];
    }
    else {
        $explanationCode_entry = $_POST['explanationCode'];
    }
    $dept_entry = $_POST['dept'];
    $payStatus_entry = $_POST['payStatus'];
    $inTime_entry = $_POST['inTime'];
    $outTime_entry = $_POST['outTime'];
    $workOrder_entry = $_POST['workOrder'];
    $seq_entry = $_POST['seq'];
    $totalInTimeHour_entry = $_POST['totalInTimeHour'];
    $totalInTimeMin_entry = $_POST['totalInTimeMin'];
    $lessLunchHour_entry = $_POST['lessLunchHour'];
    $lessLunchMin_entry = $_POST['lessLunchMin'];
    $netInTimeHour_entry = $_POST['netInTimeHour'];
    $netInTimeMin_entry = $_POST['netInTimeMin'];
}

$identity = sha1(time());

if ($form == 'time-off-request') {
    $sql = "INSERT INTO `tbl_time` (`employee_no`, `employee_name`, `supervisor`, `pay_end`, `type`, `begin_date`, `end_date`, `total_hours`, `identity`) VALUES (
    '" . $employee_no_request . "', '" . $employee_name_request . "', '" . $supervisor_request . "', '" . $pay_end_request . "', '" . $type_request . "', '" . $begin_date_request . "', '" . $end_date_request . "', '" . $total_request . "', '" . $identity . "')";
    // use exec() because no results are returned
    $conn->exec($sql);
    $last_id = $conn->lastInsertId();

    $mail = mailer($identity, 'time-off-request');

    if ($mail == "success") {
        echo 'sent';
    }
    else {
        echo 'wrong';
    }
}
else if ($form == 'time-off-request-approve') {
    $identity_string = $_POST['identity'];
    $sql = "UPDATE `tbl_time` SET `employee_no`='" . $employee_no_request . "',`employee_name`='" . $employee_name_request . "',`supervisor`='" . $supervisor_request . "',`pay_end`='" . $pay_end_request . "',`type`='" . $type_request . "',`begin_date`='" . $begin_date_request . "',`end_date`='" . $end_date_request . "',`total_hours`='" . $total_request . "', `approve` = 0 WHERE `identity` = '" . $identity_string . "'";
    $conn->exec($sql);
    $pub_name =  MD5(date("Y-m-d H:i:s")).'.pdf';
    $file_url = 'pdf\\'.MD5(date("Y-m-d H:i:s")).'.pdf';
    time_request_pdf($employee_no_request, $employee_name_request,  $supervisor_request, $pay_end_request, $type_request, $begin_date_request, $end_date_request, $total_request, $file_url);
    
    $mail = mailer($identity_string, 'time-off-request-approve', $file_url, 'time-off-request.pdf');
    unlink($file_url);
    if ($mail == "success") {
        echo 'sent';
    }
    else {
        echo 'wrong';
    }
}
else if ($form == 'manual-time-entry') {
    $sql = "INSERT INTO `tbl_manual` (`employee_no`, `employee_name`, `supervisor`, `occurrence_date`, `explanation_code`, `dept`, `pay_status`, `clock_in`, `clock_out`, `work_order`, `seq`, `total_hour`, `total_min`, `less_hour`, `less_min`, `net_hour`, `net_min`, `identity`) VALUES (
    '" . $employee_no_entry . "', '" . $employee_name_entry . "', '" . $supervisor_entry . "', '" . $occurrenceDate_entry . "', '" . $explanationCode_entry . "', '" . $dept_entry . "', '" . $payStatus_entry . "', '" . $inTime_entry . "', '" . $outTime_entry . "', '" . $workOrder_entry . "', '" . $seq_entry . "', '" . $totalInTimeHour_entry . "', '" . $totalInTimeMin_entry . "', '" . $lessLunchHour_entry . "', '" . $lessLunchMin_entry . "', '" . $netInTimeHour_entry . "', '" . $netInTimeMin_entry . "', '" . $identity . "')";
    // use exec() because no results are returned
    $conn->exec($sql);
    $last_id = $conn->lastInsertId();

    $mail = mailer($identity, 'manual-time-entry');

    if ($mail == "success") {
        echo 'sent';
    }
    else {
        echo 'wrong';
    }
}
else if ($form == 'manual-time-entry-approve') {
    $identity_string = $_POST['identity'];
    $sql = "UPDATE `tbl_manual` SET `employee_no` = '" . $employee_no_entry . "', `employee_name`='" . $employee_name_entry . "', `supervisor` = '" . $supervisor_entry . "', `occurrence_date` = '" . $occurrenceDate_entry . "', `explanation_code` = '" . $explanationCode_entry . "', `dept` = '" . $dept_entry . "', `pay_status` = '" . $payStatus_entry . "', `clock_in` = '" . $inTime_entry . "', `clock_out` = '" . $outTime_entry . "', `work_order` = '" . $workOrder_entry . "', `seq` = '" . $seq_entry . "', `total_hour` = '" . $totalInTimeHour_entry . "', `total_min` = '" . $totalInTimeMin_entry . "', `less_hour` = '" . $lessLunchHour_entry . "', `less_min` = '" . $lessLunchMin_entry . "', `net_hour` = '" . $netInTimeHour_entry . "', `net_min` = '" . $netInTimeMin_entry . "', `approve`=0 WHERE `identity` = '" . $identity_string . "'";
    $conn->exec($sql);
   
    $pub_name =  MD5(date("Y-m-d H:i:s")).'.pdf';
    $file_url = 'pdf\\'.MD5(date("Y-m-d H:i:s")).'.pdf';
    
    manual_time_entry_pdf($employee_no_entry, $employee_name_entry,  $supervisor_entry, $occurrenceDate_entry, $explanationCode_entry, $dept_entry, $payStatus_entry, $inTime_entry,$outTime_entry, $workOrder_entry, $seq_entry, $totalInTimeHour_entry, $totalInTimeMin_entry, $lessLunchHour_entry, $lessLunchMin_entry, $netInTimeHour_entry, $netInTimeMin_entry, $file_url);
    $mail = mailer($identity_string, 'manual-time-entry-approve', $file_url, 'manual-time-entry.pdf');
    unlink($file_url);
    if ($mail == "success") {
        echo 'sent';
    }
    else {
        echo 'wrong';
    }
}