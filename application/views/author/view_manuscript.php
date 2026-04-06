<div class="content-wrapper" style="background: #f4f6f9;">
    
    <!-- Content Header -->
    <section class="content-header">
        <div style="background: white; border-radius: 15px; padding: 20px 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); border-left: 5px solid #2c5f2d;">
            <h1 style="color: #333; font-size: 2em; font-weight: 500; margin: 0;">
                <i class="fa fa-file-text" style="color: #2c5f2d; margin-right: 10px;"></i>
                Manuscript Details
                <small style="color: #777;">#<?= $manuscript->manuscriptNumber ?></small>
            </h1>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-8">
                <!-- Main Manuscript Card -->
                <div class="box" style="border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); overflow: hidden;">
                    <div class="box-header" style="background: #f8fafc; padding: 15px 20px; border-bottom: 1px solid #e9ecef;">
                        <h3 class="box-title" style="font-weight: 600;">
                            <i class="fa fa-info-circle" style="color: #2c5f2d;"></i> 
                            Manuscript Information
                        </h3>
                        <div class="box-tools pull-right">
                            <span class="label label-<?= $manuscript->status == 'published' ? 'success' : ($manuscript->status == 'rejected' ? 'danger' : 'info') ?>" style="font-size: 1em; padding: 8px 15px;">
                                <?= ucfirst(str_replace('_', ' ', $manuscript->status)) ?>
                            </span>
                        </div>
                    </div>
                    
                    <div class="box-body" style="padding: 25px;">
                        <h2 style="margin-top: 0; margin-bottom: 20px; font-weight: 600;"><?= $manuscript->title ?></h2>
                        
                        <div style="margin-bottom: 20px;">
                            <strong>Article Type:</strong> <?= ucfirst(str_replace('_', ' ', $manuscript->articleType)) ?>
                        </div>
                        
                        <div style="margin-bottom: 20px;">
                            <strong>Submitted:</strong> <?= date('F d, Y \a\t h:i A', strtotime($manuscript->createdDtm)) ?>
                        </div>
                        
                        <div style="margin-bottom: 20px;">
                            <strong>Keywords:</strong> <?= $manuscript->keywords ?>
                        </div>
                        
                        <div style="margin-bottom: 30px;">
                            <h4 style="font-weight: 600;">Abstract</h4>
                            <div style="background: #f8fafc; padding: 20px; border-radius: 10px;">
                                <?= nl2br($manuscript->abstract) ?>
                            </div>
                        </div>
                        
                        <?php if(!empty($manuscript->coverLetter)): ?>
                        <div style="margin-bottom: 20px;">
                            <h4 style="font-weight: 600;">Cover Letter</h4>
                            <div style="background: #f8fafc; padding: 20px; border-radius: 10px;">
                                <?= nl2br($manuscript->coverLetter) ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Authors Card -->
                <div class="box" style="border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); margin-top: 20px;">
                    <div class="box-header" style="background: #f8fafc; padding: 15px 20px; border-bottom: 1px solid #e9ecef;">
                        <h3 class="box-title" style="font-weight: 600;">
                            <i class="fa fa-users" style="color: #2c5f2d;"></i> 
                            Authors
                        </h3>
                    </div>
                    
                    <div class="box-body" style="padding: 20px;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Institution</th>
                                    <th>Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($authors as $index => $author): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= $author->name ?></td>
                                    <td><?= $author->email ?></td>
                                    <td><?= $author->institution ?? 'Not specified' ?></td>
                                    <td>
                                        <?php if($author->isCorresponding): ?>
                                        <span class="label label-success">Corresponding</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <!-- Status Card -->
                <div class="box" style="border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05);">
                    <div class="box-header" style="background: #f8fafc; padding: 15px 20px; border-bottom: 1px solid #e9ecef;">
                        <h3 class="box-title" style="font-weight: 600;">
                            <i class="fa fa-clock-o" style="color: #2c5f2d;"></i> 
                            Status Timeline
                        </h3>
                    </div>
                    
                    <div class="box-body" style="padding: 20px;">
                        <ul class="timeline" style="list-style: none; padding: 0;">
                            <li style="margin-bottom: 15px;">
                                <i class="fa fa-check-circle bg-green" style="background: #28a745; color: white; border-radius: 50%; width: 30px; height: 30px; text-align: center; line-height: 30px; margin-right: 10px;"></i>
                                <span style="font-weight: 600;">Submitted</span>
                                <span class="pull-right text-muted"><?= date('d M Y', strtotime($manuscript->createdDtm)) ?></span>
                            </li>
                            <?php if($manuscript->status == 'under_review' || $manuscript->status == 'revision_required' || $manuscript->status == 'accepted'): ?>
                            <li style="margin-bottom: 15px;">
                                <i class="fa fa-spinner bg-yellow" style="background: #ffc107; color: white; border-radius: 50%; width: 30px; height: 30px; text-align: center; line-height: 30px; margin-right: 10px;"></i>
                                <span style="font-weight: 600;">Under Review</span>
                                <span class="pull-right text-muted">In progress</span>
                            </li>
                            <?php endif; ?>
                            <?php if($manuscript->status == 'revision_required'): ?>
                            <li style="margin-bottom: 15px;">
                                <i class="fa fa-edit bg-primary" style="background: #007bff; color: white; border-radius: 50%; width: 30px; height: 30px; text-align: center; line-height: 30px; margin-right: 10px;"></i>
                                <span style="font-weight: 600;">Revision Required</span>
                                <span class="pull-right text-muted">Action needed</span>
                            </li>
                            <?php endif; ?>
                            <?php if($manuscript->status == 'accepted' || $manuscript->status == 'published'): ?>
                            <li style="margin-bottom: 15px;">
                                <i class="fa fa-check-circle bg-green" style="background: #28a745; color: white; border-radius: 50%; width: 30px; height: 30px; text-align: center; line-height: 30px; margin-right: 10px;"></i>
                                <span style="font-weight: 600;">Accepted</span>
                                <span class="pull-right text-muted">Completed</span>
                            </li>
                            <?php endif; ?>
                            <?php if($manuscript->status == 'published'): ?>
                            <li style="margin-bottom: 15px;">
                                <i class="fa fa-globe bg-green" style="background: #28a745; color: white; border-radius: 50%; width: 30px; height: 30px; text-align: center; line-height: 30px; margin-right: 10px;"></i>
                                <span style="font-weight: 600;">Published</span>
                                <span class="pull-right text-muted">Online</span>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                
                <!-- Files Card -->
                <div class="box" style="border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); margin-top: 20px;">
                    <div class="box-header" style="background: #f8fafc; padding: 15px 20px; border-bottom: 1px solid #e9ecef;">
                        <h3 class="box-title" style="font-weight: 600;">
                            <i class="fa fa-files-o" style="color: #2c5f2d;"></i> 
                            Files
                        </h3>
                    </div>
                    
                    <div class="box-body" style="padding: 20px;">
                        <?php if(!empty($files)): ?>
                            <?php foreach($files as $file): ?>
                            <div style="margin-bottom: 15px; padding: 10px; background: #f8fafc; border-radius: 8px;">
                                <a href="<?= base_url($file->filePath) ?>" target="_blank" style="text-decoration: none;">
                                    <i class="fa fa-file-pdf-o" style="color: #dc3545; font-size: 1.2em;"></i>
                                    <?= $file->fileName ?>
                                    <span class="pull-right text-muted"><?= round($file->fileSize/1024, 2) ?> KB</span>
                                </a>
                            </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-muted">No files uploaded</p>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Actions Card -->
                <?php if($manuscript->status == 'revision_required'): ?>
                <div class="box" style="border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); margin-top: 20px;">
                    <div class="box-header" style="background: #f8fafc; padding: 15px 20px; border-bottom: 1px solid #e9ecef;">
                        <h3 class="box-title" style="font-weight: 600;">
                            <i class="fa fa-gavel" style="color: #2c5f2d;"></i> 
                            Actions Required
                        </h3>
                    </div>
                    
                    <div class="box-body" style="padding: 20px;">
                        <a href="<?= base_url('author/manuscript/revision-notifications') ?>" class="btn btn-warning btn-block" style="border-radius: 8px; padding: 12px;">
                            <i class="fa fa-edit"></i> Open Revision Notification Page
                        </a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if(!empty($reviewComments)): ?>
        <div class="row">
            <div class="col-md-12">
                <div class="box" style="border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); margin-top: 20px;">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-comments"></i> Reviewer Comments to Author</h3>
                    </div>
                    <div class="box-body">
                        <?php foreach($reviewComments as $comment): ?>
                            <div style="border:1px solid #eee; border-radius:8px; padding:12px; margin-bottom:10px;">
                                <strong><?= html_escape($comment->reviewerName ?: 'Reviewer') ?></strong>
                                <span class="label label-default"><?= html_escape(ucwords(str_replace('_', ' ', $comment->recommendationDecision ?: 'pending'))) ?></span>
                                <div class="text-muted" style="margin:6px 0;"><?= $comment->reviewSubmittedDate ? date('d M Y H:i', strtotime($comment->reviewSubmittedDate)) : '-' ?></div>
                                <div><?= nl2br(html_escape($comment->commentsToAuthor)) ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </section>
</div>
