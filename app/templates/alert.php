<?php if (isset($alert)): ?>
<div class="alert alert-<?=$alert[0]?> alert-dismissible fade show" role="alert">
    <ul class="mb-0">
        <?php foreach ($alert[1] as $alert_msg) {
            echo '<li><strong>' . $alert_msg . '</strong></li>';
        } ?>
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif;