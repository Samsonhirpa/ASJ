<div class="content-wrapper">
    <section class="content-header">
        <h1><?= html_escape($formTitle) ?></h1>
    </section>
    <section class="content">
        <div class="box box-default">
            <div class="box-body">
                <form method="post" action="<?= $formAction ?>">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Volume</label>
                                <input type="number" class="form-control" name="volume" min="1" required value="<?= set_value('volume', isset($issue) && $issue ? $issue->volume : '') ?>">
                                <?= form_error('volume', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Issue Number</label>
                                <input type="number" class="form-control" name="issueNumber" min="1" required value="<?= set_value('issueNumber', isset($issue) && $issue ? $issue->issueNumber : '') ?>">
                                <?= form_error('issueNumber', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Year</label>
                                <input type="number" class="form-control" name="year" min="1901" max="2100" required value="<?= set_value('year', isset($issue) && $issue ? $issue->year : date('Y')) ?>">
                                <?= form_error('year', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Month</label>
                                <input type="text" class="form-control" name="month" value="<?= set_value('month', isset($issue) && $issue ? $issue->month : '') ?>" placeholder="e.g. April">
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" class="form-control" name="title" required value="<?= set_value('title', isset($issue) && $issue ? $issue->title : '') ?>" placeholder="Issue title">
                                <?= form_error('title', '<small class="text-danger">', '</small>') ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="4" name="description" placeholder="Optional description"><?= set_value('description', isset($issue) && $issue ? $issue->description : '') ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Status</label>
                        <?php $currentStatus = set_value('status', isset($issue) && $issue ? $issue->status : 'draft'); ?>
                        <select name="status" class="form-control" required>
                            <option value="draft" <?= $currentStatus === 'draft' ? 'selected' : '' ?>>Draft</option>
                            <option value="published" <?= $currentStatus === 'published' ? 'selected' : '' ?>>Published</option>
                        </select>
                    </div>

                    <a href="<?= base_url('admin/issues') ?>" class="btn btn-default">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save Issue</button>
                </form>
            </div>
        </div>
    </section>
</div>
