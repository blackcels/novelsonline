<?php
/*
    Moteur de template
 */

class View
{

    private $view;
    private $templates;
    private $data = [];
    private $tpl;

    /**
     * View constructor.
     */
    public function __construct($view="v_index", $templates="front", $error=false){
        $this->tpl = $templates."/";
        $this->templates = $templates.".tpl.php";
        $this->view = $view.".view.php";
        
        if (!$error) {
            if(!file_exists("views/".$templates."/".$this->view)){
                die("la vue $this->view n'existe pas");
            }
        } else {
            $this->tpl = "error/";
            if(!file_exists("views/error/".$this->view)){
                die("la vue $this->view n'existe pas");
            }
        }

        if(!file_exists("views/templates/".$this->templates)){
            die("le template $this->templates n'existe pas");
        }
    }

    //Destruction d'une vue une fois l'objet devenue inexistant
    public function __destruct()
    {
        extract($this->data);
        include "views/templates/".$this->templates;
    }

    //Appel d'une vue
    public function assign($key, $value){
        $this->data[$key] = $value;
    }

    //Inclusion d'un modal
    public function addModal($modal,$config, $errors=[] ){
        include "views/modals/".$modal.".mdl.php";
    }
}
