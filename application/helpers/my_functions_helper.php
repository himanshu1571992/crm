<?php

/* From version 1.2.0 my_functions_helper.php removed from the main files and need to be created when needed.
  /* Upload this file to application/helpers IF DONT EXISTS */
/* Add your own functions here */


add_action('after_render_single_aside_menu', 'my_custom_menu_items');


/*
 <li><a href="' . base_url("admin/component") . '">Components</a></li>
 <li><a href="' . base_url("admin/raw_material") . '">Raw Material</a></li>
 <li><a href="' . base_url("admin/raw_material/view") . '">Product/Component Raw Material</a></li>
*/


function my_custom_menu_items($order) {

  if ($order == 1) {
    echo get_new_menu();
  }
  ?>
  <!-- <li>
    <a href="#" aria-expanded="false"><i class="fa fa-window-restore menu-icon"></i> Products Master<span class="fa arrow"></span></a>
    <ul class="nav nav-second-level collapse" aria-expanded="false">
        <li><a href="#">Products</a></li>
        <li><a href="#">Products Category</a></li>
        <li>
          <a href="#" aria-expanded="false">Products Category <span class="fa arrow"></span></a>
          <ul class="nav nav-second-level collapse" aria-expanded="false">
            <li><a href="https://schachengineers.com/">Products</a></li>
            <li><a href="https://schachengineers.com/">Products Category</a></li>
          </ul>
        </li>
    </ul>
  </li> -->
  <?php

}

