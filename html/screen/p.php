<?php
// Incluye la configuración desde config.php
include_once('config.php');
?>

<script>
    // Pasar variables PHP a JavaScript
    // El objeto config contiene valores de configuración para uso en JS
    const config = {
        INTERVALO: <?php echo $config['INTERVALO'] ?? 0; ?>, // Intervalo de actualización en milisegundos
        TEXTO: "<?php echo $config['TEXTO'] ?? ''; ?>", // Texto para mostrar en la pantalla
        TOKEN: "<?php echo $_GET['token'] ?? 'fa3b2c9c-a96d-48a8-82ad-0cb775dd3e5d';?>" // Token de autenticación
    };
</script>
<!DOCTYPE html>
<html>
    <head>
        <meta charset=utf-8 />
        <title>Pantalla #01</title>
        <!--
        <link rel="stylesheet" type="text/css" media="screen" href="css/layers.min.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/responsive.css" />
        -->
        <!-- Hoja de estilos principal -->
        <link rel="stylesheet" type="text/css" media="screen" href="css/style.css.php" />
    </head>
    <body>
        <!-- Audio de alarma, se reproduce cuando hay cambios -->
        <audio id="alarmBeep" muted>
            <source src="<?php echo $config['AUDIOS'][$config['AUDIO']] ?>" />
            <p>Your browser doesn't support Audio.</p>
        </audio>
        <!-- Panel de información de pantalla -->
        <div class="absolute00">
            <div id="screendata"></div> <!-- Muestra resolución de pantalla -->
            <div id="framedelay"></div> <!-- Muestra frames caídos del video -->
        </div>
        <!-- Panel de turnos -->
        <div id="turnos" class="panel datos column full medium-half fix">
            <table class="plain squeeze">
                <!-- 
                <thead>
                    <tr>
                        <th class="middle center">Turno</th>
                        <th class="middle center">Posición</th>
                    </tr>
                </thead>
                -->
                <tbody>
                    <!-- Turnos will be populated here by JavaScript -->
                </tbody>
            </table>
        </div>
        <!-- Panel secundario con video y datos -->
        <div id="turnos2" class="panel publi column full medium-half medium-last">
            <div class="encabezado">
                <div class="logo"><img src="img/clinick.svg"></img></div>
                <div class="fechahora">
                    <div class="hora" id="hora"></div> <!-- Hora actual -->
                    <div class="fecha" id="fecha"></div> <!-- Fecha actual -->
                </div>
            </div>
            <div id="contenido" class="contenido">
                <div class="entry-page-course-thumbnail">
                    <!-- Video principal -->
                    <video id="video" autoplay muted loop class="imgpost" decoding="async">
                        <source src="video/doghealth.mp4" type="video/mp4">
                        <!--<source src="video/6478032.mp4" type="video/mp4">-->
                        Your browser does not support the video tag.
                    </video><!--
                    <img src="img/vlcsnap-2025-05-19-17h07m29s364.png" class="imgpost" decoding="async" alt="Curso de peluquería canina – Técnico de estilismo canino y felino">
                    -->
                </div>
                <!--
                <header class="entry-header">
                    <h3>Curso de peluquería canina – Técnico de estilismo canino y felino</h3>            
                </header>
                <?php if ($config['SIZE'] != 'small') { ?>
                <div class="entry-post">
                    <p>
                        Con este curso de peluquería canina y felina adquirirás todos los conocimientos necesarios para convertirte en profesional del sector.            
                    </p>
                </div>
                <?php } ?>
                -->
            </div>
            <div class="pie">
                <!-- Marquee con texto configurable -->
                <marquee>
                    <?php echo $config['TEXTO'] ?? ''; ?>
                </marquee>
            </div> 
        </div>

        <script>
            // Función para obtener y mostrar los turnos y la hora/fecha
            function getTurnos() {
                document.getElementById('screendata').innerHTML = window.innerWidth + 'x' + window.innerHeight;
                fetch('/screen/turnos?token='+config.TOKEN)
                    .then(response => response.json())
                    .then(data => {
                        const tbody = document.querySelector('#turnos tbody');
                        tbody.innerHTML = ''; // Limpiar filas existentes
                        data.forEach(turno => {
                            const row = document.createElement('tr');
                            if (turno.actualizado > 0) {
                                row.classList.add('actualizado');
                                if (!zumbidos.includes(turno.modificado)) {
                                    zumbidos.push(turno.modificado);
                                    // Reproducir alarma solo si el turno fue modificado
                                    playAlarm();
                                    console.log(`Alarm played for usercode: ${turno.usercode}`); // Debug
                                }
                            } else {
                                row.classList.remove('actualizado');    
                            }
                            row.innerHTML = `<td class="middle center">${turno.usercode}</td><td class="middle center">${turno.posicion}</td>`;
                            tbody.appendChild(row);
                        });
                    })
                    .catch(error => console.error('Error fetching turnos:', error));
                // Actualizar hora
                fetch('/screen/hora?token='+config.TOKEN)
                    .then(response => response.json())
                    .then(data => {
                        const hora = document.getElementById('hora');
                        hora.innerHTML = data;
                    })
                    .catch(error => console.error('Error fetching hora:', error));
                // Actualizar fecha
                fetch('/screen/fecha?token='+config.TOKEN)
                    .then(response => response.json())
                    .then(data => {
                        const fecha = document.getElementById('fecha');
                        fecha.innerHTML = data;
                    })
                    .catch(error => console.error('Error fetching fecha:', error));
            }
            // Reproduce el sonido de alarma
            function playAlarm() {
                const alarmBeep = document.getElementById('alarmBeep');
                alarmBeep.currentTime = 0; // Reinicia audio
                alarmBeep.muted = false; // Desmutea
                alarmBeep.play();
                waitForAudioToFinish(alarmBeep);
            }
            // Espera a que termine el audio y lo mutea
            function waitForAudioToFinish(audio) {
                audio.addEventListener('ended', () => {
                    setTimeout(() => {
                    }, 1000); // Espera antes de mutear
                    audio.muted = true; // Mutea el audio
                });
            }
            // Al cambiar el tamaño de la ventana, actualiza la resolución y baja la calidad del video
            window.addEventListener('resize', function() {
                document.getElementById('screendata').innerHTML = window.innerWidth + 'x' + window.innerHeight;
                document.getElementById('video').firstElementChild.src = 'video/doghealth480p.mp4'; // Change video source to lower quality
                document.getElementById('video').load(); // Reload the video element
            });
        </script>
    </body>
    <script>
        // Desactiva las barras de scroll
        window.scrollbars = "no";
        // Muestra información de la pantalla en consola
        console.log("Screen Width: " + screen.width);
        console.log("Screen Height: " + screen.height);
        console.log("Window Width: " + window.innerWidth);
        console.log("Window Height: " + window.innerHeight);
        console.log("Available Screen Width: " + screen.availWidth);
        console.log("Available Screen Height: " + screen.availHeight);
        // Variables y temporizadores
        var zumbidos = []; // Array para controlar turnos modificados
        setInterval(getTurnos, config.INTERVALO); // Actualiza turnos cada INTERVALO ms
        setInterval(() => {
            // Control de calidad de video
            droppedFrames = document.getElementById('video').getVideoPlaybackQuality().droppedVideoFrames;
            if (droppedFrames > 200) {
                droppedFrames = 0; // Reinicia contador
                bajarCalidad = true; // Bandera para bajar calidad
                document.getElementById('video').firstElementChild.src = 'video/doghealth180p.mp4'; // Cambia a calidad muy baja
                document.getElementById('video').load(); // Recarga el video
                console.warn(`Dropped frames detected: ${droppedFrames}`); // Debug
            }
            document.getElementById('framedelay').innerHTML = document.getElementById('video').getVideoPlaybackQuality().droppedVideoFrames + ' ' + document.getElementById('video').src;
        }, 10);
        console.log(document.getElementById('video').firstElementChild); 
        //console.log(config.INTERVALO); // Debugging line to check interval value
        //setInterval(playAlarm, 100000); // Play alarm every 10 seconds
        getTurnos(); // Initial fetch
    </script>
</html>