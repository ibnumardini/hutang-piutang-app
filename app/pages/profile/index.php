<div class="container">
    <h1>Profile</h1>
    <div class="row mt-3">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <img src="<?=$user['avatar'] ? '/public/avatar/' . $user['avatar'] : 'https://placekitten.com/300/300'?>"
                        class="avatar card-img-top img-thumbnail" alt="Muhammad Fatkurozi">
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>
                                    <span class="fw-bold">Full Name</span>
                                    <br>
                                    <span class="text-muted"><?=$user['name']?></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="fw-bold">Username</span>
                                    <br>
                                    <span class="text-muted"><?=$user['username']?></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="fw-bold">Email</span>
                                    <br>
                                    <span class="text-muted"><?=$user['email']?></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="fw-bold">Whatsapp Number</span>
                                    <br>
                                    <span class="text-muted"><?=$user['wa_num']?></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="fw-bold">Registered At</span>
                                    <br>
                                    <span
                                        class="text-muted"><?=date("d F Y H:i:s", strtotime($user['created_at']));?>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="/app/index.php?page=profile&action=edit" class="btn btn-primary"><i class="bi bi-pencil-square"></i> Edit</a>
                </div>
            </div>
        </div>
    </div>
</div>
