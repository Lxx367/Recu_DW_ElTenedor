<?php

require_once(dirname(__FILE__) . '/../../persistance/conf/PersistentManager.php');
require_once(dirname(__FILE__) . '/../models/Reserva.php');
require_once(dirname(__FILE__) . '/../../persistance/DAO/ReservaDAO.php');

$_reservaController = new ReservaController;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["fecha"]) && isset($_POST["hora"]) && isset($_POST["comensales"])) {

    $_reservaController->create();
}

class ReservaController {

    public function create() {
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $comensales = $_POST['comensales'];
        $ip = $_SERVER['REMOTE_ADDR']; 
        $fechaActual = date('Y-m-d');
        $horasValidas = ['14:00', '21:00'];

        if ($fecha <= $fechaActual) {
            header('Location: ../views/public/reserva.php?error=fechaInvalida');
            exit();
        }

        if (!in_array($hora, $horasValidas)) {
            header('Location: ../views/public/reserva.php?error=horaInvalida');
            exit();
        }

        if (!is_numeric($comensales) || $comensales <= 0 || $comensales > 20) {
            header('Location: ../views/public/reserva.php?error=comensalesInvalidos');
            exit();
        }

        $reserva = new Reserva();
        $reserva->setFecha($fecha);
        $reserva->setHora($hora);
        $reserva->setComensales($comensales);
        $reserva->setIp($ip);

        $reservaDAO = new ReservaDAO();
        try {
            if ($reservaDAO->create($reserva)) {
                header('Location: ../views/public/reserva.php?success=1');
                exit();
            } else {
                header('Location: ../views/public/reserva.php?error=dbError');
                exit();
            }
        } catch (Exception $e) {
            echo 'Error en la base de datos: ' . $e->getMessage();
            exit();
        }
    }
}
