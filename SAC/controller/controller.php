<?php
session_start();// Comienzo de la sesión

require("model/paciente.php");
require("model/doctor.php");
require("model/cita.php");
require("model/consulta.php");

//require("config/config.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'public/phpMailer/Exception.php';
require 'public/phpMailer/PHPMailer.php';
require 'public/phpMailer/SMTP.php';

class Controller
{

    private $model;
    private $resp;

    private $modelPaciente;
    private $modelDoctor;
    private $modelCitas;
    private $modelConsulta;

    public function __CONSTRUCT(){
        $this->modelPaciente = new Paciente();
        $this->modelDoctor = new Doctor();
        $this->modelCitas = new Cita();
        $this->modelConsulta = new Consulta();
    }

    public function index(){
        require("view/login.php");
    }

    public function CerrarSesion(){
        SESSION_START();
        SESSION_DESTROY();
        header('Location: ?sel=login');
    }

    public function Principal(){
        require("view/principal.php");
    }

    public function Citas(){
        $tablaCitas = new Cita();
        $tablaCitas = $this->modelCitas->MostrarCitas($_SESSION["cedula"]);
        require("view/citas.php");
    }

    public function consultaCC(){
        $datosPaciente = new Paciente();
        $datosPaciente = $this->modelPaciente->buscarDatosCitaPaciente($_SESSION["idCitaa"]);
        require("view/consultaCC.php");
    }

    public function consultaSC(){
        $listaPacientes = new Paciente();
        $listaPacientes = $this->modelPaciente->mostrarPacientes();
        require("view/consultaSC.php");
    }

   public function historial(){
        $listaHistorial = new Paciente();
        $listaHistorial = $this->modelPaciente->mostrarPacientes();
        require("view/historial.php");
    }

   /*  public function historial(){
        $tablaHistorial = new Consulta();
        $tablaHistorial = $this->modelConsulta->datoshistorial();
        require("view/historial.php");
    }*/

    public function Capacitacion(){
        require("view/capacitacion.php");
    }


    public function Loguear(){
        $loguearDoctor = new Doctor();

        $loguearDoctor->correoUsuario = $_REQUEST['email'];  
        $loguearDoctor->contrasena = md5($_REQUEST['password']);    

        //Verificamos si existe en la base de datos
        if ($resultado= $this->modelDoctor->LoguearDoctor($loguearDoctor))
        {
            $_SESSION["acceso"] = true;
            $_SESSION["idDoctor"] = $resultado->id;
            $_SESSION["cedula"] = $resultado->cedula;
            $_SESSION["correo"] = $resultado->correoUsuario;
            $_SESSION["nombre"] = $resultado->nombre;
            $_SESSION["apellido"] = $resultado->apellido;
            header('Location: ?sel=principal');
        }
        else
        {header('Location: ?&msg=Su contraseña o usuario está incorrecto');}
    }

    public function busquedaPaciente(){
        $paciente = new Paciente();
        $paciente->cedula = $_REQUEST['pacientes'];
        
        $pacienteResultado = $this->modelPaciente->buscarDatosPaciente($paciente);
        require("view/consultaSC.php");
    }

    public function pacienteHistorial(){
        $historial = new Consulta();
        $historial->cedulaP = $_REQUEST['pacientes'];
        
        $historialResultado = $this->modelConsulta->datosHistorial($historial);
        require("view/historial.php");
    }

    public function crearConsultaSC(){
        $consulta = new Consulta();
        $consulta->cedulaP =$_REQUEST['cedula'];
        $consulta->motivoConsulta = $_REQUEST['motivo'];
        $consulta->medicamentosRecetados= $_REQUEST['receta'];
        
        $emailPaciente = $_REQUEST['correo'];


        if($consultaEnviada = $this->modelConsulta->crearConsultaSC($consulta)){
            
            //Aqui va enviar correo
            $mail = new PHPMailer(true);

            try 
            {
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;       
                $mail->isSMTP();                              
                $mail->Host       = 'smtp.gmail.com';       
                $mail->SMTPAuth   = true;                 
                $mail->Username   = constant('CORREO_REMITENTE');     
                $mail->Password   = constant('CORREO_PASS');        
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
                $mail->Port       = 465;

                $mail->setFrom(constant('CORREO_REMITENTE'), 'SAC 1LS131');
                $mail->addAddress($emailPaciente);  
                
                $mensajeHTML='
                <p align="center"> 
                <img src="https://utp.ac.pa/documentos/2015/imagen/logo_utp_1_72.png" width="100px" height="100px" >
                </p>
                <p align="center">DATOS DE CONSULTA</p>
                <p align="center"><b>Motivo de Consulta: '.$consulta->motivoConsulta.' </b></p>
                <p align="center"><b>Receta del Doctor: '.$consulta->medicamentosRecetados.'  </b></p>
                <p align="center">
                <br/>
                </p>';

                $mail->isHTML(true);
                $mail->Subject = 'DATOS DE CONSULTA';
                $mail->Body    = $mensajeHTML;

                $mail->send();
                //header('Location: ?&msg=Consulta Realizada');
                header('Location: ?sel=principal&msg=Consulta Realizada');

            } catch (Exception $e) {
                header('Location: ?sel=principal&msg=ERROR ENVIAR CORREO DE CONSULTA');
            }
            
            //header('Location: ?sel=principal');
        }

        
    }


    public function crearConsultaCC(){
        $consulta = new Consulta();

        $consulta->idCita = $_REQUEST['idCita'];
        $consulta->cedulaP =$_REQUEST['cedula'];
        $consulta->motivoConsulta = $_REQUEST['motivo'];
        $consulta->medicamentosRecetados= $_REQUEST['receta'];
        
        $emailPaciente = $_REQUEST['correo'];

        if($consultaEnviada = $this->modelConsulta->crearConsultaCC($consulta)){
            
            //Aqui va enviar correo
            $mail = new PHPMailer(true);

            try 
            {
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;       
                $mail->isSMTP();                              
                $mail->Host       = 'smtp.gmail.com';       
                $mail->SMTPAuth   = true;                 
                $mail->Username   = constant('CORREO_REMITENTE');     
                $mail->Password   = constant('CORREO_PASS');        
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; 
                $mail->Port       = 465;

                $mail->setFrom(constant('CORREO_REMITENTE'), 'SAC 1LS131');
                $mail->addAddress($emailPaciente);  
                
                $mensajeHTML='
                <p align="center"> 
                <img src="https://utp.ac.pa/documentos/2015/imagen/logo_utp_1_72.png" width="100px" height="100px" >
                </p>
                <p align="center">DATOS DE CONSULTA</p>
                <p align="center"><b>Motivo de Consulta: '.$consulta->motivoConsulta.' </b></p>
                <p align="center"><b>Receta del Doctor: '.$consulta->medicamentosRecetados.'  </b></p>
                <p align="center">
                <br/>
                </p>';

                $mail->isHTML(true);
                $mail->Subject = 'DATOS DE CONSULTA';
                $mail->Body    = $mensajeHTML;

                $mail->send();
                //header('Location: ?&msg=Consulta Realizada');
                header('Location: ?sel=citas&msg=Consulta Realizada');

            } catch (Exception $e) {
                header('Location: ?sel=citas&msg=no se envio correo');
            }
            
            //header('Location: ?sel=citas');
        }

        
    }


}
