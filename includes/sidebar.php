<div id="sidebar">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <img src="voler/dist/assets/images/brandlogo.png" alt="" srcset="">
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">

                        <li class="sidebar-item <?php if(isset($_GET['dashboard'])){echo "active";};?>">
                            <a href="index.php?dashboard" class='sidebar-link'>
                                <i data-feather="home" width="20"></i>
                                <span>Dashboard</span>
                            </a>

                        </li>

                        <li class='sidebar-title <?php if($user_role==='admin'){echo "show";}else{echo "d-none";} ?>'>Staff Management</li>



                        <li class="sidebar-item  <?php if(isset($_GET['staff']) || isset($_GET['staff_registration']) || isset($_GET['staff_edit'])){echo "active";};?> <?php if($user_role==='admin'){echo "show";}else{echo "d-none";} ?>">
                            <a href="index.php?staff" class='sidebar-link'>
                                <i data-feather="layers" width="20"></i>
                                <span>Staff Registration</span>
                            </a>

                        </li>

                        <li class="sidebar-item  <?php if(isset($_GET['staff_performance'])){echo "active";};?> <?php if($user_role==='admin'){echo "show";}else{echo "d-none";} ?>">
                            <a href="index.php?staff_performance" class='sidebar-link'>
                                <i data-feather="layers" width="20"></i>
                                <span>Staff Work Performance</span>
                            </a>

                        </li>


                        <li class='sidebar-title <?php if($user_role==='admin' || $user_role==='back_office' || $user_role==='sales'){echo "show";}else{echo "d-none";} ?>'>Purchase Management</li>

                        <li class="sidebar-item  <?php if(isset($_GET['suppliers']) || isset($_GET['supplier_registration']) || isset($_GET['supplier_edit'])){echo "active";};?> <?php if($user_role==='admin' || $user_role==='back_office' || $user_role==='sales'){echo "show";}else{echo "d-none";} ?>">
                            <a href="index.php?suppliers" class='sidebar-link'>
                                <i data-feather="layers" width="20"></i>
                                <span>Supplier Details</span>
                            </a>

                        </li>

                        <li class="sidebar-item  <?php if(isset($_GET['raw_stock']) || isset($_GET['new_raw_stock']) || isset($_GET['raw_stock_edit'])){echo "active";};?> <?php if($user_role==='admin' || $user_role==='back_office' || $user_role==='sales'){echo "show";}else{echo "d-none";} ?>">
                            <a href="index.php?raw_stock" class='sidebar-link'>
                                <i data-feather="layers" width="20"></i>
                                <span>Raw Stock</span>
                            </a>

                        </li>

                        <li class="sidebar-item  <?php if(isset($_GET['purchase_enquiry']) || isset($_GET['new_purchase_enquiry']) || isset($_GET['purchase_enquiry_edit'])){echo "active";};?> <?php if($user_role==='admin' || $user_role==='back_office' || $user_role==='sales'){echo "show";}else{echo "d-none";} ?>">
                            <a href="index.php?purchase_enquiry" class='sidebar-link'>
                                <i data-feather="layers" width="20"></i>
                                <span>Purchase Enquiry</span>
                            </a>

                        </li>

                        <li class="sidebar-item  <?php if(isset($_GET['purchase_invoice']) || isset($_GET['new_purchase_invoice'])){echo "active";};?> <?php if($user_role==='admin' || $user_role==='back_office' || $user_role==='sales'){echo "show";}else{echo "d-none";} ?>">
                            <a href="index.php?purchase_invoice" class='sidebar-link'>
                                <i data-feather="layers" width="20"></i>
                                <span>Purchase Invoices</span>
                            </a>

                        </li>


                        <li class='sidebar-title <?php if($user_role==='admin' || $user_role==='back_office' || $user_role==='production'){echo "show";}else{echo "d-none";} ?>'>Ready Stock Management</li>


                        <li class="sidebar-item  <?php if(isset($_GET['work_orders']) || isset($_GET['new_work_order']) || isset($_GET['work_order_edit'])){echo "active";};?> <?php if($user_role==='admin' || $user_role==='back_office' || $user_role==='production'){echo "show";}else{echo "d-none";} ?>">
                            <a href="index.php?work_orders" class='sidebar-link'>
                                <i data-feather="layers" width="20"></i>
                                <span>Work Order</span>
                            </a>

                        </li>


                        <li class="sidebar-item  <?php if(isset($_GET['custom_products']) || isset($_GET['new_custom_product'])){echo "active";};?> <?php if($user_role==='admin' || $user_role==='back_office' || $user_role==='production'){echo "show";}else{echo "d-none";} ?>">
                            <a href="index.php?custom_products" class='sidebar-link'>
                                <i data-feather="layers" width="20"></i>
                                <span>Custom Products</span>
                            </a>

                        </li>

                        <li class="sidebar-item  <?php if(isset($_GET['ready_stock']) || isset($_GET['new_ready_stock'])){echo "active";};?> <?php if($user_role==='admin' || $user_role==='back_office' || $user_role==='production'){echo "show";}else{echo "d-none";} ?>">
                            <a href="index.php?ready_stock" class='sidebar-link'>
                                <i data-feather="layers" width="20"></i>
                                <span>Ready Stock</span>
                            </a>

                        </li>

                        <li class='sidebar-title <?php if($user_role==='admin' || $user_role==='back_office' || $user_role==='sales'){echo "show";}else{echo "d-none";} ?>'>Sales</li>

                        <li class="sidebar-item  <?php if(isset($_GET['customers']) || isset($_GET['customer_registration'])){echo "active";};?> <?php if($user_role==='admin' || $user_role==='back_office' || $user_role==='sales'){echo "show";}else{echo "d-none";} ?>">
                            <a href="index.php?customers" class='sidebar-link'>
                                <i data-feather="layers" width="20"></i>
                                <span>Customers</span>
                            </a>

                        </li>

                        <li class="sidebar-item  <?php if(isset($_GET['sales_invoices']) || isset($_GET['new_sale_invoice'])){echo "active";};?> <?php if($user_role==='admin' || $user_role==='back_office' || $user_role==='sales'){echo "show";}else{echo "d-none";} ?>">
                            <a href="index.php?sales_invoices" class='sidebar-link'>
                                <i data-feather="layers" width="20"></i>
                                <span>Sales Invoices</span>
                            </a>

                        </li>

                        <li class='sidebar-title <?php if($user_role==='admin' || $user_role==='back_office' || $user_role==='sales'){echo "show";}else{echo "d-none";} ?>'>Reports</li>

                        <li class="sidebar-item  <?php if(isset($_GET['bulk_purchase_invoice'])){echo "active";};?> <?php if($user_role==='admin' || $user_role==='back_office' || $user_role==='sales'){echo "show";}else{echo "d-none";} ?>">
                            <a href="index.php?bulk_purchase_invoice" class='sidebar-link'>
                                <i data-feather="layers" width="20"></i>
                                <span>Bulk Purchase Reports</span>
                            </a>

                        </li>

                        <li class="sidebar-item  <?php if(isset($_GET['bulk_sale_invoice'])){echo "active";};?> <?php if($user_role==='admin' || $user_role==='back_office' || $user_role==='sales'){echo "show";}else{echo "d-none";} ?>">
                            <a href="index.php?bulk_sale_invoice" class='sidebar-link'>
                                <i data-feather="layers" width="20"></i>
                                <span>Bulk Sale Reports</span>
                            </a>

                        </li>

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>