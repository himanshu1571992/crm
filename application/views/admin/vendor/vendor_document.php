
<?php init_head(); ?>
<style>
ul.tree, ul.tree ul {
    list-style: none;
     margin: 0;
     padding: 0;
   } 
  
   ul.tree li {
        margin-bottom: 20px;
     padding: 0 7px;
     line-height: 20px;
     color: #369;
     font-weight: bold;
     /*border-left:1px solid #415165;*/

   }
   ul.tree li:last-child {
       border-left:none;
   }
ul.tree li:before {
    position: relative;
    top: -0.3em;
    /* height: 2em; */
    width: 12px;
    color: white;
    /* border-bottom: 1px solid #415165; */
    content: "";
    display: none;
    left: -7px;
}
   /*ul.tree li:last-child:before {
      border-left:1px solid #415165;   
   }*/
ul.tree h4 {
    display: inline-block;
    color: #fff;
    /* border: 1px solid; */
    padding: 10px 15px;
    /* border-radius: 20px; */
    font-size: 17px;
    box-shadow: 0px 3px 8px #ccc;
    background: #FF9800;
    display: block;
    margin: 0;
}
  ul.tree ul li b{
    color:#415165;
  }
ul.tree ul {
    background: #f6f6f6;
    padding: 10px 0px;
    box-shadow: 0px 3px 7px #ccc;
}
ul.tree ul li {
    margin: 0;
    padding: 6px 15px;
    line-height: 20px;
    color: #369;
    font-weight: bold;
    font-size:14px;
    /* border-left: 1px solid #415165; */
}
</style>
<div id="wrapper" class="customer_profile">
<div class="content">
   <div class="row">
      <div class="col-md-2">
         <div class="panel_s mbot5">
            <div class="panel-body padding-10">
               <h4 class="bold"><?php echo $vendor_info->name; ?></h4>
            </div>
         </div>
         <?php echo vendor_report_tab('document',$vendor_info->id);?>
      </div>
      
            <div class="col-md-10">
                <div class="panel_s">
                    <div class="panel-body">

                    <div class="col-md-4"><h4 class="no-margin"> </h4></div>  

                   <h4 class="no-margin"><?php echo $title; ?> </h4>

          <hr class="hr-panel-heading">
          
          <div class="row">

            
         <div class="panel-body">
                        <div class="_buttons">
                            <button type="button" class="btn btn-info mright5 test pull-left display-block" data-toggle="modal" data-target="#folder_model">New Folder</button>
                            <button type="button" class="btn btn-info mright5 test pull-left display-block" data-toggle="modal" data-target="#file_model">New File</button>
                            <div class="visible-xs">
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="clearfix"></div>

                        <div class="clearfix mtop20"></div>

               
                        <?php
                        if(!empty($document_info)){
                            ?>
                            <ul class="tree">
                                 <?php 
                                 if($parent_id > 0){
                                     $folder_info  = $this->db->query("SELECT * FROM tblvendordocuments WHERE id =  '".$parent_id."'  ")->row();

                                  echo '<li style="color:red;"><a href="'.admin_url('vendor/vendor_documents/'.$vendor_info->id.'?parent_id='.$folder_info->parent_id).'"><h4><i class="fa fa-arrow-left" aria-hidden="true"></i> '.$folder_info->name.'</h4></a>';
                                 }
                                 ?>
                                
                                <ul>
                                    <?php
                                    foreach ($document_info as $key => $value) {
                                        
                                        
                                        if($value->type == 1){
                                            echo '<li><i class="fa fa-folder" aria-hidden="true"></i> <a href="'.admin_url('vendor/vendor_documents/'.$vendor_info->id.'?parent_id='.$value->id).'" ><b>'.$value->name.'</b></a>&nbsp;&nbsp;&nbsp;&nbsp;<a val="'.$value->id.'" class="edit_folder" href="#"> <i class="fa fa-pencil" aria-hidden="true"  data-toggle="modal" data-target="#editfolder_model"></i></a></li>';    
                                        }else{
                                            $file_info  = $this->db->query("SELECT * FROM tblfiles WHERE rel_id = '".$value->id."' and rel_type = 'vendor_document'  ")->result();
                                            
                                            if(!empty($file_info)){
                                              foreach ($file_info as $r) {
                                                
                                                 ?>
                                                 <li><i class="fa fa-file" aria-hidden="true"></i> <a href="<?php echo base_url('uploads/vendor_document/'.$value->id.'/'.$r->file_name); ?>" target="_blank"><b><?php echo $r->file_name; ?></b></a>
                                                  <a download href="<?php echo base_url('uploads/vendor_document/'.$value->id.'/'.$r->file_name); ?>" ><b class="fa fa-download"></b></a>
                                                  &nbsp;&nbsp;&nbsp;&nbsp;<a onclick="return confirm('Are you sure you want to Remove?');" href="<?php echo admin_url('vendor/delete_file/'.$r->id.'/'.$parent_id.'/'.$vendor_info->id); ?>"><i style="color: red; " class="fa fa-trash" aria-hidden="true"></i></a></li>

                                                 <?php  
                                                }
                                            }
                                        }
                                        
                                    }
                                    ?>
                                </ul>
                                </li>
                            </ul>
                            <?php
                        }elseif($parent_id > 0){
                            ?>
                            <ul class="tree">
                                <?php
                                 $folder_info  = $this->db->query("SELECT * FROM tblvendordocuments WHERE id =  '".$parent_id."'  ")->row();
                                     echo '<li style="color:red;"><a href="'.admin_url('vendor/vendor_documents/'.$vendor_info->id.'?parent_id='.$folder_info->parent_id).'"><h4><i class="fa fa-arrow-left" aria-hidden="true"></i> '.$folder_info->name.'</h4></a></li>';


                                ?>
                            </ul>
                            <?php
                        }
                        ?>
                        
                        
                    </div>
               <!-- </div>
             </div>
        </div>
    </div> -->



  <div id="folder_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New Folder Name</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo admin_url('vendor/create_folder'); ?>" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">


            <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="title" class="control-label">Folder Name *</label>
                    <input type="text" id="folder_name" name="folder_name" class="form-control" required="">
                </div>

                <input type="hidden" value="<?php echo $parent_id; ?>" name="parent_id">
                <input type="hidden" value="<?php echo $vendor_info->id; ?>" name="vendor_id">
            </div>
        </div>

         <button class="btn btn-info" type="submit">Create Folder</button>

         </form>   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="file_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">New File Upload</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo admin_url('vendor/upload_file'); ?>" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">


            <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="file" class="control-label">Upload Files</label>
                    <input lass="form-group" required="" type="file" id="file"  name="file[]" multiple="" style="width: 100%;">
                </div>

                <input type="hidden" value="<?php echo $parent_id; ?>" name="parent_id">
                <input type="hidden" value="<?php echo $vendor_info->id; ?>" name="vendor_id">
            </div>
        </div>

         <button class="btn btn-info" type="submit">Upload File</button>

         </form>   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal -->
<div id="editfolder_model" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Folder Name</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo admin_url('vendor/edit_folder'); ?>" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">


            <div id="edit_data" class="row">
            
             </div>
             <input type="hidden" value="<?php echo $parent_id; ?>" name="parent_id">
             <input type="hidden" value="<?php echo $vendor_info->id; ?>" name="vendor_id">

         <button class="btn btn-info" type="submit">Edit Folder</button>

         </form>   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


                          
          </div>
                       
        </div>
                       
       </div>
     </div>
   </div>
</div>
</div>

<?php init_tail(); ?>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="text/javascript">
$(document).on('click', '.edit_folder', function() { 

    var id = $(this).attr('val');  
    $.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/vendor/get_editdata'); ?>",
            data    : {'id' : id},
            success : function(response){
                if(response != ''){                  
                     $('#edit_data').html(response);  
                }
            }
        })
}); 

</script>