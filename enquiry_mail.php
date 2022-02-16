<?php

include("includes/db.php");
session_start();

if (isset($_GET['purchase_enquiry_mail'])) {

  $purchase_enquiry_id = $_GET['purchase_enquiry_mail'];

  $get_purchase_enquiry = "select * from purchase_enquires where purchase_enquiry_id='$purchase_enquiry_id'";
  $run_purchase_enquiry = mysqli_query($con, $get_purchase_enquiry);
  $row_purchase_enquiry = mysqli_fetch_array($run_purchase_enquiry);

  $purchase_enquiry_created_at = date('M d, Y', strtotime($row_purchase_enquiry['purchase_enquiry_created_at']));
  $email_subject = $row_purchase_enquiry['email_subject'];
  $email_content = $row_purchase_enquiry['email_content'];
  $email_note = $row_purchase_enquiry['email_note'];
  $supplier_email = $row_purchase_enquiry['supplier_email'];


?>
  <!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

  <head>
    <!--[if gte mso 9]>
<xml>
  <o:OfficeDocumentSettings>
    <o:AllowPNG/>
    <o:PixelsPerInch>96</o:PixelsPerInch>
  </o:OfficeDocumentSettings>
</xml>
<![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="x-apple-disable-message-reformatting">
    <!--[if !mso]><!-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--<![endif]-->
    <title></title>

    <?php
    require("PHPMailer/src/Exception.php");
    require("PHPMailer/src/PHPMailer.php");
    require("PHPMailer/src/SMTP.php");

    //   use PHPMailer\PHPMailer\PHPMailer;
    //   use PHPMailer\PHPMailer\Exception;

    //   require 'PHPMailer/src/Exception.php';
    //   require 'PHPMailer/src/PHPMailer.php';
    //   require 'PHPMailer/src/SMTP.php';

    //PHPMailer Object
    $mail = new PHPMailer\PHPMailer\PHPMailer(); //Argument true in constructor enables exceptions

    //Tell PHPMailer to use SMTP
    $mail->IsSMTP();
    $mail->Mailer = "smtp";
    $mail->SMTPDebug  = 0;
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;
    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = "andsystems@gmail.com";
    $mail->Password   = "information#102";

    $mail->IsHTML(true);
    $mail->AddAddress($supplier_email, "AND SYSTEM");
    $mail->SetFrom("andsystems@gmail.com", "And Systems");
    $mail->AddReplyTo("andsystems@gmail.com", "AND SYSTEM");
    // $mail->AddCC("cc-recipient-email@domain", "cc-recipient-name");
    $mail->Subject = $email_subject;

    $content = "

    <style type='text/css'>
      table, td { color: #000000; } @media only screen and (min-width: 620px) {
  .u-row {
    width: 600px !important;
  }
  .u-row .u-col {
    vertical-align: top;
  }

  .u-row .u-col-33p33 {
    width: 199.98px !important;
  }

  .u-row .u-col-50 {
    width: 300px !important;
  }

  .u-row .u-col-66p67 {
    width: 400.02px !important;
  }

  .u-row .u-col-100 {
    width: 600px !important;
  }

}

@media (max-width: 620px) {
  .u-row-container {
    max-width: 100% !important;
    padding-left: 0px !important;
    padding-right: 0px !important;
  }
  .u-row .u-col {
    min-width: 320px !important;
    max-width: 100% !important;
    display: block !important;
  }
  .u-row {
    width: calc(100% - 40px) !important;
  }
  .u-col {
    width: 100% !important;
  }
  .u-col > div {
    margin: 0 auto;
  }
}
body {
  margin: 0;
  padding: 0;
}

table,
tr,
td {
  vertical-align: top;
  border-collapse: collapse;
}

p {
  margin: 0;
}

.ie-container table,
.mso-container table {
  table-layout: fixed;
}

* {
  line-height: inherit;
}

a[x-apple-data-detectors='true'] {
  color: inherit !important;
  text-decoration: none !important;
}

</style>
</head>

<body class='clean-body' style='margin: 0;padding: 0px 10px 0px 10px;-webkit-text-size-adjust: 100%;background-color: #fff;color: #000000'>
<!--[if IE]><div class='ie-container'><![endif]-->
<!--[if mso]><div class='mso-container'><![endif]-->
<table style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #fff;width:100%' cellpadding='0' cellspacing='0'>
<tbody>
<tr style='vertical-align: top'>
  <td style='word-break: break-word;border-collapse: collapse !important;vertical-align: top'>
  <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td align='center' style='background-color: #707070;'><![endif]-->
  

<div class='u-row-container' style='padding: 29px 10px 0px;background-color: rgba(255,255,255,0)'>
<div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #17c297;'>
  <div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>
    <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding: 29px 10px 0px;background-color: rgba(255,255,255,0);' align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:600px;'><tr style='background-color: #17c297;'><![endif]-->
    
<!--[if (mso)|(IE)]><td align='center' width='200' style='width: 200px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;' valign='top'><![endif]-->
<div class='u-col u-col-33p33' style='max-width: 320px;min-width: 200px;display: table-cell;vertical-align: top;'>
<div style='width: 100% !important;'>
<!--[if (!mso)&(!IE)]><!--><div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'><!--<![endif]-->

<table style='font-family:'Lato',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
<tbody>
  <tr>
    <td style='overflow-wrap:break-word;word-break:break-word;padding:20px;font-family:'Lato',sans-serif;' align='left'>
      
<table width='100%' cellpadding='0' cellspacing='0' border='0'>
<tr>
  <td style='padding-right: 0px;padding-left: 0px;' align='center'>
    
    <img align='center' border='0' src='https://ik.imagekit.io/wrnear2017/andlogo_T335zmpyI.png' alt='Image' title='Image' style='outline: none;text-decoration: none;-ms-interpolation-mode: bicubic;clear: both;display: inline-block !important;border: none;height: auto;float: none;width: 100%;max-width: 120px;' width='120'/>
    
  </td>
</tr>
</table>

    </td>
  </tr>
</tbody>
</table>

<!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td><![endif]-->
<!--[if (mso)|(IE)]><td align='center' width='400' style='width: 400px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;' valign='top'><![endif]-->
<div class='u-col u-col-66p67' style='max-width: 320px;min-width: 400px;display: table-cell;vertical-align: top;'>
<div style='width: 100% !important;'>
<!--[if (!mso)&(!IE)]><!--><div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'><!--<![endif]-->

<table style='font-family:'Lato',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
<tbody>
  <tr>
    <td style='overflow-wrap:break-word;word-break:break-word;padding:44px 20px 20px;font-family:'Lato',sans-serif;' align='left'>
      
<div style='color: #ffffff; line-height: 120%; text-align: right; word-wrap: break-word;'>
  <p style='font-size: 14px; line-height: 120%; text-align: left;'><span style='font-size: 2rem; line-height: 80px; font-weight:bolder; font-family:arial;'>PURCHASE ENQUIRY</span></p>
</div>

    </td>
  </tr>
</tbody>
</table>

<!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td><![endif]-->
    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
  </div>
</div>
</div>



<div class='u-row-container' style='padding: 0px 10px;background-color: rgba(255,255,255,0)'>
<div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #f5f5f5;'>
  <div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>
    <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding: 0px 10px;background-color: rgba(255,255,255,0);' align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:600px;'><tr style='background-color: #f5f5f5;'><![endif]-->
    
<!--[if (mso)|(IE)]><td align='center' width='300' style='width: 300px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;' valign='top'><![endif]-->
<div class='u-col u-col-50' style='max-width: 320px;min-width: 300px;display: table-cell;vertical-align: top;'>
<div style='width: 100% !important;'>
<!--[if (!mso)&(!IE)]><!--><div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'><!--<![endif]-->

<table style='font-family:'Lato',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
<tbody>
  <tr>
    <td style='overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:'Lato',sans-serif;' align='left'>
      
<h1 style='margin: 0px; padding-left:15px; color: #7e8c8d; line-height: 350%; text-align: left; word-wrap: break-word; font-weight: normal; font-family: arial,helvetica,sans-serif; font-size: 17px;'>
  $purchase_enquiry_created_at
</h1>

    </td>
  </tr>
</tbody>
</table>

<table style='font-family:'Lato',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
<tbody>
  <tr>
    <td style='overflow-wrap:break-word;word-break:break-word;padding:10px 20px 30px;font-family:'Lato',sans-serif;' align='left'>
      
<div style='color: #757575; line-height: 100%; text-align: left; word-wrap: break-word;padding-left:15px;'>
                    <p style='font-size: 14px; line-height: 80%;'>ANDSYSTEMS.PVT.LTD</p>
                    <p style='font-size: 14px; line-height: 80%;'>Mahape, Navi Mumbai,</p>
                    <p style='font-size: 14px; line-height: 80%;'>Maharashtra 421204. </p>
</div>

    </td>
  </tr>
</tbody>
</table>

<!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td><![endif]-->
<!--[if (mso)|(IE)]><td align='center' width='300' style='width: 300px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;' valign='top'><![endif]-->
<div class='u-col u-col-50' style='max-width: 320px;min-width: 300px;display: table-cell;vertical-align: top;'>
<div style='width: 100% !important;'>
<!--[if (!mso)&(!IE)]><!--><div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'><!--<![endif]-->

<!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td><![endif]-->
    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
  </div>
</div>
</div>



<div class='u-row-container' style='padding: 0px 10px;background-color: rgba(255,255,255,0)'>
<div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #f5f5f5;'>
  <div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>
    <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding: 0px 10px;background-color: rgba(255,255,255,0);' align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:600px;'><tr style='background-color: #f5f5f5;'><![endif]-->
    
<!--[if (mso)|(IE)]><td align='center' width='600' style='width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;' valign='top'><![endif]-->
<div class='u-col u-col-100' style='max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;'>
<div style='width: 100% !important;'>
<!--[if (!mso)&(!IE)]><!--><div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'><!--<![endif]-->

<table style='font-family:'Lato',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
<tbody>
  <tr>
    <td style='overflow-wrap:break-word;word-break:break-word;padding:10px;font-family:'Lato',sans-serif;' align='left'>
      
<div style='line-height: 140%; text-align: left; word-wrap: break-word;padding-left:15px;'>
  <p style='font-size: 14px; line-height: 140%;'>
    $email_content
  </p>
</div>

    </td>
  </tr>
</tbody>
</table>

<!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td><![endif]-->
    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
  </div>
</div>
</div>



<div class='u-row-container' style='padding: 0px 10px;background-color: rgba(255,255,255,0)'>
<div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;'>
  <div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>
    <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding: 0px 10px;background-color: rgba(255,255,255,0);' align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:600px;'><tr style='background-color: #ffffff;'><![endif]-->
    
<!--[if (mso)|(IE)]><td align='center' width='300' style='width: 300px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;' valign='top'><![endif]-->
<div class='u-col u-col-50' style='max-width: 320px;min-width: 300px;display: table-cell;vertical-align: top;'>
<div style='width: 100% !important;padding-left:15px;'>
<!--[if (!mso)&(!IE)]><!--><div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'><!--<![endif]-->

<table style='font-family:'Lato',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
<tbody>
  <tr>
    <td style='overflow-wrap:break-word;word-break:break-word;padding:30px 20px 20px;font-family:'Lato',sans-serif;' align='left'>
      
<div style='color: #333333; line-height: 120%; text-align: left; word-wrap: break-word;'>
  <p style='font-size: 14px; line-height: 120%; text-align: left;'><strong><span style='font-size: 24px; line-height: 28.8px;'>Products</span></strong></p>
</div>

    </td>
  </tr>
</tbody>
</table>

<table style='font-family:'Lato',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
<tbody>
  <tr>
    <td style='overflow-wrap:break-word;word-break:break-word;padding:0px;font-family:'Lato',sans-serif;' align='left'>
      
<table height='0px' align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 1px solid #e3e3e3;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
  <tbody>
    <tr style='vertical-align: top'>
      <td style='word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
        <span>&#160;</span>
      </td>
    </tr>
  </tbody>
</table>

    </td>
  </tr>
</tbody>
</table>

<!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td><![endif]-->
<!--[if (mso)|(IE)]><td align='center' width='300' style='width: 300px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;' valign='top'><![endif]-->
<div class='u-col u-col-50' style='max-width: 320px;min-width: 300px;display: table-cell;vertical-align: top;'>
<div style='width: 100% !important;'>
<!--[if (!mso)&(!IE)]><!--><div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 1px solid #eee;'><!--<![endif]-->

<table style='font-family:'Lato',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
<tbody>
  <tr>
    <td style='overflow-wrap:break-word;word-break:break-word;padding:30px 20px 20px;font-family:'Lato',sans-serif;' align='left'>
      
<div style='color: #333333; line-height: 120%; text-align: left; word-wrap: break-word;'>
  <p style='font-size: 14px; line-height: 120%; text-align: center;'><strong><span style='font-size: 24px; line-height: 28.8px;'>Quantity</span></strong></p>
</div>

    </td>
  </tr>
</tbody>
</table>

<!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td><![endif]-->
    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
  </div>
</div>
</div>";


    $unserialized_array = unserialize($row_purchase_enquiry['raw_product_array']);
    $array_size = (count($unserialized_array) - 1);

    for ($i = 0; $i <= $array_size; $i++) {

      $item_id = $unserialized_array[$i][0];
      $item_qty = $unserialized_array[$i][1];

      $get_raw_id = "select * from raw_products where raw_product_id='$item_id'";
      $run_raw_id = mysqli_query($con, $get_raw_id);
      $row_raw_id = mysqli_fetch_array($run_raw_id);
      $raw_title = $row_raw_id['raw_product_title'];
      $raw_unit = $row_raw_id['raw_product_unit'];

      $content .= "

<div class='u-row-container' style='padding-left:15px;background-color: rgba(255,255,255,0)'>
<div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;'>
  <div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>
    <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding: 0px 10px;background-color: rgba(255,255,255,0);' align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:600px;'><tr style='background-color: #ffffff;'><![endif]-->
    
<!--[if (mso)|(IE)]><td align='center' width='400' style='width: 400px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;' valign='top'><![endif]-->
<div class='u-col u-col-66p67' style='max-width: 320px;min-width: 400px;display: table-cell;vertical-align: top;'>
<div style='width: 100% !important;'>
<!--[if (!mso)&(!IE)]><!--><div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'><!--<![endif]-->

<table style='font-family:'Lato',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
<tbody>
  <tr>
    <td style='overflow-wrap:break-word;word-break:break-word;padding:28px 20px 20px;font-family:'Lato',sans-serif;' align='left'>
      
<div style='color: #333333; line-height: 140%; text-align: left; word-wrap: break-word;'>
  <p style='font-size: 14px; line-height: 140%;'><span style='font-size: 18px; padding-left:10px; line-height: 25.2px;'>$raw_title</span></p>
</div>

    </td>
  </tr>
</tbody>
</table>

<!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td><![endif]-->
<!--[if (mso)|(IE)]><td align='center' width='200' style='width: 200px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;' valign='top'><![endif]-->
<div class='u-col u-col-33p33' style='max-width: 320px;min-width: 200px;display: table-cell;vertical-align: top;'>
<div style='width: 100% !important;'>
<!--[if (!mso)&(!IE)]><!--><div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'><!--<![endif]-->

<table style='font-family:'Lato',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
<tbody>
  <tr>
    <td style='overflow-wrap:break-word;word-break:break-word;padding:40px 20px 20px;font-family:'Lato',sans-serif;' align='left'>
      
<div style='color: #333333; line-height: 120%; text-align: left; word-wrap: break-word;'>
  <p style='font-size: 14px; line-height: 120%;'><span style='font-size: 24px; line-height: 28.8px;'><strong><span style='line-height: 28.8px; font-size: 24px;'>$item_qty $raw_unit</span></strong></span></p>
</div>

    </td>
  </tr>
</tbody>
</table>

<!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td><![endif]-->
    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
  </div>
</div>
</div>
";
    }

    $content .= "
<div class='u-row-container' style='padding-left:10px;background-color: rgba(255,255,255,0)'>
<div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #ffffff;'>
  <div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>
    <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding: 0px 10px;background-color: rgba(255,255,255,0);' align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:600px;'><tr style='background-color: #ffffff;'><![endif]-->
    
<!--[if (mso)|(IE)]><td align='center' width='600' style='width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;' valign='top'><![endif]-->
<div class='u-col u-col-100' style='max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;'>
<div style='width: 100% !important;'>
<!--[if (!mso)&(!IE)]><!--><div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'><!--<![endif]-->

<table style='font-family:'Lato',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
<tbody>
  <tr>
    <td style='overflow-wrap:break-word;word-break:break-word;padding:0px;font-family:'Lato',sans-serif;' align='left'>
      
<table height='0px' align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 1px solid #e3e3e3;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
  <tbody>
    <tr style='vertical-align: top'>
      <td style='word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%'>
        <span>&#160;</span>
      </td>
    </tr>
  </tbody>
</table>

    </td>
  </tr>
</tbody>
</table>

<!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td><![endif]-->
    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
  </div>
</div>
</div>



<div class='u-row-container' style='padding: 0px 10px 20px;background-color: rgba(255,255,255,0)'>
<div class='u-row' style='Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #17c297;'>
  <div style='border-collapse: collapse;display: table;width: 100%;background-color: transparent;'>
    <!--[if (mso)|(IE)]><table width='100%' cellpadding='0' cellspacing='0' border='0'><tr><td style='padding: 0px 10px 20px;background-color: rgba(255,255,255,0);' align='center'><table cellpadding='0' cellspacing='0' border='0' style='width:600px;'><tr style='background-color: #17c297;'><![endif]-->
    
<!--[if (mso)|(IE)]><td align='center' width='600' style='width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;' valign='top'><![endif]-->
<div class='u-col u-col-100' style='max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;'>
<div style='width: 100% !important;'>
<!--[if (!mso)&(!IE)]><!--><div style='padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;'><!--<![endif]-->

<table style='font-family:'Lato',sans-serif;' role='presentation' cellpadding='0' cellspacing='0' width='100%' border='0'>
<tbody>
  <tr>
    <td style='overflow-wrap:break-word;word-break:break-word;padding:30px 20px;font-family:'Lato',sans-serif;' align='left'>
      
<div style='color: #ffffff; line-height: 140%; text-align: center; word-wrap: break-word;padding-left:15px;'>
<p style='font-size: 14px; line-height: 140%; text-align: left;'>$email_note</p>
</div>

    </td>
  </tr>
</tbody>
</table>

<!--[if (!mso)&(!IE)]><!--></div><!--<![endif]-->
</div>
</div>
<!--[if (mso)|(IE)]></td><![endif]-->
    <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
  </div>
</div>
</div>


  <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
  </td>
</tr>
</tbody>
</table>
<!--[if mso]></div><![endif]-->
<!--[if IE]></div><![endif]-->
";
    $mail->MsgHTML($content);
    if (!$mail->Send()) {
      // echo "<script>alert('Error! Try Again');</script>";
      $e->getMessage();
      // echo "<script>window.open('index.php?purchase_enquiry','_self')</script>";
    } else {
      echo "<script>alert('Mail Sent Successfully');</script>";
      echo "<script>window.open('index.php?purchase_enquiry','_self')</script>";
      $staff = $_SESSION['user'];
      $insert_task = "insert into work_task_entries (user_id,
                                                  work_task_title,
                                                  work_task_content,
                                                  work_task_entry_created_at,
                                                  work_task_entry_updated_at)
                                                  values 
                                                  ('$staff',
                                                   'Resend Purchase Enquiry Mail',
                                                   'Purchase enquiry mail sent again to $supplier_email with subject-$email_subject',
                                                   '$today',
                                                   '$today')";
      $run_insert_task = mysqli_query($con, $insert_task);
    }
    ?>
    </body>

  </html>
<?php } ?>