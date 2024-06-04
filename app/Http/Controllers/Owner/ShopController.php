<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Shop;
use Illuminate\Support\Facades\Storage;
use InterventionImage;
// use App\Http\Requests\UploadImageRequest;
// use App\Service\ImageService;
// use App\Providers\ImageServiceProvider;
// use Intervention\Image\ImageManager;
// use Intervention\Image\Drivers\Gd\Driver;


class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:owners');

        $this->middleware(function ($request, $next){
           // dd($request->route()->parameter('shop')); // 文字列になる
            $id = $request->route()->parameter('shop'); //shopのid取得
            if(!is_null($id)){ // null判定 
            $shopsOwnerId = Shop::findOrFail($id)->owner->id;
            $shopId = (int)$shopsOwnerId; //キャスト 文字列->数値に型変換
            $ownerId = Auth::id();
            if($shopId !== $ownerId){ // 同じでなかったら
            abort(404); // 404画面を表示
            }
          }


            return $next($request);
        });
    }

    public function index()
    {
          phpinfo();
        // $ownerId = Auth::id();
        $shops = Shop::where('owner_id', Auth::id())->get();

        return view('owner.shops.index',
        compact('shops'));
    }

    public function edit(string $id)
    {
        $shop = Shop::findOrFail($id);
        // dd(Shop::findOrFail($id));
        return view('owner.shops.edit', compact('shop'));
    }

    public function update(Request $request, string $id)
    {
        $imageFile = $request->image;
        if(!is_null($imageFile) && $imageFile->isValid()) {
        //    $fileNameToStore = ImageService::upload($imageFile, 'shops');
        //    Storage::putFile('public/shops', $imageFile); // リサイズなしの場合
            $fileName = uniqid(rand().'_'); //ランダムでファイル名を作成し、_を付ける。
            $extension = $imageFile->extension(); // 拡張子を取得
            $fileNameToStore = $fileName.'.'. $extension; // 作ったファイル名と拡張子を変数になおす。
            $resizedImage = InterventionImage::make($imageFile)->resize(1920, 1080)->encode();
            dd($imageFile, $resizedImage);
           
            Storage::put('public/'. $folderName.'/', $fileNameToStore, $file);

        }

        return redirect()->route('owner.shops.index');
    }
}