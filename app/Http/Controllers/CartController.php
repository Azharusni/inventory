<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $product = DB::table('products')->where('id',$id)->first();

        $data = array();
        $data['pro_id'] = $id;
        $data['pro_name'] = $product->product_name;
        $data['pro_quantity'] = 1;
        $data['product_price'] = $product->selling_price;
        $data['sub_total'] = $product->selling_price;

        DB::table('pos')->insert($data);

    }

    public function CartProduct()
    {
        $cart = DB::table('pos')->get();

        return response()->json($cart);
    }
}
