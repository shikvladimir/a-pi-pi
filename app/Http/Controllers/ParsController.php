<?php

namespace App\Http\Controllers;

use DiDom\Document;
use GuzzleHttp\Client;
use GuzzleHttp\Pool;
use GuzzleHttp\Promise;
use GuzzleHttp\Promise\Utils;
use GuzzleHttp\TransferStats;
use Illuminate\Http\Request;
use Psr\Http\Message\ResponseInterface;

class ParsController extends Controller
{
    public function get(Request $request)
    {
        $text = $request->text;

        $page = 1000;

        $data[$page] = [];
//
//        while ($page <= 1323){
//            $url = "https://tabletka.by/user-query?page=" . $page;
//
//            $client = new Client();
//            $resp = $client->get($url);
//            $html = $resp->getBody()->getContents();
//
//            array_push($data, $this->search($html, $text));
//
//            $page++;
//        }

        //-------------------------------------------

//        $client = new Client();
//
//        $promises = [];
////        while ($page <= 1323){
//        while ($page <= 1000){
//            array_push($promises, $client->getAsync("https://tabletka.by/user-query?page=" . $page));
//            $page++;
//        }
//
//        $results = Promise\Utils::settle($promises)->wait();
//
//        foreach ($results as $key => $result) {
//            if ($result['state'] === 'fulfilled') {
//                $html = $result['value']->getBody()->getContents();
//                array_push($data, $this->search($html, $text));
//            } else {
//                echo $key . ': ' . $result['reason'] . "\n";
//            }
//
////            usleep(500000);
//
//        }

        //-------------------------------------------


        $client = new Client();

        $urls = [];
        while ($page <= 1323) {
            array_push($urls, "https://tabletka.by/user-query?page=" . $page);
            $page++;
        }

        $promises = [];
        foreach($urls as $urlIndex => $url) {
            $request = new \GuzzleHttp\Psr7\Request('GET', $url, []);

//            echo date('d.m.Y H:i:s') . ' запрос ' . $url . PHP_EOL;

            $promises[$urlIndex] = $client->sendAsync($request, [
                'timeout' => 1000,
                'on_stats' => function (TransferStats $stats) use ($url) {
                    // Тут можно получить статистику запроса
                    $stat = $stats->getHandlerStats();
//                    echo date('d.m.Y H:i:s') . ' получена статистика ' . $url . PHP_EOL;
                }
            ]);

            $promises[$urlIndex]->then(
                function (ResponseInterface $res) use ($url, $data, $text) {
                    // Тут обработка ответа

//                    echo date('d.m.Y H:i:s') . ' запрос выполнен ' . $url . PHP_EOL;
                },
                function (\GuzzleHttp\Exception\RequestException $e) {
                    // Тут обработка ошибки
                }
            );
        }

        $results = Promise\Utils::settle($promises)->wait(true);
        foreach ($results as $key => $result) {
            if ($result['state'] === 'fulfilled') {
                $html = $result['value']->getBody()->getContents();
                array_push($data, $this->search($html, $text));
            } else {
                echo $key . ': ' . $result['reason'] . "\n";
            }
        }
//        dd($data,$results);

        return view('welcome', compact('data', 'text'));
    }

    public function search($html, $text)
    {
        $document = new Document();
        $document->loadHtml($html);
        $data = $document->find('.quest-inner');

        $res = [];
        foreach ($data as $item) {
            if (strpos(mb_strtolower($item->text()), mb_strtolower($text)) !== false) {
                array_push($res, $item->text());
            }
        }

        return $res;
    }
}
