@extends('layouts.app')

@section('title', 'Products - abcsheba.com')

@section('content')

<!-- Page Content -->
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <!-- Sidebar Filter -->
            <div class="col-md-12 col-lg-4 col-xl-3">
                <div class="card search-filter">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Filter Products</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('products') }}" method="GET">
                            <div class="filter-widget">
                                <h4>Search</h4>
                                <input type="text" name="search" class="form-control" placeholder="Search products..." value="{{ request('search') }}">
                            </div>
                            <div class="filter-widget">
                                <h4>Categories</h4>
                                @foreach($categories as $category)
                                <div>
                                    <label class="custom_check">
                                        <input type="radio" name="category" value="{{ $category->id }}" {{ request('category') == $category->id ? 'checked' : '' }}>
                                        <span class="checkmark"></span> {{ $category->name }}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                            <div class="btn-search">
                                <button type="submit" class="btn btn-block w-100">Filter</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /Sidebar Filter -->

            <!-- Product Grid -->
            <div class="col-md-12 col-lg-8 col-xl-9">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="row">
                    @forelse($products as $product)
                    <div class="col-md-6 col-lg-4 col-xl-4">
                        <div class="card product-card h-100">
                            <a href="{{ route('products.show', $product->id) }}">
                                <img src="{{ $product->image ? asset('storage/'.$product->image) : asset('assets/img/products/product-1.jpg') }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                            </a>
                            <div class="card-body">
                                <span class="badge bg-primary mb-2">{{ $product->category->name ?? 'General' }}</span>
                                <h5 class="card-title">
                                    <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                                </h5>
                                <div class="product-price">
                                    @if($product->sale_price)
                                        <span class="text-muted text-decoration-line-through me-2">৳{{ number_format($product->price, 2) }}</span>
                                        <span class="text-primary fw-bold">৳{{ number_format($product->sale_price, 2) }}</span>
                                        <span class="badge bg-danger">{{ $product->discount_percentage }}% OFF</span>
                                    @else
                                        <span class="text-primary fw-bold">৳{{ number_format($product->price, 2) }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-0 pt-0">
                                <form action="{{ route('cart.add') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="alert alert-info">No products found.</div>
                    </div>
                    @endforelse
                </div>

                <div class="load-more text-center mt-4">
                    {{ $products->withQueryString()->links() }}
                </div>
            </div>
            <!-- /Product Grid -->
        </div>

    </div>
</div>
<!-- /Page Content -->
@endsection

@push('styles')
<style>
    .product-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    }
    .product-card .card-title a {
        color: #272b41;
        text-decoration: none;
    }
    .product-card .card-title a:hover {
        color: #09e5ab;
    }
</style>
@endpush
