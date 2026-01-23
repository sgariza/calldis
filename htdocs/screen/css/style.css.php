<?php
include_once('../config.php');
$color1 = $config['color1'] ?? '#005a9f';
$color2 = $config['color2'] ?? '#e9e9e9';
$color3 = $config['color3'] ?? '#f1f1f1';
$color4 = $config['color4'] ?? '#015ba0';
$color5 = $config['color5'] ?? '#003377';
$orientacion = $config['ORIENTACION'] ?? 'horizontal';
$size = $config['SIZE'] ?? 'medium';
$colorText = $config['colorText'] ?? '#111';
$colorAlert = $config['colorAlert'] ?? '#FF0000';
$trHeight = $config['trHeight'] ?? '6vh';
$panelHeight = $config['panelHeight'] ?? '50vh';
$panelWidth = $config['panelWidth'] ?? '100vw';
$panelPadding = $config['panelPadding'] ?? '3vh';
$imgWidth = $config['imgWidth'] ?? '100vw';
$imgmaxWidth = $config['imgmaxWidth'] ?? '100vw';
$imgHeight = $config['imgHeight'] ?? 'auto';
$imgmaxHeight = $config['imgmaxHeight'] ?? '50vh';
$fontSizeTable = $config['fontSizeTable'] ?? '6vw';
?>

:root {
    --color1: <?php echo $color1; ?>;
    --color2: <?php echo $color2; ?>;
    --color3: <?php echo $color3; ?>;
    --color4: <?php echo $color4; ?>;
    --color5: <?php echo $color5; ?>;
    --color-text: <?php echo $colorText; ?>;
    --color-alert: <?php echo $colorAlert; ?>;
    --font-size-p:      <?php echo $config['ORIENTACIONES']['vertical']['small']['fontSize']; ?>;
    --font-size-m:      <?php echo $config['ORIENTACIONES']['vertical']['medium']['fontSize']; ?>;
    --font-size-g:      <?php echo $config['ORIENTACIONES']['vertical']['large']['fontSize']; ?>;
    --table-font-size:  <?php echo $config['ORIENTACIONES']['vertical'][$size]['fontSizeTable']; ?>;
    --tr-height:        <?php echo $config['ORIENTACIONES']['vertical'][$size]['trHeight']; ?>;
    --panel-height:     <?php echo $config['ORIENTACIONES']['vertical']['panelHeight']; ?>;
    --panel-datos-width:<?php echo $config['ORIENTACIONES']['vertical']['panelWidth']; ?>;
    --panel-publi-width:<?php echo $config['ORIENTACIONES']['vertical']['panelWidth']; ?>;
    --encabezado-height:<?php echo $config['ORIENTACIONES']['vertical'][$size]['encabezadoHeight']; ?>;
    --fechahora-width:  <?php echo $config['ORIENTACIONES']['vertical']['fechahoraWidth']; ?>;
    --pie-height:       <?php echo $config['ORIENTACIONES']['vertical'][$size]['pieHeight']; ?>;
    --panel-padding:    <?php echo $config['ORIENTACIONES']['vertical'][$size]['panelPadding']; ?>;
    --img-width:        <?php echo $config['ORIENTACIONES']['vertical']['imgWidth']; ?>;
    --font-size:        <?php echo $config['ORIENTACIONES']['vertical'][$size]['fontSize']; ?>;
    --imgmax-width:     <?php echo $config['ORIENTACIONES']['vertical']['imgmaxWidth']; ?>;
    --img-height:       <?php echo $config['ORIENTACIONES']['vertical']['imgHeight']; ?>;
    --imgmax-height:    <?php echo $config['ORIENTACIONES']['vertical']['imgmaxHeight']; ?>;
}

