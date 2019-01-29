<?php
   class AuthentificationLib {
   	
	protected $sBdd ="bd_fol_espoir_1";
	protected $sHost="localhost";
	protected $sUser="root";
	protected $sPwd="";
	
	protected $sTable="administrateurs";
	
	protected $sColLogin="sLoginAdmin";
	protected $sColPwd="sPwdAdmin";
	
	protected $sLoginSaisi;
	protected $sPwdSaisi;
	
	/**
	 * Accesseurs
	 */
	public function setLogin($sLogin){
		TypeException::estChaineDeCaracteres($sLogin);
		$this->sLoginSaisi = $sLogin;
	}
	public function getLogin(){
		return $this->sLoginSaisi;
	}
	public function setPwd($sPwd){
		$this->sPwdSaisi = $sPwd;
	}
	public function getPwd(){
		return $this->sPwdSaisi;
	}
	public function __construct($sLogin, $sPwd){
		$this->setLogin($sLogin);
		$this->setPwd($sPwd);
	}
	
	/**
	 * Vérifie que les login/pwd saisis existent dans la BDD
	 * Si ils existent affecter la variable session $_SESSION et retourner true
	 * sinon retourne false
	 * @param string $sNomSession 
	 * @return boolean 
	 */
	public function authentifier($sNomSession){
		TypeException::estChaineDeCaracteres($sNomSession);
		
		//Connexion à la bdd
		$oPDOLib = new PDOLib();
		//Réaliser la requête
		$sRequete="
			SELECT *
			FROM ".$this->sTable."
			WHERE ".$this->sColLogin ."= :login
			AND ".$this->sColPwd."= :pwd 			
		";
		//Préparer la requête
		$oPDOStatement = $oPDOLib->getoPDO()->prepare($sRequete);
		
		//Lier les paramètres aux valeurs
		$oPDOStatement->bindValue(":login", $this->getLogin(), PDO::PARAM_STR);
		$oPDOStatement->bindValue(":pwd", $this->getPwd(), PDO::PARAM_STR);
		
		//Exécuter la requête
		$b = $oPDOStatement->execute();
		
		//Si la requête a bien été exécutée
		if($b == true){
			//Récupérer l'enregistrement (fetch)
			$aEnregs = $oPDOStatement->fetch(PDO::FETCH_ASSOC);
			
			if($aEnregs !== false){
				$_SESSION[$sNomSession] = $this->getLogin();			
				$oPDOLib->fermerLaConnexion();
				return true;
			}
		}
		$oPDOLib->fermerLaConnexion();
		return false;	
	}
	/**
	 * vérifier que la variable Session de nom $sNomSession est affectée d'une valeur
	 * @param string $sNomSession
	 * @return boolean true si la variable Session de nom $sNomSession est affectée d'une valeur
	 * 		   false dans le cas contraire
	 */
	public static function estAuthentifie($sNomSession){
		TypeException::estChaineDeCaracteres($sNomSession);
		return isset($_SESSION[$sNomSession]);
	}
	
	/**
	 * détruire la variable session
	 */
	public static function deconnecter($sNomSession){
		TypeException::estChaineDeCaracteres($sNomSession);
		unset($_SESSION[$sNomSession]);		
	} 
	
   }//fin de la classe AuthentificationLib
?>