<?php 

/**
 * @author Abdessalam 
 * this class extends from collection
 * new method cols and jointure
 * 
 * 
 */
use Illuminate\Support\Collection;

 class Columns extends Collection {

    protected $items = [];

    public function __construct( $items = []){
        $this->items = $this->getArrayableItems($items);

    }
    /**
     * Summary of cols
     * @param string|array $keys : coulmns you want to select
     * @return Columns collection with specific columns
     */

     //String | array $keys
    public  function cols( $keys){
        $res = $this->map(function ($item) use ($keys) {
            $item = new Columns($item);
            return $item->only($keys);
        });
        return new Columns($res);
    }

          /**
           * Summary of jointure
           * @param string $origine : the key in current table
           * @param array|Columns $target
           * @param string $foregin : the key in target table
            * @return Columns
           * current table (*)
           */
    
    public function jointure(array | Columns $target,string $origine,string $foregin){
        
        $target=new Columns($target);
       
        $res = new Columns;
         //one - one 
        if(!$this->is_multi_array($this->toArray()) && !$this->is_multi_array($target->toArray())){
            if($this[$origine]==$target[$foregin]){
                $res = $res->merge($target->forget($foregin));
                $res = $this->merge($res);
            }
        }
        //one- Many
        if(!$this->is_multi_array($this->toArray()) && $this->is_multi_array($target->toArray())){
            $res = $target->where($foregin, $this[$origine]);
            $res = $res->map(function ($item) use ($origine, $foregin) {
                $item = new Columns($item);
                $item = $this->merge($item->forget($foregin));
                return $item;
            });
        }

        //many to one
        if ($this->is_multi_array($this->toArray()) && !$this->is_multi_array($target->toArray())) {
            return $target->jointure($this, $foregin, $origine);
        }

        //Many Many

        if ($this->is_multi_array($this->toArray()) && $this->is_multi_array($target->toArray())) {
            $res = $this->map(function ($item) use ($target, $foregin, $origine) {
                $item = new Columns($item);
                $item = $item->jointure($target, $origine, $foregin);
                return $item;
            });
            return $res;
        }
        

         return $res;
        // $results = new Collection;
        // $this->each(function($item, $key) use ($target, $results) {
        //     $push = $target->has($key) ? $item->mergeRecursive($target->get($key)) : $item;
        //     $results[$key] = $push;
        // });
        // return $results;
        /*
        $target = new Columns($target);
        if($target->count()==0){
            return new Collection([]);
        }
        $res1 = new Columns;
        $res1 = $target->whereIn($foregin,$this->cols($origine)->all())->forget($foregin);
        return $res1;
        if (!isset($this[0][0])) {
            if(!isset($target[0])){
                echo '<br>target and orgine 1';
                if($this[$origine]==$target[$foregin]){
                    $res1 = $res1->merge($this)
                        ->merge($target)->forget($foregin);     
                }
            }else{
                echo '<br>only orgine 1';
                    
                    $res1 = $target->where($foregin,$this[$origine])->forget($foregin);
                    $res1 = array_merge($res1->toArray(), $this->toArray());
                echo '<br>only orgine 1<br>';
                    var_dump($res1);
                    echo '<br>only orgine 1';
                }
           
        }else{
            echo '<br>multi  mult';
            var_dump($this->cols($origine));
            $res1 = $target->whereIn($foregin,$this->cols($origine)->all())->forget($foregin);

        }
        return new Columns($res1);
        */
        // $res1 = $this->map(function ($item) use ($target,$origine,$foregin) {
        //     $item = new Columns($item);
        //     $id = $item->only($origine)[$origine];
        //     $res2 = $target->filter(function ($item2) use ($id,$foregin) {
        //         $item2 = new Columns($item2);
        //         if($id==$item2->only($foregin)[$foregin]){
        //                 return $item2->forget('id');
        //         }   
        //     });
        //     $res2 = array_values($res2->toArray());
        //     $res2 = $res2[0]; 
        //     unset($res2[$foregin]);
        //     $item = array_merge($item->toArray(),$res2 );
        //     return $item;
        // });
        // echo '<br>';
        // var_dump($res1);
        // echo '<br>';
        // echo '<br>';
       // return new Columns($res1);
    }
    public static function is_multi_array( $arr ) {
       $result = array_filter($arr, 'is_array');

        if (!empty($result)) {
            return true;
        } else {
            return false;
        }
    }

    public function clean(){
        $res = $this->map(function ($u) {
            if($this->count()>1){
                $u = array_values($u->toArray());
                if(!isset($u[0][0])){
                    $u = array_values($u[0]);
               
                    $u = $u[0];
                }else{
                    $u = array_values($u[0]);
                    $u = $u[0];
                }
    
            }else{
                $u = $u[0];
            }
            return $u;
        });
        return $res;
    }


}

?>