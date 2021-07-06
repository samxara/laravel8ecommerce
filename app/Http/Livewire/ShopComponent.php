<?php

namespace App\Http\Livewire;

use App\Models\Product;
//use Gloudemans\Shoppingcart\Cart;
use Livewire\Component;
use Livewire\WithPagination;
use Gloudemans\Shoppingcart\Facades\Cart;

class ShopComponent extends Component
{
    public function store($product_id,$product_name,$product_price)
    {
        Cart::instance('cart')->add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        session()->flash('success_message','Item added in Cart');
        return redirect()->route('product.cart');
    }

    public function addToWishlist($product_id,$product_name,$product_price)
    {
        Cart::instance('wishlist')->add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
    }

    use WithPagination;
    public function render()
    {
        $products = Product::paginate(12);
        return view('livewire.shop-component',['products'=> $products])->layout("layouts.base");
    }
}

