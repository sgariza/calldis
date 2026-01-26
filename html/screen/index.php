<?php
error_reporting(E_ERROR);
setlocale(LC_TIME, 'es_ES');
date_default_timezone_set('Europe/Madrid');

$BASE_URI = "/screen/";

$endpoints = array();
$requestData = array();
//print_r($_SERVER);
$parsedURI = parse_url($_SERVER["REQUEST_URI"]);
$endpointName = str_replace($BASE_URI, "", $parsedURI["path"]);

if (empty($endpointName)) {
    $endpointName = "/";
}

//definimos el encoding de la respuesta, por defecto usaremos json
header("Content-Type: application/json; charset=UTF-8");


//capturar parámetros recibidos
switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $requestData = $_POST;
        // Si se recibe un token, lo agregamos a requestData
        if (isset($_GET['token'])) {
            $requestData['token'] = $_GET['token'];
        }
        break;
    case 'GET':
        $requestData = $_GET;
        break;
    case 'DELETE':
        $requestData = $_DELETE;
        break;
    case 'PUT':
    case 'PATCH':
        parse_str(file_get_contents('php://input'), $requestData);
        //si la información recibida no puede interpretarse como arreglo se ignora.
        if (!is_array($requestData)) {
            $requestData = array();
        }
        break;
    default:
        //TODO: implementa aquí cualquier otro tipo de request method que pueda presentarse.
        break;
}

//Si el token es enviado en un header X-API-KEY
if (isset($_SERVER["HTTP_X_API_KEY"])) {
    $requestData["token"] = $_SERVER["HTTP_X_API_KEY"];
}


// closures para definir la lógica de cada endpoint, 
// lo sé, esto se puede mejorar con un esquema OOP pero es un ejemplo básico, 
// no hagan esto en casa!, bueno o si quieren háganlo, no se sientan juzgados.

/**
 * imprime un mensaje por defecto si se consulta la ruta base de la API.
 * @param   array  $requestData contiene los parámetros enviados en la solicitud, para este endpoint son ignorados.
 * @return  void
 */
$endpoints["/"] = function (array $requestData): void {

    echo json_encode("Bienvenido a mi API!");
};

/**
 * imprime un mensaje de saludo con el nombre indicado en el item $requestData["name"]
 * si la variable está vacía se usa un nombre por defecto.
 * @param   array  $requestData este arreglo debe contener un item con llave "name" si quieres mostrar
 *                  un nombre personalizado en el saludo.
 * @return  void
 */
$endpoints["sayhello"] = function (array $requestData): void {

    if (!isset($requestData["name"])) {
        $requestData["name"] = "Misterioso enmascarado";
    }

    echo json_encode("hello! " . $requestData["name"]);
};

/**
 * imprime un mensaje por defecto si la ruta del endpoint no existe.
 * @param   array  $requestData contiene los parámetros enviados en la solicitud, para este endpoint son ignorados.
 * @return  void
 */
$endpoints["404"] = function ($requestData): void {

    echo json_encode("El endpoint " . $requestData["endpointName"] . " no fue encontrado.");
};


/**
 * verifica si el token es válido, e impide la ejecución del endpoint solicitado.
 * @param   array  $requestData contiene los parámetros enviados en la solicitud, para este endpoint se requiere un item con llave "token" que
 *                  contenga el token recibido para autenticar y autorizar la petición.
 * @return  void
 */
$endpoints["checktoken"] = function ($requestData): void {

    //puedes crear tokens seguros con esta línea, pero esa es una discusión para otra publicación.
    //$token = str_replace("=", "", base64_encode(random_bytes(160 / 8)));

    //tokens autorizados
    $tokens = array(
        "fa3b2c9c-a96d-48a8-82ad-0cb775dd3e5d" => "",
        "3ad1259c-0e6d-928c-a9d1-302b7b5d3321" => "",
        "d4c9f8e1-5f4b-4a3e-9f2e-1c2b3a4d5e6f" => ""
    );

    if (!isset($requestData["token"])) {
        echo json_encode("No se recibió un token para autorizar la operación. Verifica la información enviada");
        exit;
    }

    if (!isset($tokens[$requestData["token"]])) {
        echo json_encode("El token  " . $requestData["token"] . " no existe o no se encuentra autorizado para realizar esta operación.");
    }
};

/**
 * Maneja la pantalla
 * @param int $p pantalla
 * @return void
 */
$endpoints['pantalla'] = function ($requestData): void {
    //
    if (!isset($requestData["p"])) {
        echo json_encode("No se especificó pantalla");
        exit;
    }
    else {
        include_once ('01.php');
        exit;
    }
};

/**
 * Devuelve los turnos
 * @param int $p pantalla
 * @return void
 */
