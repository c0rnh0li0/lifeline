<div class="container">
    <div class="row">
        <div class="col">
            <p class="h3 mt-3 mb-2 text-black-50">Frontend settings</p>

            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-groups-tab" data-bs-toggle="tab" data-bs-target="#nav-groups" type="button" role="tab" aria-controls="nav-groups" aria-selected="true">Groups</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-groups" role="tabpanel" aria-labelledby="nav-groups-tab">
                    <?php require 'frontend-tabs/lifeline-admin-fe-groups.php'; ?>
                </div>
            </div>
        </div>
    </div>
</div>