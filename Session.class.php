<?php
Class CSession
{

    public static $verbose = False;


    public function __construct()
    {

        $servername = "localhost:";
        $username = "admin";
        $password = "admin";
        $dbname = "camagru";
        $email = strip_tags($_POST['email']);
        $password = strip_tags($_POST['password']);

        try {
            $conn = new PDO('mysql:host=localhost;dbname=camagru', $username, $password);// or die(print_r($bdd->errorInfo()));
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $requete = $conn->prepare("SELECT id, Nom, Prenom, email, password FROM tbl_camagru"); 
            $requete->execute();

            while($lignes=$requete->fetch(PDO::FETCH_OBJ))
                {
                //echo $lignes->Nom.'<br />'; && $lignes->password == $password
                if ($lignes->email == $email )  { $this->set_session($lignes->email, $lignes->Nom ); }
                }

            }
        catch(PDOException $e)
            {
            echo "Error Database : " . $e->getMessage();
            }
        $conn = null;
        return;
    }

    public function __destruct()
    {
         if (self::$verbose == True)
            print('D').PHP_EOL;
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
       return (file_get_contents('Form.doc.txt'));
    }

    public function set_session($email, $Nom)
   {
    //PRINT 'SESSION<BR />';
        $_SESSION['email'] = $email;
        $_SESSION['Nom'] = $Nom;
        $_SESSION['valide'] = 'ok';
        //print ('user valide<br />');
        //foreach ($_SESSION as $key => $value) {
         //   echo $value.'<br />';
        
        return('ok');
   }

   
}


?>
