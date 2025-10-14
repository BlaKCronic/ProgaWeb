<?php if(isset($alerta)): ?>
<div class="alert alert-<?php echo $alerta['tipo']; ?> alert-dismissible fade show" role="alert">
    <?php echo $alerta['mensaje']; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>