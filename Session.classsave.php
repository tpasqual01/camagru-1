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
        $Password = strip_tags($_POST['Password']);

        try {
            $conn = new PDO('mysql:host=localhost;dbname=camagru', $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $requete = $conn->prepare("SELECT id, Nom, Prenom, email, Password FROM tbl_camagru LIMIT 1"); 
            $requete->execute();

            while($lignes=$requete->fetch(PDO::FETCH_OBJ))
                {
                //echo $lignes->Nom.'<br />'; && $lignes->password == $password
                    //print ( $lignes->Nom.' '.$lignes->Password .' ' .$Password. '<br />');
                    if ($lignes->email == $email && $lignes->Password == $Password )
                    {
                        $this->set_session($lignes->email, $lignes->Nom, $lignes->Prenom );
                        //exit();
                    }
                }
                //return;

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

    public function set_session($email, $Nom, $Prenom)
   {
    //PRINT 'SESSION<BR />';
        $_SESSION['email'] = $email;
        $_SESSION['Nom'] = $Nom;
        $_SESSION['Prenom'] = $Prenom;
        $_SESSION['valide'] = 'ok';
        //print ('user valide<br />');
        //foreach ($_SESSION as $key => $value)
            //echo $value.'<br />';
        return('ok');
   }
    public function kill_session()
   {
        $_SESSION = array(); session_destroy(); 
        return('ok');
   }
   
}


?>
