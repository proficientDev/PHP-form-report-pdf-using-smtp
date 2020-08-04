<?php

require_once __DIR__ . '/vendor/autoload.php';

function time_request_pdf($employee_no_request, $employee_name_request,  $supervisor_request, $pay_end_request, $type_request, $begin_date_request, $end_date_request, $total_request, $file_url){
    $mpdf = new \Mpdf\Mpdf([
        'margin_left' => 0,
        'margin_right' => 0,
        'margin_top' => 250,
        //'margin_bottom' => 25,
        'margin_header' => 26,
        'margin_footer' => 0,
        'mode' => 'utf-8', 'format' => [656, 928]
    ]);
    $mpdf->setAutoTopMargin = 'stretch';
    $mpdf->SetProtection(array('print'));
    $mpdf->SetTitle("Time Off Request Form PDF");
    $mpdf->SetAuthor("Jeffrey");
    
    
    $logo = 'img/time-off-request.jpg';
    $mpdf->imageVars['myvariable'] = file_get_contents('img/time-off-request.jpg');
            $html = '
    <html>
    <head>
    <style>
    body {font-family: jose;
        font-style:normal;
        font-size: 10pt;
        color: #0f2e3e;
    }
    p {	margin: 0pt; }
    table.items {
        border: 0.1mm solid #000000;
    }
    td { vertical-align: top; }
    .items td {
        border-left: 0.1mm solid #000000;
        border-right: 0.1mm solid #000000;
    }
    table thead td { background-color: #EEEEEE;
        text-align: center;
        border: 0.1mm solid #000000;
        font-variant: small-caps;
    }
    .items td.blanktotal {
        background-color: #EEEEEE;
        border: 0.1mm solid #000000;
        background-color: #FFFFFF;
        border: 0mm none #000000;
        border-top: 0.1mm solid #000000;
        border-right: 0.1mm solid #000000;
    }
    .items td.totals {
        text-align: right;
        border: 0.1mm solid #000000;
    }
    .items td.cost {
        text-align: "." center;
    }
    
    table.headertable td{
        vertical-align: bottom;
        
    }
    table.sub-headertable td{
        
        float:right;
    }
    .footer table th{
        text-align:left;
        
    }
    </style>
    </head>
    <body>
    <!--mpdf
    <htmlpageheader name="myheader">
    <table width="100%" class="headertable"><tr>
        <td width="64%"><img src="'.$logo.'" height="100%" style=" max-width: 536px; margin-left:160px"/></td>
       
    </tr></table>
    <div style="padding-top:250px"></div>
    <div style="display:inline-block">
    
    <table class="sub-headertable" width="100%" style="float:left"><tr>
        <td width="7%"></td>
        <td width="5%"><span style="font-size:88px;font-family:serif; font-weight: bold; color: #51bbff; margin-right: 30px;">&mdash;</span></td>
        <td width="25%"><span style="font-size: 96px; font-style: regular">TIME OFF REQUEST</span></td>
        <td width="55%"><div> &nbsp;</div>
        <div style="font-size: 38px; ">Below is the TIME OFF REQUEST FORM DATA</div>
        <div> &nbsp;</div>
    </tr></table>
    </div>
    
    
    </htmlpageheader>
    
    
    <htmlpagefooter name="myfooter">
    <div class="footer" style="background:#eef2f4">
    
     <div style="margin-top: 245px;">
        <table style="width: 100%">
            <tr>
                <td width="7%"></td>
                <td width="93%"><span style="font-size: 25px; color: #607f8f;">© Copyright 2020</span></td>
                
            </tr>
        </table>
     </div>
    <div style=" margin-top:85px">
    </div>
     </div>
    </htmlpagefooter>
    <sethtmlpageheader name="myheader" value="on" show-this-page="1" />
    <sethtmlpagefooter name="myfooter" value="on" />
    mpdf-->
    
    
    <style>
        .container{
            margin-left:230px;
            margin-right: 210px;
            width: 100%;
            position: relative;
        }
        .pharse-row{
            position: relative;
            margin-left: 70px;
            margin-top: 50px;
            width: 100%;
        }
        
        .pharse-first{width: 100%; }
        .pharse-first .pharse-title{
            width: 30%;
            float: left;
        }
        .pharse-first .date{
            width; 70%;
        }
        .pharse-title span{
            font-size: 36px;
            font-weight:bold;
            
        }
        .dates span{
            font-size: 36px;
            font-weight:bold;
            
        }
        .pharse-row .row-desc{
            position: relative;
            width: 28%;
            float: left;
        }
        .pharse-row .row-date{
            position: relative;
            width: 20%;
            float:left;
            
        }
        .row-bar{
            float: left;
            position: relative;
            background: grey;
            border-radius:40%;
            width: 900px;
        }
        .row-bar .row-position{
            width: 50px; 
            height: 50px; 
            background: #f51e6a; 
            border-radius: 40%; 
            margin-left: 400px;  
            float:left;
        }
        .pharse-row span{
            font-size: 36px;
            
            font-style: italic;
        }
    </style>
    
    <div class="container">
        <div class="pharse-row">
            <div class="row-desc"><span>Employee No:</span></div>
            <div class="row-date"><span>'.$employee_no_request.'</span></div>
            <div class="row-desc"><span>Employee Name:</span></div>
            <div class="row-date"><span>'.$employee_name_request.'</span></div>
        </div>
        <div class="pharse-row">
            <div class="row-desc"><span>Your Supervisor:</span></div>
            <div class="row-date"><span>John Doe</span></div>
        </div>
        <div class="pharse-row">
            <div class="row-desc"><span>For pay period Ending:</span></div>
            <div class="row-date"><span>'.$pay_end_request.'</span></div>
        </div>
        <div class="pharse-row">
            <div class="row-desc"><span>Time Off Request Type:</span></div>
            <div class="row-date"><span>'.$type_request.'</span></div>
        </div>';

        if($begin_date_request != '' || $end_date_request != ''){
            $html .= '<div class="pharse-row">';
        }
        if($begin_date_request != ''){
            $html .= '   
            <div class="row-desc"><span>Time Off Beginning Date:</span></div>
            <div class="row-date"><span>'.$begin_date_request.'</span></div>';
        }

        if($end_date_request != ''){
            $html .= '<div class="row-desc"><span>Time Off Ending Date:</span></div>
            <div class="row-date"><span>'.$end_date_request.'</span></div>';
        }
        if($begin_date_request != '' || $end_date_request != ''){
            $html .= '</div>';
        }
        $html .= '<div class="pharse-row">
            <div class="row-desc"><span>Time Off Total Hrs Requested:</span></div>
            <div class="row-date"><span>'.$total_request.'</span></div>
        </div>
    </div>
    </body>
    </html>
    ';
    
    $mpdf->WriteHTML($html);
    $mpdf->debug = false;
    
    $mpdf->Output($file_url, "F");
    
    //$mpdf->Output($pub_date, "I");
}

