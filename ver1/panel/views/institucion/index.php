<h1>Instituciones</h1>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Logotipo</th>
            <th scope="col">Institución</th>
            <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($data as $institucion):?>
        <tr>
            <th scope="row"><?php echo $institucion['id_institucion'] ?></th>
            <td><?php echo $institucion['logotipo'] ?></td>
            <td><?php echo $institucion['institucion'] ?></td>
            <td>@mdo</td>
        </tr>
        <?php endforeach?>
    </tbody>
</table>