@media only screen and (min-aspect-ratio: 4/5) {
    :root {
        --font-size-p:      <?php echo $config['ORIENTACIONES']['horizontal']['small']['fontSize']; ?>;
        --font-size-m:      <?php echo $config['ORIENTACIONES']['horizontal']['medium']['fontSize']; ?>;
        --font-size-g:      <?php echo $config['ORIENTACIONES']['horizontal']['large']['fontSize']; ?>;
        --table-font-size:  <?php echo $config['ORIENTACIONES']['horizontal'][$size]['fontSizeTable']; ?>;
        --tr-height:        <?php echo $config['ORIENTACIONES']['horizontal'][$size]['trHeight']; ?>;
        --panel-height:     <?php echo $config['ORIENTACIONES']['horizontal']['panelHeight']; ?>;
        --panel-datos-width:<?php echo $config['ORIENTACIONES']['horizontal'][$size]['panelDatosWidth']; ?>;
        --panel-publi-width:<?php echo $config['ORIENTACIONES']['horizontal'][$size]['panelPubliWidth']; ?>;
        --encabezado-height:<?php echo $config['ORIENTACIONES']['horizontal'][$size]['encabezadoHeight']; ?>;
        --fechahora-width:  <?php echo $config['ORIENTACIONES']['horizontal']['fechahoraWidth']; ?>;
        --pie-height:       <?php echo $config['ORIENTACIONES']['horizontal'][$size]['pieHeight']; ?>;
        --panel-padding:    <?php echo $config['ORIENTACIONES']['horizontal'][$size]['panelPadding']; ?>;
        --img-width:        <?php echo $config['ORIENTACIONES']['horizontal']['imgWidth']; ?>;
        --font-size:        <?php echo $config['ORIENTACIONES']['horizontal'][$size]['fontSize']; ?>;
        --imgmax-width:     <?php echo $config['ORIENTACIONES']['horizontal']['imgmaxWidth']; ?>;
        --img-height:       <?php echo $config['ORIENTACIONES']['horizontal']['imgHeight']; ?>;
        --imgmax-height:    <?php echo $config['ORIENTACIONES']['horizontal']['imgmaxHeight']; ?>;
    }
    .column.medium-half {
      width: 48%;
    }
    
    .column[class^="medium-"], .column[class*=" medium-"] {
      clear: none;
      float: left;
      min-height: 1px;
      margin-left: 0;
      margin-right: 1px;
    }
    .column.medium-last, .column.medium-last[class^="medium-"], .column.medium-last[class*=" medium-"] {
      margin-right: 0;
    }
    .encabezado .logo {
        text-align: center !important;
    }

}
/*
@media only screen and (min-aspect-ratio: 2/1) {
    .column.fix {
      width: 99vh !important;
    }
}
*/

@-moz-keyframes parpadeo{  
    0% { opacity: 1.0; }
    49% { opacity: 1.0; }
    50% { opacity: 0.0; }
    79% { opacity: 0.0; }
    80% { opacity: 1.0; }
}
  
@-webkit-keyframes parpadeo {  
    0% { opacity: 1.0; }
    49% { opacity: 1.0; }
    50% { opacity: 0.0; }
    79% { opacity: 0.0; }
    80% { opacity: 1.0; }
}

@keyframes parpadeo {  
    0% { opacity: 1.0; }
    49% { opacity: 1.0; }
    50% { opacity: 0.0; }
    79% { opacity: 0.0; }
    80% { opacity: 1.0; }
}

body{ 
    background: var(--color1); 
    color: var(--color-text);
    font-family: helvetica, Arial, sans-serif;  
    text-align: center; 
    /*width:  660px*/; 
    margin: 0 auto;
    font-size: var(--font-size);
    overflow: hidden;
}

div {
    outline-width: 0;
    border-width: 1px;
    border-style: solid;
    border-color: transparent;
    background: transparent;
    outline-style: solid;
}
tr:nth-child(1) {
    border-top: none;  
}
/*tr:nth-child(odd) {background: var(--color4)    }
tr:nth-child(even) {background: #FFF}*/
tr {
    height: var(--tr-height);
    border-top: 1px solid var(--color2);
}
h3 {
    color: var(--color1);
    margin: 0px 0px 20px 0px;
}
table {
    font-size: var(--table-font-size);
    font-weight: bold;
    text-shadow: 0.3vh 0 var(--color5), -0.3vh 0 var(--color5), 0 0.3vh var(--color5), 0 -0.3vh var(--color5), 0.2vh 0.2vh var(--color5), -0.2vh -0.2vh var(--color5), 0.2vh -0.2vh var(--color5), -0.2vh 0.2vh var(--color5);
    /*-webkit-text-stroke: 0.3vh var(--color5);*/
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
}

th.middle, td.middle {
  vertical-align: middle;
}
th.center, td.center {
  text-align: center;
}

