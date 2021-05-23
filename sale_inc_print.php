<?php 

include("includes/db.php");

?>
<?php 

if(isset($_GET['sale_inc_print'])){

 $sale_inc_entry_id = $_GET['sale_inc_print'];

 $get_print = "select * from sale_inc_entries where sale_inc_entry_id='$sale_inc_entry_id'";
 $run_print = mysqli_query($con,$get_print);
 $row_print = mysqli_fetch_array($run_print);

 $sale_inc_no = $row_print['sale_inc_no'];
 $sale_inc_date = $row_print['sale_inc_date'];
 $sale_inc_due_date = $row_print['sale_inc_due_date'];
 $sale_supply_date = $row_print['sale_supply_date'];
 $transport_title = $row_print['transport_title'];
 $transport_vehicle_no = $row_print['transport_vehicle_no'];
 $e_way_bill_no = $row_print['e_way_bill_no'];
 $billed_title = $row_print['billed_title'];
 $billed_contact = $row_print['billed_contact'];
 $billed_address = $row_print['billed_address'];
 $billed_state = $row_print['billed_state'];
 $billed_state_code = $row_print['billed_state_code'];
 $billed_gstn = $row_print['billed_gstn'];
 $shipped_title = $row_print['shipped_title'];
 $shipped_contact = $row_print['shipped_contact'];
 $shipped_address = $row_print['shipped_address'];
 $shipped_state = $row_print['shipped_state'];
 $shipped_state_code = $row_print['shipped_state_code'];
 $shipped_gstn = $row_print['shipped_gstn'];
 $extra_paid = $row_print['extra_paid'];

?>

    <?php     
            // Create a function for converting the amount in words
        function AmountInWords(float $amount)
        {
        $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
        // Check if there is any number after decimal
        $amt_hundred = null;
        $count_length = strlen($num);
        $x = 0;
        $string = array();
        $change_words = array(0 => '', 1 => 'One', 2 => 'Two',
            3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
            7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
            10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
            13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
            16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
            19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
            40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
            70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
            $here_digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
            while( $x < $count_length ) {
            $get_divider = ($x == 2) ? 10 : 100;
            $amount = floor($num % $get_divider);
            $num = floor($num / $get_divider);
            $x += $get_divider == 10 ? 1 : 2;
            if ($amount) {
            $add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
            $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
            $string [] = ($amount < 21) ? $change_words[$amount].' '. $here_digits[$counter]. $add_plural.' 
            '.$amt_hundred:$change_words[floor($amount / 10) * 10].' '.$change_words[$amount % 10]. ' 
            '.$here_digits[$counter].$add_plural.' '.$amt_hundred;
                }
        else $string[] = null;
        }
        $implode_to_Rupees = implode('', array_reverse($string));
        $get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
        " . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';
        return ($implode_to_Rupees ? $implode_to_Rupees . ' ' : '') . $get_paise;
        }
    ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Silver Wrap</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
    body{
        color:#000;
    }
    table,th,td{
        border:1px solid #000;
    }
      @media print {
                    .pagebreak { page-break-before: always; } 
                    }
                    @page {
                        margin: 2%;
                            }
  </style>
    <script>
        window.onload = function () {
            window.print();
        }

        window.onafterprint = function(){
            window.close();
        }
    </script>
  </head>
  <body>
    <?php
            for ($i=0; $i <= 2; $i++) { 

                if($i==0){
                    $print_copy = 'Original For Recipient';
                }elseif($i==1){
                    $print_copy = 'Duplicate For Transporter';
                }elseif($i==2){
                    $print_copy = 'Triplicate For Supplier';
                }

    ?>
<div class="pagebreak"> 
    <div class="container-fluid text-dark bg-white">
            <div class="row">
                    <div class="col-9 px-0" style="border:1px solid #000;">
                        <h4 class="text-center p-2 mb-0">
                            TAX INVOICE
                        </h4>
                    </div>
                    <div class="col-3 px-0" style="border:1px solid #000;">
                        <h5 class="text-center p-2 mb-0">
                            <?php echo $print_copy; ?>
                        </h5>
                    </div>
                    <div class="col-6 pt-2 text-center pt-2" style="border:1px solid #000;text-transform: uppercase;">
                        <h1 class="mb-0 text-uppercase">AND SYSTEMS</h1>
                    </div>
                    <div class="col-6 p-2" style="border:1px solid #000;">
                        <h5 class="text-center mb-0 text-capitalize">Mahape navi mumbai, maharashtra 421204</h5>
                        <h5 class="text-center mb-0">✆ +91 9867765397 | ✉ andsystems@gmail.com</h5>
                    </div>
                <div class="col-6 pt-2 mb-0" style="border:1px solid #000;">
                    <h5>GSTIN Number : 27254dFERT25OZ</h5>
                    <h5>Invoice Number : <?php echo $sale_inc_no; ?></h5>
                    <h5>Invoice Date : <?php echo date("d-M-Y", strtotime($sale_inc_date)); ?></h5>
                    <h5 class="mb-0 text-uppercase">
                        State: MAHARASHTRA
                        <table class="float-right mr-5">
                        <th class="px-2">State Code :</th>
                        <th class="px-3"> 27</th>
                        </table>
                    </h5>
                </div>
                <div class="col-6 pt-2 mb-0" style="border:1px solid #000;">
                    <h5 class="text-capitalize">Transportor : <?php echo $transport_title; ?></h5>
                    <h5>E-way Number : <?php echo $e_way_bill_no; ?></h5>
                    <h5 class="text-uppercase">Vehicle Number: <?php echo $transport_vehicle_no; ?></h5>
                    <h5 class="mb-0">Supply Date : <?php echo date("d-M-Y", strtotime($sale_supply_date)); ?></h5>
                </div>
                <div class="col-6 text-center py-1 bg-secondary" style="border:1px solid #000;">
                    <h4 class="mb-0">Details Of Reciever (Billed To)</h4>
                </div>
                <div class="col-6 text-center py-1 bg-secondary" style="border:1px solid #000;">
                    <h4 class="mb-0">Details Of consignee (Shipped To)</h4>
                </div>
                <!-- Billed to -->
                <div class="col-6 pt-2" style="border:1px solid #000;">
                    <h5 class="text-capitalize">Name : <?php echo $billed_title; ?></h5>
                    <h5>Contact : +91 <?php echo $billed_contact; ?></h5>
                    <h5>Address : <?php echo $billed_address; ?></h5>
                    <h5 class="text-uppercase">GSTIN Number: <?php echo $billed_gstn; ?></h5>
                    <h5 class="mb-0 text-uppercase">
                        State: <?php echo $billed_state; ?>
                        <table class="float-right mr-5">
                        <th class="px-2">State Code :</th>
                        <th class="px-3"> <?php echo $billed_state_code; ?></th>
                        </table>
                    </h5>
                </div>
                <!-- Shipped to -->
                <div class="col-6 pt-2" style="border:1px solid #000;">
                    <h5 class="text-capitalize">Name : <?php echo $shipped_title; ?></h5>
                    <h5>Contact : +91 <?php echo $shipped_contact; ?></h5>
                    <h5 class="text-capitalize">Address : <?php echo $shipped_address; ?></h5>
                    <h5 class="text-uppercase">GSTIN Number: <?php echo $shipped_gstn; ?></h5>
                    <h5 class="mb-0 text-uppercase">
                        State: <?php echo $shipped_state; ?>
                        <table class="float-right mr-5">
                        <th class="px-2">State Code :</th>
                        <th class="px-3"> <?php echo $shipped_state_code; ?></th>
                        </table>
                    </h5>
                </div>
                <div class="col-12 px-0 mt-2">
                    <table class="border-0 text-dark" style="width:100%;">
                        <thead style="font-size:1.1rem;">
                            <tr class="text-center">
                                <th class="align-middle p-1">Sl.No</th>
                                <th class="align-middle p-1">Description of goods</th>
                                <th class="align-middle p-1">HSN Code</th>
                                <th class="align-middle p-1">Quantity</th>
                                <th class="align-middle p-1">Rate</th>
                                <th class="align-middle p-1">Amount</th>
                                <th class="align-middle p-1">Discount</th>
                                <th class="align-middle  p-1">Taxable Value</th>
                            </tr>
                        </thead>
                        <tbody style="font-size:0.7rem;">
                        <?php 
                        
                        $get_inc_pro = "select * from sale_inc_products where sale_inc_no='$sale_inc_no'";
                        $run_inc_pro = mysqli_query($con,$get_inc_pro);
                        $pro_counter = 0;
                        $total_amount = 0;
                        while($row_inc_pro=mysqli_fetch_array($run_inc_pro)){
                            $sale_product_type = $row_inc_pro['sale_product_type'];
                            $sale_product_id = $row_inc_pro['sale_product_id'];
                            $sale_product_qty = $row_inc_pro['sale_product_qty'];
                            $sale_product_unit_rate = $row_inc_pro['sale_product_unit_rate'];
                            $sale_product_hsn_code = $row_inc_pro['sale_product_hsn_code'];
                            $sale_product_gst_rate = $row_inc_pro['sale_product_gst_rate'];
                            $sale_product_gst_type = $row_inc_pro['sale_product_gst_type'];
                            $sale_product_discount = $row_inc_pro['sale_product_discount'];

                            if($sale_product_type==='raw'){

                                $get_product = "select * from raw_products where raw_product_id='$sale_product_id'";
                                $run_product = mysqli_query($con,$get_product);
                                $row_product = mysqli_fetch_array($run_product);

                                $product_title = $row_product['raw_product_title'];
                                $product_unit = $row_product['raw_product_unit'];
                                $product_subunit = $row_product['raw_product_subunit'];

                            }elseif($sale_product_type==='custom'){

                                $get_product = "select * from custom_products where custom_product_id='$sale_product_id'";
                                $run_product = mysqli_query($con,$get_product);
                                $row_product = mysqli_fetch_array($run_product);

                                $product_title = $row_product['custom_product_title'];
                                $product_unit = $row_product['custom_product_unit'];
                                $product_subunit = $row_product['custom_product_subunit'];

                            }

                            $taxable_amount = $sale_product_unit_rate*$sale_product_qty;
                            $total = $taxable_amount-($taxable_amount*($sale_product_discount/100));
                            $total_amount += $total;
                            
                        ?>
                            <tr class="text-center" style="font-size:1rem;">
                                <td class=" p-1"><?php echo ++$pro_counter; ?></td>
                                <td class=" p-1"><?php echo $product_title; ?></td>
                                <td class=" p-1"><?php echo $sale_product_hsn_code; ?></td>
                                <td class=" p-1"><?php echo $sale_product_qty; ?></td>
                                <td class=" p-1"><?php echo $sale_product_unit_rate; ?></td>
                                <td class=" p-1"><?php echo $taxable_amount; ?></td>
                                <td class=" p-1"><?php echo $sale_product_discount; ?> %</td>
                                <td class=" p-1"><?php echo $taxable_amount-($taxable_amount*($sale_product_discount/100)); ?></td>
                            </tr>
                        <?php } ?>
                            <?php 
                            
                            $get_inc_count = "select * from sale_inc_products where sale_inc_no='$sale_inc_no'";
                            $run_inc_count = mysqli_query($con,$get_inc_count);
                            $inc_count = mysqli_num_rows($run_inc_count);
                            $req_count = 10-$inc_count;

                            if($req_count>1){
                                
                                for ($x = 0; $x <= $req_count; $x++) {
                                    echo "
                                        <tr>
                                            <td class='p-3'></td>
                                            <td class='p-3'></td>
                                            <td class='p-3'></td>
                                            <td class='p-3'></td>
                                            <td class='p-3'></td>
                                            <td class='p-3'></td>
                                            <td class='p-3'></td>
                                            <td class='p-3'></td>
                                        </tr>
                                    ";

                            }

                            }else{
                                echo "";
                            }
                            
                            ?>
                        </tbody>
                        <tfoot style="font-size:0.8rem;">
                            <tr>
                                <th colspan="7" class="text-right pr-2"><h5 class="mb-0">TOTAL TAXABLE VALUE</h5></th>
                                <th class="text-center"><h5 class="mb-0"><?php echo $total_amount; ?></h5></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <div class="row mt-2">
            <div class="col-12 px-0 mt-2 mb-2">
                    <table style="width:100%;">
                        <thead>
                            <tr class="text-center">
                                <th rowspan="2">HSN/SAC</th>
                                <th rowspan="2">Taxable Value</th>
                                <th colspan="2">CGST</th>
                                <th colspan="2">SGST</th>
                                <th colspan="2">IGST</th>
                                <th rowspan="2">Total Tax Amount</th>
                            </tr>
                            <tr class="text-center">
                                <th class=" p-1">Rate</th>
                                <th class=" p-1">Amount</th>
                                <th class=" p-1">Rate</th>
                                <th class=" p-1">Amount</th>
                                <th class=" p-1">Rate</th>
                                <th class=" p-1">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $get_dis_hsn = "select distinct(sale_product_hsn_code) from sale_inc_products where sale_inc_no='$sale_inc_no'";
                                $run_dis_hsn = mysqli_query($con,$get_dis_hsn);
                                $grand_taxable = 0;
                                $grand_cgst = 0;
                                $grand_sgst = 0;
                                $grand_igst = 0;
                                while($row_dis_hsn = mysqli_fetch_array($run_dis_hsn)){
                                $dis_hsn = $row_dis_hsn['sale_product_hsn_code'];

                                $get_gst_rate = "select * from sale_inc_products where sale_inc_no='$sale_inc_no' and sale_product_hsn_code='$dis_hsn'";
                                $run_gst_rate = mysqli_query($con,$get_gst_rate);
                                $row_gst_rate = mysqli_fetch_array($run_gst_rate);
                                $dis_gst_rate = $row_gst_rate['sale_product_gst_rate'];
                                $dis_gst_type = $row_gst_rate['sale_product_gst_type'];
                                $dis_carton_qty = $row_gst_rate['sale_product_qty'];
                                $dis_unit_rate = $row_gst_rate['sale_product_unit_rate'];

                                if($dis_gst_type==='STA_TAX'){
                                    $cgst_tax_hsn = $dis_gst_rate/2;
                                    $sgst_tax_hsn = $dis_gst_rate/2;
                                    $igst_tax_hsn = 0;
                                }else{
                                    $cgst_tax_hsn = 0;
                                    $sgst_tax_hsn = 0;
                                    $igst_tax_hsn = $dis_gst_rate;
                                }


                                    $get_hsn = "select * from sale_inc_products where sale_inc_no='$sale_inc_no' and sale_product_hsn_code='$dis_hsn'";
                                    $run_hsn = mysqli_query($con,$get_hsn);
                                    $cgst_amount_hsn = 0;
                                    $sgst_amount_hsn = 0;
                                    $igst_amount_hsn = 0;
                                    $total_taxable_amount_hsn = 0;
                                    while($row_hsn=mysqli_fetch_array($run_hsn)){

                                        $carton_qty_hsn = $row_hsn['sale_product_qty'];
                                        $unit_rate_hsn = $row_hsn['sale_product_unit_rate'];
                                        $gst_type_hsn = $row_hsn['sale_product_gst_type'];
                                        $gst_rate_hsn = $row_hsn['sale_product_gst_rate'];
                                        $gst_discount_hsn = $row_hsn['sale_product_discount'];

                                        $taxable_amount_hsn_bef_discount_hsn = $unit_rate_hsn*$carton_qty_hsn;
                                        $taxable_amount_hsn = $taxable_amount_hsn_bef_discount_hsn-($taxable_amount_hsn_bef_discount_hsn*($gst_discount_hsn/100));
                                        $total_taxable_amount_hsn += $taxable_amount_hsn;

                                        if($gst_type_hsn==='STA_TAX'){
                                            $cgst_amount_hsn += $taxable_amount_hsn*(($gst_rate_hsn/2)/100);
                                            $sgst_amount_hsn += $taxable_amount_hsn*(($gst_rate_hsn/2)/100);
                                            $igst_amount_hsn += 0;
                                        }else{
                                            $cgst_amount_hsn += 0;
                                            $sgst_amount_hsn += 0;
                                            $igst_amount_hsn += $taxable_amount_hsn*($gst_rate_hsn/100);
                                        }
                                    }
                                    $grand_taxable += $total_taxable_amount_hsn;
                                    $grand_cgst += $cgst_amount_hsn;
                                    $grand_sgst += $sgst_amount_hsn;
                                    $grand_igst += $igst_amount_hsn;
                            ?>
                            <tr class="text-center">
                                <td><?php echo $dis_hsn; ?></td>
                                <td><?php echo $total_taxable_amount_hsn; ?></td>
                                <td><?php echo $cgst_tax_hsn; ?> %</td>
                                <td><?php echo $cgst_amount_hsn; ?></td>
                                <td><?php echo $sgst_tax_hsn; ?> %</td>
                                <td><?php echo $sgst_amount_hsn; ?></td>
                                <td><?php echo $igst_tax_hsn; ?> %</td>
                                <td><?php echo $igst_amount_hsn; ?></td>
                                <td><?php echo $cgst_amount_hsn+$sgst_amount_hsn+$igst_amount_hsn; ?></td>
                            </tr>
                                <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr class="text-center">
                                <th>TOTAL</th>
                                <th><?php echo $grand_taxable; ?></th>
                                <th>0</th>
                                <th><?php echo $grand_cgst; ?></th>
                                <th>0</th>
                                <th><?php echo $grand_sgst; ?></th>
                                <th>0</th>
                                <th><?php echo $grand_igst; ?></th>
                                <th><?php echo $grand_cgst+$grand_sgst+$grand_igst; ?></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="col-5 pt-2" style="border:1px solid #000;">
                    <h5 class="text-uppercase"><u>Bank Details</u></h5>
                    <h5 class="text-uppercase">Bank : KOTAK MAHINDRA BANK</h5>
                    <h5 class="text-uppercase">AC Number : 12025480002154 </h5>
                    <h5 class="text-uppercase">Branch : Mahape (IFSC:KMB00012)</h5>
                    <h5 class="text-uppercase">AC Holder : AND SYSTEMS</h5>
                    <h5 class="text-uppercase">Due Date : <?php echo date("d-M-Y", strtotime($sale_inc_due_date)); ?></h5>
                </div>
                <div class="col-3 pt-2" style="border:1px solid #000;">
                    <h6 style="font-size:0.8rem;text-align:center;">Customer Signature</h6>
                </div>
                <div class="col-4 px-0">
                    <table class="table text-dark" style="height:100%;">
                    <?php 
                    
                    $get_dis_ex = "select distinct(sale_product_hsn_code) from sale_inc_products where sale_inc_no='$sale_inc_no'";
                    $run_dis_ex = mysqli_query($con,$get_dis_ex);
                    $grand_taxable_ex = 0;
                    $grand_cgst_ex = 0;
                    $grand_sgst_ex = 0;
                    $grand_igst_ex = 0;
                    while($row_dis_ex = mysqli_fetch_array($run_dis_ex)){
                    $dis_hsn_ex = $row_dis_ex['sale_product_hsn_code'];

                    $get_gst_rate_ex = "select * from sale_inc_products where sale_inc_no='$sale_inc_no' and sale_product_hsn_code='$dis_hsn_ex'";
                    $run_gst_rate_ex = mysqli_query($con,$get_gst_rate_ex);
                    $row_gst_rate_ex = mysqli_fetch_array($run_gst_rate_ex);
                    $dis_gst_rate_ex = $row_gst_rate_ex['sale_product_gst_rate'];
                    $dis_gst_type_ex = $row_gst_rate_ex['sale_product_gst_type'];
                    $dis_carton_qty_ex = $row_gst_rate_ex['sale_product_qty'];
                    $dis_unit_rate_ex = $row_gst_rate_ex['sale_product_unit_rate'];

                    if($dis_gst_type_ex==='STA_TAX'){
                    $cgst_tax_hsn_ex = $dis_gst_rate_ex/2;
                    $sgst_tax_hsn_ex = $dis_gst_rate_ex/2;
                    $igst_tax_hsn_ex = 0;
                }else{
                    $cgst_tax_hsn_ex = 0;
                    $sgst_tax_hsn_ex = 0;
                    $igst_tax_hsn_ex = $dis_gst_rate_ex;
                }


                    $get_hsn_ex = "select * from sale_inc_products where sale_inc_no='$sale_inc_no' and sale_product_hsn_code='$dis_hsn_ex'";
                    $run_hsn_ex = mysqli_query($con,$get_hsn_ex);
                    $cgst_amount_hsn_ex = 0;
                    $sgst_amount_hsn_ex = 0;
                    $igst_amount_hsn_ex = 0;
                    $total_taxable_amount_hsn_ex = 0;
                    while($row_hsn_ex=mysqli_fetch_array($run_hsn_ex)){

                        $carton_qty_hsn_ex = $row_hsn_ex['sale_product_qty'];
                        $unit_rate_hsn_ex = $row_hsn_ex['sale_product_unit_rate'];
                        $gst_type_hsn_ex = $row_hsn_ex['sale_product_gst_type'];
                        $gst_rate_hsn_ex = $row_hsn_ex['sale_product_gst_rate'];
                        $gst_discount_hsn_ex = $row_hsn_ex['sale_product_discount'];

                        $taxable_amount_hsn_bef_discount_ex = $unit_rate_hsn_ex*$carton_qty_hsn_ex;
                        $taxable_amount_hsn_ex = $taxable_amount_hsn_bef_discount_ex-($taxable_amount_hsn_bef_discount_ex*($gst_discount_hsn_ex/100));
                        $total_taxable_amount_hsn_ex += $taxable_amount_hsn_ex;

                        if($gst_type_hsn_ex==='STA_TAX'){
                            $cgst_amount_hsn_ex += $taxable_amount_hsn_ex*(($gst_rate_hsn_ex/2)/100);
                            $sgst_amount_hsn_ex += $taxable_amount_hsn_ex*(($gst_rate_hsn_ex/2)/100);
                            $igst_amount_hsn_ex += 0;
                        }else{
                            $cgst_amount_hsn_ex += 0;
                            $sgst_amount_hsn_ex += 0;
                            $igst_amount_hsn_ex += $taxable_amount_hsn_ex*($gst_rate_hsn_ex/100);
                        }
                    }
                    $grand_taxable_ex += $total_taxable_amount_hsn_ex;
                    $grand_cgst_ex += $cgst_amount_hsn_ex;
                    $grand_sgst_ex += $sgst_amount_hsn_ex;
                    $grand_igst_ex += $igst_amount_hsn_ex;
                    }
                    
                    ?>
                        <tr>
                            <th class="py-1">Taxable Amount</th> <td class="py-1 text-right"><?php echo $grand_taxable_ex; ?></td>
                        </tr>
                        <tr class="<?php if($grand_cgst_ex>=1){ echo "show";}else{ echo "d-none";} ?>">
                            <th class="py-1">Output CGST</th><td class="py-1 text-right"><?php echo $grand_cgst_ex; ?></td>
                        </tr>
                        <tr class="<?php if($grand_sgst_ex>=1){ echo "show";}else{ echo "d-none";} ?>">
                            <th class="py-1">Output SGST</th><td class="py-1 text-right"><?php echo $grand_sgst_ex; ?></td>
                        </tr>
                        <tr class="<?php if($grand_igst_ex>=1){ echo "show";}else{ echo "d-none";} ?>">
                            <th class="py-1">Output IGST</th><td class="py-1 text-right"><?php echo $grand_igst_ex; ?></td>
                        </tr>
                        <tr>
                            <th class="py-1">Total Tax</th><td class="py-1 text-right"><?php echo $grand_cgst_ex+$grand_sgst_ex+$grand_igst_ex; ?></td>
                        </tr>
                        <tr>
                            <th class="py-1">Round Off</th><td class="py-1 text-right">
                                <?php 
                                
                                if((round(round($grand_taxable_ex+$grand_cgst_ex+$grand_sgst_ex+$grand_igst_ex)-($grand_taxable_ex+$grand_cgst_ex+$grand_sgst_ex+$grand_igst_ex),2))>0){
                                    $sign = '+';
                                }else{
                                    $sign = '';
                                }
                                
                                ?>
                                <?php echo $sign.round(round($grand_taxable_ex+$grand_cgst_ex+$grand_sgst_ex+$grand_igst_ex)-($grand_taxable_ex+$grand_cgst_ex+$grand_sgst_ex+$grand_igst_ex),2); ?>
                                </th>
                        </tr>
                        <tr>
                            <th class="py-1">Grand Total</th><td class="py-1 text-right"><?php echo round($grand_taxable_ex+$grand_cgst_ex+$grand_sgst_ex+$grand_igst_ex); ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-12" style="border:1px solid #000;">
                    <h5 class="my-2 text-right text-uppercase">
                        TOTAL IN WORDS : INR 
                                <?php
                                // call the function here
                                $amt_words=$total_amount;
                                // nummeric value in variable
                                
                                $get_grand_amount= AmountInWords(round($grand_taxable_ex+$grand_cgst_ex+$grand_sgst_ex+$grand_igst_ex));
                                echo $get_grand_amount;

                                ?> Only
                    </h5>
                </div>
                <div class="col-8 py-2" style="border:1px solid #000;">
                <h4><u>TERMS & CONDITIONS:</u></h4>
                <p class="mb-0 font-italic">
                    1. Interest will be charged @25% P.A, if the bill is not paid on delivery. <br>
                    2. All claims for shortage, delay, loss or damage to be preferred against carriers only. <br>
                    3. Every care is taken in Packing of Goods and our responsibility ceases as soon as the goods leave our godown. <br>
                    4. Goods once sold will not be taken back. <br>
                    5. All disputes are subject to Mumbai Juridiction only.
                </p>
                </div>
                <div class="col-4 text-center py-2" style="border:1px solid #000;">
                <p class="text-center mb-0" style="font-size:0.6rem;">Certified That the particulars given above are true and correct</p>
                <h5 class="text-center text-uppercase">For AND SYSTEMS</h5> <br>
                <br>
                <br>
                <br>
                <h5 class="text-center">Authorised Signature</h5>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<?php } ?>