<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
		 <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
					<h4 class="no-margin">Location Map</h4>
					<hr class="hr-panel-heading">
					
					<div class="row">
						<div class="form-group col-md-4" id="employee_div">
							<label for="staff_id" class="control-label"><?php echo 'Employee Name'; ?> *</label>
							<select class="form-control selectpicker" id="staff_id" name="staff_id">
								<option value="" disabled selected >--Select One-</option>
								<?php
								if(!empty($staff_list)){
									foreach($staff_list as $staff){
										?>
										<option value="<?php echo $staff->staffid;?>" <?php echo (isset($s_staff) && $s_staff ==$staff->staffid) ? 'selected' : "" ?>><?php echo $staff->firstname; ?></option>
										<?php
									}
								}
								?>
							</select>
						</div>
						
						
						<div class="form-group col-md-4" app-field-wrapper="date">
							<label for="date" class="control-label"><?php echo 'Select Date'; ?></label>
							<div class="input-group date">
								<input id="date" required name="date" class="form-control datepicker" value="<?php echo (isset($s_date) && $s_date != "") ? $s_date : date('d/m/Y') ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>
						</div>
						
						<div class="form-group col-md-4" app-field-wrapper="date">
							
							<div class="input-group date">
								<button class="btn btn-info" value="1" name="mark" type="submit">Search</button>
							</div>
						</div>
												
					</div>
					
                        <div class="row">
						
							
                            <div class="col-md-3 table-responsive">
								<table class="table">
									<thead>
									  <tr>
										<th>Check In</th>
										<th>Check Out</th>
									  </tr>
									</thead>
									<tbody>
									<?php
									if(!empty($att_info)){
										$i=1;
										foreach($att_info as $row){
											
											//$staff_info = $this->home_model->get_row('tblstaff', array('staffid'=>$staff->staffid), '');		
											?>
											<tr>
												<td><?php if(!empty($row->checkin_time)){ echo date('h:i a',strtotime($row->checkin_time)); }else{ echo '--';}?></td>
												<td><?php if(!empty($row->checkout_time)){ echo date('h:i a',strtotime($row->checkout_time)); }else{ echo '--';}?></td>
											</tr>
											<?php
										}
									}else{
										echo '<tr><td class="text-center" colspan="3"><h5>Record Not Found</h5></td></tr>';
									}
									?>
									  
									 
									</tbody>
								  </table>
							</div>						
							
							<div class="col-md-9">																
								<?php
							if(!empty($marker)){
							?>
							<div id="dvMap" style="height: 800px">
							</div>
							<?php	
							}else{
								echo '<div class="text-center" style="height: 100px; margin-top: 70px"><h3>Location Map Not found!</h3></div>';
							}
							?>
							</div>
						
						

                               
                            </div>
							 
                        </div>
                       
                    </div>
                </div>
             
            <?php echo form_close(); ?>
		</div>		
        <div class="btn-bottom-pusher"></div>
    </div>
</div>

<?php init_tail(); ?>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&key=AIzaSyCog0SwrdpgOuhxZ3ftbUhyJVKwWSTA0iI"></script>
<script type="text/javascript">
    var markers = [
  
	<?php
		if(!empty($marker)){
			foreach($marker as $mark){
				echo $mark;
			}	
		}else{
			?>
			/*{
				
				"lat": '20.5937',
				"lng": '78.9629'
			}*/
			<?php
		}
		
	?>
    ];
    window.onload = function () {
        LoadMap();
    }
    function LoadMap() {
        var mapOptions = {
            center: new google.maps.LatLng(markers[0].lat, markers[0].lng),
            zoom: 5,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
 
        //Create and open InfoWindow.
        var infoWindow = new google.maps.InfoWindow();
		
 
        for (var i = 0; i < markers.length; i++) {
            var data = markers[i];
            var myLatlng = new google.maps.LatLng(data.lat, data.lng);
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: data.title
            });
 
            //Attach click event to the marker.
            (function (marker, data) {
                google.maps.event.addListener(marker, "click", function (e) {
                    //Wrap the content inside an HTML DIV in order to set height and width of InfoWindow.
                    infoWindow.setContent("<div style = 'width:auto;min-height:80px'>" + data.description + "</div>");
                    infoWindow.open(map, marker);
                });
            })(marker, data);
        }
    }
</script>

<script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });
</script>


<script type="text/javascript">
	$(document).on('change', '#branch_id', function(){	
		$("#attendance_form").submit();	
	});
	
	$(document).on('change', '#date', function(){	
		$("#attendance_form").submit();	
	});
</script> 

<script type="text/javascript">
	$(document).on('change', '.status', function(){	
		var staff_id = $(this).attr('title');
		var status = $(this).val();
		
		if(status == 5){
			
			$("#working_to_"+staff_id).prop("disabled", false);
		}else{
			$("#working_to_"+staff_id).prop("disabled", true);
		}
			
		
		//$("#attendance_form").submit();	
	});	
</script> 

</body>
</html>
