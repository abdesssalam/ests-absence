<?php

require $_SERVER['DOCUMENT_ROOT']."/ests-absence/vendor/autoload.php";
require 'Columns.php';
use Illuminate\Support\Collection;

class Data{

    // public $scolarite=simplexml_load_file('absence.xml');
    public $scolarite;
    public $users;
    protected $keys=[];

    public function __construct($xml){
       
        $this->scolarite = $xml;
        $this->users = $this->scolarite->users;
    }

    public function add_user($data){
        try{
            // default pass
            $pass = password_hash('ESTS123', PASSWORD_DEFAULT);
            $user = $this->users->addChild('user');
            $user->addChild('nom', $data['nom']);
            $user->addChild('prenom', $data['prenom']);
            $user->addChild('email', $data['email']);
            $user->addChild('password',  $pass);
            $user->addChild('role', $data['role']);

            $type = isset($data['type']) ? $data['type'] : '';
            $this->saveChange($type);
            return true;

        }catch(Exception $e){
            return array(
                "error" => $e->getMessage(),
                "line" => $e->getLine()
            );
           
        }
        
    }

    public function get_users(){
        return  $this->xml_to_collection($this->users);
    }

    /**
     * @author abdessalam 
     * @method collection : xml_to_collection(simplexmlobject) 
     * this function used to convert xml to array that can be used in collection
     */
    public function xml_to_collection($data){
        $json = json_encode($data);
        $arr = json_decode($json,true);
        $arr = array_values($arr);
        $arr = $arr[0];
        $arr =new Collection($arr);
        //cleaning collection (attribute to simple element)

        return new Columns($this->exctract_xml_attrs($arr));
    }

    /**
     * @author abdessalam 
     * @method array : exctract_xml_attrs(simplexmlobject) 
     * this function used to make xml attribue like any element
     */
    
    public function exctract_xml_attrs($arr){ 
        $arr = $arr->map(function ($item, $key) {
            $item = new Collection($item);
            $attrs=[];
            if($item->has('@attributes')){
                $attrs = $item->get('@attributes');
                $item->forget('@attributes');
            }
            $item=$item->merge($attrs);
            return $item;
        });
        return $arr;
    }
    
    
    /**
     * @author abdessalam 
     * @method array : saveChange(string) 
     * used after updating xml file (add,delete,edit)
     * to save new data
     */
    public function saveChange($type){
        if($type=="ajax"){
            file_put_contents('../db/absence.xml',$this->scolarite->asXML());
        }else{
            file_put_contents('absence.xml',$this->scolarite->asXML());
        }
        
       
    }

    public function getSpecificUser($id){

        foreach($this->get_users() as $user) { 
            if(  $id ==  $user['email'] ){
             return $user;
             }
         }
       
    }
    
    public function getDepartements(){
       return $this->xml_to_collection($this->scolarite->departements);
  
    }

    public function getFiliers(){
        return $this->xml_to_collection($this->scolarite->filiers);
   
     }
     public function getProfesseurs(){
        return $this->xml_to_collection($this->scolarite->professeurs);
   
     }
     public function getModules(){
        return $this->xml_to_collection($this->scolarite->modules);
   
     }
     public function getMatieres(){
        return $this->xml_to_collection($this->scolarite->matieres);
   
     }
     public function getGroups(){
        return $this->xml_to_collection($this->scolarite->groups);
   
     }
     public function getEtudiants(){
        return $this->xml_to_collection($this->scolarite->etudiants);
   
     }
     public function getSemesters(){
        return $this->xml_to_collection($this->scolarite->semesters);
   
     }
     public function getSemaines(){
        return $this->xml_to_collection($this->scolarite->semaines);
   
     }
     public function getJours(){
        return $this->xml_to_collection($this->scolarite->jours);
   
     }
     public function getSeances(){
        return $this->xml_to_collection($this->scolarite->seances);
   
     }

     public function userExist($login,$pass){

        //get user pass  from with email
        $checking = false ;
        $us=$this->get_users()->firstWhere('email',$login);
        if($us){
        if(password_verify($pass,$us['password'])){
            $checking = true;
         }
        }
        return $checking;
     
    }

     public function connect($location,$login,$pass){
        if($this->userExist($login,$pass)){
            session_start();
            $_SESSION['identifiant'] = $_POST['email'];
            header("Location:$location");
        }
     }
     
     
//flmodification mohal khsak t9lbha collection axbanlikom ankhliha mn ba3d

public function updateUserInfo($nom,$prenom,$email,$nvPass){
     
}


    }
?>