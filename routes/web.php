<?php

use App\Models\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use DiDom\Document;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $data = Order::with('user')->get(/*['id','title','cost']*/);

    return view('welcome', compact('data'));
});

Route::post('go', function (Request $request) {


//    for ($step = 1; $step < 100; $step++){
        $url_tabletka = file_get_contents('https://tabletka.by/user-query?page='.$step);

        $document = new Document($url_tabletka);
        $ul = $document->find('ul');

        $arr = [];
//        foreach ($ul as $item) {
//            if(strpos($item->text(), $request->text) !== false){
//                array_push($arr, $item->text());
//            }
//        }
//
//        $p = $document->find('p');
//        foreach ($p as $item) {
//            if(strpos($item->text(), $request->text) !== false){
//                array_push($arr, $item->text());
//            }
//        }

        $div = $document->find('p');
        foreach ($div as $item) {
            if(strpos($item->text(), $request->text) !== false){
                array_push($arr, $item->text());
            }
        }
//    }



    return view('welcome', compact( 'arr'));
    dd(123,$request->all());
})->name('go');
