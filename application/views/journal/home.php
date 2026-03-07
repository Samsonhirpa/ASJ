<?php
// REMOVE these lines if they exist in your home.php:
// $this->load->view('journal/header');
// $this->load->view('journal/footer');
?>

<div class="row mb-5">
    <div class="col-lg-8 mx-auto text-center">
        <h2 class="display-4 mb-4">Welcome to OJAS</h2>
        <p class="lead">The Oromia Journal of Agricultural Sciences publishes original research, reviews, and case studies across all fields of agricultural sciences, with emphasis on tropical and subtropical agriculture.</p>
        <div class="mt-4">
            <a href="<?php echo base_url('journal/current_issue'); ?>" class="btn btn-ojas btn-lg me-2">
                <i class="fas fa-book-open me-2"></i>Current Issue
            </a>
            <a href="<?php echo base_url('author/manuscript/submit'); ?>" class="btn btn-outline-success btn-lg">
                <i class="fas fa-upload me-2"></i>Submit Manuscript
            </a>
        </div>
    </div>
</div>

<!-- Latest Issue -->
<?php if(isset($latest_issue) && $latest_issue): ?>
<div class="row mb-5">
    <div class="col-12">
        <h3 class="mb-4">
            <i class="fas fa-newspaper me-2 text-success"></i>
            Latest Issue: Volume <?php echo $latest_issue->volume; ?>, Issue <?php echo $latest_issue->issueNumber; ?> (<?php echo $latest_issue->year; ?>)
        </h3>
        
        <?php if(!empty($latest_issue->articles)): ?>
            <?php foreach($latest_issue->articles as $article): ?>
            <div class="article-card">
                <div class="article-meta">
                    <span class="badge bg-primary me-2"><?php echo get_article_type_name($article->articleType); ?></span>
                    <span class="me-3"><i class="fas fa-calendar"></i> <?php echo date('M d, Y', strtotime($article->publishedDate)); ?></span>
                    <span><i class="fas fa-eye"></i> <?php echo $article->viewsCount; ?> views</span>
                </div>
                <h4>
                    <a href="<?php echo base_url('journal/article/' . $article->articleId); ?>" class="text-decoration-none text-dark">
                        <?php echo $article->title; ?>
                    </a>
                </h4>
                <p class="text-muted"><?php echo $article->author_names; ?></p>
                <p class="mt-3"><?php echo substr(strip_tags($article->abstract), 0, 200); ?>...</p>
                <a href="<?php echo base_url('journal/article/' . $article->articleId); ?>" class="btn btn-sm btn-outline-success">
                    Read More <i class="fas fa-arrow-right ms-1"></i>
                </a>
            </div>
            <?php endforeach; ?>
            
            <div class="text-center mt-3">
                <a href="<?php echo base_url('journal/archive'); ?>" class="btn btn-link">View All Issues <i class="fas fa-arrow-right"></i></a>
            </div>
        <?php else: ?>
            <p class="text-muted">No articles published in this issue yet.</p>
        <?php endif; ?>
    </div>
</div>
<?php endif; ?>

<!-- Recent Articles -->
<?php if(isset($recent_articles) && !empty($recent_articles)): ?>
<div class="row">
    <div class="col-12">
        <h3 class="mb-4">
            <i class="fas fa-clock me-2 text-success"></i>
            Recently Published
        </h3>
    </div>
    
    <?php foreach($recent_articles as $article): ?>
    <div class="col-md-6">
        <div class="article-card">
            <div class="article-meta">
                <span class="badge bg-info me-2"><?php echo get_article_type_name($article->articleType); ?></span>
                <span>Vol <?php echo $article->volume; ?>(<?php echo $article->issueNumber; ?>), <?php echo $article->issue_year; ?></span>
            </div>
            <h5>
                <a href="<?php echo base_url('journal/article/' . $article->articleId); ?>" class="text-decoration-none text-dark">
                    <?php echo $article->title; ?>
                </a>
            </h5>
            <p class="text-muted small"><?php echo $article->author_names; ?></p>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>

<!-- Journal Information -->
<div class="row mt-5 pt-4 border-top">
    <div class="col-md-4 mb-4">
        <div class="text-center p-4 bg-light rounded">
            <i class="fas fa-search fa-3x text-success mb-3"></i>
            <h5>Abstracting & Indexing</h5>
            <p class="text-muted">Indexed in major databases including DOAJ, Scopus, and Web of Science</p>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="text-center p-4 bg-light rounded">
            <i class="fas fa-clock fa-3x text-success mb-3"></i>
            <h5>Fast Publication</h5>
            <p class="text-muted">Average time to first decision: 3 weeks</p>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="text-center p-4 bg-light rounded">
            <i class="fas fa-globe fa-3x text-success mb-3"></i>
            <h5>Open Access</h5>
            <p class="text-muted">All articles freely available under CC BY license</p>
        </div>
    </div>
</div>