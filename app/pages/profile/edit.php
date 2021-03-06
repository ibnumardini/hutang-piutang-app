<div class="container">
    <h1>Edit Profile</h1>
    <div class="row">
        <div class="col-md-6">
        <?php
            
            if(isset($alert)) :
                ?>
            <div class="alert alert-<?= $alert[0] ?> alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    <?php
                    
                    foreach ($alert[1] as $alert_msg) {
                        echo '<li><strong>'. $alert_msg .'</strong></li>';
                    }

                    ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
            endif;
            ?>
            <form method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="fullname" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" value="<?= $user['name'] ?>">
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= $user['username'] ?>">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>">
                </div>
                <div class="mb-3">
                    <label for="wa_num" class="form-label">Whatsapp Number</label>
                    <input type="text" class="form-control" id="wa_num" name="wa_num" value="<?= $user['wa_num'] ?>">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="mb-3">
                    <label for="avatar" class="form-label">Avatar</label>
                    <input class="form-control" type="file" id="avatar" name="avatar">
                </div>
                <div class="mb-3">
                    <input type="hidden" name="action" value="edit_profile">
                    <button class="btn btn-primary"><i class="bi bi-device-hdd-fill"></i> Save</button>
                <div>
            </form>
        </div>
        <div class="col-md-6"></div>
    </div>
</div>