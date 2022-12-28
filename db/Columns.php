<?php 

/**
 * @author Abdessalam 
 * this class extends from collection
 * new method added to get collection of columns 
 * like select col1,col2 from t1
 * 
 * 
 */
use Illuminate\Support\Collection;

 class Columns extends Collection {




    private $keys=[];
    protected $items = [];

    public function __construct( $items = []){
        $this->items = $this->getArrayableItems($items);

    }

    public  function cols($ks){
        $this->keys = $ks;

        $res = $this->map(function ($item) {
            $item = new Columns($item);
            return $item->only($this->keys);
        });
        return new Columns($res);

    }


}

?>