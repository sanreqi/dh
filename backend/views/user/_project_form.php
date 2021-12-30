<?php
/* @var $projects */
?>

<div class="card pr">
    <div class="card-body">
        <h5 class="card-title">项目权限</h5>
        <div id="project-content">
            <form id="project-form">
                <?php if (!empty($projects)): ?>
                    <?php foreach ($projects as $project): ?>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                <input name="projects[]" type="checkbox" <?= $project['checked']; ?> value="<?= $project['key'] ?>"
                                       class="controller-chx-item form-check-input" ?><?= $project['val']; ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </form>
        </div>
    </div>
    <button type="button" class="card-edit-btn" id="save-project-btn">保存</button>
</div>