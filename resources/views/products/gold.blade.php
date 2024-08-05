<!DOCTYPE html>
<html lang="en">
@include('layouts.head', ['title' => '灃耘 - 箔材', 'cssPath' => 'css/gold.css'])

<x-app-layout>
<body onload="GetGoldPrice()">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.portfolio-filter li').click(function(){
            var category = $(this).attr('data-filter');
            $('.portfolio-filter li').removeClass('active');
            $(this).addClass('active');

            if(category == '*'){
                $('.single-portfolio').show();
            } else {
                $('.single-portfolio').hide();
                $(category).show(); 
            }
        });
    });

    function validateInputAndFetchPrice() {
        var leafAmount = document.getElementById('LeafAmount').value;
        if (leafAmount < 100 || leafAmount > 10000) {
            // 顯示警告消息並中止操作
            document.getElementById('alertBox').style.display = 'block';
        } else {
            // 隱藏警告消息（如果之前顯示過）
            document.getElementById('alertBox').style.display = 'none';
            GetGoldPrice();
        }
    }    
    function GetGoldPrice() {
        // 取得輸入框中的數值
        var leafAmount = document.getElementById('LeafAmount').value;

        // 進行API調用
        fetch(`/products/gold/fetch-gold-prices?amount=${leafAmount}`)
            .then(response => response.json())
            .then(prices => {
                prices.forEach((price, index) => {
                    // 移除價格中的 'NT$ ' 和逗號
                    var cleanPrice = price.price.replace(/NT\$ /, '').replace(/,/g, '');
                    // 將清理後的價格轉換為浮點數並乘以 1.1
                    var adjustedPrice = parseFloat(cleanPrice) * 1.1;
                    // 格式化調整後的價格為兩位小數，並更新到對應的td元素
                    document.getElementById(`total${index}`).innerText = `NT$ ${adjustedPrice.toFixed(0)}`;

                    if(leafAmount == 100) {
                        updateGoldPriceOnServer(index, adjustedPrice.toFixed(0));
                    }
                });
            })
            .catch(error => console.error('Error fetching gold prices:', error));
    }

    function updateGoldPriceOnServer(productId, newPrice) {
        fetch('/products/gold/update-gold-prices', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({prices: {[productId]: newPrice}})
        })
        .then(response => response.json())
        .then(data => console.log('Price update response:', data))
        .catch(error => console.error('Error updating gold prices:', error));
    }


    </script>

    <!-- Start Price Section -->
    <section id="price_sec">
        <div class="title">金箔即時價格</div>
        <div class="input">
            <h3 style="display: inline-block;">請輸入張數 (最少100，最多10000)</h3>
            <input type="number" value="100" id="LeafAmount" min="100" max="10000">
            <button class="btn-info btn" onclick="validateInputAndFetchPrice()">取得時價</button>
            <div id="alertBox" style="color: red; display: none;">請輸入有效的張數（100 至 10000 張之間）</div>
        </div>
        <div class="price_table ">
            <table class="table">
                <thead class="thead-inverse">
                    <tr>
                        <th>#</th>
                        <th>金箔種類</th>
                        <th>金箔大小</th>
                        <th>金箔尺寸</th>
                        <th>價　　格</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>一號金箔</td>
                        <td>9分</td>
                        <td>2.65公分 x 2.65公分</td>
                        <td id="total0"></td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>一號金箔</td>
                            <td>1吋2</td>
                        <td>3.55公分 x 3.55公分</td>
                        <td id="total1"></td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>一號金箔</td>
                        <td>1吋8</td>
                        <td>5.40公分 x 5.40公分</td>
                        <td id="total2"></td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td>一號金箔</td>
                        <td>3吋6</td>
                        <td>10.9公分 x 10.9公分</td>
                        <td id="total3"></td>
                    </tr>
                    <tr>
                        <th scope="row">5</th>
                        <td>四號金箔</td>
                        <td>9分</td>
                        <td>2.65公分 x 2.65公分</td>
                        <td id="total4"></td>
                    </tr>
                    <tr>
                        <th scope="row">6</th>
                        <td>四號金箔</td>
                        <td>1 吋 2</td>
                        <td>3.55公分 x 3.55公分</td>
                        <td id="total5"></td>
                    </tr>
                    <tr>
                        <th scope="row">7</th>
                        <td>四號金箔</td>
                        <td>1吋8</td>
                        <td>5.40公分 x 5.40公分</td>
                        <td id="total6"></td>
                    </tr>
                    <tr>
                        <th scope="row">8</th>
                        <td>四號金箔</td>
                        <td>3吋6</td>
                        <td>10.9公分 x 10.9公分</td>
                        <td id="total7"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
    <!-- End Price Section -->

    <!-- Start Product Section -->
    <section id="product_sec">
        <div class="title">商品選購</div>
        <div class="sub_title">金箔</div>
        <div class="product_lis">
            @foreach ($goldProducts as $product)
                <a href="{{ route('products.detail', ['id' => $product->id]) }}" class="card-link">
                    <div class="card">
                        <div class="img">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}">
                        </div>
                        <div class="info">
                            <div class="tt">
                                {{ $product->name }}
                            </div>
                            <div class="price">${{ number_format($product->price, 0) }}元</div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="sub_title">食用金箔</div>
        <div class="product_lis">
            @foreach ($edibleProducts as $product)
                <a href="{{ route('products.detail', ['id' => $product->id]) }}" class="card-link">
                    <div class="card">
                        <div class="img">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}">
                        </div>
                        <div class="info">
                            <div class="tt">
                                {{ $product->name }}
                            </div>
                            <div class="price">${{ number_format($product->price, 0) }}元</div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="sub_title">銀箔</div>
        <div class="product_lis">
            @foreach ($silverProducts as $product)
                <a href="{{ route('products.detail', ['id' => $product->id]) }}" class="card-link">
                    <div class="card">
                        <div class="img">
                            <img src="{{ $product->image }}" alt="{{ $product->name }}">
                        </div>
                        <div class="info">
                            <div class="tt">
                                {{ $product->name }}
                            </div>
                            <div class="price">${{ number_format($product->price, 0) }}元</div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

    </section>
    <!-- End Product Section -->

    <!-- Start Proof Section -->
    <section id="proof_sec">
        <div class="title">資料證明</div>
        <div class="link">
            <a href="https://drive.google.com/file/d/1B4_qhw0Atm8y0PSyWCrao8Ud4XaN-xK8/view?usp=sharing" class="proof_btn" target="_blank">許可證明</a>
            <a href="https://drive.google.com/file/d/1R8QKJv1LBJ0ccKB1VJJAoXU_WyCMiGbc/view?usp=sharing" class="proof_btn" target="_blank">金箔材料</a>
        </div>
    </section>
    <!-- End Proof Section -->

    <!-- Ｓtart Portfolio Section -->
    <section id="protfolio_sec">
        <div class="title">技術與服務</div>
        <div class="info">
            <div class="portfolio-filter">
                <ul class="filter">
                    <li class="active" data-filter="*">全部</li>
                    <li data-filter=".melting">熔金</li>
                    <li data-filter=".extending">壓延</li>
                    <li data-filter=".beating">捶打</li>
                    <li data-filter=".interleaving">出箔</li>
                    <li data-filter=".process">剪裁</li>
                </ul>
            </div>
            <div class="portfolio-wrapper">
                <div class="all-portfolios">
                    <!-- Melting -->
                    <div class="single-portfolio melting">
                        <img class="img-responsive fixsize" src="{{ asset('images/gold/metling1.jpg') }}" alt="">
                    </div>
                    <!-- Extending -->
                    <div class="single-portfolio extending">
                        <img class="img-responsive fixsize" src="{{ asset('images/gold/rolling1a.jpg') }}" alt="">
                    </div>
                    <div class="single-portfolio extending">
                        <img class="img-responsive fixsize" src="{{ asset('images/gold/rolling1b.jpg') }}" alt="">
                    </div>
                    <div class="single-portfolio extending">
                        <img class="img-responsive fixsize" src="{{ asset('images/gold/rolling1c.jpg') }}" alt="">
                    </div>
                    <!-- Beating -->
                    <div class="single-portfolio beating">
                        <img class="img-responsive fixsize" src="{{ asset('images/gold/beating1.jpg') }}" alt="">
                    </div>
                    <div class="single-portfolio beating">
                        <img class="img-responsive fixsize" src="{{ asset('images/gold/beating2.jpg') }}" alt="">
                    </div>
                    <div class="single-portfolio beating">
                        <img class="img-responsive fixsize" src="{{ asset('images/gold/beating3.jpg') }}" alt="">
                    </div>
                    <div class="single-portfolio beating">
                        <img class="img-responsive fixsize" src="{{ asset('images/gold/beating4.jpg') }}" alt="">
                    </div>
                    <div class="single-portfolio beating">
                        <img class="img-responsive fixsize" src="{{ asset('images/gold/beating5.jpg') }}" alt="">
                    </div>
                    <!-- Interleaving -->
                    <div class="single-portfolio interleaving">
                        <img class="img-responsive fixsize" src="{{ asset('images/gold/interleaving1.jpg') }}" alt="">
                    </div>
                    <div class="single-portfolio interleaving">
                        <img class="img-responsive fixsize" src="{{ asset('images/gold/interleaving2.jpg') }}" alt="">
                    </div>
                    <!-- Process -->
                    <div class="single-portfolio process">
                        <img class="img-responsive fixsize" src="{{ asset('images/gold/examining1.jpg') }}" alt="">
                    </div>
                    <div class="single-portfolio process">
                        <img class="img-responsive fixsize" src="{{ asset('images/gold/packaging1.jpg') }}" alt="">
                    </div>
                    <div class="single-portfolio process">
                        <img class="img-responsive fixsize" src="{{ asset('images/gold/cutting1.jpg') }}" alt="">
                    </div>
                    <div class="single-portfolio process">
                        <img class="img-responsive fixsize" src="{{ asset('images/gold/cutting2.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Portfolio Section -->

    <br><br><br>
</body>
</x-app-layout>
</html>
