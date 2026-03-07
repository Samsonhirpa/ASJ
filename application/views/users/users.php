<div class="content-wrapper" style="background: #f4f6f9;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div style="background: white; border-radius: 15px; padding: 20px 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); border-left: 5px solid #2c5f2d;">
        <h1 style="color: #333; font-size: 2em; font-weight: 500; margin: 0;">
          <i class="fa fa-users" style="color: #2c5f2d; margin-right: 10px;"></i>
          User Management
          <small style="color: #777;">Add, Edit, Delete</small>
        </h1>
      </div>
    </section>
    
    <section class="content">
        <!-- Add Button Row -->
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn" href="<?php echo base_url(); ?>addNew" 
                       style="background: linear-gradient(135deg, #2c5f2d 0%, #3e7c40 100%); color: white; border: none; padding: 10px 25px; border-radius: 8px; font-weight: 500; box-shadow: 0 5px 15px rgba(44,95,45,0.3);">
                        <i class="fa fa-plus"></i> Add New User
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Messages Row -->
        <div class="row">
            <div class="col-md-12">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable" style="border-radius: 10px; border-left: 4px solid #dc3545;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="fa fa-exclamation-triangle"></i> <?php echo $error; ?>                    
                </div>
                <?php } ?>
                
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable" style="border-radius: 10px; border-left: 4px solid #28a745;">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="fa fa-check-circle"></i> <?php echo $success; ?>
                </div>
                <?php } ?>
                
                <?php echo validation_errors('<div class="alert alert-danger alert-dismissable" style="border-radius: 10px;">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
            </div>
        </div>
        
        <!-- Users Table -->
        <div class="row">
            <div class="col-xs-12">
                <div class="box" style="border-radius: 15px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.05); border: 1px solid #e9ecef;">
                    <div class="box-header" style="background: #f8fafc; padding: 15px 20px; border-bottom: 1px solid #e9ecef;">
                        <h3 class="box-title" style="font-weight: 600;"><i class="fa fa-list"></i> Users List</h3>
                        <div class="box-tools">
                            <form action="<?php echo base_url() ?>userListing" method="POST" id="searchList">
                                <div class="input-group" style="width: 200px;">
                                    <input type="text" name="searchText" value="<?php echo $searchText; ?>" 
                                           class="form-control input-sm pull-right" 
                                           style="border-radius: 20px 0 0 20px; border: 1px solid #ced4da; padding: 6px 15px;"
                                           placeholder="Search users..."/>
                                    <div class="input-group-btn">
                                        <button class="btn btn-sm searchList" 
                                                style="background: #2c5f2d; color: white; border: 1px solid #2c5f2d; border-radius: 0 20px 20px 0; padding: 6px 15px;">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <div class="box-body table-responsive" style="padding: 0;">
                        <table class="table table-hover" style="margin-bottom: 0;">
                            <thead style="background: #f8fafc; border-bottom: 2px solid #2c5f2d;">
                                <tr>
                                    <th style="padding: 15px;">Photo</th>
                                    <th style="padding: 15px;">Name</th>
                                    <th style="padding: 15px;">Email</th>
                                    <th style="padding: 15px;">Mobile</th>
                                    <th style="padding: 15px;">Role</th>
                                    <th style="padding: 15px;">Type</th>
                                    <th style="padding: 15px;">Institution</th>
                                    <th style="padding: 15px;">Country</th>
                                    <th style="padding: 15px;">Created On</th>
                                    <th style="padding: 15px; text-align: center;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if(!empty($userRecords))
                                {
                                    foreach($userRecords as $record)
                                    {
                                        $profileImage = !empty($record->profile_image) ? base_url('uploads/profile_images/'.$record->profile_image) : base_url('assets/dist/img/avatar-default.png');
                                ?>
                                <tr style="border-bottom: 1px solid #e9ecef;">
                                    <td style="padding: 10px 15px;">
                                        <img src="<?php echo $profileImage; ?>" alt="Profile" 
                                             style="width: 45px; height: 45px; border-radius: 50%; object-fit: cover; border: 2px solid #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                                    </td>
                                    <td style="padding: 15px; font-weight: 500;"><?php echo $record->name ?></td>
                                    <td style="padding: 15px;"><?php echo $record->email ?></td>
                                    <td style="padding: 15px;"><?php echo $record->mobile ?></td>
                                    <td style="padding: 15px;">
                                        <?php echo $record->role; ?>
                                        <?php if($record->roleStatus == 2) { ?> 
                                            <br><span class="label label-warning" style="font-size: 0.8em;">Inactive</span>
                                        <?php } ?>
                                    </td>
                                    <td style="padding: 15px;">
                                        <?php 
                                        if($record->isAdmin == 1) { 
                                            echo '<span class="label" style="background: #2c5f2d; color: white;">System Admin</span>';
                                        } else { 
                                            echo '<span class="label" style="background: #6c757d; color: white;">Regular User</span>';
                                        } 
                                        ?>
                                    </td>
                                    <td style="padding: 15px;"><?php echo isset($record->institution) ? $record->institution : '-'; ?></td>
                                    <td style="padding: 15px;"><?php echo isset($record->country) ? $record->country : '-'; ?></td>
                                    <td style="padding: 15px;"><?php echo date("d-m-Y", strtotime($record->createdDtm)) ?></td>
                                    <td style="padding: 15px; text-align: center;">
                                        <div class="btn-group">
                                            <a class="btn btn-sm" href="<?= base_url().'login-history/'.$record->userId; ?>" 
                                               style="background: #17a2b8; color: white; margin: 0 2px; border-radius: 4px;"
                                               title="Login history">
                                                <i class="fa fa-history"></i>
                                            </a>
                                            <a class="btn btn-sm" href="<?php echo base_url().'editOld/'.$record->userId; ?>" 
                                               style="background: #ffc107; color: #333; margin: 0 2px; border-radius: 4px;"
                                               title="Edit">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a class="btn btn-sm deleteUser" href="#" data-userid="<?php echo $record->userId; ?>" 
                                               style="background: #dc3545; color: white; margin: 0 2px; border-radius: 4px;"
                                               title="Delete">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                    }
                                } else {
                                ?>
                                <tr>
                                    <td colspan="10" style="text-align: center; padding: 30px; color: #6c757d;">
                                        <i class="fa fa-users" style="font-size: 3em; display: block; margin-bottom: 10px;"></i>
                                        No users found
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="box-footer clearfix" style="background: #f8fafc; padding: 15px; border-top: 1px solid #e9ecef;">
                        <div class="pull-right">
                            <?php echo $this->pagination->create_links(); ?>
                        </div>
                        <div class="pull-left" style="color: #6c757d;">
                            <i class="fa fa-info-circle"></i> Total Users: <?php echo count($userRecords); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 15px;">
            <div class="modal-header" style="background: #f8fafc; border-bottom: 1px solid #e9ecef; border-radius: 15px 15px 0 0;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="deleteModalLabel" style="color: #dc3545;">
                    <i class="fa fa-exclamation-triangle"></i> Confirm Delete
                </h4>
            </div>
            <div class="modal-body" style="padding: 25px;">
                <p style="font-size: 1.1em;">Are you sure you want to delete this user?</p>
                <p class="text-muted"><small>This action cannot be undone.</small></p>
            </div>
            <div class="modal-footer" style="border-top: 1px solid #e9ecef; padding: 15px;">
                <button type="button" class="btn" data-dismiss="modal" style="background: #f8f9fa; color: #555; border: 1px solid #ced4da; padding: 8px 20px; border-radius: 8px;">
                    <i class="fa fa-times"></i> Cancel
                </button>
                <button type="button" class="btn" id="confirmDelete" style="background: #dc3545; color: white; border: none; padding: 8px 20px; border-radius: 8px;">
                    <i class="fa fa-trash"></i> Delete
                </button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
        // Pagination
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;            
            var value = link.substring(link.lastIndexOf('/') + 1);            
            jQuery("#searchList").attr("action", baseURL + "userListing/" + value);
            jQuery("#searchList").submit();
        });
        
        // Delete user
        var deleteUserId = null;
        
        jQuery('.deleteUser').click(function(e){
            e.preventDefault();
            deleteUserId = jQuery(this).data('userid');
            jQuery('#deleteModal').modal('show');
        });
        
        jQuery('#confirmDelete').click(function(){
            if(deleteUserId) {
                jQuery.ajax({
                    url: baseURL + 'deleteUser',
                    type: 'POST',
                    data: {userId: deleteUserId},
                    dataType: 'json',
                    success: function(response) {
                        if(response.status == true) {
                            location.reload();
                        } else {
                            alert('Failed to delete user');
                        }
                    }
                });
            }
        });
    });
</script>