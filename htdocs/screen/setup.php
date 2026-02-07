<!DOCTYPE html>
<html>
    <head>
      <meta charset=utf-8 />
      <title>Configuración inicial.</title>
    </head>
    <body>
<?php
include_once('config.php');
$sql = "SELECT * FROM config";
while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
  $$row['opcion'] = $row['valor'];
}
if ($configured == 'true') {
  echo ("Sistema iniciado.<br>\nNo se requiere acción.");
}
else {
?>
  <form>
    <input type="text" label="URL" />
  </form>
<?php
}
?>
  </body>
</html>
