<?php

use App\Http\Controllers\ParsController;
use App\Models\Order;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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
    return view('welcome',);
});

Route::post('/pars', [ParsController::class, 'get'])->name('pars');

Route::post('go', function (Request $request) {

    $page = 1322;

    $url = "https://tabletka.by/user-query?page=".$page;

    $client = new \GuzzleHttp\Client();
    $resp = $client->get($url);
    $html = $resp->getBody()->getContents();

    $document = new Document();
    $document->loadHtml($html);
    $catalog = $document->find('.quest-inner');

    print_r($catalog);
//    echo $catalog;









/**
    $text = $request->text;

    $currentPage = 1322;

    $nextPageSelector = '.table-pagination-next';
    $nextPageUrlAttribute = 'href';

    $arr = [];

    do{
        $startPageUrl = file_get_contents("https://tabletka.by/user-query?page=".$currentPage);

        $document = new Document($startPageUrl);

        // Извлечение данных из текущей страницы
        $ul = $document->find('.quest-inner');
        foreach ($ul as $item) {
            if (strpos(mb_strtolower($item->text()), mb_strtolower($request->text)) !== false) {
                array_push($arr, $item->text());
            }
        }

        // Переход на следующую страницу
        $nextPageLink = $document->first($nextPageSelector);

        if (!empty($nextPageLink->attr($nextPageUrlAttribute))) {
            $currentPage++;
        } else {
            break;
        }

//    }while($currentUrl);
    }while(true);
    return view('welcome', compact('arr','text'));
 **/
})->name('go');
