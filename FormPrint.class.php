<?php
Class CFormPrint{
    public $newvar = 0;
    public static $verbose = False;

    public function __construct()
    {
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
       return (file_get_contents('Form.doc.txt'));
    }

   public  function FormPrint($Titre, $Tab)
    {
      print ('<div id="form">');
    	print ('<h2 class="FormTitre">'.$Titre.'</h2>');
    	print($Tab[0]);
    	//print('<p class="form">');
        print('<table>');
        for ($key = 1; $key <=count($Tab);$key = $key + 2)
			echo '<tr><td class="form">'.$Tab[$key].'</td><td class="form">'.$Tab[$key + 1].'</td></tr>';
        print('</table>');
        print('</form>');
        print('</div>');
        return;
    }
}
?>