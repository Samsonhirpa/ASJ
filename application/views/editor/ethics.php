<div class="content-wrapper">
    <section class="content-header"><h1>Ethics Cases</h1></section>
    <section class="content">
        <div class="row">
            <div class="col-md-5">
                <div class="box box-danger">
                    <div class="box-header with-border"><h3 class="box-title">Handle Ethics Case</h3></div>
                    <form method="post" action="<?= base_url('editor/ethics') ?>">
                        <div class="box-body">
                            <input type="text" name="title" class="form-control" placeholder="Case title" required>
                            <select name="manuscriptId" class="form-control" style="margin-top:10px;">
                                <option value="">Related manuscript (optional)</option>
                                <?php foreach ($manuscripts as $m): ?>
                                <option value="<?= (int)$m->manuscriptId ?>"><?= html_escape($m->manuscriptNumber) ?></option>
                                <?php endforeach; ?>
                            </select>
                            <textarea name="details" class="form-control" style="margin-top:10px;" rows="6" placeholder="Case details" required></textarea>
                        </div>
                        <div class="box-footer"><button class="btn btn-danger">Create Case</button></div>
                    </form>
                </div>
            </div>
            <div class="col-md-7">
                <div class="box box-default"><div class="box-header with-border"><h3 class="box-title">Existing Cases</h3></div>
                    <div class="box-body table-responsive"><table class="table table-striped"><thead><tr><th>Title</th><th>Status</th><th>Created</th></tr></thead><tbody>
                        <?php if (!empty($cases)): foreach ($cases as $c): ?>
                        <tr><td><?= html_escape($c->title) ?></td><td><?= html_escape($c->status) ?></td><td><?= html_escape($c->createdDtm) ?></td></tr>
                        <?php endforeach; else: ?><tr><td colspan="3">No ethics cases.</td></tr><?php endif; ?>
                    </tbody></table></div>
                </div>
            </div>
        </div>
    </section>
</div>