/*function my_custom_menu_items($order) {
    if ($order == 1) {
        echo '<li>';
        echo '<a href="#" aria-expanded="false"><i class="fa fa-window-restore menu-icon"></i> Products Master<span class="fa arrow"></span></a>';
        echo '<ul class="nav nav-second-level collapse" aria-expanded="false">
                   
                    <li><a href="' . base_url("admin/product") . '">Products</a></li>
                    <li><a href="' . base_url("admin/productcategory") . '">Product Category</a></li>
                    <li><a href="' . base_url("admin/productsubcategory") . '">Product Sub Category</a></li>
					
                 </ul>';
        echo '</li>';

        echo '<li>';
        echo '<a href="#" aria-expanded="false"><i class="fa fa-user menu-icon"></i> Client Master<span class="fa arrow"></span></a>';

        echo '<ul class="nav nav-second-level collapse" aria-expanded="false">
                    <li><a href="' . base_url("admin/site_manager") . '">Site Master</a></li>
                    <li><a href="' . base_url("admin/ClientBranch/") . '">Client branch</a></li>
                    <li><a href="' . base_url("admin/Client/") . '">Client</a></li>
                 </ul>';
        echo '</li>';

        echo '<li>';
        echo '<a href="#" aria-expanded="false"><i class="fa fa-user menu-icon"></i> Master<span class="fa arrow"></span></a>';

        echo '<ul class="nav nav-second-level collapse" aria-expanded="false">
                    <li><a href="' . base_url("admin/unit") . '">Unit</a></li>
                    <li><a href="' . base_url("admin/Designation") . '">Designation Master</a></li>
                    <li><a href="' . base_url("admin/clientcategory") . '">Client category</a></li>
                    <li><a href="' . base_url("admin/contacttype") . '">Contact Type</a></li>
                    <li><a href="' . base_url("admin/multiselect") . '">Multiselect</a></li>
                    <li><a href="' . base_url("admin/Business_type") . '">Business Type</a></li>
                    <li><a href="' . base_url("admin/staffgroup") . '">Staff Group</a></li>
                    <li><a href="' . base_url("admin/enquirytype") . '">Enquiry Type</a></li>
                    <li><a href="' . base_url("admin/enquiryfor") . '">Enquiry For</a></li>
                    <li><a href="' . base_url("admin/othercharges") . '">Other Charges</a></li>
                    <li><a href="' . base_url("admin/Defaultsettingcategory") . '">Default Setting category</a></li>
                    <li><a href="' . base_url("admin/Defaultsetting") . '">Default Setting</a></li>
                    <li><a href="' . base_url("admin/expenses/settings") . '">Expense Settings</a></li>
                    <li><a href="' . base_url("admin/expenses/purposes") . '">Expense Purpose</a></li>
                    <li><a href="' . base_url("admin/requests/categories") . '">Requests Categories</a></li>
                    <li><a href="' . base_url("admin/requests/loan_tenues") . '">Loan Tenure</a></li>
                    <li><a href="' . base_url("admin/leaves/categories") . '">Leaves Categories</a></li>
                    <li><a href="' . base_url("admin/leaves/setting") . '">Leaves Setting</a></li>
                    <li><a href="' . base_url("admin/attendance/events") . '">Events</a></li>
                    <li><a href="' . base_url("admin/salary/salary_deduction") . '">Salary Deduction Setting</a></li>
                    <li><a href="' . base_url("admin/wallet/settings") . '">Wallet Setting</a></li>
                    <li><a href="'. base_url("admin/expenses/tempo") .'">Tempo Master</a></li>
                    <li><a href="'. base_url("admin/cities/city") .'">City Master</a></li>
                    <li><a href="'. base_url("admin/expenses/billtypes") .'">Bill Type Master</a></li>
                    <li><a href="'. base_url("admin/live_location") .'">Live Location Master</a></li>
                    <li><a href="'. base_url("admin/company_expense") .'">Expense Category Master</a></li>
                    <li><a href="'. base_url("admin/company_expense/party_list") .'">Expense Parties Master</a></li>
                    <li><a href="'. base_url("admin/petty_cash") .'">Petty Cash Master</a></li>
                 </ul>';
        echo '</li>';

        echo '<li>';
        echo '<a href="#" aria-expanded="false"><i class="fa fa-industry menu-icon"></i> Vendor Master<span class="fa arrow"></span></a>';

        echo '<ul class="nav nav-second-level collapse" aria-expanded="false">
                    <li><a href="' . base_url("admin/vendor") . '">Vendor</a></li>
                    
                    
                 </ul>';
        echo '</li>';

        echo '<li>';
        echo '<a href="#" aria-expanded="false"><i class="fa fa-caret-square-o-right menu-icon"></i> Stock<span class="fa arrow"></span></a>';

        echo '<ul class="nav nav-second-level collapse" aria-expanded="false">
                    <li><a href="' . base_url("admin/Stock/addstock") . '">Add Stock</a></li>
                    <li><a href="' . base_url("admin/Stock/") . '">Warehouse Stock</a></li>
                    <li><a href="' . base_url("admin/Stock/checkavailability") . '">' . _l('check_availability') . '</a></li>
                    <li><a href="' . base_url("admin/Stock/transferstock") . '">Add Transfer Stock</a></li>
                    <li><a href="' . base_url("admin/Stock/alltransferstock") . '">Transfer Stock</a></li>
                    <li><a href="' . base_url("admin/stock_booking/add") . '">Add Booking</a></li>
                    <li><a href="' . base_url("admin/stock_booking") . '">Stock Bookings</a></li>
                    <li><a href="' . base_url("admin/bill_of_material") . '">Bill of Material</a></li>
                 </ul>';
        echo '</li>';



        echo '<li>';
        echo '<a href="#" aria-expanded="false"><i class="fa fa-tasks menu-icon"></i> Tasks<span class="fa arrow"></span></a>';

        echo '<ul class="nav nav-second-level collapse" aria-expanded="false">
                    <li><a href="' . base_url("admin/Task/add") . '">Add Task</a></li>
                    <li><a href="' . base_url("admin/Task/added_by_me") . '">Task Added By Me</a></li>
                    <li><a href="' . base_url("admin/Task/added_for_me") . '">Task For Me</a></li>
                    <li><a href="' . base_url("admin/Task/task_list") . '">Task List</a></li>
                 </ul>';
        echo '</li>';

   
        echo '<li>';
        echo '<a href="#" aria-expanded="false"><i class="fa fa-industry menu-icon"></i>Requirement<span class="fa arrow"></span></a>';

        echo '<ul class="nav nav-second-level collapse" aria-expanded="false">
                    <li><a href="' . base_url("admin/requirement") . '">Requirement</a></li>
                    <li><a href="' . base_url("admin/requirement/process_list") . '">Process Requirement</a></li>
                    <li><a href="' . base_url("admin/requirement/approval_list") . '">Process Approval</a></li>
                 </ul>';
        echo '</li>';
		
		
		echo '<li>';
        echo '<a href="#" aria-expanded="false"><i class="fa fa-user menu-icon"></i> HR<span class="fa arrow"></span></a>';

        echo '<ul class="nav nav-second-level collapse" aria-expanded="false">
                    <li><a href="' . base_url("admin/requests/list_requests") . '">Requests</a></li>
                    <li><a href="' . base_url("admin/leaves") . '">Leaves</a></li>
                    <li><a href="' . base_url("admin/wallet") . '">Wallet</a></li>';
					  if (is_admin() == 1) {
						  echo '<li><a href="' . base_url("admin/attendance/mark_attendance") . '">Mark Attendance</a></li>';
                          echo '<li><a href="' . base_url("admin/salary") . '">Manage Salary</a></li>';
                          echo '<li><a href="' . base_url("admin/salary/non_payable") . '">Mange Cash Salary</a></li>';
                          echo '<li><a href="' . base_url("admin/document/view") . '">Documentation</a></li>';
                          echo '<li><a href="' . base_url("admin/holidays") . '">Holidays</a></li>';
                          echo '<li><a href="' . base_url("admin/bank_payments") . '">Bank Payments</a></li>';
						  
					  }
					
					
        echo    '</ul>';
        echo '</li>';



      echo '<li>';
        echo '<a href="#" aria-expanded="false"><i class="fa fa-files-o menu-icon"></i>Reports<span class="fa arrow"></span></a>';

        echo '<ul class="nav nav-second-level collapse" aria-expanded="false">';
            if (is_admin() == 1) {
             
                          echo '<li><a href="' . base_url("admin/Expense_payble") . '">Payble Report</a></li>';
                          echo '<li><a href="' . base_url("admin/salary/paid_salary_report") . '">Paid Salary Report</a></li>';
                          echo '<li><a href="' . base_url("admin/salary/advance_salary_report") . '">Advance Salary Report</a></li>';
                          echo '<li><a href="' . base_url("admin/expenses/employee_payble") . '">Expense Payble Report</a></li>';
                          echo '<li><a href="' . base_url("admin/leaves/leave_report") . '">Leave Report</a></li>';
                          echo '<li><a href="' . base_url("admin/staff/ex_employee") . '">Ex-Employees</a></li>';
                          echo '<li><a href="' . base_url("admin/salary/employee_ctc") . '">Employee CTC</a></li>';
                          echo '<li><a href="' . base_url("admin/salary/export_report") . '">Paid Excel Report</a></li>';
                          echo '<li><a href="' . base_url("admin/petty_cash/reports") . '">Petty Cash Report</a></li>';
                          echo '<li><a href="' . base_url("admin/attendance/employee_attendance") . '">Attendance Report</a></li>';
              
            }
          
          
        echo    '</ul>';
        echo '</li>';  



        echo '<li>';
        echo '<a href="#" aria-expanded="false"><i class="fa fa-handshake-o menu-icon"></i> Follow Up<span class="fa arrow"></span></a>';

        echo '<ul class="nav nav-second-level collapse" aria-expanded="false">
                    <li><a href="' . base_url("admin/follow_up") . '">Payment Follow Up</a></li>
                    <li><a href="' . base_url("admin/follow_up/lead_followup") . '">Lead Follow Up</a></li>';

                     if (is_admin() == 1) {
                          echo '<li><a href="' . base_url("admin/follow_up/allotted_group") . '">Client Allotment</a></li>
                                <li><a href="' . base_url("admin/follow_up/suggestion") . '">Suggestion</a></li>'; 
                     }
                    
       echo        '</ul>';


                                


        echo '</li>';

 echo '<li class="menu-item-customers">
                       <a href="' . base_url("admin/reminder") . '" aria-expanded="false"><i class="fa fa-bell menu-icon"></i>Reminders</a>
                                   </li>';

        echo '<li class="menu-item-customers">
                       <a href="' . base_url("admin/app_lead") . '" aria-expanded="false"><i class="fa fa-briefcase menu-icon"></i>App Leads</a>
                                   </li>';  

            echo '<li>';
        echo '<a href="#" aria-expanded="false"><i class="fa fa-shopping-cart menu-icon"></i>Purchase<span class="fa arrow"></span></a>';

        echo '<ul class="nav nav-second-level collapse" aria-expanded="false">
                    <li><a href="' . base_url("admin/purchase") . '">Purchase Order</a></li>
                    <li><a href="' . base_url("admin/purchase/pending_purchaseorder") . '">Pending PO</a></li>
                    <li><a href="' . base_url("admin/purchase/receipt_list") . '">Material Receipt</a></li>
                    <li><a href="' . base_url("admin/purchase/pending_mr") . '">Pending MR</a></li>';
          
        echo    '</ul>';
        echo '</li>';


        echo '<li>';
        echo '<a href="#" aria-expanded="false"><i class="fa fa-inr menu-icon"></i>Sales Payment<span class="fa arrow"></span></a>';

        echo '<ul class="nav nav-second-level collapse" aria-expanded="false">
                    <li><a href="' . base_url("admin/Invoice_payments") . '">Add Payment</a></li>
                    <li><a href="' . base_url("admin/payments") . '">payments</a></li>
                    <li><a href="' . base_url("admin/Invoice_payments/on_account") . '">On Account</a></li>
                    <li><a href="' . base_url("admin/invoices/ledger") . '">Client Ledger</a></li>';
          
        echo    '</ul>';
        echo '</li>';


    }
}*/