$endpoints['turnos'] = function ($requestData): void {
    //
    include_once('config.php');
    $mysqli = new mysqli("172.17.0.3", "root", "5er610", "turninline");
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT id, usercode, posicion, vivo, modificado, IF((NOW()-modificado)<90,true,false) AS actualizado FROM turno WHERE vivo = true AND (NOW()-modificado) < (3600 * 24) ORDER BY modificado DESC LIMIT 0," . $config['ORIENTACIONES'][$config['ORIENTACION']][$config['SIZE']]['nFilas'];
    $result = $mysqli->query($sql);
    echo(json_encode($mysqli->query($sql)->fetch_all(MYSQLI_ASSOC)));
    $mysqli->close();
};

/**
 * Devuelve la fecha y hora
 * @return void
 */
$endpoints['fechahora'] = function ($requestData): void {
    echo(json_encode(strftime("%A %d de %B   %H:%M", strtotime("now"))));
};

/**
 * Devuelve la fecha
 * @return void
 */
$endpoints['fecha'] = function ($requestData): void {
    //echo(json_encode(".".strftime("%d de %B", time())));
    $dateTimeObj = new DateTime('now', new DateTimeZone('Europe/Madrid'));
    $dateFormatted = 
    IntlDateFormatter::formatObject(
    $dateTimeObj, 
    "eeee dd MMMM yyyy", 
    "es_ES" 
    );
    echo(json_encode(value: strtolower(ucwords($dateFormatted))));
};

/**
 * Devuelve la hora
 * @return void
 */
$endpoints['hora'] = function ($requestData): void {
    //echo(json_encode(strftime("%H:%M", strtotime("now"))));
    $dateTimeObj = new DateTime('now');
    $dateFormatted = 
    IntlDateFormatter::formatObject(
    $dateTimeObj, 
    "hh:mm", 
    "es_ES" 
    );
    echo(json_encode(value: $dateFormatted));
};

/**
 * Maneja un trigger genérico
 * @return void
 */
