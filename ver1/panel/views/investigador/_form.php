<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['error_message'])){
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
    echo $_SESSION['error_message'];
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';
    unset($_SESSION['error_message']);
}

if(isset($_SESSION['success_message'])){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
    echo $_SESSION['success_message'];
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';
    unset($_SESSION['success_message']);
}
?>

<h1>Nuevo Investigador</h1>

<div class="alert alert-info">
    <strong>Requisitos para la fotografía:</strong>
    <ul class="mb-0">
        <li>Formato: JPG, PNG, GIF o WEBP</li>
        <li>Tamaño máximo: 5 MB</li>
        <li>Dimensiones recomendadas: 800x800 px mínimo</li>
    </ul>
</div>

<form method="POST" enctype="multipart/form-data" action="investigador.php?action=create" id="formInvestigador">
    <div class="mb-3">
        <label for="PrimerApellido" class="form-label">Primer Apellido <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="PrimerApellido" name="primer_apellido" 
               placeholder="Primer Apellido" required minlength="2" maxlength="100">
        <div class="invalid-feedback">Por favor ingrese el primer apellido (mínimo 2 caracteres)</div>
    </div>

    <div class="mb-3">
        <label for="SegundoApellido" class="form-label">Segundo Apellido <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="SegundoApellido" name="segundo_apellido" 
               placeholder="Segundo Apellido" required minlength="2" maxlength="100">
        <div class="invalid-feedback">Por favor ingrese el segundo apellido (mínimo 2 caracteres)</div>
    </div>

    <div class="mb-3">
        <label for="Nombre" class="form-label">Nombre(s) <span class="text-danger">*</span></label>
        <input type="text" class="form-control" id="Nombre" name="nombre" 
               placeholder="Nombre" required minlength="2" maxlength="100">
        <div class="invalid-feedback">Por favor ingrese el nombre (mínimo 2 caracteres)</div>
    </div>

    <div class="mb-3">
        <label for="Fotografia" class="form-label">Fotografía <span class="text-danger">*</span></label>
        <input type="file" class="form-control" id="Fotografia" name="fotografia" 
               accept="image/jpeg,image/jpg,image/png,image/gif,image/webp" required>
        <div class="invalid-feedback" id="fileError">Por favor seleccione una fotografía válida</div>
        <div class="form-text">Formatos permitidos: JPG, PNG, GIF, WEBP. Tamaño máximo: 5MB</div>
        
        <div id="imagePreview" class="mt-3" style="display: none;">
            <img id="previewImg" src="" alt="Vista previa" class="img-thumbnail" style="max-width: 300px;">
            <div id="imageInfo" class="mt-2 small text-muted"></div>
        </div>
    </div>

    <div class="mb-3">
        <label for="Semblanza" class="form-label">Semblanza <span class="text-danger">*</span></label>
        <textarea class="form-control" id="Semblanza" name="semblanza" rows="5"
                  placeholder="Escriba una breve biografía del investigador..." 
                  required minlength="50" maxlength="1000"></textarea>
        <div class="form-text">
            <span id="charCount">0</span> / 1000 caracteres (mínimo 50)
        </div>
        <div class="invalid-feedback">La semblanza debe tener entre 50 y 1000 caracteres</div>
    </div>

    <div class="mb-3">
        <label for="Institucion" class="form-label">Institución <span class="text-danger">*</span></label>
        <select class="form-select" id="Institucion" name="id_institucion" required>
            <option value="">Seleccione una institución</option>
            <?php foreach ($instituciones as $institucion): ?>
                <option value="<?php echo $institucion['id_institucion']; ?>">
                    <?php echo htmlspecialchars($institucion['institucion']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <div class="invalid-feedback">Por favor seleccione una institución</div>
    </div>

    <div class="mb-3">
        <label for="Tratamiento" class="form-label">Tratamiento <span class="text-danger">*</span></label>
        <select class="form-select" id="Tratamiento" name="id_tratamiento" required>
            <option value="">Seleccione un tratamiento</option>
            <?php foreach ($tratamientos as $tratamiento): ?>
                <option value="<?php echo $tratamiento['id_tratamiento']; ?>">
                    <?php echo htmlspecialchars($tratamiento['tratamiento']); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <div class="invalid-feedback">Por favor seleccione un tratamiento</div>
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-success" id="btnEnviar" name="enviar">
            <i class="fa fa-save"></i> Guardar
        </button>
        <a href="investigador.php" class="btn btn-secondary">
            <i class="fa fa-times"></i> Cancelar
        </a>
    </div>
</form>

<script>
document.getElementById('Fotografia').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const fileError = document.getElementById('fileError');
    const imagePreview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');
    const imageInfo = document.getElementById('imageInfo');
    
    fileError.textContent = 'Por favor seleccione una fotografía válida';
    this.setCustomValidity('');
    imagePreview.style.display = 'none';
    
    if (!file) {
        return;
    }
    
    const maxSize = 5 * 1024 * 1024;
    if (file.size > maxSize) {
        fileError.textContent = 'El archivo excede el tamaño máximo de 5MB';
        this.setCustomValidity('El archivo es demasiado grande');
        this.classList.add('is-invalid');
        return;
    }
    
    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
    if (!allowedTypes.includes(file.type)) {
        fileError.textContent = 'Formato no permitido. Use JPG, PNG, GIF o WEBP';
        this.setCustomValidity('Formato no válido');
        this.classList.add('is-invalid');
        return;
    }
    
    const allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    const fileExtension = file.name.split('.').pop().toLowerCase();
    if (!allowedExtensions.includes(fileExtension)) {
        fileError.textContent = 'Extensión no permitida';
        this.setCustomValidity('Extensión no válida');
        this.classList.add('is-invalid');
        return;
    }
    
    this.classList.remove('is-invalid');
    this.classList.add('is-valid');
    
    const reader = new FileReader();
    reader.onload = function(e) {
        previewImg.src = e.target.result;
        imagePreview.style.display = 'block';
        
        const sizeInMB = (file.size / (1024 * 1024)).toFixed(2);
        imageInfo.textContent = `Archivo: ${file.name} | Tamaño: ${sizeInMB} MB | Tipo: ${file.type}`;
    };
    reader.readAsDataURL(file);
    
    const img = new Image();
    img.onload = function() {
        const minWidth = 200;
        const minHeight = 200;
        
        if (this.width < minWidth || this.height < minHeight) {
            fileError.textContent = `La imagen es muy pequeña. Dimensiones mínimas: ${minWidth}x${minHeight}px`;
            document.getElementById('Fotografia').setCustomValidity('Imagen muy pequeña');
            document.getElementById('Fotografia').classList.add('is-invalid');
            imageInfo.textContent += ` | Dimensiones: ${this.width}x${this.height}px (demasiado pequeña)`;
        } else {
            imageInfo.textContent += ` | Dimensiones: ${this.width}x${this.height}px`;
        }
    };
    img.src = URL.createObjectURL(file);
});

