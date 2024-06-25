<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Stock;
use App\Models\PrimaryCategory;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use App\Jobs\SendThanksMail;

class ItemController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:users');

        $this->middleware(function ($request, $next) {
            $id = $request->route()->parameter('item'); //Itemのid取得
            if (!is_null($id)) { // null判定 
                $itemId = Product::availableItems()->where('products.id', $id)->exists(); //入ってきたIDのものが存在しているかどうか
                if (!$itemId) {
                    abort(404);
                }
            }

            return $next($request);
        });
    }
    public function index(Request $request)
    {
        // 同期的に送信
        // Mail::to('test@example.com')
        // ->send(new testMail());

        // 非同期に送信
        // SendThanksMail::dispatch();

        $categories = PrimaryCategory::with('secondary')
        ->get();

        $products = Product::availableItems()
        ->selectCategory($request->category ?? '0')
        ->searchKeyword($request->keyword)
        ->sortOrder($request->sort)
        ->paginate($request->pagination ?? '20');

        return view('user.index', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $quantity = Stock::where('product_id', $product->id)
        ->sum('quantity');

        if($quantity > 9){
            $quantity = 9;
        }

        return view('user.show', compact('product', 'quantity'));
    }
}
