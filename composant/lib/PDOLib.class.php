<?php

/**
 * Component du framework
 * pour le cours 582-449-MA
 * @author Caroline Martin
 * @version 2016-01-18
 */

class PDOLib
{ 
		/* À Modifier */
	const HOST = "localhost";
	const USER = "root";
	const PWD = "root";
	const BDD = "bd_fol_espoir";
		/* Non modifié */
	const PILOTE_BDD = "mysql";
	const CHARSET = "utf8";
	const MODE_ERREUR = "ERRMODE_EXCEPTION";
		
		/*
	 *  
	 */

	/** 
	 * @var string
	 * @access private
	 */
	private $sHost;
	/** 
	 * @var string
	 * @access private
	 */
	private $sUser;
	/** 
	 * @var string
	 * @access private
	 */
	private $sPwd;
	/** 
	 * @var string
	 * @access private
	 */
	private $sBdd;

	/** 
	 * @var string
	 * @access private
	 */
	private $sPiloteBdd;
	/** 
	 * @var string 
	 * @access private
	 */
	private $sCharset;

	/** 
	 * @var string 
	 * @access private
	 */
	private $sModeErreur;

	/** 
	 * @var pdo
	 * @access private
	 */
	private $oPDO;

	/**
	 * 
	 * Affecter une valeur à la propriété privée
	 * @access public
	 * @param string $sHost 
	 */
	public function setsHost($sHost)
	{
		TypeException::estVide($sHost);
		TypeException::estChaineDeCaracteres($sHost);
		$this->sHost = $sHost;
	}
	/**
	 * 
	 * Affecter une valeur  à la propriété privée
	 * @access public
	 * @param string $sUser 
	 */
	public function setsUser($sUser)
	{
		TypeException::estVide($sUser);
		TypeException::estChaineDeCaracteres($sUser);
		$this->sUser = $sUser;
	}
	/**
	 * 
	 * Affecter une valeur à la propriété privée
	 * @access public
	 * @param string $sPwd 
	 */
	public function setsPwd($sPwd)
	{

		$this->sPwd = $sPwd;
	}

	/**
	 * 
	 * Affecter une valeur à la propriété privée
	 * @access public
	 * 
	 * @param string $sPiloteBdd
	 * CUBRID (PDO) — CUBRID Functions (PDO_CUBRID)
	 * MS SQL Server (PDO) — Microsoft SQL Server and Sybase Functions (PDO_DBLIB)
	 * Firebird (PDO) — Firebird Functions (PDO_FIREBIRD)
	 * IBM (PDO) — IBM Functions (PDO_IBM)
	 * Informix (PDO) — Informix Functions (PDO_INFORMIX)
	 * MySQL (PDO) — MySQL Functions (PDO_MYSQL)
	 * MS SQL Server (PDO) — Microsoft SQL Server Functions (PDO_SQLSRV)
	 * Oracle (PDO) — Oracle Functions (PDO_OCI)
	 * ODBC and DB2 (PDO) — ODBC and DB2 Functions (PDO_ODBC)
	 * PostgreSQL (PDO) — PostgreSQL Functions (PDO_PGSQL)
	 * SQLite (PDO) — SQLite Functions (PDO_SQLITE)
	 * 4D (PDO) — 4D Functions (PDO_4D)
	 * Pour vérifier quels sont les pilotes installés : print_r(PDO::getAvailableDrivers()); 
	 */
	public function setsPiloteBdd($sPiloteBdd)
	{
		TypeException::estVide($sPiloteBdd);
		TypeException::estChaineDeCaracteres($sPiloteBdd);
		$aPilotesBdd = array("cubrid", "mssql", "mysql", "sybase", "sqlite");

		if (in_array($sPiloteBdd, $aPilotesBdd) == false) {
			throw new Exception("ERR_PDO_PILOTE_BDD");
		}

		$this->sPiloteBdd = $sPiloteBdd;
	}
	/**
	 * Affecter une valeur à la propriété privée
	 * @access public
	 * @param string $sBdd 
	 */
	public function setsBdd($sBdd)
	{
		TypeException::estVide($sBdd);
		TypeException::estChaineDeCaracteres($sBdd);
		$this->sBdd = $sBdd;
	}
	/**
	 * 
	 * Affecter une valeur à la propriété privée
	 * @access public
	 * @param string $sCharset 
	 */
	public function setsCharset($sCharset)
	{
		TypeException::estVide($sCharset);
		TypeException::estChaineDeCaracteres($sCharset);

		$aCharsets = array("utf8", "iso8859-1");
		if (in_array($sCharset, $aCharsets) == false) {
			throw new Exception("ERR_PDO_CHARSET");
		}

		$this->sCharset = $sCharset;
	}




	/**
	 * 
	 * Affecter une valeur à la propriété privée
	 * @access public
	 * @param string $sModeErreur 
	 * PDO::ERRMODE_SILENT c'est le mode par défaut de PHP, 
	 * PDO::ERRMODE_WARNING : This mode will issue a standard PHP warning, and allow the program to continue execution. It's useful for debugging.
	 * PDO::ERRMODE_EXCEPTION : This is the mode you should want in most situations. It fires an exception, allowing you to handle errors gracefully
	 *  and hide data that might help someone exploit your system. Here's an example of taking advantage of exceptions
	 */
	public function setsModeErreur($sModeErreur)
	{
		TypeException::estVide($sModeErreur);
		$aModesErreurs = array("ERRMODE_SILENT", "ERRMODE_WARNING", "ERRMODE_EXCEPTION");

		if (in_array($sModeErreur, $aModesErreurs) == false) {
			throw new Exception("ERR_PDO_ERRMODE");
		}
			
			//$this->oConnect->setAttribute(PDO::ATTR_ERRMODE, $sModeErreur);
		$this->sModeErreur = $sModeErreur;
	}

