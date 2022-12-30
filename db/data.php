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
            $user->addAttribute('id', $this->auto_increment('id', $this->get_users()));
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
            file_put_contents('../db/abs_dev.xml',$this->scolarite->asXML());
        }else{
            file_put_contents('abs_dev.xml',$this->scolarite->asXML());
        }
    }

    /**
     * 
     * @author abdessalam
     * Summary of auto_increment
     * @param string $identifier : the identifier of table
     * @param Collection $table : collection of table
     * @return int  : the ID of new record
     * 
     */
    public function auto_increment(string $identifier,Collection $table){
        if($table->count()==0){
            return 1;
        }else{
           return (int)($table->last()[$identifier])+1;
        }
    }

    /**
     * @author Abdessalam
     * Summary of get_tables
     * @return array of all xml table name
     * use case : in dashboard/roles and permessions we have to fill it dynamicly
     */
    public function get_tables(){
        $root = new Columns($this->scolarite);
        $names = new Columns(array_keys($root->toArray()));
        return $names->all();
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
     
     public function getRoles(){
        return $this->xml_to_collection($this->scolarite->roles);
   
     }
     
//flmodification mohal khsak t9lbha collection axbanlikom ankhliha mn ba3d
public function updateUserInfo($nom,$prenom,$email,$nvPass){
    $hashedPass =  password_hash($nvPass, PASSWORD_DEFAULT);
    $arr = $this->scolarite->users;
foreach($arr as $element){
    if($element->email == $email){
        $element->nom = $nom;
        $element->prenom = $prenom;
        $element->email = $email;
        $element->password = $hashedPass;
        break ;
    }

}
$this->saveChange("ajax");
}

public function updateUserPass($id,$pass){
               $activeUser = $this->getSpecificUser($id); 
               $hached_pass = password_hash($pass, PASSWORD_DEFAULT);
               $activeUser->password = $hached_pass;
               $this->saveChange(" ");//not ajax
               header("Location:dashboard/profile.php");            
        }




   



 public function add_departement($data){
    try{
        $departement =$this->scolarite->departements->addChild('departement');
        $departement->addChild('intitule', $data['intitule']);
    
        $departement->addAttribute('codeDep',$data['codeDep']);
        $departement->addAttribute('idProf',$data['idProf']);

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

}
?>