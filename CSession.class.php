<?php
Class CSession
{

    public static $verbose = False;
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "camagru";
    private $tbl = "tbl_camagru";
    //private $conn =''; pas necessaire


    public function __construct()
    {
        //print '__construct';
        // a l'initialisation de la class on genere la variable de conenxion a la base
        $this->conn = new PDO('mysql:host='.$this->servername.';dbname='.$this->dbname, $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return;
    }

    public function user_login()
    {
        $email = strip_tags($_POST['email']);
        $Password = strip_tags($_POST['Password']);
        $retour = 'user not exit';
        try {
            $rq = $this->secure("SELECT Id, Nom, Prenom, email, Password, Confirm, Keyuser FROM $this->tbl WHERE email = '$email'");
            $requete = $this->conn->prepare($rq); //
            $requete->execute();
            while($lignes = $requete->fetch(PDO::FETCH_OBJ)){
                    if ($lignes->email == $email && $lignes->Password == $Password && $lignes->Confirm == 1)
                    {
                        $this->set_session($lignes->email, $lignes->Nom, $lignes->Prenom, $lignes->Confirm );
                        $retour = 'user_login';
                    }
                    if ($lignes->email == $email && $lignes->Password == $Password && $lignes->Confirm == 0)
                        $retour = 'user not confirmed';

                    if ($lignes->email == $email && $lignes->Password != $Password)
                        $retour = 'user password bad';

                    if ($lignes->email != $email )
                        $retour = 'user not exit';
                }
            }
        catch(PDOException $e)
            { echo "Error Database : " . $e->getMessage(); }
        //$conn = null;
        return($retour);
    }

    public function maj_key($email)
    {
        $generatedKey = uniqid();
        try {
            $rq = $this->secure("UPDATE $this->tbl SET Keyuser = '$generatedKey' WHERE email = '$email'");
            $requete = $this->conn->prepare($rq); 
            $requete->execute();
            if ($requete)
                $retour = $generatedKey;
            else
                {
                    $retour = 'maj key err';
                    $CPrint = new CPrint();
                    $CPrint->content('Erreur maj key', 'msg_err');
                    exit;
                }
            }

        catch(PDOException $e)
            { echo "Error Database : " . $e->getMessage(); $exist = 'Erreur'; return($exist);}
        //$conn = null;
        return($retour);
    }

    public function user_exist()
    {
        $email = strip_tags($_POST['email']);
       ///   securisation : https://openclassrooms.com/courses/securite-php-securiser-les-flux-de-donnees
        try {
            //$requete = $this->conn->prepare("SELECT email FROM $this->tbl WHERE email = :email"); 
            //$requete->bindValue(':email', $email, PDO::PARAM_STR);
            $rq = $this->secure("SELECT email FROM $this->tbl WHERE email = '$email'");
            $requete = $this->conn->prepare($rq);
            $requete->execute();
            $exist = 'no';
            while($lignes=$requete->fetch(PDO::FETCH_OBJ))
                if ($lignes->email == $email ) { $exist = 'yes'; }
            }
        catch(PDOException $e)
            { echo "Error Database : " . $e->getMessage(); $exist = 'Erreur'; return($exist);}
        //$conn = null;
        return($exist);
    }

    private function quotesep($val)// securise le passage des variables dans la requete sql, avec separateur
    {
        return("'".$val."', ");
    }

    private function quote($val)// securise le passage des variables dans la requete sql, sans separateur
    {
        return("'".$val."'");
    }

        public function user_add()
    {
        $email = strip_tags($_POST['email']);
        $Password = strip_tags($_POST['Password']);
        $Confirm = 0;
        $CInscription = new CInscription();
        $Keyuser = $CInscription->set_key_validation;
        $cpt_reinit = 5;

        // contre les injection sql : https://openclassrooms.com/courses/pdo-comprendre-et-corriger-les-erreurs-les-plus-frequentes

        try {
            $rq = $this->secure("INSERT INTO  $this->tbl (Nom, Prenom, email, Password, Confirm, Keyuser, cpt_reinit, Info) VALUES ('$_POST['Nom']', '$_POST['Prenom']', '$email', '$_POST['Password']', '$Confirm', '$Keyuser', '$cpt_reinit', 'info'");

//$req = "INSERT INTO ". $this->tbl." (Nom, Prenom, email, Password, Confirm, Keyuser, cpt_reinit, Info) VALUES (".$this->quotesep($_POST['Nom']).$this->quotesep($_POST['Prenom']).$this->quotesep($email).$this->quotesep($_POST['Password']).$Confirm.', '.$this->quotesep($Keyuser).$cpt_reinit.", "."'info')";
            $requete = $this->conn->prepare($rq);
            $requete->execute();

            // envoi validation par mail uniquement si base maj
            //print ($email.' '.$lignes->Prenom.' '.$lignes->Nom.' '.$lignes->Keyuser);
            $CInscription->send_validation($email, $lignes->Prenom, $lignes->Nom, $lignes->Keyuser);
            }
        catch(PDOException $e)
            { echo "Error Database : " . $e->getMessage(); print 'Erreur user_add'; exit;}
        //$conn = null;
        return('user_add');
    }

    public function user_list() // reservé superuser
    {
        try {
            //$conn = new PDO('mysql:host='.$this->servername.';dbname='.$this->dbname, $this->username, $this->password);
            //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $requete = $this->conn->prepare("SELECT Id, Nom, Prenom, email, Confirm, Keyuser FROM ".$this->tbl); 
            $requete->execute();
            print '<p><table>';
            while($lignes=$requete->fetch(PDO::FETCH_OBJ))
                {
                    print '<tr><td>'.$lignes->Id.'</td>';
                    print '<td>'.$lignes->email.'</td>';
                    print '<td>'.$lignes->Nom.'</td>';
                    print '<td>'.$lignes->Prenom.'</td>';
                    print '<td>'.$lignes->Confirm.'</td>';
                    print '<td>'.$lignes->Keyuser.'</td>';
                    print '</tr>';
                }
            print '</table></p>';

            }
        catch(PDOException $e)
            { echo "Error Database : " . $e->getMessage(); $exist = 'Erreur';}
        //$conn = null;
        return;
    }

    public function set_session($email, $nom, $prenom, $confirm)
   {
        $_SESSION['email'] = $email;
        $_SESSION['Nom'] = $nom;
        $_SESSION['Prenom'] = $prenom;
        $_SESSION['Confirme'] = $confirm;
        $_SESSION['valide'] = 'ok';
        if ($_SESSION["email"] == 'dominique@lievre.net' or $_SESSION["email"] == 'tpasqual@student.42.fr') $_SESSION['Superuser'] = 'yes';
        return('ok');
   }

    public function get_profile()
    {
        if ($_SESSION['valide'] == 'ok') {
            $tab = array();
            foreach ($_SESSION as $nom => $value)
                $tab[$nom] = $value;
            return($tab);
        }
        else
            return('erreur');
    }

    function secure($var)
    {
        $var = strip_tags (string $var);
        return($var); // pour l'instant on ne fait que le strip_tags car protege par 'value'
        //return (mysql_real_escape_string($var)); // ne fonctionne pas
        //return($var);
    }

    function ismajuscule($var)// permet de verifier si il y a une majuscule dans la chaine pour les mauvais password
    {
        $nb = strlen($var);
        $retour = 'minuscule';
        for($i = 0; $i < $nb; $i++) {
            if (ctype_upper (substr($var, $i, 1))) 
                $retour = 'majuscule';
        }
        return($retour);
    }
    
    public function __destruct()
    {
        //print ('<p>destruct</p>');
        $this->conn = null; // on efface la connexion a la base
        return;
    }

   public function __toString() //print ($Form);
   {
        return('toString');
   }

   public function __invoke() //print ($Form());
   {
        return('invoke');
   }

    static function doc()
    {
        $info = '';
        //INSERT INTO `tbl_camagru` (`id`, `Nom`, `Prenom`, `email`, `password`, `info`) VALUES (NULL, 'LIEVRE', 'Dominique', 'dominique@lievre.net', 'test', 'sans');
       return (file_get_contents('documentation.txt'));
    }
   
    public function kill_session()
   {
        $_SESSION = array(); session_destroy(); 
        return('ok');
   }


   
}


?>
