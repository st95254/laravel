@include('layouts.head', ['title' => '灃耘 - 商品管理', 'cssPath' => 'css/admin/product.css'])

<x-app-layout>
    <div class="container">
        <div class="title">商品管理</div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif

        <a href="#" class="create" onclick="showCreateForm()">新增商品</a>
        
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>類別</th>
                    <th>名稱</th>
                    <th>價格</th>
                    <th>圖片</th>
                    <th>敘述</th>
                    <!-- <th>Created At</th>
                    <th>Updated At</th> -->
                    <th>存貨</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->product_type }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td><img src="{{ $product->image }}" alt="{{ $product->name }}" width="50"></td>
                    <td>{{ $product->description }}</td>
                    <!-- <td>{{ $product->created_at }}</td>
                    <td>{{ $product->updated_at }}</td> -->
                    <td>{{ $product->in_stock }}</td>
                    <td>
                        <a class="btn btn-primary" href="#" onclick="showEditForm({{ $product }})">編輯</a>
                        <!-- <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">刪除</button>
                        </form> -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Create Product Form -->
        <div id="createForm" style="display:none;">
            <div class="formTitle">新增商品</div>
            <form action="{{ route('product.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="product_type">類別：</label>
                    <input type="text" class="form-control" id="product_type" name="product_type">
                </div>
                <div class="form-group">
                    <label for="name">名稱：</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group">
                    <label for="price">價格：</label>
                    <input type="number" class="form-control" id="price" name="price">
                </div>
                <div class="form-group">
                    <label for="image">圖片：</label>
                    <input type="text" class="form-control" id="image" name="image">
                </div>
                <div class="form-group">
                    <label for="description">敘述：</label>
                    <input type="text" class="form-control" id="description" name="description">
                </div>
                <div class="form-group">
                    <label for="in_stock">存貨：</label>
                    <input type="number" class="form-control" id="in_stock" name="in_stock">
                </div>
                <button type="submit" class="btn btn-primary">提交</button>
                <button type="button" class="btn btn-secondary" onclick="hideCreateForm()">取消</button>
            </form>
        </div>

        <!-- Edit Product Form -->
        <div id="editForm" style="display:none;">
            <div class="formTitle">編輯商品</div>
            <form id="editProductForm" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="edit_product_type">類別：</label>
                    <input type="text" class="form-control" id="edit_product_type" name="product_type">
                </div>
                <div class="form-group">
                    <label for="edit_name">名稱：</label>
                    <input type="text" class="form-control" id="edit_name" name="name">
                </div>
                <div class="form-group">
                    <label for="edit_price">價格：</label>
                    <input type="number" class="form-control" id="edit_price" name="price">
                </div>
                <div class="form-group">
                    <label for="edit_image">圖片：</label>
                    <input type="text" class="form-control" id="edit_image" name="image">
                </div>
                <div class="form-group">
                    <label for="edit_description">敘述：</label>
                    <input type="text" class="form-control" id="edit_description" name="description">
                </div>
                <div class="form-group">
                    <label for="edit_in_stock">存貨：</label>
                    <input type="number" class="form-control" id="edit_in_stock" name="in_stock">
                </div>
                <button type="submit" class="btn btn-primary">更新</button>
                <button type="button" class="btn btn-secondary" onclick="hideEditForm()">取消</button>
            </form>
        </div>   
    </div>

    <br>
</x-app-layout>

<script>
    @if (session('error'))
        alert('{{ session('error') }}');
    @endif

    function showCreateForm() {
        document.getElementById('createForm').style.display = 'block';
    }

    function hideCreateForm() {
        document.getElementById('createForm').style.display = 'none';
    }

    function showEditForm(product) {
        document.getElementById('editForm').style.display = 'block';
        document.getElementById('editProductForm').action = `/admin/product/${product.id}`;
        document.getElementById('edit_product_type').value = product.product_type;
        document.getElementById('edit_name').value = product.name;
        document.getElementById('edit_price').value = product.price;
        document.getElementById('edit_image').value = product.image;
        document.getElementById('edit_description').value = product.description;
        document.getElementById('edit_in_stock').value = product.in_stock;
    }

    function hideEditForm() {
        document.getElementById('editForm').style.display = 'none';
    }
</script>
