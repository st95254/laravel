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