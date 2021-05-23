<?php 
include("../includes/db.php");

if(isset($_POST['purchase_excel'])){

    require('xlsxwriter.class.php');
    $fname='Purchase_Invoice_Excel.xlsx';

    $purchase_incarr = $_POST['purchase_inc'];
    $writer = new XLSXWriter();
    $writer->setAuthor('ANDSYSTEMS');

    if(!empty($purchase_incarr)){
        for($i = 0; $i < count($purchase_incarr); $i++){
            if(!empty($purchase_incarr[$i])){
                $purchase_inc_no = $purchase_incarr[$i];

                $get_purchase_inc_entries = "select * from purchase_inc_entries where purchase_inc_no='$purchase_inc_no'";
                $run_purchase_inc_entries = mysqli_query($con,$get_purchase_inc_entries);
                $row_purchase_inc_entries = mysqli_fetch_array($run_purchase_inc_entries);

                $purchase_inc_date = $row_purchase_inc_entries['purchase_inc_date'];
                $supplier_id = $row_purchase_inc_entries['supplier_id'];
                $purchase_inc_custom_duty = $row_purchase_inc_entries['purchase_inc_custom_duty'];
                $transport_charges = $row_purchase_inc_entries['transport_charges'];

                $get_supplier = "select * from suppliers where supplier_id='$supplier_id'";
                $run_supplier = mysqli_query($con,$get_supplier);
                $row_supplier = mysqli_fetch_array($run_supplier);

                $supplier_title = $row_supplier['supplier_title'];
                $supplier_address = $row_supplier['supplier_address'];
                $supplier_gstn = $row_supplier['supplier_gstn'];

                $header1 = [ 'Date' => 'date', //1
                'Supplier Name' => 'string',//2
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

                $get_purchase_products = "select * from purchase_inc_products where purchase_inc_no='$purchase_inc_no'";
                $run_purchase_products = mysqli_query($con,$get_purchase_products);
                $pur_counter = 0;
                $data1 = array();
                $taxable_total = 0;
                $cgst_total = 0;
                $sgst_total = 0;
                $igst_total = 0;
                while($row_purchase_products=mysqli_fetch_array($run_purchase_products)){
                    $raw_product_id = $row_purchase_products['raw_product_id'];
                    $purchase_inc_product_hsn_code = $row_purchase_products['purchase_inc_product_hsn_code'];
                    $purchase_inc_product_unit_rate = $row_purchase_products['purchase_inc_product_unit_rate'];
                    $purchase_inc_product_qty = $row_purchase_products['purchase_inc_product_qty'];
                    $purchase_inc_product_gst_type = $row_purchase_products['purchase_inc_product_gst_type'];
                    $purchase_inc_product_gst_rate = $row_purchase_products['purchase_inc_product_gst_rate'];

                    $taxable_value = $purchase_inc_product_unit_rate*$purchase_inc_product_qty;

                    if($purchase_inc_product_gst_type==='STA_TAX'){
                        $CGST_rate = $purchase_inc_product_gst_rate/2;
                        $CGST_amt = $taxable_value*(($purchase_inc_product_gst_rate/2)/100);
                        $SGST_rate = $purchase_inc_product_gst_rate/2;
                        $SGST_amt = $taxable_value*(($purchase_inc_product_gst_rate/2)/100);
                        $IGST_rate = 0;
                        $IGST_amt = 0;
                    }elseif($purchase_inc_product_gst_type==='CEN_TAX'){
                        $CGST_rate = 0;
                        $CGST_amt = 0;
                        $SGST_rate = 0;
                        $SGST_amt = 0;
                        $IGST_rate = $purchase_inc_product_gst_rate;
                        $IGST_amt = $taxable_value*($purchase_inc_product_gst_rate/100);
                    }

                    $taxable_total += $taxable_value;
                    $cgst_total += $CGST_amt;
                    $sgst_total += $SGST_amt;
                    $igst_total += $IGST_amt;

                    $get_raw_products = "select * from raw_products where raw_product_id='$raw_product_id'";
                    $run_raw_products = mysqli_query($con,$get_raw_products);
                    $row_raw_products = mysqli_fetch_array($run_raw_products);

                    $raw_product_title = $row_raw_products['raw_product_title'];
                    $raw_product_unit = $row_raw_products['raw_product_unit'];
                    $raw_product_subunit = $row_raw_products['raw_product_subunit'];
                    $pur_row_data = array($purchase_inc_date,
                                          $supplier_title,
                                          $supplier_gstn,
                                          $supplier_address,
                                          $purchase_inc_product_hsn_code,
                                          $raw_product_title,
                                          $raw_product_unit,
                                          $raw_product_subunit,
                                          $purchase_inc_product_unit_rate,
                                          $purchase_inc_product_qty,
                                          $taxable_value,
                                          $CGST_rate,
                                          $CGST_amt,
                                          $SGST_rate,
                                          $SGST_amt,
                                          $IGST_rate,
                                          $IGST_amt);
                    array_push($data1, $pur_row_data);
                }
                $grand_total = $taxable_total+$cgst_total+$sgst_total+$igst_total+$purchase_inc_custom_duty+$transport_charges;
                $blank = array('','','','','','','','','','','','','','','','','');
                $purchase_taxable_total_row = array('','','','','','','','','','','','','','','','Total Taxable Value',$taxable_total);
                $purchase_cgst_total_row = array('','','','','','','','','','','','','','','','Total CGST',$cgst_total);
                $purchase_sgst_total_row = array('','','','','','','','','','','','','','','','Total SGST',$sgst_total);
                $purchase_igst_total_row = array('','','','','','','','','','','','','','','','Total IGST',$igst_total);
                $purchase_custom_total_row = array('','','','','','','','','','','','','','','','Total Custom',$purchase_inc_custom_duty);
                $purchase_charges_total_row = array('','','','','','','','','','','','','','','','Extra Charges',$transport_charges);
                $purchase_grand_total_row = array('','','','','','','','','','','','','','','','Grand Total',$grand_total);

                array_push($data1, $blank, $blank, $purchase_taxable_total_row, $purchase_cgst_total_row, $purchase_sgst_total_row, $purchase_igst_total_row, $purchase_custom_total_row, $purchase_charges_total_row, $purchase_grand_total_row);
                $writer->writeSheet($data1,$purchase_inc_no, $header1);  // with headers
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