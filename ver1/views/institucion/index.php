<h1>Instituciones</h1>
    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nombre de la institución</th>
    </tr>
  </thead>
  <tbody>
<?php
    foreach ($instituciones as $institucion) :
    echo "<tr>";
      echo "<th scope=\"row\">" . $institucion['id_institucion'] . "</th>";
      echo "<td>" . $institucion['institucion'] . "</td>";
    echo "</tr>";
    endforeach;
?>
    </tbody>
    </table>