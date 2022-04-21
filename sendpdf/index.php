	<?php

	if (isset($_POST['mail_sent'])) {

		include('pdf.php');

		$file_tmp_name  = $_FILES['bill_image']['tmp_name'];
		$file_name_oc = $_FILES['bill_image']['name'];

		// var_dump($attachment);

		$message = '';

		// $connect = new PDO("mysql:host=localhost:3308;dbname=andsystems", "root", "");
		$connect = mysqli_connect('localhost', 'u708087849_andsystems', 'Ands@1234', 'u708087849_andsystems');

		$mail_inc_id = $_POST['Mail_inc_no'];

		$get_inc_ref = "select * from sale_inc_entries where sale_inc_entry_id='$mail_inc_id'";
		$run_inc_ref = mysqli_query($connect, $get_inc_ref);
		$row_inc_ref = mysqli_fetch_array($run_inc_ref);

		$mail_title = $row_inc_ref['billed_title'];
		$mail_inc_no = $row_inc_ref['sale_inc_no'];
		$mail_billed_contact = $row_inc_ref['billed_contact'];

		$get_customer_email = "select * from customers where customer_contact='$mail_billed_contact'";
		$run_customer_email = mysqli_query($connect, $get_customer_email);
		$row_customer_email = mysqli_fetch_array($run_customer_email);
		$customer_email = $row_customer_email['customer_email'];


		function AmountInWords(float $amount)
		{
			$amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;
			// Check if there is any number after decimal
			$amt_hundred = null;
			$count_length = strlen($num);
			$x = 0;
			$string = array();
			$change_words = array(
				0 => '', 1 => 'One', 2 => 'Two',
				3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
				7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
				10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
				13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
				16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
				19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
				40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
				70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety'
			);
			$here_digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
			while ($x < $count_length) {
				$get_divider = ($x == 2) ? 10 : 100;
				$amount = floor($num % $get_divider);
				$num = floor($num / $get_divider);
				$x += $get_divider == 10 ? 1 : 2;
				if ($amount) {
					$add_plural = (($counter = count($string)) && $amount > 9) ? 's' : null;
					$amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
					$string[] = ($amount < 21) ? $change_words[$amount] . ' ' . $here_digits[$counter] . $add_plural . ' 
            ' . $amt_hundred : $change_words[floor($amount / 10) * 10] . ' ' . $change_words[$amount % 10] . ' 
            ' . $here_digits[$counter] . $add_plural . ' ' . $amt_hundred;
				} else $string[] = null;
			}
			$implode_to_Rupees = implode('', array_reverse($string));
			$get_paise = ($amount_after_decimal > 0) ? "And " . ($change_words[$amount_after_decimal / 10] . " 
        " . $change_words[$amount_after_decimal % 10]) . ' Paise' : '';
			return ($implode_to_Rupees ? $implode_to_Rupees . ' ' : '') . $get_paise;
		}


		function fetch_customer_data($connect)
		{
			$mail_inc_no = $_POST['Mail_inc_no'];
			$get_inc_data = "select * from sale_inc_entries where sale_inc_entry_id='$mail_inc_no'";
			$run_inc_data = mysqli_query($connect, $get_inc_data);
			$row_inc_data = mysqli_fetch_array($run_inc_data);

			$sale_inc_no = $row_inc_data['sale_inc_no'];
			$sale_inc_date = $row_inc_data['sale_inc_date'];
			$sale_inc_due_date = $row_inc_data['sale_inc_due_date'];
			$sale_supply_date = $row_inc_data['sale_supply_date'];
			$transport_title = $row_inc_data['transport_title'];
			$transport_vehicle_no = $row_inc_data['transport_vehicle_no'];
			$e_way_bill_no = $row_inc_data['e_way_bill_no'];
			$billed_title = $row_inc_data['billed_title'];
			$billed_contact = $row_inc_data['billed_contact'];
			$billed_address = $row_inc_data['billed_address'];
			$billed_state = $row_inc_data['billed_state'];
			$billed_gstn = $row_inc_data['billed_gstn'];
			$billed_state_code = $row_inc_data['billed_state_code'];
			$shipped_title = $row_inc_data['shipped_title'];
			$shipped_contact = $row_inc_data['shipped_contact'];
			$shipped_address = $row_inc_data['shipped_address'];
			$shipped_state = $row_inc_data['shipped_state'];
			$shipped_state_code = $row_inc_data['shipped_state_code'];
			$shipped_gstn = $row_inc_data['shipped_gstn'];
			$extra_paid = $row_inc_data['extra_paid'];
			$sale_inc_status = $row_inc_data['sale_inc_status'];
			$sale_inc_created_at = $row_inc_data['sale_inc_created_at'];
			$sale_inc_updated_at = $row_inc_data['sale_inc_updated_at'];

			$output = '
			<table class="table table-bordered mb-0" style="font-family: Poppins;">
				<tr>
					<th class="p-1" style="width:80%;">
						<h4 class="text-center p-2 mb-0 mt-1 font-weight-bold">
							TAX INVOICE
						</h4>
					</th>
					<th class="p-1">
						<h5 class="text-center p-2 mb-0 mt-1">
							Original For Recipient
						</h5>
					</th>
				</tr>
			</table>
			<table class="table table-bordered" style="font-family: Poppins;">
				<tr>
					<th>
						<h2 class="mb-0 mt-3 text-uppercase text-center font-weight-bold">
							AND SYSTEMS
						</h2>
					</th>
					<th>
						<h5 class="text-center mb-0 text-capitalize">Mahape navi mumbai, maharashtra 421204</h5>
						<h5 class="text-center mb-0"> +91 7045936918 /19 /20 |  andsystems@gmail.com</h5>
					</th>
				</tr>
				<tr>
					<th class="pb-0">
						<h5>GSTIN Number : 27254dFERT25OZ</h5>
						<h5>Invoice Number : 
						
						';

			$output .= $sale_inc_no;

			$output .= '
						
						</h5>
						<h5>Invoice Date : ';
			$output .= date("d-M-Y", strtotime($sale_inc_date));
			$output .= '
						</h5>
						<h5 class="mb-0 text-uppercase">
							State: MAHARASHTRA (State Code : 27)
						</h5>
					</th>
					<th>
						<h5 class="text-capitalize">Transportor : 
						';
			$output .= $transport_title;
			$output .= '
						</h5>
						<h5>E-way Number : 
						';
			$output .= $e_way_bill_no;
			$output .= '
						</h5>
						<h5 class="text-uppercase">Vehicle Number: 
							';
			$output .= $transport_vehicle_no;
			$output .= '
							</h5>
						<h5 class="mb-0">Supply Date : 
						';
			$output .= $sale_supply_date;
			$output .= '
						</h5>
					</th>
				</tr>
				<tr style="background-color:#C8C8C8;">
					<th>
						<h4 class="mb-0 mt-1">Details Of Reciever (Billed To)</h4>
					</th>
					<th>
						<h4 class="mb-0 mt-1">Details Of consignee (Shipped To)</h4>
					</th>
				</tr>
				<tr>
				<th class="pb-0">
					<h5 class="text-capitalize">Name : 
					';
			$output .= $billed_title;
			$output .= '			
					</h5>
					<h5>Contact : +91 
					';
			$output .= $billed_contact;
			$output .= '			
					</h5>
					<h5>Address : 
					';
			$output .= $billed_address;
			$output .= '			
					</h5>
					<h5 class="text-uppercase">GSTIN Number: 
						';
			$output .= $billed_gstn;
			$output .= '				
						</h5>
					<h5 class="mb-0 text-uppercase">
						State: 
						';
			$output .= $billed_state;
			$output .= '				
						(State Code : 
						';
			$output .= $billed_state_code;
			$output .= '				
						)
					</h5>
				</th>
				<th class="pb-0">
					<h5 class="text-capitalize">Name : 
					';
			$output .= $shipped_title;
			$output .= '							
					</h5>
					<h5>Contact : +91 
					';
			$output .= $shipped_contact;
			$output .= '							
					</h5>
					<h5 class="text-uppercase">Address : 
					';
			$output .= $shipped_address;
			$output .= '							
					</h5>
					<h5 class="text-uppercase">GSTIN Number: 
						';
			$output .= $shipped_gstn;
			$output .= '								
						</h5>
					<h5 class="mb-0 text-uppercase">
						State: 
						';
			$output .= $shipped_state;
			$output .= '								
						(State Code : 
						';
			$output .= $shipped_state_code;
			$output .= '								
						)
					</h5>
				</th>
				</tr>
			</table>
			<table class="table table-bordered text-dark" style="width:100%;font-family: Poppins;">
				<thead style="font-size:1.3rem;">
					<tr class="text-center">
						<th class="align-middle text-center p-1">Sl.No</th>
						<th class="align-middle text-center p-1">Description of goods</th>
						<th class="align-middle text-center p-1">HSN Code</th>
						<th class="align-middle text-center p-1">Quantity</th>
						<th class="align-middle text-center p-1">Rate</th>
						<th class="align-middle text-center p-1">Amount</th>
						<th class="align-middle text-center p-1">Discount</th>
						<th class="align-middle text-center p-1">Taxable Value</th>
					</tr>
				</thead>
				<tbody style="font-size:0.7rem;">
				';
			$get_inc_pro = "select * from sale_inc_products where sale_inc_no='$sale_inc_no'";
			$run_inc_pro = mysqli_query($connect, $get_inc_pro);
			$pro_counter = 0;
			$total_amount = 0;
			while ($row_inc_pro = mysqli_fetch_array($run_inc_pro)) {
				$sale_product_type = $row_inc_pro['sale_product_type'];
				$sale_product_id = $row_inc_pro['sale_product_id'];
				$sale_product_qty = $row_inc_pro['sale_product_qty'];
				$sale_product_unit_rate = $row_inc_pro['sale_product_unit_rate'];
				$sale_inc_product_desc = $row_inc_pro['sale_inc_product_desc'];
				$sale_product_hsn_code = $row_inc_pro['sale_product_hsn_code'];
				$sale_product_gst_rate = $row_inc_pro['sale_product_gst_rate'];
				$sale_product_gst_type = $row_inc_pro['sale_product_gst_type'];
				$sale_product_discount = $row_inc_pro['sale_product_discount'];

				if ($sale_product_type === 'raw') {

					$get_product = "select * from raw_products where raw_product_id='$sale_product_id'";
					$run_product = mysqli_query($connect, $get_product);
					$row_product = mysqli_fetch_array($run_product);

					$product_title = $row_product['raw_product_title'];
					$product_unit = $row_product['raw_product_unit'];
					$product_subunit = $row_product['raw_product_subunit'];
				} elseif ($sale_product_type === 'custom') {

					$get_product = "select * from custom_products where custom_product_id='$sale_product_id'";
					$run_product = mysqli_query($connect, $get_product);
					$row_product = mysqli_fetch_array($run_product);

					$product_title = $row_product['custom_product_title'];
					$product_unit = $row_product['custom_product_unit'];
					$product_subunit = $row_product['custom_product_subunit'];
				}

				$taxable_amount = $sale_product_unit_rate * $sale_product_qty;
				$total = $taxable_amount - ($taxable_amount * ($sale_product_discount / 100));
				$total_amount += $total;
				$output .= '										
					<tr class="text-center" style="font-size:1rem;">
						<td class=" p-1"> 
						';
				$output .= ++$pro_counter;
				$output .= '				
						</td>
						<td class=" p-1"> 
						';
				$output .= $product_title;
				$output .= '				
			<br> <span class="font-italic">(
				';
				$output .= $sale_inc_product_desc;
				$output .= '				
			)</span>
			';
				$output .= '				
						</td>
						<td class=" p-1"> 
						';
				$output .= $sale_product_hsn_code;
				$output .= '				
						</td>
						<td class=" p-1"> 
						';
				$output .= $sale_product_qty;
				$output .= '				
						</td>
						<td class=" p-1"> 
						';
				$output .= $sale_product_unit_rate;
				$output .= '				
						</td>
						<td class=" p-1"> 
						';
				$output .= $taxable_amount;
				$output .= '				
						</td>
						<td class=" p-1"> 
						';
				$output .= $sale_product_discount;
				$output .= '				
						</td>
						<td class=" p-1"> 
						';
				$output .= $taxable_amount - ($taxable_amount * ($sale_product_discount / 100));
				$output .= '				
						</td>
					</tr>						
					';
			}
			$get_inc_count = "select * from sale_inc_products where sale_inc_no='$sale_inc_no'";
			$run_inc_count = mysqli_query($connect, $get_inc_count);
			$inc_count = mysqli_num_rows($run_inc_count);
			$req_count = 6 - $inc_count;

			if ($req_count > 1) {

				for ($x = 0; $x <= $req_count; $x++) {
					$output .= '
						<tr>
						<td class="p-3"></td>
						<td class="p-3"></td>
						<td class="p-3"></td>
						<td class="p-3"></td>
						<td class="p-3"></td>
						<td class="p-3"></td>
						<td class="p-3"></td>
						<td class="p-3"></td>
					</tr>

						';
				}
			}
			$output .= '
				</tbody>
				<tfoot style="font-size:0.8rem;">
					<tr>
						<th colspan="7" class="text-right pr-2">
							<h5 class="mb-0 mt-1 font-weight-bold">TOTAL TAXABLE VALUE</h5>
						</th>
						<th class="text-center">
							<h5 class="mb-0">
							';
			$output .= $total_amount;
			$output .= '								
							</h5>
						</th>
					</tr>
				</tfoot>
			</table>
			<table class="table-bordered" style="width:100%;font-family: Poppins;">
				<thead>
					<tr class="text-center">
						<th rowspan="2" class="text-center">HSN/SAC</th>
						<th rowspan="2" class="text-center">Taxable Value</th>
						<th colspan="2" class="text-center">CGST</th>
						<th colspan="2" class="text-center">SGST</th>
						<th colspan="2" class="text-center">IGST</th>
						<th rowspan="2" class="text-center">Total Tax Amount</th>
					</tr>
					<tr class="text-center">
						<th class=" p-1 text-center">Rate</th>
						<th class=" p-1 text-center">Amount</th>
						<th class=" p-1 text-center">Rate</th>
						<th class=" p-1 text-center">Amount</th>
						<th class=" p-1 text-center">Rate</th>
						<th class=" p-1 text-center">Amount</th>
					</tr>
				</thead>
				<tbody>
				';
			$get_dis_hsn = "select distinct(sale_product_hsn_code) from sale_inc_products where sale_inc_no='$sale_inc_no'";
			$run_dis_hsn = mysqli_query($connect, $get_dis_hsn);
			$grand_taxable = 0;
			$grand_cgst = 0;
			$grand_sgst = 0;
			$grand_igst = 0;
			while ($row_dis_hsn = mysqli_fetch_array($run_dis_hsn)) {
				$dis_hsn = $row_dis_hsn['sale_product_hsn_code'];

				$get_gst_rate = "select * from sale_inc_products where sale_inc_no='$sale_inc_no' and sale_product_hsn_code='$dis_hsn'";
				$run_gst_rate = mysqli_query($connect, $get_gst_rate);
				$row_gst_rate = mysqli_fetch_array($run_gst_rate);
				$dis_gst_rate = $row_gst_rate['sale_product_gst_rate'];
				$dis_gst_type = $row_gst_rate['sale_product_gst_type'];
				$dis_carton_qty = $row_gst_rate['sale_product_qty'];
				$dis_unit_rate = $row_gst_rate['sale_product_unit_rate'];

				if ($dis_gst_type === 'STA_TAX') {
					$cgst_tax_hsn = $dis_gst_rate / 2;
					$sgst_tax_hsn = $dis_gst_rate / 2;
					$igst_tax_hsn = 0;
				} else {
					$cgst_tax_hsn = 0;
					$sgst_tax_hsn = 0;
					$igst_tax_hsn = $dis_gst_rate;
				}


				$get_hsn = "select * from sale_inc_products where sale_inc_no='$sale_inc_no' and sale_product_hsn_code='$dis_hsn'";
				$run_hsn = mysqli_query($connect, $get_hsn);
				$cgst_amount_hsn = 0;
				$sgst_amount_hsn = 0;
				$igst_amount_hsn = 0;
				$total_taxable_amount_hsn = 0;
				while ($row_hsn = mysqli_fetch_array($run_hsn)) {

					$carton_qty_hsn = $row_hsn['sale_product_qty'];
					$unit_rate_hsn = $row_hsn['sale_product_unit_rate'];
					$gst_type_hsn = $row_hsn['sale_product_gst_type'];
					$gst_rate_hsn = $row_hsn['sale_product_gst_rate'];
					$gst_discount_hsn = $row_hsn['sale_product_discount'];

					$taxable_amount_hsn_bef_discount_hsn = $unit_rate_hsn * $carton_qty_hsn;
					$taxable_amount_hsn = $taxable_amount_hsn_bef_discount_hsn - ($taxable_amount_hsn_bef_discount_hsn * ($gst_discount_hsn / 100));
					$total_taxable_amount_hsn += $taxable_amount_hsn;

					if ($gst_type_hsn === 'STA_TAX') {
						$cgst_amount_hsn += $taxable_amount_hsn * (($gst_rate_hsn / 2) / 100);
						$sgst_amount_hsn += $taxable_amount_hsn * (($gst_rate_hsn / 2) / 100);
						$igst_amount_hsn += 0;
					} else {
						$cgst_amount_hsn += 0;
						$sgst_amount_hsn += 0;
						$igst_amount_hsn += $taxable_amount_hsn * ($gst_rate_hsn / 100);
					}
				}
				$grand_taxable += $total_taxable_amount_hsn;
				$grand_cgst += $cgst_amount_hsn;
				$grand_sgst += $sgst_amount_hsn;
				$grand_igst += $igst_amount_hsn;

				$output .= '										
				<tr class="text-center">
					<td>
					';
				$output .= $dis_hsn;
				$output .= '											
					</td>
					<td>
					';
				$output .= $total_taxable_amount_hsn;
				$output .= '											
					</td>
					<td>
					';
				$output .= $cgst_tax_hsn;
				$output .= '											
					%</td>
					<td>
					';
				$output .= $cgst_amount_hsn;
				$output .= '											
					</td>
					<td>
					';
				$output .= $sgst_tax_hsn;
				$output .= '											
					%</td>
					<td>
					';
				$output .= $sgst_amount_hsn;
				$output .= '											
					</td>
					<td>
					';
				$output .= $igst_tax_hsn;
				$output .= '											
					%</td>
					<td>
					';
				$output .= $igst_amount_hsn;
				$output .= '											
					</td>
					<td>
					';
				$output .= $cgst_amount_hsn + $sgst_amount_hsn + $igst_amount_hsn;
				$output .= '											
					</td>
				</tr>
				';
			}
			$output .= '										
				</tbody>
				<tfoot>
					<tr class="text-center">
						<th class="text-center">TOTAL</th>
						<th class="text-center">
						';
			$output .= $grand_taxable;
			$output .= '														
						</th>
						<th class="text-center">0</th>
						<th class="text-center">
						';
			$output .= $grand_cgst;
			$output .= '														
						</th>
						<th class="text-center">0</th>
						<th class="text-center">
						';
			$output .= $grand_sgst;
			$output .= '														
						</th>
						<th class="text-center">0</th>
						<th class="text-center">
						';
			$output .= $grand_igst;
			$output .= '																		
						</th>
						<th class="text-center">
						';
			$output .= $grand_cgst + $grand_sgst + $grand_igst;
			$output .= '				
						</th>
					</tr>
				</tfoot>
			</table>
			<table class="table table-bordered" style="font-family: Poppins;">
			<tr>
				<th>
					<h5 class="text-uppercase font-weight-bold mt-2 mb-3"><u>Bank Details</u></h5>
					<h5 class="text-uppercase my-2">Bank : KOTAK MAHINDRA BANK</h5>
					<h5 class="text-uppercase my-2">AC Number : 12025480002154 </h5>
					<h5 class="text-uppercase my-2">Branch : Mahape (IFSC:KMB00012)</h5>
					<h5 class="text-uppercase my-2">AC Holder : AND SYSTEMS</h5>
					<h5 class="text-uppercase mb-0 mt-1">Due Date : </h5>
				</th>
				<th>
					<h6 class="font-weight-bold" style="font-size:1.5rem;text-align:center;">Customer Signature</h6>
				</th>
				<th class="p-0">
					<table class="table table-bordered mb-0">
					';
			$get_dis_ex = "select distinct(sale_product_hsn_code) from sale_inc_products where sale_inc_no='$sale_inc_no'";
			$run_dis_ex = mysqli_query($connect, $get_dis_ex);
			$grand_taxable_ex = 0;
			$grand_cgst_ex = 0;
			$grand_sgst_ex = 0;
			$grand_igst_ex = 0;
			while ($row_dis_ex = mysqli_fetch_array($run_dis_ex)) {
				$dis_hsn_ex = $row_dis_ex['sale_product_hsn_code'];

				$get_gst_rate_ex = "select * from sale_inc_products where sale_inc_no='$sale_inc_no' and sale_product_hsn_code='$dis_hsn_ex'";
				$run_gst_rate_ex = mysqli_query($connect, $get_gst_rate_ex);
				$row_gst_rate_ex = mysqli_fetch_array($run_gst_rate_ex);
				$dis_gst_rate_ex = $row_gst_rate_ex['sale_product_gst_rate'];
				$dis_gst_type_ex = $row_gst_rate_ex['sale_product_gst_type'];
				$dis_carton_qty_ex = $row_gst_rate_ex['sale_product_qty'];
				$dis_unit_rate_ex = $row_gst_rate_ex['sale_product_unit_rate'];

				if ($dis_gst_type_ex === 'STA_TAX') {
					$cgst_tax_hsn_ex = $dis_gst_rate_ex / 2;
					$sgst_tax_hsn_ex = $dis_gst_rate_ex / 2;
					$igst_tax_hsn_ex = 0;
				} else {
					$cgst_tax_hsn_ex = 0;
					$sgst_tax_hsn_ex = 0;
					$igst_tax_hsn_ex = $dis_gst_rate_ex;
				}


				$get_hsn_ex = "select * from sale_inc_products where sale_inc_no='$sale_inc_no' and sale_product_hsn_code='$dis_hsn_ex'";
				$run_hsn_ex = mysqli_query($connect, $get_hsn_ex);
				$cgst_amount_hsn_ex = 0;
				$sgst_amount_hsn_ex = 0;
				$igst_amount_hsn_ex = 0;
				$total_taxable_amount_hsn_ex = 0;
				while ($row_hsn_ex = mysqli_fetch_array($run_hsn_ex)) {

					$carton_qty_hsn_ex = $row_hsn_ex['sale_product_qty'];
					$unit_rate_hsn_ex = $row_hsn_ex['sale_product_unit_rate'];
					$gst_type_hsn_ex = $row_hsn_ex['sale_product_gst_type'];
					$gst_rate_hsn_ex = $row_hsn_ex['sale_product_gst_rate'];
					$gst_discount_hsn_ex = $row_hsn_ex['sale_product_discount'];

					$taxable_amount_hsn_bef_discount_ex = $unit_rate_hsn_ex * $carton_qty_hsn_ex;
					$taxable_amount_hsn_ex = $taxable_amount_hsn_bef_discount_ex - ($taxable_amount_hsn_bef_discount_ex * ($gst_discount_hsn_ex / 100));
					$total_taxable_amount_hsn_ex += $taxable_amount_hsn_ex;

					if ($gst_type_hsn_ex === 'STA_TAX') {
						$cgst_amount_hsn_ex += $taxable_amount_hsn_ex * (($gst_rate_hsn_ex / 2) / 100);
						$sgst_amount_hsn_ex += $taxable_amount_hsn_ex * (($gst_rate_hsn_ex / 2) / 100);
						$igst_amount_hsn_ex += 0;
					} else {
						$cgst_amount_hsn_ex += 0;
						$sgst_amount_hsn_ex += 0;
						$igst_amount_hsn_ex += $taxable_amount_hsn_ex * ($gst_rate_hsn_ex / 100);
					}
				}
				$grand_taxable_ex += $total_taxable_amount_hsn_ex;
				$grand_cgst_ex += $cgst_amount_hsn_ex;
				$grand_sgst_ex += $sgst_amount_hsn_ex;
				$grand_igst_ex += $igst_amount_hsn_ex;
			}
			$output .= '																		
			
						<tr>
							<th class="py-1">Taxable Amount</th>
							<td class="py-1 text-right">
							';
			$output .= $grand_taxable_ex;
			$output .= '																							
							</td>
						</tr>
						<tr>
							<th class="py-1 
							';
			if ($grand_cgst_ex >= 1) {
				$output .= "show";
			} else {
				$output .= "d-none";
			}
			$output .= '																												
							">Output CGST</th>
							<td class="py-1 text-right">
							';
			$output .= $grand_cgst_ex;
			$output .= '																							
							</td>
						</tr>
						<tr>
							<th class="py-1 
							';
			if ($grand_sgst_ex >= 1) {
				$output .= "show";
			} else {
				$output .= "d-none";
			}
			$output .= '																																	
							">Output SGST</th>
							<td class="py-1 text-right">
							';
			$output .= $grand_sgst_ex;
			$output .= '																							
							</td>
						</tr>
						<tr>
						<th class="py-1 
						';
			if ($grand_igst_ex >= 1) {
				$output .= "show";
			} else {
				$output .= "d-none";
			}
			$output .= '																																	
						">Output IGST</th>
						<td class="py-1 text-right">
						';
			$output .= $grand_igst_ex;
			$output .= '																							
						<tr>
							<th class="py-1 ">Total Tax</th>
							<td class="py-1 text-right">
							';
			$output .= $grand_cgst_ex + $grand_sgst_ex + $grand_igst_ex;
			$output .= '																							
							</td>
						</tr>
						<tr>
							<th class="py-1">Round Off</th>
							<td class="py-1 text-right">
							';
			if ((round(round($grand_taxable_ex + $grand_cgst_ex + $grand_sgst_ex + $grand_igst_ex) - ($grand_taxable_ex + $grand_cgst_ex + $grand_sgst_ex + $grand_igst_ex), 2)) > 0) {
				$sign = '+';
			} else {
				$sign = '';
			}
			$output .= $sign . round(round($grand_taxable_ex + $grand_cgst_ex + $grand_sgst_ex + $grand_igst_ex) - ($grand_taxable_ex + $grand_cgst_ex + $grand_sgst_ex + $grand_igst_ex), 2);
			$output .= '																							
							</td>
						</tr>
						<tr>
							<th class="py-1">Grand Total</th>
							<td class="py-1 text-right">
							';
			$output .= round($grand_taxable_ex + $grand_cgst_ex + $grand_sgst_ex + $grand_igst_ex);
			$output .= '																							
							</td>
						</tr>
					</table>
				</th>
			</tr>
			<tr>
				<th colspan="3">
					<h5 class="my-1 text-right text-uppercase font-weight-bold">TOTAL IN WORDS : 
						';
			$output .= AmountInWords(round($grand_taxable_ex + $grand_cgst_ex + $grand_sgst_ex + $grand_igst_ex));
			$output .= '																											
						ONLY</h5>
				</th>
			</tr>
			<tr>
			<th colspan="2">
				<h4><u>TERMS & CONDITIONS:</u></h4>
				<p class="mb-0 font-italic">
					1. Interest will be charged @25% P.A, if the bill is not paid on delivery. <br>
					2. All claims for shortage, delay, loss or damage to be preferred against carriers only. <br>
					3. Every care is taken in Packing of Goods and our responsibility ceases as soon as the goods leave our godown. <br>
					4. Goods once sold will not be taken back. <br>
					5. All disputes are subject to Mumbai Juridiction only.
				</p>
			</th>
			<th>
				<p class="text-center mb-0" style="font-size:0.6rem;">Certified That the particulars given above are true and correct</p>
				<h5 class="text-center text-uppercase">For AND SYSTEMS</h5> <br>
				<br>
				<br>
				<br>
				<h5 class="text-center">Authorised Signature</h5>
			</th>
			</tr>
			</table>
		';
			return $output;
		}
		$file_name = $mail_inc_no . '.pdf';
		$html_code = '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">';
		$html_code .= '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">';
		$html_code .= '<link rel="stylesheet"href="https://fonts.googleapis.com/css?family=Roboto">';
		$html_code .= fetch_customer_data($connect);
		$pdf = new Pdf();
		$pdf->loadHtml($html_code, 'UTF-8');
		$pdf->setPaper("a4", "portrait");
		$pdf->render();
		$file = $pdf->output();
		file_put_contents($file_name, $file);

		require 'class/class.phpmailer.php';
		$mail = new PHPMailer;
		$mail->IsSMTP();
		$mail->Mailer = "smtp";
		$mail->SMTPDebug  = 0; 								//Sets Mailer to send message using SMTP
		$mail->Host = 'smtp.gmail.com';		//Sets the SMTP hosts of your Email hosting, this for Godaddy
		$mail->Port = 587;								//Sets the default SMTP server port
		$mail->SMTPAuth = true;							//Sets SMTP authentication. Utilizes the Username and Password variables
		$mail->Username = 'andsystems@gmail.com';					//Sets SMTP username
		$mail->Password = 'information#102';					//Sets SMTP password
		$mail->SMTPSecure = 'tls';							//Sets connection prefix. Options are "", "ssl" or "tls"
		$mail->SetFrom("andsystems@gmail.com", "And Systems");
		$mail->AddReplyTo("andsystems@gmail.com", "AND SYSTEM");		//Sets the From name of the message
		$mail->AddAddress($customer_email, 'Invoice');		//Adds a "To" address
		// $mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
		$mail->IsHTML(true);
		$mail->AddAttachment($file_tmp_name, $file_name_oc);				//Sets message type to HTML				
		$mail->AddAttachment($file_name);
		$mail->Subject = 'Invoice from AND SYSTEMS Invoice No.' . $mail_inc_no;			//Sets the Subject of the message
		$mail->Body     = "<html><body><p><b>Dear" . $mail_title . "</b></p><p><i>Wellness Greetings.</i></p></body></html>";
		$mail->Body     .= "<html><body><p><b>I hope you’re well. Please see attached invoice. Don’t hesitate to reach out if you have any questions.</b></p><p><i>Kind Regards.</i></p></body></html>";
		if ($mail->Send())								//Send an Email. Return true on success or false on error
		{
			echo "<script>alert('Mail Sent to customer')</script>";
			echo "<script>window.open('../index.php?sales_invoices','_self')</script>";
		} else {
			echo 'Mailer Error: ' . $mail->ErrorInfo;
		}
		unlink($file_name);

	?>
	<?php } ?>