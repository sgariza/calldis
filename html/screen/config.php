<?php
$config = [
    'INTERVALO' => 15000, // Intervalo en milisegundos para la actualización de datos
    'TEXTO' => 'Clinick - Tu clínica veterinaria de confianza', // Texto a mostrar en el
    'ORIENTACIONES' => [
        'vertical' => [ // Orientación vertical
            'small' => [
                'fontSize' => '5vw', // Tamaño de fuente para pantallas pequeñas
                'fontSizeTable' => '7vw', // Tamaño de fuente para tablas pequeñas
                'trHeight' => '8vh', // Altura de las filas de la tabla pequeñas
                'panelPadding' => '4vh', // Relleno del panel pequeñas
                'nFilas' => 6, // Número de filas para pantallas pequeñas
                'panelDatosWidth' => '100vw', // Ancho del panel de datos
                'panelPubliWidth' => '100vw', // Ancho del panel de publicidad
                'encabezadoHeight' => '12vh', // Altura del encabezado
                'pieHeight' => '4vh', // Altura del pie
            ],
            'medium' => [
                'fontSize' => '4vw', // Tamaño de fuente para pantallas medianas
                'fontSizeTable' => '5vw', // Tamaño de fuente para tablas medianas
                'trHeight' => '6vh', // Altura de las filas de la tabla medianas
                'panelPadding' => '3vh', // Relleno del panel medianas
                'nFilas' => 8, // Número de filas para pantallas medianas
                'panelDatosWidth' => '100vw', // Ancho del panel de datos
                'panelPubliWidth' => '100vw', // Ancho del panel de publicidad
                'encabezadoHeight' => '10vh', // Altura del encabezado
                'pieHeight' => '4vh', // Altura del pie
            ],
            'large' => [
                'fontSize' => '3vw', // Tamaño de fuente para pantallas grandes
                'fontSizeTable' => '4vw', // Tamaño de fuente para tablas grandes
                'trHeight' => '4.7vh', // Altura de las filas de la tabla grandes
                'panelPadding' => '2vh', // Relleno del panel grandes
                'nFilas' => 10, // Número de filas para pantallas grandes
                'panelDatosWidth' => '100vw', // Ancho del panel de datos
                'panelPubliWidth' => '100vw', // Ancho del panel de publicidad
                'encabezadoHeight' => '12vh', // Altura del encabezado
                'pieHeight' => '4vh', // Altura del pie
            ],
            'panelHeight' => '50vh', // Altura del panel
            'panelWidth' => '100vw', // Ancho del panel
            
            
            'fechahoraWidth' => '50vw', // Ancho del espacio para la fecha y la hora
            
            'imgWidth' => '90vw', // Ancho de la imagen
            'imgmaxWidth' => '90vw', // Ancho máximo de la imagen
            'imgHeight' => 'auto', // Altura de la imagen
            'imgmaxHeight' => '45vh', // Altura máxima de la imagen
        ],
        'horizontal' => [ // Orientación horizontal
            'small' => [
                'fontSize' => '5vh', // Tamaño de fuente para pantallas pequeñas
                'fontSizeTable' => '7.1vh', // Tamaño de fuente para tablas pequeñas
                'trHeight' => '16vh', // Altura de las filas de la tabla pequeñas
                'panelPadding' => '4vw', // Relleno del panel pequeñas
                'nFilas' => 6, // Número de filas para pantallas pequeñas
                'panelDatosWidth' => '35vw', // Ancho del panel de datos
                'panelPubliWidth' => '65vw', // Ancho del panel de publicidad
                'encabezadoHeight' => '26vh', // Altura del encabezado
                'pieHeight' => '8vh', // Altura del pie
            ],
            'medium' => [
                'fontSize' => '4vh', // Tamaño de fuente para pantallas medianas
                'fontSizeTable' => '5.5vh', // Tamaño de fuente para tablas medianas
                'trHeight' => '12vh', // Altura de las filas de la tabla medianas
                'panelPadding' => '3vw', // Relleno del panel medianas
                'nFilas' => 8, // Número de filas para pantallas medianas
                'panelDatosWidth' => '30vw', // Ancho del panel de datos
                'panelPubliWidth' => '70vw', // Ancho del panel de publicidad
                'encabezadoHeight' => '20vh', // Altura del encabezado
                'pieHeight' => '8vh', // Altura del pie
            ],
            'large' => [
                'fontSize' => '3vh', // Tamaño de fuente para pantallas grandes
                'fontSizeTable' => '5vh', // Tamaño de fuente para tablas grandes
                'trHeight' => '9.7vh', // Altura de las filas de la tabla grandes
                'panelPadding' => '2vw', // Relleno del panel grandes
                'nFilas' => 10, // Número de filas para pantallas grandes
                'panelDatosWidth' => '28vw', // Ancho del panel de datos
                'panelPubliWidth' => '72vw', // Ancho del panel de publicidad
                'encabezadoHeight' => '20vh', // Altura del encabezado
                'pieHeight' => '6vh', // Altura del pie
            ],
            'panelHeight' => '100vh', // Altura del panel
            'panelWidth' => '50vw', // Ancho del panel

            
            'fechahoraWidth' => '25vw', // Ancho del espacio para la fecha y la hora
            
            'imgWidth' => 'auto', // Ancho de la imagen
            'imgmaxWidth' => '45vw', // Ancho máximo de la imagen
            'imgHeight' => '90vh', // Altura de la imagen
            'imgmaxHeight' => '90vh', // Altura máxima de la imagen
        ]
    ],
    'ORIENTACION' => 'horizontal', // Orientación por defecto
    'SIZE' => 'medium', // Tamaño de pantalla por defecto
    'AUDIOS' =>  [
        'beep-1' => 'audio/beep-1.mp3',
        'beep-2' => 'audio/beep-2.mp3',
        'beep-3' => 'audio/beep-3.mp3',
        'beep-4' => 'audio/beep-4.mp3',
        'beep-5' => 'audio/beep-5.mp3',
    ],
    'AUDIO' => 'beep-1', // Nombre del audio a reproducir por defecto,
    'color1' => '#005a9f', // Color principal
    'color2' => '#e9e9e9', // Color secundario
    'color3' => '#f1f1f1', // Color de fondo
    'color4' => '#2476b4',
    'color5' => '#0003', // Color de borde de texto
    'trHeight' => '6vh', // Altura de las filas de la tabla
    'panelWidth' => '100vw', // Ancho del panel
    'panelPadding' => '3vh', // Relleno del panel
    'imgWidth' => '35vh', // Ancho de la imagen
    'colorText' => '#eee', // Color del texto
    'colorAlert' => '#D40000', // Color de alerta
];
//echo ($_FILES[]);
$db = new SQLite3('/var/www/html/screen/db.db');
$res=$db->query("SELECT * FROM opciones");
while ($row = $res->fetchArray(SQLITE3_ASSOC)) {
    if ($row['valor'] != ""){
        $config[$row['opcion']] = $row['valor'];
        //echo($row['opcion'] . "\n");
    }
}
?>
