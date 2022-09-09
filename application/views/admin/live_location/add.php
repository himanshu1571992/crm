<?php init_head(); ?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyCN_pDdu4H40ws0JZ1H6iH6WN41IdAVKCE"></script>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'unit-form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
						<h4 class="no-margin">Update Live Location</h4>	
                        <div class="row">
                            <div class="col-md-12">
							
								<div class="form-group">
                                    <label for="title" class="control-label"><?php echo 'Title'; ?> </label>
                                    <input type="text" id="title" name="title" class="form-control" value="<?php echo (isset($location['title']) && $location['title'] != "") ? $location['title'] : "" ?>">
                                </div>
							
                                <div class="form-group">
                                    <label for="location" class="control-label"><?php echo 'Location'; ?> *</label>
                                    <input type="text" id="location" name="location" class="form-control location" required="" value="<?php echo (isset($location['location']) && $location['location'] != "") ? $location['location'] : "" ?>">
                                </div>


                                <div class="form-group">
                                    <label for="lat_long " class="control-label"><?php echo 'Latitude & Longitude'; ?> *</label>
                                    <input type="text" id="lat_long " name="lat_long" class="form-control" value="<?php echo (isset($location['lat_long']) && $location['lat_long'] != "") ? $location['lat_long'] : "" ?>">
                                </div>
                                
								
								
                                <div class="form-group">
                                    <label for="view_status" class="control-label">View Status *</label>
                                    <select class="form-control selectpicker" name="view_status" required="">
                                        <option value=""></option>
                                        <option value="1" <?php echo (isset($location['view_status']) && $location['view_status'] == 1) ? 'selected' : "" ?>>Enable</option>
                                        <option value="0" <?php echo (isset($location['view_status']) && $location['view_status'] == 0) ? 'selected' : "" ?>>Disable</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" type="submit">
                                <?php echo _l('submit'); ?>
                            </button>
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


<script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });
</script>

<script>
var inputs = document.getElementsByClassName('location');

var options = {
 // types: ['(cities)'],
  componentRestrictions: {country: 'In'}
};

var autocompletes = [];

for (var i = 0; i < inputs.length; i++) {
  var autocomplete = new google.maps.places.Autocomplete(inputs[i], options);
  autocomplete.inputId = inputs[i].id;
  autocomplete.addListener('place_changed', fillIn);
  autocompletes.push(autocomplete);
}

function fillIn() {
  console.log(this.inputId);
  var place = this.getPlace();
  console.log(place. address_components[0].long_name);
}
 </script>

</body>
</html>
