<?php

require_once 'app/Core/Core.php';
require_once 'lib/Database/Connection.php';

require_once 'app/Controller/HomeController.php';
require_once 'app/Controller/ErrorController.php';
require_once 'app/Controller/EmpresaController.php';
require_once 'app/Controller/ParticipanteController.php';

require_once 'app/Model/Empresa.php';
require_once 'app/Model/Participante.php';

require_once 'vendor/autoload.php';

$template = file_get_contents('app/Template/struct.html');

ob_start();
    $core = new Core;
    $core->start($_GET);

    $exit = ob_get_contents();
ob_end_clean();

$tplReady = str_replace('{{dynamic_area}}', $exit, $template);

echo $tplReady;