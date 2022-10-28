<div class="row">
    <div class="col-md-12 grid-margin"> 
    <div class="row">
        <div class="col-12 col-xl-8 mb-4 mb-xl-0">
        <h3 class="font-weight-bold"><?= $title; ?></h3>
        <h6 class="font-weight-normal mb-0"><?= $upp_description ?></h6>
        </div>
        <div class="col-12 col-xl-4">
        <div class="justify-content-end d-flex">
        <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
            <button class="btn btn-sm btn-light bg-white" type="button">
            <i class="mdi mdi-calendar"></i>Today is <span class="text-primary"><?= date("F d Y"); ?></span>
            </button>
        </div>
        </div>
        </div>
    </div>
    </div>
</div>