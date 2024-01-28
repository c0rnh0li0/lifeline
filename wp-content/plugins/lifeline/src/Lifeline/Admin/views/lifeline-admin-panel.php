<div class="row p-0 m-0">
    <div class="col pt-4">
        <h3>Lifeline</h3>

        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true"><?= __('General', 'propeller-ecommerce'); ?></a>
            </li>
        </ul>

        <div class="tab-content mb-1" id="propeller_tabs">
            <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                <?php require_once 'tab/lifeline-admin-general.php'; ?>
            </div>
        </div>
    </div>
</div>