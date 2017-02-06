<?php
Class CForm{
    public $newvar = 0;
    public static $verbose = False;
    //private tabpost = array();

    public function __construct()
    {
             //print('C').PHP_EOL;

        return;
    }

    public function __destruct()
    {
         if (self::$verbose == True)
           // print('D').PHP_EOL;
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
       return (file_get_contents('Form.doc.txt'));
    }

   public  function FormTitre($titre)
    {
        print('<table>');
        print ('<h2 class="FormTitre">'.$titre.'</h2>');
        return;
    }
   public  function Form($uri, $class, $method )
    {
        return('<FORM class="'.$class.'" action="'. $uri.'" method="'.$method.'">');
        // !$uri || !$method
    }

    public  function InputLabel($labelTitre, $id, $labelFor)
    {
        return('<LABEL for="'.$labelFor.'">'. $labelTitre."</LABEL>");
    }

    public  function InputText($Titre, $id, $post)
    {
        //$value = $_POST[$id];
        return('<INPUT type="text" name="'. $id.'" id="'. $id.'" value="'.$post.'">');
        // !$id || !$labelFor
    }

    public  function InputMail($Titre, $id, $post)
    {
        //$value = $post;
//                print('...'.$post. ' ...'. $id.'...');
        return('<INPUT type="mail" name="'. $id.'" id="'. $id.'" value="'.$post.'" placeholder=" yourname@domain.com" alt="Email servira au login" required>');
        // !$id || !$labelFor
    }

    public  function InputSelect($Titre, $id, $tbl, $selected)
    {
        $retour ='<select name='.$id.' id='.$id.'>';
        foreach ($tbl as $key => $value)
        {
            if ($key == $selected) {$option_select = ' selected';} else {$option_select = '';}
            $retour .= '<option value="'.$key.'"'.$option_select.'>'.$value.'</option>';
        }
        $retour .= '</select>';
        return($retour);
    }

	public  function InputPassword($Titre, $id)
    {
        return('<INPUT type="password" name="'. $id.'" id="'. $id.'" required>');
        // !$id || !$labelFor
    }

	public  function Submit($Titre, $id)
    {   
        return('<INPUT type="submit"  name="'. $id.'" id="'. $id.'" value="'. $Titre.'">');
        // !$id || !$labelFor
    }


}

?>