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
        $tb = $this->xml_to_collection($this->scolarite->$table)->sortBy($identifier);
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
    public function getLoggedUser($email){
        $user = $this->getData('users')->firstWhere('email', $email);
        return $user;
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
            $pass = password_hash($data['pass'], PASSWORD_DEFAULT);
            $user = $this->scolarite->xpath('//users/user[@id='.$id.']');
            $user =$user[0];
            $user->nom = $data['nom'];
            $user->prenom = $data['prenom'];
            $user->password = $pass;
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
        //incrementer before add 
            $id = $this->auto_increment('NumDept', 'departements');
        $departement =$this->scolarite->departements->addChild('departement');
        $departement->addChild('intitule', $data['intitule']);
        $departement->addAttribute('NumDept',$id );
        $departement->addAttribute('chef',$data['chef']);
        $this->saveChange();
        return true;

    }catch(Exception $e){
        return array(
            "error" => $e->getMessage(),
            "line" => $e->getLine()
        );   
    }
    
    }

    // auth and permessions
     //add auth
     public function add_authorization(array $data){
        //get permession code
        $permession_code = $this->get_permessionID($data);
        //permession = null => add new permession
        //permession != null => add only auth
        if(!$permession_code){
            if($this->add_permession($data)){
                $permession_code = $this->get_permessionID($data); 
            }
        }
        //add auth
        $authorization = $this->scolarite->authorizations->addChild('authorization');
            $authorization->addAttribute('CodePermission', $permession_code);
            $authorization->addAttribute('NumRole', $data['role']);
            $this->saveChange();
            return true;
      
    
    }

    public function get_permessionID($data){
        $permession =$this->getData('permissions')
        ->where('action',$data['action'])
        ->where('table',$data['table'])
        ->cols('code')
        ->first();
        if($permession!=null){
            return $permession['code'];
        }
        return null;
    }

    public function add_permession(array $data){
        //check permession not exsit
        $permession_code = $this->get_permessionID($data); 
        if($permession_code==null){
            $permession = $this->scolarite->permissions->addChild('permission');
            $permession->addAttribute('code', $this->auto_increment('code','permissions'));
            $permession->addChild('action', $data['action']);
            $permession->addChild('table', $data['table']);
            $this->saveChange();
            return true;
        }
        return false;
    }

    public function getRolesByUser($idUser){
        $userRole = $this->getData('RoleUsers')->where('id', $idUser); 
        return  new Columns($userRole);
    }


    public function addRoleUsers($data){
        $RoleUser = $this->scolarite->RoleUsers->addChild('RoleUser');
        $RoleUser->addAttribute('NumRole', $data['NumRole']);
        $RoleUser->addAttribute('id', $data['id']);
        $this->saveChange();
    }


}
?>