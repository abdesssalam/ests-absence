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
    //string $origine,array | Columns $target,string $foregin
    public function jointure(string $origine, $target,string $foregin){
        $target = new Columns($target);
        if($target->count()==0){
            return new Collection([]);
        }
        $res1 = $this->map(function ($item) use ($target,$origine,$foregin) {
            $item = new Columns($item);
            $id = $item->only($origine)[$origine];
            $res2 = $target->filter(function ($item2) use ($id,$foregin) {
                $item2 = new Columns($item2);
                if($id==$item2->only($foregin)[$foregin]){
                        return $item2->forget('id');
                }   
            });
             $res2 = array_values($res2->toArray());
            $res2 = $res2[0]; 
            unset($res2[$foregin]);
            $item = array_merge($item->toArray(),$res2 );
            return $item;
        });
        // echo '<br>';
        // var_dump($res1);
        // echo '<br>';
        // echo '<br>';
        return new Columns($res1);
    }


}

?>