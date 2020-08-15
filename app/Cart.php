<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;
    //khoi tao gio hang
    public function __construct($oldCart){
    	if($oldCart){
    		$this->items = $oldCart->items;
    		$this->totalQty = $oldCart->totalQty;
    		$this->totalPrice = $oldCart->totalPrice;
    	}
    }
    //them sp vao gio hang
    public function add($item, $id){
        $giohang = ['qty'=>0, 'price' => $item->unit_or_promotion_price, 'unit_price' => $item->unit_price, 'promotion_price' => $item->promotion_price, 'item' => $item];
        if($this->items){
            if(array_key_exists($id, $this->items)){
            $giohang = $this->items[$id];
            }
        }
        $giohang['qty']++;
        if($item->promotion_price == 0) {
            $item->unit_or_promotion_price = $item->unit_price;
        } else {
            $item->unit_or_promotion_price = $item->promotion_price;
        }
        $giohang['price'] = $item->unit_or_promotion_price * $giohang['qty'];
        $this->items[$id] = $giohang;
        $this->totalQty++;
        $this->totalPrice += $item->unit_or_promotion_price;
        }
    // xoa 1
    public function reduceByOne($id){
    	$this->items[$id]['qty']--;
    	$this->items[$id]['price'] -= $this->items[$id]['price'];
    	$this->totalQty--;
    	$this->totalPrice -= $this->items[$id]['item']['price'];
    	if($this->items[$id]['qty'] <= 0){
    		unset($this->items[$id]);
    	}
    }
    // xoa nhieu
    public function removeItem($id){
    	$this->totalQty -= $this->items[$id]['qty'];
    	$this->totalPrice -= $this->items[$id]['price'];
    	unset($this->items[$id]);
    }

}
