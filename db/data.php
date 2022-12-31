<?php

require $_SERVER['DOCUMENT_ROOT']."/ests-absence/vendor/autoload.php";
require 'Columns.php';
use Illuminate\Support\Collection;

class Data{

    // public $scolarite=simplexml_load_file('absence.xml');
    public $scolarite;
    public $users;

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
            $user->addAttribute('id', $this->auto_increment('id', 'users'));
            $type = isset($data['type']) ? $data['type'] : '';
            $this->saveChange();
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
    public function saveChange(){
            file_put_contents($_SERVER['DOCUMENT_ROOT'].'/ests-absence/db/abs_dev.xml',$this->scolarite->asXML());
       
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
    public function auto_increment(string $identifier,String $table){
        $tb = $this->xml_to_collection($this->scolarite->$table);
        if($tb->count()==0){
            return 1;
        }else{
           return (int)($tb->last()[$identifier])+1;
        }
    }
    /**
     * @author Abdessalam
     * Summary of get_tables
     * @return array of all xml table name
     * use case : in dashboard/roles and permessions we have to fill it dynamic
     */
    public function get_tables(){
        $root = new Columns($this->scolarite);
        $names = new Columns(array_keys($root->toArray()));
        return $names->all();
    }
    //had function trj3 lna id d l user li rah logged
    public function getLoggedUserID($email){
        $user = $this->getData('users')->firstWhere('email', $email);
        return $user['id'];
    }
    
    /**
     * Summary of getData
     * @param string $table : the name of element parent in xml
     * @return Columns : all records of this column
     */
    public function getData(String $table){
        return $this->xml_to_collection($this->scolarite->$table);
    }

     
     
//flmodification mohal khsak t9lbha collection axbanlikom ankhliha mn ba3d
/**
 * ay modification khdm b xpath
 *  matnsach dima ay modification (add,delete,update) dirha wst try catch
 * */ 
    public function updateUserInfo($id,$data){
        try{
            $data['pass'] = password_hash($data['pass'], PASSWORD_DEFAULT);
            $user = $this->scolarite->xpath('//users/user[@id='.$id.']');
            $user =$user[0];
            $user->nom = $data['nom'];
            $user->prenom = $data['prenom'];
            $user->password = $data['pass'];
            $user->email = $data['email'];
            $this->saveChange();
            return true;
        }catch(Exception $e){
            return false;
        }
        
    }

    
    public function updateUserPass($id,$pass){
        try{
            $pass = password_hash($pass, PASSWORD_DEFAULT);
            $user = $this->scolarite->xpath('//users/user[@id='.$id.']');
            $user =$user[0];
            $user->password = $pass;
            
            $this->saveChange();
            return true;
        }catch(Exception $e){
            return false;
        }
    }




   



 public function add_departement($data){
    try{
        $departement =$this->scolarite->departements->addChild('departement');
        $departement->addChild('intitule', $data['intitule']);
    
        $departement->addAttribute('codeDep',$data['codeDep']);
        $departement->addAttribute('idProf',$data['idProf']);

        $type = isset($data['type']) ? $data['type'] : '';
        $this->saveChange();
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