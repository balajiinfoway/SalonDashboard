<?php if (validation_errors()) { ?>
    <div role="alert" class="alert bg-danger alert-dismissible mb-2">
        <button aria-label="Close" data-dismiss="alert" class="close" type="button">
        <span aria-hidden="true">×</span>
        </button>
        <strong>Alert!</strong>
        <?php echo validation_errors(); ?>
    </div>
<?php } ?>
<?php
    $errors = $this->session->userdata('errors');
    if(isset($errors)) {
?>
    <div class="alert alert-<?= $errors['type']  ?> alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong><?= $errors['type'] ?>!</strong> <?= $errors['message'] ?>
    </div>
<?php
    }
 ?>