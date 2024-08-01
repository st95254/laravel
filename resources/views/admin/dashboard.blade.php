@include('layouts.head', ['title' => '灃耘 - 後台管理', 'cssPath' => 'css/shared.css'])

<x-app-layout>
    <div class="content">
        <a href="{{ route('admin.history') }}" class="btn">訂單管理</a>
        <a href="{{ route('admin.history') }}" class="btn">商品管理</a>
    </div>

    <hr style="margin: 0 auto;" width="80%" color="#e6e6e6" size="1"><br>
</x-app-layout>

<script>
    @if (session('error'))
        alert('{{ session('error') }}');
    @endif
</script>
