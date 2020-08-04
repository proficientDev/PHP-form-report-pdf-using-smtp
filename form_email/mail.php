<?php
//Settings 
$your_email = 'ultraj0330@gmail.com';// update this to your email address

$errors ='';

require_once('PHPMailer/PHPMailer.php');
require_once('PHPMailer/Exception.php');
require_once('PHPMailer/SMTP.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function mailer($identity_string, $form_name, $file_path = '', $file_name = '') {
    if ($form_name == 'time-off-request') {
        global $employee_no_request, $employee_name_request, $conn, $your_email, $supervisor_request;
	}
	else if ($form_name == 'time-off-request-approve') {
		global $employee_no_request, $employee_name_request, $conn, $your_email, $supervisor_request;
	}
	else if ($form_name == 'manual-time-entry') {
        global $employee_no_entry, $employee_name_entry, $conn, $your_email, $supervisor_entry;
	}
	else if ($form_name == 'manual-time-entry-approve') {
		global $employee_no_entry, $employee_name_entry, $conn, $your_email, $supervisor_entry;
	}

    // $identity_string = sha1(time() . $id);

    $mail = new PHPMailer();

	$mail->SMTPDebug = 4; 
	$mail->IsSMTP();
	$mail->Host = "smtp.mailtrap.io";

	//$mail->SMTPAuth = false;
	$mail->SMTPAutoTLS = false; 
	$mail->Port = 2525; 

	// optional
	// used only when SMTP requires authentication  
	$mail->SMTPAuth = true;
	$mail->Username = 'e720b03794a6c4';
	$mail->Password = '57f88b9754fbbb';
	$mail->isHTML();
	$mail->SetFrom($your_email);
	
	if ($form_name == 'time-off-request') {
		$mail->Subject   = 'Time Off Request';
		$mail->Body      = '<h1>Time Off Request</h1>
							<label>Employee No: </label><span>' . $employee_no_request . '</span></br>
							<label>Employee Name: </label><span>' . $employee_name_request . '</span>
							</br>
							<a href="' . $_SERVER['HTTP_ORIGIN'] . substr($_SERVER['REQUEST_URI'], 0, -11) . $form_name . '-approve.php?ref=' . $identity_string . '">Click this link to approve employee request.</a>';
		$mail->AddAddress( $supervisor_request );
	}
	else if ($form_name == 'manual-time-entry') {
		$mail->Subject   = 'Manual Time Entry';
		$mail->Body      = '<h1>Manual Time Entry</h1>
							<label>Employee No: </label><span>' . $employee_no_entry . '</span></br>
							<label>Employee Name: </label><span>' . $employee_name_entry . '</span>
							</br>
							<a href="' . $_SERVER['HTTP_ORIGIN'] . substr($_SERVER['REQUEST_URI'], 0, -11) . $form_name . '-approve.php?ref=' . $identity_string . '">Click this link to approve employee request.</a>';
		$mail->AddAddress( $supervisor_entry );
		
	}
	else if ($form_name == 'time-off-request-approve') {
		$mail->Subject   = 'Time Off Request - Approved';
        $mail->Body      = '<h1>Time Off Request Approved</h1>
                            <label>Employee No: </label><span>' . $employee_no_request . '</span></br>
                            <label>Employee Name: </label><span>' . $employee_name_request . '</span></br>';
		$mail->AddAddress( $supervisor_request );
		$mail->AddAttachment( $file_path , $file_name );
		
	}
	else if ($form_name == 'manual-time-entry-approve') {
		$mail->Subject   = 'Manual Time Entry - Approved';
        $mail->Body      = '<h1>Manual Time Entry Approved</h1>
                            <label>Employee No: </label><span>' . $employee_no_entry . '</span></br>
                            <label>Employee Name: </label><span>' . $employee_name_entry . '</span></br>';
		$mail->AddAddress( $supervisor_entry );
		$mail->AddAttachment( $file_path , $file_name );
	}

	$res = $mail->Send();
	// echo "response".$res;
	// echo "send mail failed:".$mail->ErrorInfo;
	return 'success';
}