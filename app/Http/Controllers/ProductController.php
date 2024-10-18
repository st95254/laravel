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
        $goldProducts = Product::where('product_type', 'gold')
                                    ->where('in_stock', 1)
                                    ->get();

        $edibleProducts = Product::where('product_type', 'edible')
                                    ->where('in_stock', 1)
                                    ->get();

        $silverProducts = Product::where('product_type', 'silver')
                                    ->where('in_stock', 1)
                                    ->get();
            
        return view('products.gold', compact('goldProducts', 'edibleProducts', 'silverProducts'));
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

    public function fetchGoldPrice()
    {
        try {
            // 設定目標URL
            $goldUrl = 'https://tradingeconomics.com/commodity/gold';
            $exchangeRateUrl = 'https://rate.bot.com.tw/xrt/quote/ltm/USD';

            // 抓取金價
            $goldResponse = Http::get($goldUrl);
            $goldHtml = $goldResponse->body();
            $goldCrawler = new Crawler($goldHtml);
            $goldPrice = $goldCrawler->filter('#p')->first()->text(); // 抓取金價

            // 抓取匯率
            $exchangeRateResponse = Http::get($exchangeRateUrl);
            $exchangeRateHtml = $exchangeRateResponse->body();
            $exchangeRateCrawler = new Crawler($exchangeRateHtml);
            $exchangeRate = $exchangeRateCrawler->filter('.rate-content-sight')->eq(4)->text(); // 抓取賣出匯率

            // 去掉匯率中的逗號並轉換為浮點數
            $exchangeRate = (float) str_replace(',', '', $exchangeRate);

            // 計算最終金價 (乘以匯率)
            $goldPriceNTD = (float) str_replace(',', '', $goldPrice) * $exchangeRate;

            return response()->json([
                'gold_price' => $goldPrice,
                'exchange_rate' => $exchangeRate,
                'gold_price_NTD' => $goldPriceNTD,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
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

    // Admin 功能
    public function index()
    {
        $products = Product::all();
        return view('admin.product', compact('products'));
    }

    // Store a newly created product in storage
    public function store(Request $request)
    {
        $request->validate([
            'product_type' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|url',
            'in_stock' => 'required|integer'
        ]);

        Product::create($request->all());

        return redirect()->route('product.index')->with('success', '產品新增成功');
    }

    // Update the specified product in storage
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('product.index')->with('error', 'Product not found.');
        }

        $request->validate([
            'product_type' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|url',
            'in_stock' => 'required|integer'
        ]);

        $product->fill($request->all());
        $product->save();

        return redirect()->route('product.index')->with('success', '產品資訊更新成功');
    }


    // Remove the specified product from storage
    public function destroy($id)
    {
        Product::find($id)->delete();
        return redirect()->route('product.index')->with('success', '產品刪除成功');
    }
}