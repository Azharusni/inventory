<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PosController extends Controller
{

    public function getProduct($id)
    {
        $product = DB::table('products')
            ->where('category_id',$id)
            ->get();

        return response()->json($product);
    }

    public function TodaySell()
    {
        $date =date('d/m/Y');
        $sell = DB::table('orders')->where('order_date',$date)->sum('total');

        return response()->json($sell);
    }

    public function TodayIncome()
    {
        $date =date('d/m/Y');
        $income = DB::table('orders')->where('order_date',$date)->sum('pay');

        return response()->json($income);
    }

    public function TodayDue()
    {
        $date =date('d/m/Y');
        $due = DB::table('orders')->where('order_date',$date)->sum('due');

        return response()->json($due);
    }

    public function TodayExpense()
    {
        $date =date('d/m/Y');
        $expense = DB::table('expenses')->where('expense_date',$date)->sum('amount');

        return response()->json($expense);
    }

    public function StockOut()
    {
        $product = DB::table('products')->where('product_quantity','<','1')->get();

        return response()->json($product);
    }
}
