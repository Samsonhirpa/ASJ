<div class="content-wrapper" style="background: #f4f6f9;">
    
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div style="background: white; border-radius: 15px; padding: 20px 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); border-left: 5px solid #2c5f2d;">
            <h1 style="color: #333; font-size: 2em; font-weight: 500; margin: 0;">
                <i class="fa fa-users" style="color: #2c5f2d; margin-right: 10px;"></i>
                User Management
                <small style="color: #777;">Add, Edit, Delete, Export</small>
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
                            <!-- Removed search form - will be handled by DataTables -->
                        </div>
                    </div>
                    
                    <div class="box-body" style="padding: 20px;">
                        <table id="usersTable" class="table table-hover table-striped" style="width:100%; margin-bottom: 0;">
                            <thead style="background: #f8fafc; border-bottom: 2px solid #2c5f2d;">
                                <tr>
                                    <th style="padding: 12px;">Photo</th>
                                    <th style="padding: 12px;">Name</th>
                                    <th style="padding: 12px;">Email</th>
                                    <th style="padding: 12px;">Mobile</th>
                                    <th style="padding: 12px;">Role</th>
                                    <th style="padding: 12px;">Type</th>
                                    <th style="padding: 12px;">Institution</th>
                                    <th style="padding: 12px;">Country</th>
                                    <th style="padding: 12px; text-align: center;">Actions</th>
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
                                <tr>
                                    <td style="padding: 10px 12px;">
                                        <img src="<?php echo $profileImage; ?>" alt="Profile" 
                                             style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                                    </td>
                                    <td style="padding: 15px 12px; font-weight: 500; vertical-align: middle;"><?php echo $record->name ?></td>
                                    <td style="padding: 15px 12px; vertical-align: middle;"><?php echo $record->email ?></td>
                                    <td style="padding: 15px 12px; vertical-align: middle;"><?php echo $record->mobile ?></td>
                                    <td style="padding: 15px 12px; vertical-align: middle;">
                                        <?php echo $record->role; ?>
                                        <?php if($record->roleStatus == 2) { ?> 
                                            <br><span class="label label-warning" style="font-size: 0.8em; margin-top: 5px; display: inline-block;">Inactive</span>
                                        <?php } ?>
                                    </td>
                                    <td style="padding: 15px 12px; vertical-align: middle;">
                                        <?php 
                                        if($record->isAdmin == 1) { 
                                            echo '<span class="label" style="background: #2c5f2d; color: white;">System Admin</span>';
                                        } else { 
                                            echo '<span class="label" style="background: #6c757d; color: white;">Regular User</span>';
                                        } 
                                        ?>
                                    </td>
                                    <td style="padding: 15px 12px; vertical-align: middle;"><?php echo isset($record->institution) ? $record->institution : '-'; ?></td>
                                    <td style="padding: 15px 12px; vertical-align: middle;"><?php echo isset($record->country) ? $record->country : '-'; ?></td>
                                    <td style="padding: 10px 12px; text-align: center; vertical-align: middle;">
                                        <div class="btn-group" style="display: flex; gap: 3px;">
                                            <a class="btn btn-xs" href="<?= base_url().'login-history/'.$record->userId; ?>" 
                                               style="background: #17a2b8; color: white; border-radius: 4px; padding: 5px 8px;"
                                               title="Login history">
                                                <i class="fa fa-history"></i>
                                            </a>
                                            <a class="btn btn-xs" href="<?php echo base_url().'editOld/'.$record->userId; ?>" 
                                               style="background: #ffc107; color: #333; border-radius: 4px; padding: 5px 8px;"
                                               title="Edit">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a class="btn btn-xs deleteUser" href="#" data-userid="<?php echo $record->userId; ?>" 
                                               style="background: #dc3545; color: white; border-radius: 4px; padding: 5px 8px;"
                                               title="Delete">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
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

<!-- DataTables CSS and JS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap.min.css">

<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.colVis.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>