function getExplanation($name){
    switch($name){
        case '01':
            return 'Forgot to Clock In/Out';
            break;
        case '02':
            return 'Input Error';
            break;
        case '03':
            return 'Out of Shop / Errand';
            break;
        case '04':
            return 'System Down';
            break;
        case '05':
            return 'skipped Lunch';
            break;
        case '06':
            return 'Took Lunch (Friday)';
            break;
        case '07':
            return 'Vacation';
            break;
        case '08':
            return 'Sick-Pay';
            break;
        default: 
            return $name;
            break;
    }
    return;
}

function getPayStatus($status){
    switch($status){
        case '01':
            return 'Weekly - Hourly';
            break;
        case '02':
            return 'Weekly - Salary';
            break;
        case '03':
            return 'Bi - Weekly - Salary';
            break;
        default:
            return 'Weekly - Hourly';
            break;
    }
    return;

}
function manual_time_entry_pdf($employee_no_entry, $employee_name_entry,  $supervisor_entry, $occurrenceDate_entry, $explanationCode_entry, $dept_entry, $payStatus_entry, $inTime_entry,$outTime_entry, $workOrder_entry, $seq_entry, $totalInTimeHour_entry, $totalInTimeMin_entry, $lessLunchHour_entry, $lessLunchMin_entry, $netInTimeHour_entry, $netInTimeMin_entry, $file_url){
    $mpdf = new \Mpdf\Mpdf([
        'margin_left' => 0,
        'margin_right' => 0,
        'margin_top' => 250,
        //'margin_bottom' => 25,
        'margin_header' => 26,
        'margin_footer' => 0,
        'mode' => 'utf-8', 'format' => [656, 928]
    ]);
    $mpdf->setAutoTopMargin = 'stretch';
    $mpdf->SetProtection(array('print'));
    $mpdf->SetTitle("Time Off Request Form PDF");
    $mpdf->SetAuthor("Jeffrey");
    
    
    $logo = 'img/manual-time-entry.jpg';
    $mpdf->imageVars['myvariable'] = file_get_contents('img/manual-time-entry.jpg');
            $html = '
    <html>
    <head>
    <style>
    body {font-family: jose;
        font-style:normal;
        font-size: 10pt;
        color: #0f2e3e;
    }
    p {	margin: 0pt; }
    table.items {
        border: 0.1mm solid #000000;
    }
    td { vertical-align: top; }
    .items td {
        border-left: 0.1mm solid #000000;
        border-right: 0.1mm solid #000000;
    }
    table thead td { background-color: #EEEEEE;
        text-align: center;
        border: 0.1mm solid #000000;
        font-variant: small-caps;
    }
    .items td.blanktotal {
        background-color: #EEEEEE;
        border: 0.1mm solid #000000;
        background-color: #FFFFFF;
        border: 0mm none #000000;
        border-top: 0.1mm solid #000000;
        border-right: 0.1mm solid #000000;
    }
    .items td.totals {
        text-align: right;
        border: 0.1mm solid #000000;
    }
    .items td.cost {
        text-align: "." center;
    }
    
    table.headertable td{
        vertical-align: bottom;
        
    }
    table.sub-headertable td{
        
        float:right;
    }
    .footer table th{
        text-align:left;
        
    }
    </style>
    </head>
    <body>
    <!--mpdf
    <htmlpageheader name="myheader">
    <table width="100%" class="headertable"><tr>
        <td width="64%"><img src="'.$logo.'" height="100%" style=" max-width: 536px; margin-left:160px"/></td>
       
    </tr></table>
    <div style="padding-top:250px"></div>
    <div style="display:inline-block">
    
    <table class="sub-headertable" width="100%" style="float:left"><tr>
        <td width="7%"></td>
        <td width="5%"><span style="font-size:88px;font-family:serif; font-weight: bold; color: #51bbff; margin-right: 30px;">&mdash;</span></td>
        <td width="25%"><span style="font-size: 96px; font-style: regular">MANUAL TIME ENTRY</span></td>
        <td width="55%"><div> &nbsp;</div>
        <div style="font-size: 38px; ">Below is the MANUAL TIME ENTRY FORM DATA</div>
        <div> &nbsp;</div>
    </tr></table>
    </div>
    
    </htmlpageheader>
    
    <htmlpagefooter name="myfooter">
    <div class="footer" style="background:#eef2f4">
     <div style="margin-top: 245px;">
        <table style="width: 100%">
            <tr>
                <td width="7%"></td>
                <td width="93%"><span style="font-size: 25px; color: #607f8f;">© Copyright 2020</span></td>
                
            </tr>
        </table>
     </div>
    <div style=" margin-top:85px">
    </div>
     </div>
    </htmlpagefooter>
    <sethtmlpageheader name="myheader" value="on" show-this-page="1" />
    <sethtmlpagefooter name="myfooter" value="on" />
    mpdf-->
    
    
    <style>
        .container{
            margin-left:230px;
            margin-right: 210px;
            width: 100%;
            position: relative;
        }
        .pharse-row{
            position: relative;
            margin-left: 70px;
            margin-top: 50px;
            width: 100%;
        }
        
        .pharse-first{width: 100%; }
        .pharse-first .pharse-title{
            width: 30%;
            float: left;
            margin-top:100px;
        }
        .pharse-first .date{
            width; 70%;
        }
        .pharse-title span{
            font-size: 36px;
            font-weight:bold;
            
        }
        .dates span{
            font-size: 36px;
            font-weight:bold;
            
        }
        .pharse-row .row-desc{
            position: relative;
            width: 28%;
            float: left;
        }
        .pharse-row .row-date{
            position: relative;
            width: 20%;
            float:left;
            
        }
        .row-bar{
            float: left;
            position: relative;
            background: grey;
            border-radius:40%;
            width: 900px;
        }
        .row-bar .row-position{
            width: 50px; 
            height: 50px; 
            background: #f51e6a; 
            border-radius: 40%; 
            margin-left: 400px;  
            float:left;
        }
        .pharse-row span{
            font-size: 36px;
            
            font-style: italic;
        }
    </style>
    
    <div class="container">
        <div class="pharse-row">
            <div class="row-desc"><span>Employee No:</span></div>
            <div class="row-date"><span>'.$employee_no_entry.'</span></div>
            <div class="row-desc"><span>Employee Name:</span></div>
            <div class="row-date"><span>'.$employee_name_entry.'</span></div>
        </div>
        <div class="pharse-row">
            <div class="row-desc"><span>Your Supervisor:</span></div>
            <div class="row-date"><span>John Doe</span></div>
        </div>
        <div class="pharse-row">
            <div class="row-desc"><span>Date of Occurrence:</span></div>
            <div class="row-date"><span>'.$occurrenceDate_entry.'</span></div>
            <div class="row-desc"><span>Explanation Code:</span></div>
            <div class="row-date"><span>'.getExplanation($explanationCode_entry).'</span></div>
        </div>
        <div class="pharse-row">
            <div class="row-desc"><span>Dept #:</span></div>
            <div class="row-date"><span>'.$dept_entry.'</span></div>
            <div class="row-desc"><span>Pay Status:</span></div>
            <div class="row-date"><span>'.getPayStatus($payStatus_entry).'</span></div>
         </div>';

        if ($inTime_entry != '' || $outTime_entry != '') {
            $html .= '<div class="pharse-row">';
        }
        if($inTime_entry != ''){
            $html .= '<div class="row-desc"><span>Clock-in Time:</span></div>
            <div class="row-date"><span>'.$inTime_entry.'</span></div>';
        }
        if($outTime_entry != ''){
            $html .= '<div class="row-desc"><span>Clock-out Time:</span></div>
            <div class="row-date"><span>'.$outTime_entry.'</span></div>';
        }

        if ($inTime_entry != '' || $outTime_entry != '') {
            $html .= '</div>';
        }

        //////////////////////////////////////////////////
        if ($workOrder_entry != '' || $seq_entry != '') {
            $html .= '<div class="pharse-row">';
        }
        if($workOrder_entry != ''){
            $html .= ' <div class="row-desc"><span>Work Order #:</span></div>
            <div class="row-date"><span>'.$workOrder_entry.'</span></div>';
        }
        if($seq_entry != ''){
            $html .= ' <div class="row-desc"><span>Seq #:</span></div>
            <div class="row-date"><span>'.$seq_entry.'</span></div>';
        }

        if ($workOrder_entry != '' || $seq_entry != '') {
            $html .= '</div>';
        }

        /////////////////////////////////////////////////////////////////
        if ($totalInTimeHour_entry != '0' || $totalInTimeMin_entry != '0') {
            $html .= '
            <div class="pharse-first">
                <div class="pharse-title"><span>Total Clocked-in Time:</span></div>
            </div>
            <div class="pharse-row">';
        }
        if($totalInTimeHour_entry != '0'){
            $html .= '<div class="row-desc"><span>hours:</span></div>
            <div class="row-date"><span>'.$totalInTimeHour_entry.'</span></div>';
        }
        if($totalInTimeMin_entry != '0'){
            $html .= ' <div class="row-desc"><span>minutes:</span></div>
            <div class="row-date"><span>'.$totalInTimeMin_entry.'</span></div>';
        }

        if ($totalInTimeHour_entry != '0' || $totalInTimeMin_entry != '0') {
            $html .= '</div>';
        }

        /////////////////////////////////////////////////////////////////////////
        if ($lessLunchHour_entry != '0' || $lessLunchMin_entry != '0') {
            $html .= '
            <div class="pharse-first">
              <div class="pharse-title"><span>Less-Lunch:</span></div>
            </div>
            <div class="pharse-row">';
        }
        if($lessLunchHour_entry != '0'){
            $html .= ' <div class="row-desc"><span>hours:</span></div>
            <div class="row-date"><span>'.$lessLunchHour_entry.'</span></div>';
        }
        if($lessLunchMin_entry != '0'){
            $html .= '<div class="row-desc"><span>minutes:</span></div>
            <div class="row-date"><span>'.$lessLunchMin_entry.'</span></div>';
        }

        if ($lessLunchHour_entry != '0' || $lessLunchMin_entry != '0') {
            $html .= '</div>';
        }


         /////////////////////////////////////////////////////////////////////////
         if ($netInTimeHour_entry != '0' || $netInTimeMin_entry != '0') {
            $html .= '
            <div class="pharse-first">
              <div class="pharse-title"><span>Net Clocked-in Time:</span></div>
            </div>
            <div class="pharse-row">';
        }
        if($netInTimeHour_entry != '0'){
            $html .= ' <div class="row-desc"><span>hours:</span></div>
            <div class="row-date"><span>'.$netInTimeHour_entry.'</span></div>';
        }
        if($netInTimeMin_entry != '0'){
            $html .= ' <div class="row-desc"><span>minutes:</span></div>
            <div class="row-date"><span>'.$netInTimeMin_entry.'</span></div>';
        }

        if ($netInTimeHour_entry != '0' || $netInTimeMin_entry != '0') {
            $html .= '</div>';
        }
        $html .='</div></body></html>';
    
    $mpdf->WriteHTML($html);
    $mpdf->debug = false;
    //return $mpdf->Output('pdf\test1.pdf', "F");
    $mpdf->Output($file_url, "F");
}
 
 //echo time_request_pdf();
?>
