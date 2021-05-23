<?php 
include("../includes/db.php");

if(isset($_POST['sale_excel'])){

    require('xlsxwriter.class.php');
    $fname='Sale_Invoice_Excel.xlsx';

    $sale_incarr = $_POST['sale_inc'];
    $writer = new XLSXWriter();
    $writer->setAuthor('ANDSYSTEMS');

    if(!empty($sale_incarr)){
        for($i = 0; $i < count($sale_incarr); $i++){
            if(!empty($sale_incarr[$i])){
                $sale_inc_no = $sale_incarr[$i];

                $get_sale_inc_entries = "select * from sale_inc_entries where sale_inc_no='$sale_inc_no'";
                $run_sale_inc_entries = mysqli_query($con,$get_sale_inc_entries);
                $row_sale_inc_entries = mysqli_fetch_array($run_sale_inc_entries);

                $sale_inc_date = $row_sale_inc_entries['sale_inc_date'];
                $billed_title = $row_sale_inc_entries['billed_title'];
                $billed_address = $row_sale_inc_entries['billed_address'];
                $billed_state = $row_sale_inc_entries['billed_state'];
                $billed_gstn = $row_sale_inc_entries['billed_gstn'];
                $extra_paid = $row_sale_inc_entries['extra_paid'];

                $header1 = [ 'Date' => 'date', //1
                'Customer Name' => 'string',//2
                'GSTN No.' => 'string',//3
                'Address' => 'string',//4
                'HSN CODE' => 'string',//5
                'Product Name' => 'string',//6
                'Unit' => 'string',//7
                'Sub Unit' => 'string',//8
                'Unit Rate' => 'price',//9
                'Quantity' => 'string',//10
                'Taxable Value' => 'price',//11
                'CGST Rate' => 'string',//12
                'CGST Amount' => 'price',//13
                'SGST Rate' => 'string',//14
                'SGST Amount' => 'price',//15
                'IGST Rate' => 'string',//16
                'IGST Amount' => 'price'];//17

                $get_sale_products = "select * from sale_inc_products where sale_inc_no='$sale_inc_no'";
                $run_sale_products = mysqli_query($con,$get_sale_products);
                $sal_counter = 0;
                $data1 = array();
                $taxable_total = 0;
                $cgst_total = 0;
                $sgst_total = 0;
                $igst_total = 0;
                while($row_sale_products=mysqli_fetch_array($run_sale_products)){
                    $sale_product_type = $row_sale_products['sale_product_type'];
                    $sale_product_id = $row_sale_products['sale_product_id'];
                    $sale_product_qty = $row_sale_products['sale_product_qty'];
                    $sale_product_unit_rate = $row_sale_products['sale_product_unit_rate'];
                    $sale_product_hsn_code = $row_sale_products['sale_product_hsn_code'];
                    $sale_product_gst_rate = $row_sale_products['sale_product_gst_rate'];
                    $sale_product_gst_type = $row_sale_products['sale_product_gst_type'];
                    $sale_product_discount = $row_sale_products['sale_product_discount'];

                    $taxable_value = $sale_product_unit_rate*$sale_product_qty;

                    if($sale_product_gst_type==='STA_TAX'){
                        $CGST_rate = $sale_product_gst_rate/2;
                        $CGST_amt = $taxable_value*(($sale_product_gst_rate/2)/100);
                        $SGST_rate = $sale_product_gst_rate/2;
                        $SGST_amt = $taxable_value*(($sale_product_gst_rate/2)/100);
                        $IGST_rate = 0;
                        $IGST_amt = 0;
                    }elseif($sale_product_gst_type==='CEN_TAX'){
                        $CGST_rate = 0;
                        $CGST_amt = 0;
                        $SGST_rate = 0;
                        $SGST_amt = 0;
                        $IGST_rate = $sale_product_gst_rate;
                        $IGST_amt = $taxable_value*($sale_product_gst_rate/100);
                    }

                    $taxable_total += $taxable_value;
                    $cgst_total += $CGST_amt;
                    $sgst_total += $SGST_amt;
                    $igst_total += $IGST_amt;
                    if($sale_product_type==='raw'){

                        $get_raw_product = "select * from raw_products where raw_product_id='$sale_product_id'";
                        $run_raw_product = mysqli_query($con,$get_raw_product);
                        $row_raw_product = mysqli_fetch_array($run_raw_product); 
                        
                        $product_title = $row_raw_product['raw_product_title'];
                        $product_unit = $row_raw_product['raw_product_unit'];
                        $product_subunit = $row_raw_product['raw_product_subunit'];

                    }elseif($sale_product_type==='custom'){

                        $get_custom_product = "select * from custom_products where custom_product_id='$sale_product_id'";
                        $run_custom_product = mysqli_query($con,$get_custom_product);
                        $row_custom_product = mysqli_fetch_array($run_custom_product);  
                        
                        $product_title = $row_custom_product['custom_product_title'];
                        $product_unit = $row_custom_product['custom_product_unit'];
                        $product_subunit = $row_custom_product['custom_product_subunit'];

                    }
                    $sale_row_data = array($sale_inc_date,
                                          $billed_title,
                                          $billed_gstn,
                                          $billed_address,
                                          $sale_product_hsn_code,
                                          $product_title,
                                          $product_unit,
                                          $product_subunit,
                                          $sale_product_unit_rate,
                                          $sale_product_qty,
                                          $taxable_value,
                                          $CGST_rate,
                                          $CGST_amt,
                                          $SGST_rate,
                                          $SGST_amt,
                                          $IGST_rate,
                                          $IGST_amt);
                    array_push($data1, $sale_row_data);
                }
                $grand_total = $taxable_total+$cgst_total+$sgst_total+$igst_total+$extra_paid;
                $blank = array('','','','','','','','','','','','','','','','','');
                $sale_taxable_total_row = array('','','','','','','','','','','','','','','','Total Taxable Value',$taxable_total);
                $sale_cgst_total_row = array('','','','','','','','','','','','','','','','Total CGST',$cgst_total);
                $sale_sgst_total_row = array('','','','','','','','','','','','','','','','Total SGST',$sgst_total);
                $sale_igst_total_row = array('','','','','','','','','','','','','','','','Total IGST',$igst_total);
                $sale_charges_total_row = array('','','','','','','','','','','','','','','','Extra Charges',$extra_paid);
                $sale_grand_total_row = array('','','','','','','','','','','','','','','','Grand Total',$grand_total);

                array_push($data1, $blank, $blank, $sale_taxable_total_row, $sale_cgst_total_row, $sale_sgst_total_row, $sale_igst_total_row, $sale_charges_total_row, $sale_grand_total_row);
                $writer->writeSheet($data1,$sale_inc_no, $header1);  // with headers
            }
        }
    }

//  $data2 = [ ['2','7','ᑌᑎIᑕᗝᗪᗴ ☋†Ϝ-➑'],
//             ['4','8','😁'] ];
//  $styles2 = array( ['font-size'=>6],['font-size'=>8],['font-size'=>10],['font-size'=>16] );

// $writer->writeSheet($data2,'MySheet2');            // no headers
//  $writer->writeSheetRow('MySheet2', $rowdata = array(300,234,456,789), $styles2 );

//  $writer->writeToFile($fname);   // creates XLSX file (in current folder) 
//  echo "Wrote $fname (".filesize($fname)." bytes)<br>";

 // ...or instead of creating the XLSX you can just trigger a
 // download by replacing the last 2 lines with:

 header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
 header('Content-Disposition: attachment;filename="'.$fname.'"');
 header('Cache-Control: max-age=0');
 $writer->writeToStdOut();

}

?>