	/**
	 * Récupérer la valeur de  la propriété privée
	 * @access public
	 * @return string
	 */
	public function getsHost()
	{

		return $this->sHost;
	}
	/**
	 * Récupérer la valeur de  la propriété privée
	 * @access public
	 * @return string
	 */
	public function getsUser()
	{

		return $this->sUser;
	}
	/**
	 * Récupérer la valeur de  la propriété privée
	 * @access public
	 * @return string
	 */
	public function getsPwd()
	{

		return $this->sPwd;
	}
	/**
	 * Récupérer la valeur de  la propriété privée
	 * @access public
	 * @return string
	 */
	public function getsBdd()
	{

		return $this->sBdd;
	}
	/**
	 * Récupérer la valeur de  la propriété privée
	 * @access public
	 * @return string
	 */
	public function getsCharset()
	{

		return $this->sCharset;
	}
	/**
	 * Récupérer la valeur de  la propriété privée
	 * @access public
	 * @return string
	 */
	public function getsModeErreur()
	{

		return $this->sModeErreur;
	}

	/**
	 * Récupérer la valeur de  la propriété privée
	 * @access public
	 * @return string
	 */
	public function getsPiloteBdd()
	{

		return $this->sPiloteBdd;
	}
	/**
	 * Récupérer la valeur de  la propriété privée
	 * @access public
	 * @return PDO
	 */
	public function getoPDO()
	{
		return $this->oPDO;
	}


	/** 
	 * Constructeur
	 * ouvrir une connexion sur la base de données
	 * @param string $sHost
	 * @param string $sUser
	 * @param string $sPwd
	 * @param string $sBdd
	 * @param string $sPiloteBdd
	 * @param string $sCharset
	 * @param string $sModeErreur
	 * @return void
	 */
	public function __construct(
		$sHost = PDOLib::HOST,
		$sUser = PDOLib::USER,
		$sPwd = PDOLib::PWD,
		$sBdd = PDOLib::BDD,
		$sPiloteBdd = PDOLib::PILOTE_BDD,
		$sCharset = PDOLib::CHARSET,
		$sModeErreur = PDOLib::MODE_ERREUR
	) {
			//Affectation
		$this->setsHost($sHost);
		$this->setsUser($sUser);
		$this->setsPwd($sPwd);
		$this->setsBdd($sBdd);
		$this->setsPiloteBdd($sPiloteBdd);
		$this->setsCharset($sCharset);
		$this->setsModeErreur($sModeErreur);

		$sDsn = $this->getsPiloteBdd()
			. ":dbname=" . $this->getsBdd() . ";"
			. "host=" . $this->getsHost() . ";"
			. "charset=" . $this->getsCharset();
		$sUser = $this->getsUser();
		$sPassword = $this->getsPwd();
			//Crée un objet PDO = connexion au SGBD mysql 
			//sur la base de données Video
		$this->oPDO = new PDO($sDsn, $sUser, $sPassword);
	}//fin de la fonction

	/**
	 * récupérer un array 
	 * des enregistrements obtenus à partir d'un SELECT 
	 * sur la base de données
	 * @param PDOStatement $oPDOStatement
	 * @return array  
	 */
	public function recupererArrayAssoc(PDOStatement $oPDOStatement)
	{
		
		//récupérer le array
		$iEnreg = -1;
		$aEnregs = array();

		do {
			$iEnreg++;
			$aEnregs[$iEnreg] = $oPDOStatement->fetch(PDO::FETCH_ASSOC);

		} while ($aEnregs[$iEnreg] != false);

		unset($aEnregs[$iEnreg]);
		return $aEnregs;

	}//fin de la fonction	
	/**
	 * récupérer un array d'objets (dont le type est précisé)
	 * des enregistrements obtenus à partir d'un SELECT 
	 * sur la base de données
	 * @param objet $oObjet
	 * @param PDOStatement $oPDOStatement
	 * @return array d'objets 
	 */
	public function recupererArrayDObjets($oObjet, PDOStatement $oPDOStatement)
	{
		TypeException::estObjet($oObjet);
		
		//affecter le mode de récupération de la méthode fetch()
		$oPDOStatement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, get_class($oObjet));
		
		//récupérer le array
		$iObjet = 0;
		$aoObjets = array();
		do {

			$oObjet = $oPDOStatement->fetch();
			$aoObjets[$iObjet] = $oObjet;
			$iObjet++;
		} while (is_object($oObjet) == true);

		unset($aoObjets[$iObjet - 1]);

		return $aoObjets;

	}//fin de la fonction

	/**
	 * Récupère sous forme d'un objet l'enregistrement obtenu après un SELECT grâce à l'objet de la classe PDOStatement
	 * @param objet $oObjet
	 * @param PDOStatement $oPdoStatement
	 * @return objet de la classe de l'objet passé en paramètre 
	 */
	public function recupererUnObjet($oObjet, PDOStatement $oPdoStatement)
	{

		TypeException::estObjet($oObjet);
				
			//PDO::FETCH_PROPS_LATE le constructeur est appelé avant que les pptés de l'objet soient affectés avec les données provenant de la BDD. 
		$oPdoStatement->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, get_class($oObjet));

		$oObjet = $oPdoStatement->fetch();

		return $oObjet;
	}//fin de la fonction

	/**
	 * Ferme la connexion PDO sur la base de données MySql
	 * @param void
	 * @return void 
	 */
	public function fermerLaConnexion()
	{
		$this->oPDO = null;
	}



}//fin de la classe PDOLib
















?>