th, td {
    overflow: hidden;
    text-wrap-mode: nowrap;
}

.column {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}

.panel {
    width: var(--panel-width);
    height: var(--panel-height);
}
.panel.datos {
    width: var(--panel-datos-width);
    margin: 0;
    padding: 2vh 0;
}
.panel.publi {
    width: calc(var(--panel-publi-width));
}
.panel.publi .encabezado {
    height: var(--encabezado-height);
    width: 100%;
    background: var(--color1);
    color: var(--color2);
    padding: 0px 0px 0px 0px;
    margin: 0px 0px 0px 0px;
}
.panel.publi .pie {
    height: var(--pie-height);
    width: 100%;
    background: var(--color1);
    color: var(--color2);
    padding: 0px 0px 0px 0px;
    margin: 0px 0px 0px 0px;
}

.panel.publi .contenido {
    width: 100%;
    height: calc(var(--panel-height) - var(--encabezado-height) - var(--pie-height));
    background: var(--color1);
    color: var(--color2);
    padding: 0px 0px 0px 0px;
    margin: 0px 0px 0px 0px;
}

.encabezado .logo {
    text-align: left;
    float: left;
    width: calc(var(--panel-publi-width) - var(--fechahora-width) - 2vh);
    height: 100%;
    vertical-align: middle;
}
.encabezado .logo img {
    height: calc(var(--encabezado-height) - 4vh);
    margin: 2vh;
}

.fecha {
    font-size: calc(var(--table-font-size) * 0.6);
}

.hora {
    font-size: calc(var(--table-font-size) * 2);
    font-weight: bolder;
    margin: -10px 0px -15px 0px;
}

.fechahora {
    float: left;
    width: var(--fechahora-width);
}

/*
#turnos2 {
    vertical-align: middle;
    display:flex;
    align-items: center;
    padding: 3vw;
}
*/
#turnos2 p {
    text-align: justify;
}

.actualizado {
    color: var(--color-alert);
    font-weight: bold;
    text-shadow: 2px 0 #fff, -2px 0 #fff, 0 2px #fff, 0 -2px #fff, 1px 1px #fff, -1px -1px #fff, 1px -1px #fff, -1px 1px #fff;

    animation-name: parpadeo;
    animation-duration: 1s;
    animation-timing-function: linear;
    animation-iteration-count: infinite;
  
    -webkit-animation-name:parpadeo;
    -webkit-animation-duration: 1s;
    -webkit-animation-timing-function: linear;
    -webkit-animation-iteration-count: infinite;
}

.imgpost {
    /*max-width: var(--imgmax-width);
    max-height: var(--imgmax-height);
    height: var(--img-height);
    width: var(--img-width);*/
    height: 100%;
    width: 100%;
}

.absolute00 {
    /*display: none;*/
    position: absolute;
    top: 0;
    left: 0;
    font-size: 2vh;
    color: #ffffff10;
    text-align: left;
}

#digitalClock{}
            
#clockCanvas{
    margin: 50px 0 20px 0;
}    
        
.button{
    text-decoration: none;
    text-shadow: 0px 0px 2px rgba(255, 255, 255, 0.1);
    color: rgba(0, 0, 0, 0.9);
    background: #111;
    padding: 10px 20px;
    margin: 0px 20px 10px 20px;
    font-weight:bold;
    text-transform: uppercase;
    font-size: 19px;
    width: 150px;
    display:inline-block;            
    -webkit-box-shadow:  0px 0px 10px rgba(255, 255, 255, 0.1); 
    -moz-box-shadow:  0px 0px 10px rgba(0, 0, 0, 1); 
    box-shadow:  0px 0px 10px rgba(0, 0, 0, 1); 
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;   
    -webkit-transition: all .3s ease-in-out;
    -moz-transition: all .3s ease-in-out;
}
        
.button:hover, .activated{
    color: rgba(0, 0, 0, 0.9);
    background: #FF0000;
    -webkit-box-shadow:  0px 0px 10px rgba(255, 0, 0, 0.8); 
    -moz-box-shadow: 0px 0px 10px rgba(255, 0, 0, 0.8); 
    box-shadow:  0px 0px 10px rgba(255, 0, 0, 0.8); 
}
