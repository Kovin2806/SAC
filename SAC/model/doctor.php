<?php
class Doctor
{
    private $pdo;
    private $msg;

    public $id;
	public $cedula;
	public $correoUsuario;
    public $contrasena;
    public $nombre;  
    public $apellido;


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

    public function LoguearDoctor(doctor $datos)
    {
		try
		{
			$stm = $this->pdo->prepare("CALL login_doctor(?,?)");
			$stm->execute(array($datos->correoUsuario, $datos->contrasena));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}
}