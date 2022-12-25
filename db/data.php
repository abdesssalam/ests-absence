<?php

require "../vendor/autoload.php";
use Illuminate\Support\Collection;

class Data{

    // public $scolarite=simplexml_load_file('absence.xml');
    public $scolarite;
    public $users;
    public function __construct($xml){
       
        $this->scolarite=$xml;
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

            $this->saveChange($data['type']);
            return true;

        }catch(Exception $e){
            return array(
                "error" => $e->getMessage(),
                "line" => $e->getLine()
            );
           
        }
        
    }

    public function get_users(){
        return new Collection($this->xml_to_aray($this->users));
    }

    /**
     * @author abdessalam 
     * @method array : xml_to_array(simplexmlobject) 
     * this function used to convert xml to array that can be used in collection
     */
    public function xml_to_aray($data){
        $json = json_encode($data);
        $arr = json_decode($json,true);
        $arr = array_values($arr);
        return $arr[0];
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
}

?>