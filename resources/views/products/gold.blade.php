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
        fetch(`/products/gold/fetch-gold-prices`)
            .then(response => response.json())
            .then(data => {
                console.log("Received price from API:", data); // 調試，檢查返回的數據

                // 更新倫敦即時金價和匯率
                document.getElementById('goldPrice').innerText = data.gold_price;
                document.getElementById('exchangeRate').innerText = data.exchange_rate;

                // 定義計算公式對應表
                const calculations = {
                    total0: (price) => (price / 31.10347) * 15.653 * leafAmount * 0.00015,
                    total1: (price) => (price / 31.10347) * 28.09 * leafAmount * 0.00015,
                    total2: (price) => (price / 31.10347) * 64.997 * leafAmount * 0.00015,
                    total3: (price) => (price / 31.10347) * 264.8249 * leafAmount * 0.00015,
                    total4: (price) => (price / 31.10347) * 15.653 * leafAmount * 0.000135,
                    total5: (price) => (price / 31.10347) * 28.09 * leafAmount * 0.000135,
                    total6: (price) => (price / 31.10347) * 64.997 * leafAmount * 0.000135,
                    total7: (price) => (price / 31.10347) * 264.8249 * leafAmount * 0.000135
                };

                // 遍歷每個計算項目並應用公式
                Object.keys(calculations).forEach((id, index) => {
                    const element = document.getElementById(id);
                    if (element) {
                        const calculatedValue = calculations[id](data.gold_price_NTD);
                        // 格式化數字，保留兩位小數並加上逗號和貨幣單位 "NT$"
                        element.innerText = 'NT$' + calculatedValue.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }); 

                        // 如果 leafAmount 是 100，則更新到伺服器
                        if (leafAmount == 100) {
                            updateGoldPriceOnServer(index, calculatedValue.toFixed(0)); // 固定到 0 位小數
                        }
                    } else {
                        console.error(`Element ${id} not found`);
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
                        <td>9 分</td>
                        <td>2.65 公分 x 2.65 公分</td>
                        <td id="total0"></td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>一號金箔</td>
                            <td>1 吋 2</td>
                        <td>3.55 公分 x 3.55 公分</td>
                        <td id="total1"></td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>一號金箔</td>
                        <td>1 吋 8</td>
                        <td>5.40 公分 x 5.40 公分</td>
                        <td id="total2"></td>
                    </tr>
                    <tr>
                        <th scope="row">4</th>
                        <td>一號金箔</td>
                        <td>3 吋 6</td>
                        <td>10.9 公分 x 10.9 公分</td>
                        <td id="total3"></td>
                    </tr>
                    <tr>
                        <th scope="row">5</th>
                        <td>四號金箔</td>
                        <td>9 分</td>
                        <td>2.65 公分 x 2.65 公分</td>
                        <td id="total4"></td>
                    </tr>
                    <tr>
                        <th scope="row">6</th>
                        <td>四號金箔</td>
                        <td>1 吋 2</td>
                        <td>3.55 公分 x 3.55 公分</td>
                        <td id="total5"></td>
                    </tr>
                    <tr>
                        <th scope="row">7</th>
                        <td>四號金箔</td>
                        <td>1 吋 8</td>
                        <td>5.40 公分 x 5.40 公分</td>
                        <td id="total6"></td>
                    </tr>
                    <tr>
                        <th scope="row">8</th>
                        <td>四號金箔</td>
                        <td>3 吋 6</td>
                        <td>10.9 公分 x 10.9 公分</td>
                        <td id="total7"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="goldPriceContainer">
            <p>倫敦即時金價 (USD/oz)：<span id="goldPrice"> 加載中...</span></p>
            <p>即時匯率 (USD/TWD)： <span id="exchangeRate"> 加載中...</span></p>
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
            <!-- <a href="https://drive.google.com/file/d/1R8QKJv1LBJ0ccKB1VJJAoXU_WyCMiGbc/view?usp=sharing" class="proof_btn" target="_blank">金箔材料</a> -->
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