$endpoints['trigger'] = function ($requestData): void {
    $error = "";
    include_once('config.php');
    $mysqli = new mysqli("172.17.0.3", "root", "5er610", "turninline");
    if ($mysqli->connect_errno) {
        echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT access_token FROM token LIMIT 1";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    $api_token = $row['access_token'];
    //$mysqli->close();
    if (!check_access_token($api_token)) {
        $error.= "El token de acceso no es válido o ha expirado.";
        $api_token = get_access_token();
        if ($api_token) {
            $sql = "UPDATE token SET access_token = '" . $api_token . "'";
            if (!$mysqli->query($sql)) {
                $error.= "Error al actualizar el token en la base de datos: (" . $mysqli->errno . ") " . $mysqli->error;
            }
        } else {
            $error.= "No se pudo obtener un nuevo token de acceso.";
        }
    }

    $data = get_data('https://awstest.provetcloud.com/8424/api/0.1/consultation/' . $requestData['consultation_id'] . '/', $api_token);

    // Verificar si la decodificación fue exitosa y la API devolvió datos
    if (json_last_error() != JSON_ERROR_NONE || empty($data)) {
        $error.= "Error al obtener los datos de la API.";
        //exit;
    }

    $patient = "";
    $id_patient = 0;

    if ($data['patients'] != null) {
        $patient = strtoupper(get_data($data['patients'][0], $api_token)['name']);
        $id_patient = get_data($data['patients'][0], $api_token)['id'];
    }
    $code_patient = substr($patient, 0, 2) . str_pad($id_patient, 3, "0", STR_PAD_LEFT);

    $ward = "";
    if ($data['ward'] != null) {
        $ward = get_data($data['ward'], $api_token)['name'];
    }
    /*$ward = "";
    if ($data['ward'] != null) {
        $ward = get_data($data['ward'], $api_token)['name'];
    }*/
    $veterinario = "";
    if ($data['supervising_veterinarian'] != null) {
        $veterinario = get_data($data['supervising_veterinarian'], $api_token)['id'];
    }

    $sql = "SELECT id FROM turno WHERE idprovet = " . $requestData['consultation_id'] . " LIMIT 1";
    $result = $mysqli->query($sql);
    $status = $data['status'] == '8' ? 'true' : 'false';
    if ($result->num_rows < 1) {
        $sql = " INSERT INTO turno (id, idprovet, usercode, posicion, veterinario, vivo, modificado) VALUES (cast(rand() * power(10,17) as UNSIGNED)," . $requestData['consultation_id'] . ",'" . $code_patient . "', '" . $ward . "', '" . $veterinario . "', " . $status . ", NOW())";
        file_put_contents('insert.sql', $sql . "\n", FILE_APPEND);
        if (!$mysqli->query($sql)) {
            $error .= "Error al insertar el turno: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        $mysqli->close();
    }
    else {
        $sql = " UPDATE turno SET posicion = '" . $ward . "', veterinario = '" . $veterinario . "', vivo = " . $status . ", modificado = NOW() WHERE idprovet = " . $requestData['consultation_id'];
        if (!$mysqli->query($sql)) {
            $error .= "Error al actualizar el turno: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        $mysqli->close();
    }


    // Define el nombre del archivo donde se guardarán los datos.
    $archivo = 'get_data.txt';

    // Usa var_export para obtener una representación del array $_POST como una cadena de código PHP.
    // Alternativamente, puedes usar print_r(true) para una representación más legible pero menos formal.
    $contenido = "Datos recibidos por POST:\n$code_patient-$ward\n\n$error\n\n";

    // Escribe el contenido en el archivo.
    // El segundo parámetro, FILE_APPEND, añade el contenido al final del archivo en lugar de sobrescribirlo.
    // Puedes eliminarlo si quieres sobrescribir el archivo en cada ejecución.
    var_dump(file_put_contents($archivo, $contenido . "\n\n", FILE_APPEND));

    echo $contenido . "\nDatos de \$_POST guardados en '{$archivo}' con éxito.";

};

/**
 * Actualiza la pantalla con los datos recibidos.
 * @param array $requestData contiene los parámetros enviados en la solicitud, para este endpoint se requiere un item con llave "token" que
 *                  contenga el token recibido para autenticar y autorizar la petición.
 * @param string $requestData['endpointName'] nombre del endpoint a ejecutar.
 * @return void
 */
$endpoints['update'] = function ($requestData): void {
    echo(json_encode($_POST));
};


if (isset($endpoints[$endpointName])) {
    // Validación del token recibido.
    $endpoints["checktoken"]($requestData);
    // Ejecución del endpoint solicitado.
    $endpoints[$endpointName]($requestData);
} else {
    $endpoints["404"](array("endpointName" => $endpointName));
}

function get_access_token() {
    // Reemplaza 'TU_CLIENT_ID' y 'TU_CLIENT_SECRET' con tus credenciales reales
    $client_id = 'mqqbxGo67pLRwefdXMbFuZ7Vcqt3ZkVlqwQsQUpm';
    $client_secret = 'KyglgUXgk7O96ApXblQ7wnRVzvfQpmV7H2jcyqzTvp0K72Nv9q4WBrM4l0InzK4cd8BuZWKAEYTLCDXceNo1xTTuEXUPWzkeydqSQXtaymjjQql7SxvEn29ejfiW2Bt2';
    $token_url = 'https://awstest.provetcloud.com/8424/oauth2/token/';
    $data = array(
        'grant_type' => 'client_credentials',
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'scope' => 'restapi',
        'response_type' => 'code'
    );
    $options = array(
        'http' => array(
            'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ),
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($token_url, false, $context);
    if ($result === FALSE) {
        die('Error al obtener el token de acceso');
    }
    $response = json_decode($result, true);
    return $response['access_token'];
}

function check_access_token($token) {
    $url = 'https://awstest.provetcloud.com/8424/api/0.1/department/';
    $options = array(
        'http' => array(
            'header'  => "Authorization: Bearer " . $token . "\r\n",
            'method'  => 'GET',
        ),
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) {
        return false;
    }
    else {
        return true;
    }
}

function get_data($url, $token) {
    $options = array(
        'http' => array(
            'header'  => "Authorization: Bearer " . $token . "\r\n",
            'method'  => 'GET',
        ),
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    if ($result === FALSE) {
        return false;
    }
    else {
        $data = json_decode($result, true);
        return $data;
    }
}

function get_token() {
    $options = array(
        'http' => array(
            'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query(array(
                'grant_type' => 'client_credentials',
                'client_id' => 'mqqbxGo67pLRwefdXMbFuZ7Vcqt3ZkVlqwQsQUpm',
                'client_secret' => 'KyglgUXgk7O96ApXblQ7wnRVzvfQpmV7H2jcyqzTvp0K72Nv9q4WBrM4l0InzK4cd8BuZWKAEYTLCDXceNo1xTTuEXUPWzkeydqSQXtaymjjQql7SxvEn29ejfiW2Bt2',
                'scope' => 'restapi',
                'response_type' => 'code'
            )),
        ),
    );
    $context  = stream_context_create($options);
    $result = file_get_contents('https://awstest.provetcloud.com/8424/oauth2/token/', false, $context);
    if ($result === FALSE) {
        die('Error al obtener el token de acceso');
    }
    $response = json_decode($result, true);
    return $response['access_token'];
}


/*
echo ("<h1>$endpointName</h1>");
print_r($parsedURI);*/
