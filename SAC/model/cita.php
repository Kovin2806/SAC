<?php
class Cita{

    private $pdo;
    private $msg;

    public $Cita;
	public $NombrePaciente;
	public $Descripcion;
    public $EstadoCita;
    public $Hora;  
    public $Fecha;


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

    public function MostrarCitas($cedula)
	{
		try
		{
            $stm = $this->pdo->prepare("CALL mostrarCitas(?)"); 
			$stm->execute(array($cedula));
			return $stm->fetchAll(PDO::FETCH_OBJ);

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}



}