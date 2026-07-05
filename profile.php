<?php
// require_once './config.php';



$pageTitle = "My Profile";
require_once './includes/header.php';
if (!is_logged_in()) {
    header('Location: ' . BASE_URL);
    exit;
}
?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>My Profile</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="<?php echo BASE_URL ?>assets/dist/img/user4-128x128.jpg"
                                     alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center"><?php echo htmlspecialchars($_SESSION['user']['name'] ?? 'User') ?></h3>
                            <p class="text-muted text-center"><?php echo htmlspecialchars($_SESSION['user']['role'] ?? 'Member') ?></p>
                            <a href="<?php echo BASE_URL ?>profile/edit.php" class="btn btn-primary btn-block">
                                <b>Edit Profile</b>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="settings">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" value="<?php echo htmlspecialchars($_SESSION['user']['email'] ?? '') ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label>Member Since</label>
                                        <input type="text" class="form-control" value="<?php echo date('F j, Y', strtotime($_SESSION['user']['created_at'] ?? 'now')) ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php require_once ROOT_PATH . 'includes/footer.php'; ?>
