<!DOCTYPE html>
<html>
    <head>
        <title>Print Page</title>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">
        <style type="text/css">
            @page{margin:20px auto};
            td p{
                font-size: 12px;
            }
            td{font-size: 12px;}
        </style>
    </head>
    <body style="font-family: 'Nunito', sans-serif;">
        <div id="printableArea">
            <table border="0" cellspacing="0" cellpadding="0" style="width: 100%; margin: auto;">
                <tr>
                    <td style="text-align:center;">
                        <img src="https://schachengineers.com/schacrm_test/uploads/company/logo.png" width=300 height="auto" class="logo">
                        <h3 style="margin-top: 0; margin-bottom:5px; font-size: 20px; text-decoration: underline; font-weight: 900;">EMPLOYEE REGISTRTION FORM</h3>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php
                        // print_r($stafffile);die;
                        if (!empty($stafffile)) {
                            foreach ($stafffile as $upload) {
                                if ($upload['rel_type'] == 'photo_doc') {
                                    ?>
                                    <img src="<?php echo base_url() . 'uploads/registered_staff/photo_attach/' . $upload['rel_id'] . '/' . $upload['file_name']; ?>" width=100 height=100 > 
                                <?php }
                            }
                        } ?></td>
                </tr>
                <tr>
                    <td>
                        <h3 style="font-size: 16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Employee Details</h3>

                        <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
                        <?php if (!empty($registeredstaff)) {
                            foreach ($registeredstaff as $value) {
                        ?>
                                    <tr>
                                        <td style="border: 1px solid #d7d7d7; padding:5px;">
                                            <p style="margin:0;">Name of Employee :- <b><?php echo cc($value['employee_name']); ?></b></p>
                                        </td>

                                        <td style="border: 1px solid #d7d7d7; padding:5px;">
                                            <p style="margin:0;">Contact Number :- <b><?php echo $value['contact_no']; ?></b></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #d7d7d7; padding:5px;">
                                            <p style="margin:0;">Email Id :- <b><?php echo $value['email']; ?></b></p>
                                        </td>
                                        <td style="border: 1px solid #d7d7d7; padding:5px;">
                                            <p style="margin:0;">Date of Birth :- <b><?php echo _d($value['birth_date']); ?></b></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #d7d7d7; padding:5px;">
                                            <p style="margin:0;">Gender :- <b><?php if ($value['gender'] == 1) {echo 'Male';} else { echo 'Female';} ?></b></p>
                                        </td>
                                        <td style="border: 1px solid #d7d7d7; padding:5px;">

                                            <p style="margin:0;">Designation :- <b><?php
                                            $designation_id = $value['designation_id'];
                                            $designation_info = $this->db->query("SELECT * FROM `tbldesignation` where id = '" . $designation_id . "'")->row();
                                            echo cc($designation_info->designation);
                                            ?></b>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #d7d7d7; padding:5px;">
                                            <p style="margin:0;">Adhaar Card No :- <b><?php echo $value['adhar_no']; ?></b></p>
                                        </td>
                                        <td style="border: 1px solid #d7d7d7; padding:5px;">
                                            <p style="margin:0;">Pan Card No :- <b><?php echo $value['pan_card_no']; ?></b></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #d7d7d7; padding:5px;">
                                            <p style="margin:0;">Old EPF No. :- <b><?php echo $value['epf_no']; ?></b></p>
                                        </td>
                                        <td style="border: 1px solid #d7d7d7; padding:5px;">
                                            <p style="margin:0;">Old ESIC No. :- <b><?php echo $value['esic_no']; ?></b></p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td style="border: 1px solid #d7d7d7; padding:5px;">
                                            <p style="margin:0;">ESIC and EPF Deduction :- <b><?php echo ($value['epf_esicdeduct_id'] == 1) ? 'Yes' : 'No'; ?></b>
                                            </p>
                                        </td>
                                        <td style="border: 1px solid #d7d7d7; padding:5px;">

                                            <p style="margin:0;">Approved Probation Period :- <b><?php echo ($value['probationperiod_id'] == 1) ? 'Yes' : 'No'; ?></b>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #d7d7d7; padding:5px;">
                                            <p style="margin:0;">Working :- <b><?php echo ($value['workingbasis_id'] == 1) ? 'Daily Basis' : 'Monthly Basis'; ?></b>
                                            </p>
                                        </td>
                                        <td style="border: 1px solid #d7d7d7; padding:5px;">

                                            <p style="margin:0;">Gross Salary :- <b><?php echo $value['gross_salary']; ?></b></p>

                                        </td>
                                    </tr>
                                    <tr>
                                        <?php
                                            $dep_id = $value["department_id"];
                                            $deps_data = $this->db->query('SELECT name FROM tbldepartmentsmaster WHERE id = '.$dep_id.'')->row();
                                            
                                            $superior_id = $value["superior_id"];
                                            $superior_data = $this->db->query('SELECT firstname FROM tblstaff WHERE staffid = '.$superior_id.'')->row();
                                        ?>
                                        <td style="border: 1px solid #d7d7d7; padding:5px;">
                                            <p style="margin:0;">Department :- <b><?php echo (!empty($deps_data)) ? $deps_data->name : "n/a"; ?></b></p>
                                        </td>
                                        <td style="border: 1px solid #d7d7d7; padding:5px;">
                                            <p style="margin:0;"> Superior Name :- <b><?php echo (!empty($superior_data)) ? cc($superior_data->firstname) : "n/a"; ?></b></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #d7d7d7; padding:5px;">
                                            <p style="margin:0;">Net Salary :- <b><?php echo $value['net_salary']; ?></b></p>
                                        </td>
                                        <td style="border: 1px solid #d7d7d7; padding:5px;">

                                            <p style="margin:0;">Interviewers Name :- <b><?php echo $value['interviewername']; ?></b></p>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="border: 1px solid #d7d7d7; padding:5px;">

                                            <p style="margin:0;">Interviewers Remark :- <b><?php echo $value['interviewerremark']; ?></b></p>

                                        </td>
                                    </tr>
                            <?php }} ?>
                        </table>

                    </td>
                </tr>

                <tr>
                    <td>
                        <h3 style="font-size: 16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Address Details</h3>
                        <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
                            <tr>
                                <?php if (!empty($registeredstaff)) {
                                    foreach ($registeredstaff as $address) {
                                        ?>
                                        <td style="border: 1px solid #d7d7d7;">
                                            <h4 style="margin:0;padding: 5px; text-decoration: underline;">Permenant Details</h4>
                                            <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
                                                <tr>
                                                    <td style="padding:2px 5px;" colspan="2">
                                                        <p style="margin:0;">Permenant Address :- <b><?php echo cc($address['permenent_address']); ?></b></p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:2px 5px;">
                                                        <p style="margin:0;">State :- <b><?php
                                                        $state_id = $address['permenent_state'];
                                                        $state_info = $this->db->query("SELECT * FROM `tblstates` where id = '" . $state_id . "'")->row();
                                                        echo cc($state_info->name);
                                                        ?></b></p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:2px 5px;">
                                                        <p style="margin:0;">City :- <b><?php
                                                        $city_id = $address['permenent_city'];
                                                        $city_info = $this->db->query("SELECT * FROM `tblcities` where id = '" . $city_id . "'")->row();
                                                        echo cc($city_info->name);
                                                        ?></b></p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:2px 5px;">
                                                        <p style="margin:0;">Pincode :- <b><?php
                                                        echo $address['permenent_pincode'];
                                                        ?></b></p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="border: 1px solid #d7d7d7;">
                                            <h4 style="margin:0;padding: 5px; text-decoration: underline;">Residential Address Details</h4>
                                            <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
                                                <tr>
                                                    <td style="padding:2px 5px;" colspan="2">
                                                        <p style="margin:0;">Residential Address :- <b><?php echo cc($address['residential_address']); ?></b></p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:2px 5px;">
                                                        <p style="margin:0;">State :- <b><?php
                                                        $state_id = $address['residential_state'];
                                                        $state_info = $this->db->query("SELECT * FROM `tblstates` where id = '" . $state_id . "'")->row();
                                                        echo cc($state_info->name);
                                                        ?></b></p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:2px 5px;">
                                                        <p style="margin:0;">City :- <b><?php
                                                        $city_id = $address['residential_city'];
                                                        $city_info = $this->db->query("SELECT * FROM `tblcities` where id = '" . $city_id . "'")->row();
                                                        echo cc($city_info->name);
                                                        ?></b></p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding:2px 5px;">
                                                        <p style="margin:0;">Pincode :- <b><?php
                                                        echo $address['residential_pincode'];
                                                        ?></b></p>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                            <?php }} ?>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <?php if (empty($staffcontact)) {?>
                        <td>
                            <h3 style="font-size: 16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Contact Person</h3>
                        </td>
                        <tr>
                            <th style="border: 1px solid #ccc;">No Records</th>
                        </tr>
                    <?php } else { ?>
                    <td>
                        <h3 style="font-size: 16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Contact Person</h3>
                        <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th style="text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Full Name</th>
                                    <th style="text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Adhaar Card No</th>
                                    <th style="text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Contact No</th>
                                    <th style="text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Date of Birth</th>
                                    <th style="text-align: left; padding: 5px; border: 1px solid #ccc; background: #f3f3f3;">Relatioship</th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php if (!empty($staffcontact)) {
                            foreach ($staffcontact as $contact) {
                                ?>
                                        <tr>
                                            <td style="padding: 5px; border: 1px solid #ccc;"><?php echo $contact['full_name']; ?></td>
                                            <td style="padding: 5px; border: 1px solid #ccc;"><?php echo $contact['adhar_no']; ?></td>
                                            <td style="padding: 5px; border: 1px solid #ccc;"><?php echo $contact['contact_no']; ?></td>
                                            <td style="padding: 5px; border: 1px solid #ccc;"><?php echo _d($contact['date_of_birth']); ?></td>
                                            <td style="padding: 5px; border: 1px solid #ccc;">
                                                <?php
                                                $relationship_id = $contact['relationship_id'];
                                                $relationship_info = $this->db->query("SELECT * FROM `tblregistrationstaffrelationshiptype` where id = '" . $relationship_id . "'")->row();
                                                echo $relationship_info->relationship;
                                                ?>
                                            </td>
                                        </tr>
                        <?php }} ?>
                            </tbody>
                        </table>
                    </td>
                <?php }?>
                </tr>
                <tr>
                    <td>
                        <h3 style="font-size:16px;font-weight: 900;margin-bottom: 0;background: #d5dce5;padding: 5px;border: 1px solid #bbc2cc;">Bank Details</h3>
                        <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
                        <?php
                        if (!empty($registeredstaff)) {
                            foreach ($registeredstaff as $bank) {
                                ?>

                                    <tr>

                                         <td style="width:33%; padding: 5px; border: 1px solid #ccc;">
                                            <p style="margin:0;">Bank Name :- <b><?php echo $bank['bank_name']; ?></b></p>
                                        </td>
                                        <td style="width:33%; padding: 5px; border: 1px solid #ccc;">
                                            <p style="margin:0;">Account Number :- <b><?php echo $bank['account_no']; ?></b></p>
                                        </td>
                                        <td style="width:33%; padding: 5px; border: 1px solid #ccc;">
                                            <p style="margin:0;">IFC Code :- <b><?php echo $bank['ifc_code']; ?></b></p>
                                        </td>
                                    </tr>

                            <?php }
                        } ?>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
        <br><br>
        <input type="button" onclick="printDiv('printableArea')" value="Print This Page!" style="float :right"/>
        <br><br>
    </body>
    <script type="text/javascript">
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
</html>