document.getElementById('Semblanza').addEventListener('input', function() {
    const charCount = this.value.length;
    document.getElementById('charCount').textContent = charCount;
    
    if (charCount < 50) {
        this.classList.add('is-invalid');
        this.classList.remove('is-valid');
    } else {
        this.classList.remove('is-invalid');
        this.classList.add('is-valid');
    }
});

document.getElementById('formInvestigador').addEventListener('submit', function(e) {
    if (!this.checkValidity()) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    this.classList.add('was-validated');
    
    if (this.checkValidity()) {
        document.getElementById('btnEnviar').disabled = true;
        document.getElementById('btnEnviar').innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...';
    }
});

document.querySelectorAll('input[required], select[required], textarea[required]').forEach(function(field) {
    field.addEventListener('blur', function() {
        if (this.checkValidity()) {
            this.classList.remove('is-invalid');
            this.classList.add('is-valid');
        } else {
            this.classList.add('is-invalid');
            this.classList.remove('is-valid');
        }
    });
});
</script>

<style>
.was-validated .form-control:valid,
.was-validated .form-select:valid {
    border-color: #28a745;
}

.was-validated .form-control:invalid,
.was-validated .form-select:invalid {
    border-color: #dc3545;
}

#imagePreview {
    padding: 15px;
    background-color: #f8f9fa;
    border-radius: 8px;
}

.spinner-border-sm {
    width: 1rem;
    height: 1rem;
    border-width: 0.15em;
}
</style>