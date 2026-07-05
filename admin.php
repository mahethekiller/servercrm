<?php
    include 'includes/header.php';
?>

<!-- Info boxes -->
<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon text-bg-primary shadow-sm">
                <i class="bi bi-gear-fill"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">CPU Traffic</span>
                <span class="info-box-number">
                    10<small>%</small>
                </span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon text-bg-danger shadow-sm">
                <i class="bi bi-hand-thumbs-up-fill"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Likes</span>
                <span class="info-box-number">41,410</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon text-bg-success shadow-sm">
                <i class="bi bi-cart-fill"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">Sales</span>
                <span class="info-box-number">760</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon text-bg-warning shadow-sm">
                <i class="bi bi-people-fill"></i>
            </span>
            <div class="info-box-content">
                <span class="info-box-text">New Members</span>
                <span class="info-box-number">2,000</span>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Monthly Recap Report</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                    </button>
                </div>
            </div>
            
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <p class="text-center">
                            <strong>Sales: 1 Jan, 2023 - 30 Jul, 2023</strong>
                        </p>
                        <div id="sales-chart"></div>
                    </div>
                    
                    <div class="col-md-4">
                        <p class="text-center"><strong>Goal Completion</strong></p>
                        <div class="progress-group">
                            Add Products to Cart
                            <span class="float-end"><b>160</b>/200</span>
                            <div class="progress progress-sm">
                                <div class="progress-bar text-bg-primary" style="width: 80%"></div>
                            </div>
                        </div>

                        <div class="progress-group">
                            Complete Purchase
                            <span class="float-end"><b>310</b>/400</span>
                            <div class="progress progress-sm">
                                <div class="progress-bar text-bg-danger" style="width: 75%"></div>
                            </div>
                        </div>

                        <div class="progress-group">
                            <span class="progress-text">Visit Premium Page</span>
                            <span class="float-end"><b>480</b>/800</span>
                            <div class="progress progress-sm">
                                <div class="progress-bar text-bg-success" style="width: 60%"></div>
                            </div>
                        </div>

                        <div class="progress-group">
                            Send Inquiries
                            <span class="float-end"><b>250</b>/500</span>
                            <div class="progress progress-sm">
                                <div class="progress-bar text-bg-warning" style="width: 50%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include 'includes/footer.php';
?>
