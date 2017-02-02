<?php
Class CInscription
{

    public static $verbose = False;
    private $servername = "localhost";
    private $username = "admin";
    private $password = "admin";
    private $dbname = "camagru";
    private $tbl = "tbl_camagru";

    public function __construct()
    {
        return;
    }

//send_validation
//cle_validation
//send_email
//validation_user
//reset_password
//remove_user

    public function send_validation($email, $Prenom, $Nom, $Keyconfirm)
    {

        $sujet = 'Confirmation d\'inscription Camagru';
        $message = 'Bonjour '.$Prenom.' '. $Nom.'<br />';
        $message .= "Félicitations vous venez de vous inscrire sur Camagru.<br />
        Pour valider cette inscription, il ne vous reste plus qu'à cliquer sur le lien suivant :";
        $message .= "<a href='http://$servername:8080/camagru/inscriptioncheck.php?key=$Keyconfirm'> Validez votre incription</a>";
        $from = 'dlievre<dlievre@student.42.fr>';

        //$CInscription = new CInscription();
        $action = $this->send_email($email, $sujet, $message, $from);
        if ($action == 'send_email') 
            return('send_validation');
        else
        {
            print ($action);
            exit;
        }
//        return;
    }

    public function set_key_validation($email)
    {
        $generatedKey = sha1(mt_rand(10000,99999).time().$email);
        // $idunik = uniqid();
        return($generatedKey);
    }

    public function get_key_validation()
    {
        //print ('<p>destruct</p>');
        return;
    }

    public function send_email($email, $sujet, $message, $from)
    {

        $to  = $email;
        $headers = "MIME-Version: 1.0\r\n"; 
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
        $headers .= "From: ".$from ."\r\nX-Mailer:PHP"; 

        if (mail($to,$sujet,$message,$headers)) 
            return "send_email";
        else 
            return " Erreur de transmission email";

  return;
    }

    public function __destruct()
    {
        //print ('<p>destruct</p>');
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
   
}

?>
