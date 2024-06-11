<?php
class Consulta{

    private $pdo;
    private $msg;

	public $cedulaP;
	public $idCita;
    public $tipoConsulta;
    public $fechaConsulta;  
    public $motivoConsulta;
    public $medicamentosRecetados;


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


    public function crearConsultaSC(consulta $datos)
	{
		try
		{
            $stm = $this->pdo->prepare("CALL crearConsultaSinCitas(?,?,?)"); 
			$stm->execute(array($datos->cedulaP, $datos->motivoConsulta, $datos->medicamentosRecetados));
			return $stm->fetchAll(PDO::FETCH_OBJ);

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function crearConsultaCC(consulta $datos)
	{
		try
		{
            $stm = $this->pdo->prepare("CALL crearConsultaConCitas(?,?,?,?);"); 
			$stm->execute(array($datos->idCita,$datos->cedulaP, $datos->motivoConsulta, $datos->medicamentosRecetados));
			return $stm->fetchAll(PDO::FETCH_OBJ);

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function datoshistorial(consulta $datos){

		try
		{
            $stm = $this->pdo->prepare("CALL mostrarHistorialPaciente(?)"); 
			$stm->execute(array($datos->cedulaP));
			return $stm->fetchAll(PDO::FETCH_OBJ);

		} catch (Exception $e) 
		{
			die($e->getMessage());
		}

	}



}