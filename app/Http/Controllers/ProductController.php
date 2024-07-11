<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

class ProductController extends Controller
{
    public function showGold()
    {
        $products = Product::where('product_type', 'gold')
                            ->where('in_stock', 1)
                            ->get();
        return view('products.gold', compact('products'));
    }

    public function showTea()
    {
        $products = Product::where('product_type', 'tea')
                            ->where('in_stock', 1)
                            ->get();
        return view('products.tea', compact('products'));
    }

    public function showDetail($id)
    {
        $product = Product::find($id);

        if (!$product) {
            abort(404, '找不到此商品');
        }

        return view('products.detail', compact('product'));
    }

    public function fetchGoldPrice(Request $request)
    {
        $amount = $request->input('amount', 100);  // 默認為100如果沒有提供
        $targetUrl = 'https://www.allbeauty.com.tw/GoldLeaf/?Curr=NT&OrderQty=' . $amount;
        $response = Http::get($targetUrl);
        $html = $response->body();
        $crawler = new Crawler($html);
        $prices = $crawler->filterXPath("//table[@id='goldleaf']//tr/td[contains(@class, 'right')]")->each(function (Crawler $node, $i) {
            return ['price' => trim($node->text())];
        });

        return response()->json($prices);
    }

    public function updateGoldPrice(Request $request)
    {
        $prices = $request->input('prices');

        foreach ($prices as $index => $price) {
            $productId = $index + 1;
            $product = Product::find($productId);
            if ($product) {
                $product->price = $price;
                $product->save();
            }
        }

        return response()->json(['message' => 'Prices updated successfully']);
    }
}