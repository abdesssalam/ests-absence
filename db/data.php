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
            $id = $this->auto_increment('id', 'users');
            $pass = password_hash('ESTS123', PASSWORD_DEFAULT);
            $user = $this->users->addChild('user');
            $user->addChild('nom', $data['nom']);
            $user->addChild('prenom', $data['prenom']);
            $user->addChild('email', $data['email']);
            $user->addChild('password',  $pass);
            $user->addAttribute('id', $id);
            $this->saveChange();
            return $id;

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
        
        //cleaning collection (attribute to simple element)
        
        return new Columns($this->exctract_xml_attrs($arr));
    }

    /**
     * @author abdessalam 
     * @method array : exctract_xml_attrs(simplexmlobject) 
     * this function used to make xml attribue like any element
     */
    
    public function exctract_xml_attrs($arr){ 
       
        if(count($arr)==1){
            if(array_key_exists('@attributes',$arr)){
                return $arr['@attributes'];
            }
        }
        $arr =new Collection($arr);
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
    public function auto_increment2(string $id,string $table,string $id1,$v1,string $id2,$v2){
        $tb = $this->xml_to_collection($this->scolarite->$table)
            ->where($id1, $v1)
            ->where($id2, $v2)
            ->sortBy($id);
        if($tb->count()==0){
            return 1;
        }else{
            
           return (int)($tb->last()[$id])+1;
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
    public function getLoggedUser($ID){
        $user = $this->getData('users')->firstWhere('id', $ID);
        return $user;
    }


    /**
     * Summary of getData
     * @param string $table : the name of element parent in xml
     * @return Columns : all records of this column
     */
    public function getData(String $table){
        if(!in_array($table,$this->get_tables())){
            return new Columns([]);
        }else{
             return $this->xml_to_collection($this->scolarite->$table);
        }
       
    }

     
    public function updateUserInfo($id,$data){
        try{
            $user = $this->scolarite->xpath('//users/user[@id='.$id.']');
            $user =$user[0];
            $user->nom = $data['nom'];
            $user->prenom = $data['prenom'];
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
        $departement->addChild('intituleDep', $data['intituleDep']);
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
        return false;
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
        $userRole = $this->getData('RoleUsers')->where('id', $idUser)
         ->jointure($this->getData('roles'),'NumRole','Num');

        $userRole = array_values($userRole->toArray());
        $userRole = new Columns($userRole);
        $userRole = $userRole->map(function ($u) {
            $u = array_values($u);
            $u = $u[0];
            unset($u['id']);
            return $u;
            
        });  
        $roles=array_values($userRole->toArray());
       
        return $roles;
    }

    public function get_num_roles_user($id){
        $userRoles = collect($this->getRolesByUser($id));
        $userRoles = $userRoles->map(function ($item) {
            return $item['NumRole'];
        });
        return $userRoles->toArray();
    }

    public function get_User_Permessions($id){
        $roles = $this->getRolesByUser($id);
        $Userpermessions = [];
        foreach($roles as $role){
            $permessions = $this->getData('authorizations')
                ->where('NumRole', $role['NumRole']);
            $Userpermessions = array_merge($permessions->toArray(), $Userpermessions);
        }
        $Userpermessions = array_map(function ($per) {
            $permession = $this->getData('permissions')
            ->firstWhere('code', $per['CodePermission']);
            $per = $permession['action'] . ' ' . $permession['table'];
            return $per;
        }, $Userpermessions);
        return $Userpermessions;
    }

    public function addRoleUsers($data){
        try{
            $RoleUser = $this->scolarite->RoleUsers->addChild('RoleUser');
            $RoleUser->addAttribute('NumRole', $data['NumRole']);
            $RoleUser->addAttribute('id', $data['id']);
            $this->saveChange();

            return true;
        }catch(Exception $e){
            return array(
                "error" => $e->getMessage(),
                "line" => $e->getLine()
            );
        }
       
    }
    public function add_professeur($id,$data){
        try{
            $prof = $this->scolarite->professeurs->addChild('professeur');
            $prof->addAttribute('id', $id);
            $prof->addAttribute('departement', 0);
            $prof->addAttribute('etat', $data['etat']);
            $this->saveChange();
            return true;  
        }catch(Exception $e){
            return false;
        }
        

    }
    public function link_prof_dep($dep,$id){
        try{
            $prof = $this->scolarite->professeurs->xpath('//professeurs/professeur[@id=' . $id . ']');
            $prof = $prof[0];
            $prof['departement'] = $dep;
            $this->saveChange();
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    public function add_module($data){
        try{
           
            $code = $this->auto_increment2('codeMod','modules','filier',$data['filier'],'annee',$data['numAnnee']);
            $module = $this->scolarite->modules->addChild('module');
            $module->addAttribute('codeMod', $code);
            $module->addAttribute('coordonnateur', $data['coordonnateur']);
            $module->addAttribute('filier', $data['filier']);
            $module->addAttribute('annee', $data['numAnnee']);
            $module->addChild('nomModule', $data['nomModule']);
            $this->saveChange();
            return true;
        }catch(Exception $e){
            return false;
        }
        
    }

    public function add_matiere($data){
        try{
            $code = $this->auto_increment2('codeMat','matieres','filier',$data['filier'],'annee',$data['annee']);
            $matiere = $this->scolarite->matieres->addChild('matiere');
            $matiere->addAttribute('codeMat',$code);
            $matiere->addAttribute('codeMod', $data['codeMod']);
            $matiere->addAttribute('filier', $data['filier']);
            $matiere->addAttribute('annee', $data['annee']);
            $matiere->addChild('nomMatier', $data['nomMatier']);
            $this->saveChange();
            return true;
        }catch(Exception $e){
            return false;
        }
       
    }

    public function add_absence($data){
        try{
            $absence = $this->scolarite->absences->addChild('absence');
            $absence->addAttribute('NumSeance', $data['NumSeance']);
            $absence->addAttribute('NumEtd', $data['NumEtd']);
            $absence->addAttribute('DateAbsence', $data['DateAbsence']);
            $absence->addAttribute('jour', $data['jour']);
            $absence->addAttribute('semaine', $data['semaine']);
            $absence->addAttribute('semester', $data['semester']);
            $absence->addAttribute('NumFilier', $data['NumFilier']);
            $absence->addAttribute('NumAnnee', $data['NumAnnee']);
            $absence->addAttribute('NumGroupe', $data['NumGroupe']);
            $absence->addAttribute('prof', $data['prof']);
            $absence->addAttribute('matier', $data['matier']);
            $absence->addAttribute('departement', $data['departement']);
            $absence->addAttribute('module', $data['module']);
            $this->saveChange();
            return true;
        }catch(Exception $e){
            return false;
        }    
    }

    public function updateUserRoles($id,$roles){
        try{
            //delete all user roles
            $role = $this->scolarite->RoleUsers->RoleUser;
            $j=0;
            for ($i = 0; $i < count($role);$i++){
                if($role[$j]['id']==$id){
                    unset($role[$j]);
                    $j = $j - 1;
                }
                $j = $j + 1;  
            }
            $this->saveChange();
            //append new roles
            $i=0;
            do {
                $roleAdded = $this->addRoleUsers(['id' => $id, 'NumRole'=>$roles[$i]]);
                if(is_array($roleAdded)){
                    return $roleAdded;
                }
                $i++;
            }while ($i < count($roles) && $roleAdded==true);

            return true;
        }catch(Exception $e){
            return array(
                "error" => $e->getMessage(),
                "line" => $e->getLine()
            );
        }
        
    }

    public function deleteAuth($data){
        try{
            $auth = $this->scolarite->authorizations->authorization;
            $j=0;
            for ($i = 0; $i < count($auth);$i++){
                if($auth[$j]['CodePermission']==$data['CodePermission'] && $auth[$j]['NumRole']==$data['NumRole'] ){
                    unset($auth[$j]);
                    $j = $j - 1;
                }
                $j = $j + 1;  
            }
            $this->saveChange();
            return true;
        }catch(Exception $e){
            return array(
                "error" => $e->getMessage(),
                "line" => $e->getLine()
            );
        }
    }


    //give role and return list of users have this given role

    public function getUsersByRole($role){
        $data = $this->getData('RoleUsers')
        ->where('NumRole',$role)
        ->cols('id');

        $Roleusers = $data->map(function ($item) {
            $item = array_values($item->toArray());
            $item =$item[0];
            return $item;
        });

        return $this->getData('users')->whereIn('id', $Roleusers);
    }


    public function updateDepartement($id,$data){
        try{
            $departement = $this->scolarite->xpath('//departements/departement[@NumDept='.$id.']');
            $departement =$departement[0];
            $departement->intituleDep = $data['intituleDep'];
            $departement['chef'] = (isset($data['chef'])?$data['chef']:$departement->chef);
            $this->saveChange();
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    public function updateFilier($id,$data){
        try{
            $nbr = count($this->scolarite->xpath('//filiers/filier[@codeFil=' . $id . ']'));

            $i = 0;
            while($i<$nbr){
                $filier = $this->scolarite->xpath('//filiers/filier[@codeFil='.$id.']');
                $filier =$filier[$i];
                $filier->intituleFil = $data['intituleFil'];
                $filier['codeDep'] = $data['codeDep'];
                $filier['responsable'] = $data['responsable'];
                $this->saveChange();
                $i++;
            }
            
            return true;
        }catch(Exception $e){
            return false;
        }
    }
    public function add_filier($data){
        try{
            $i=1;
             $id = $this->auto_increment('codeFil', 'filiers');
            while($i<=$data['annee']){
                $filier =$this->scolarite->filiers->addChild('filier');
                $filier->addChild('intituleFil', $data['intituleFil']);
                $filier->addAttribute('codeFil',$id );
                $filier->addAttribute('codeDep',$data['codeDep'] );
                $filier->addAttribute('numAnnee',$i );
                $filier->addAttribute('responsable',$data['responsable']);
                $this->saveChange();
                $i++; 
            }
            return true;

        }catch(Exception $e){
            return false;
        }
    }

    public function updateModule($id,$data){
        try{
            $module = $this->scolarite->xpath('//modules/module[@codeMod='.$id.']');
            $module =$module[0];
            $module->intitule = $data['intitule'];
           
            $module['coordonnateur'] = $data['coordonnateur'];
            $module['annee'] = $data['annee'];
            $this->saveChange();
            return true;
        }catch(Exception $e){
            return false;
        }
    }
    public function updateMatiere($id,$data){
        try{
            $matiere = $this->scolarite->xpath('//matieres/matiere[@codeMat='.$id.']');
            $matiere =$matiere[0];
            $matiere->nomMatier = $data['nomMatier'];
            $matiere['codeMod'] = $data['codeMod'];
            $this->saveChange();
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    public function add_etudiant($data){
        try{
            if(!$this->add_group_if_not_exsits($data)){
                throw new Exception();
            }
            if($this->check_etudiant_exsits($data)){
                throw new Exception();
            }
            $etudiant =$this->scolarite->etudiants->addChild('etudiant');
            $etudiant->addChild('nom', $data['nom']);
            $etudiant->addChild('prenom', $data['prenom']);
            $etudiant->addChild('email', $data['email']);
            $etudiant->addChild('CNE', $data['CNE']);
            $etudiant->addChild('anneeScolaire', $data['anneeScolaire']);
            $etudiant->addAttribute('group',$data['group'] );
            $etudiant->addAttribute('numEtd',$data['numEtd'] );
            $etudiant->addAttribute('filier',$data['filier'] );
            $etudiant->addAttribute('annee',$data['annee'] );
            $this->saveChange();
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    public function add_group_if_not_exsits($data){
        try{
            $groupe = $this->getData('groups')
                ->where('codeGrp', $data['group'])
                ->where('annee', $data['annee'])
                ->where('filier', $data['filier']);
            if($groupe->count()==0){
                $group =$this->scolarite->groups->addChild('group');
                $group->addAttribute('codeGrp',$data['group'] );
                $group->addAttribute('annee',$data['annee'] );
                $group->addAttribute('filier',$data['filier'] );
                $this->saveChange();           
            }
             return true;
        }catch(Exception $e){
            return false;
        }
    }

    public function check_etudiant_exsits($data){
        $etds = $this->getData('etudiants')
                    ->where('anneeScolaire', $data['anneeScolaire']);
        if(
            $etds->where('CNE', $data['CNE'])->count()>0 || 
            $etds->where('group', $data['group'])
            ->where('numEtd', $data['numEtd'])
            ->where('filier', $data['filier'])
            ->where('annee', $data['annee'])->count()>0
            ){   
            return true;
            }else{     
            return false;
            }
    }

    public function setDateSeance($week,$day){
        $days = (($week - 1) * 7)  + ($day - 1) ;
        $Date = "2023-01-02";
        return date('Y-m-d', strtotime($Date . ' + ' . $days . ' days'));
    }

    public function add_seance($data){
        try{
            $dateSeance=$this->setDateSeance($data['semaine'],$data['jour']);
            $anneeScolaire=$this->get_current_anneeScolaire();
            $seance = $this->scolarite->seances->addChild('seance');
            $seance->addAttribute('numSeance', $data['numSeance']);
            $seance->addAttribute('jour', $data['jour']);
            $seance->addAttribute('semaine', $data['semaine']);
            $seance->addAttribute('semester', $data['semester']);
            $seance->addAttribute('anneeScolaire', $anneeScolaire);
            $seance->addAttribute('filier', $data['filier']);
            $seance->addAttribute('annee', $data['annee']);
            $seance->addAttribute('groupe', $data['groupe']);
            $seance->addAttribute('prof', $data['prof']);
            $seance->addAttribute('matier', $data['matier']);
            $seance->addChild('dateSeance', $dateSeance);
            $this->saveChange();
            return true;
        }catch(Exception $e){
            return false;
        }
    }

    public function add_emploi($data){
        $x = 0;
        do {
            $data['semaine'] = $x+1;
            $added = $this->add_seance($data);

            $x++;
        } while ($x < $data['fin'] && $added == true);
        return $x;
    }
    public function get_current_anneeScolaire(){
        $annee = $this->getData('settings')
            ->firstWhere('name', 'anneeScolaire')->only('value');
        return $annee['value'];
    }

    public function get_seance($prof,$num_seance)
    {
        //To-Test
        $date = '2023-01-04';
        //exatt
        /*
        $date=date("Y-m-d");
        */
        return $this->getData('seances')
            ->where('dateSeance', $date)
            ->where('prof', $prof)
            ->firstWhere('numSeance', $num_seance);
    }
      
}
?>