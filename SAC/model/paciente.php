<?php
class Paciente
{
    private $pdo;
    private $msg;

	public $cedula;
	public $correoUsuario;
    public $nombre;  
    public $apellido;
    public $sexo;
	public $fechaNacimiento;
	public $celular;
    public $provincia;
    public $ciudad;
    public $dirrecion;


    public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = Db::StartUp();     
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}


    public function mostrarPacientes()
    {
		try
		{
			$stm = $this->pdo->prepare("SELECT cedula FROM paciente;");
			$stm->execute(array());
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	/* Mostrar cedulas de pacientes con consulta para el historial
	public function pacientesConConsulta()
    {
		try
		{
			$stm = $this->pdo->prepare("SELECT cedulaP FROM consulta;");
			$stm->execute(array());
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}*/

	public function buscarDatosPaciente(paciente $datos)
    {
		try
		{
			$stm = $this->pdo->prepare("SELECT nombre, apellido, cedula, correoUsuario FROM usuario WHERE cedula =?");
			$stm->execute(array($datos->cedula));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function buscarDatosCitaPaciente($idCita)
    {
		try
		{
			$stm = $this->pdo->prepare("SELECT u.nombre,u.apellido,c.cedulaP, u.correoUsuario FROM cita as C
			JOIN usuario as u ON u.cedula = c.cedulaP
			WHERE idCita = ?");
			$stm->execute(array($idCita));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}


	


}