<style>
    /* DataTables Custom Styling */
    .dt-buttons {
        margin-bottom: 15px;
    }
    
    .dt-button {
        border-radius: 8px !important;
        margin-right: 5px !important;
        padding: 6px 15px !important;
        font-size: 13px !important;
        font-weight: 500 !important;
        border: 1px solid #ced4da !important;
        background: white !important;
        color: #495057 !important;
        transition: all 0.3s ease !important;
    }
    
    .dt-button:hover {
        background: #2c5f2d !important;
        color: white !important;
        border-color: #2c5f2d !important;
    }
    
    .dt-button.buttons-copy:hover {
        background: #6c757d !important;
        border-color: #6c757d !important;
    }
    
    .dt-button.buttons-csv:hover {
        background: #17a2b8 !important;
        border-color: #17a2b8 !important;
    }
    
    .dt-button.buttons-excel:hover {
        background: #28a745 !important;
        border-color: #28a745 !important;
    }
    
    .dt-button.buttons-pdf:hover {
        background: #dc3545 !important;
        border-color: #dc3545 !important;
    }
    
    .dt-button.buttons-print:hover {
        background: #ffc107 !important;
        color: #333 !important;
        border-color: #ffc107 !important;
    }
    
    .dataTables_filter input {
        border-radius: 20px !important;
        padding: 6px 15px !important;
        border: 1px solid #ced4da !important;
    }
    
    .dataTables_filter input:focus {
        border-color: #2c5f2d !important;
        outline: none;
        box-shadow: 0 0 0 3px rgba(44,95,45,0.1);
    }
    
    .dataTables_length select {
        border-radius: 8px !important;
        border: 1px solid #ced4da !important;
        padding: 5px !important;
    }
    
    .dataTables_info {
        color: #6c757d !important;
        font-size: 13px !important;
        padding-top: 15px !important;
    }
    
    .dataTables_paginate .paginate_button {
        border-radius: 8px !important;
        margin: 0 2px !important;
    }
    
    .dataTables_paginate .paginate_button.current {
        background: #2c5f2d !important;
        color: white !important;
        border: none !important;
    }
    
    .table > tbody > tr:hover {
        background: #f8fafc !important;
    }
    
    .btn-group {
        display: flex;
        gap: 3px;
        justify-content: center;
    }
    
    .btn-group .btn-xs {
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    
    .btn-group .btn-xs:hover {
        transform: translateY(-2px);
        box-shadow: 0 3px 8px rgba(0,0,0,0.2);
    }
</style>

<script type="text/javascript">
    jQuery(document).ready(function(){
        
        // Initialize DataTable
        var table = jQuery('#usersTable').DataTable({
            responsive: true,
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            pageLength: 10,
            order: [[1, 'asc']], // Sort by name column
            dom: '<"row"<"col-sm-6"B><"col-sm-6"f>>' +
                 '<"row"<"col-sm-12"tr>>' +
                 '<"row"<"col-sm-5"i><"col-sm-7"p>>',
            buttons: [
                {
                    extend: 'copy',
                    text: '<i class="fa fa-copy"></i> Copy',
                    className: 'dt-button buttons-copy',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7] // Exclude photo and actions columns
                    }
                },
                {
                    extend: 'csv',
                    text: '<i class="fa fa-file-text-o"></i> CSV',
                    className: 'dt-button buttons-csv',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    extend: 'excel',
                    text: '<i class="fa fa-file-excel-o"></i> Excel',
                    className: 'dt-button buttons-excel',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7]
                    }
                },
                {
                    extend: 'pdf',
                    text: '<i class="fa fa-file-pdf-o"></i> PDF',
                    className: 'dt-button buttons-pdf',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7]
                    },
                    customize: function(doc) {
                        doc.content[1].table.widths = ['15%', '20%', '15%', '15%', '15%', '20%'];
                        doc.styles.tableHeader = {
                            fillColor: '#2c5f2d',
                            color: 'white',
                            alignment: 'center',
                            fontSize: 12
                        };
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="fa fa-print"></i> Print',
                    className: 'dt-button buttons-print',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7]
                    },
                    customize: function(win) {
                        jQuery(win.document.body).find('table').addClass('table').css('width', '100%');
                        jQuery(win.document.body).find('th').css('background-color', '#2c5f2d').css('color', 'white');
                    }
                },
                {
                    extend: 'colvis',
                    text: '<i class="fa fa-columns"></i> Columns',
                    className: 'dt-button buttons-colvis'
                }
            ],
            columnDefs: [
                { orderable: false, targets: [0, 8] }, // Disable ordering on photo and actions columns
                { searchable: false, targets: [0, 8] } // Disable searching on photo and actions columns
            ],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search users...",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ users",
                infoEmpty: "Showing 0 to 0 of 0 users",
                infoFiltered: "(filtered from _MAX_ total users)",
                paginate: {
                    first: "First",
                    last: "Last",
                    next: "Next",
                    previous: "Previous"
                }
            }
        });
        
        // Delete user functionality
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
                            // Remove the row from DataTable
                            table.row(jQuery('.deleteUser[data-userid="' + deleteUserId + '"]').closest('tr')).remove().draw();
                            jQuery('#deleteModal').modal('hide');
                            
                            // Show success message
                            var alertHtml = '<div class="alert alert-success alert-dismissable" style="border-radius: 10px;">' +
                                            '<button type="button" class="close" data-dismiss="alert">×</button>' +
                                            '<i class="fa fa-check-circle"></i> User deleted successfully' +
                                            '</div>';
                            jQuery('.content .row:first').after('<div class="row"><div class="col-md-12">' + alertHtml + '</div></div>');
                            
                            // Auto-hide alert
                            setTimeout(function() {
                                jQuery('.alert').fadeOut('slow');
                            }, 3000);
                        } else {
                            alert('Failed to delete user');
                        }
                    }
                });
            }
        });
        
    });
</script>