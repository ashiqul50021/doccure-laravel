@extends('layouts.app')

@section('title', 'Products - abcsheba.com')

@section('content')

<!-- Page Content -->
<div class="content">
    <div class="container">

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
                        <div class="product-item h-100 d-flex flex-column">
                            <div class="product-img">
                                <a href="{{ route('products.show', $product->id) }}">
                                    <img src="{{ $product->image ? asset($product->image) : asset('assets/img/products/product-1.jpg') }}" class="product-img" alt="{{ $product->name }}" style="height: 200px; object-fit: cover; width: 100%;">
                                </a>
                            </div>
                            <div class="product-info flex-grow-1 d-flex flex-column">
                                <span class="product-category">{{ $product->category->name ?? 'General' }}</span>
                                <h4 class="product-title">
                                    <a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a>
                                </h4>
                                <div class="product-price">
                                    @if($product->sale_price)
                                        <span class="current-price">৳{{ number_format($product->sale_price, 2) }}</span>
                                        <span class="original-price">৳{{ number_format($product->price, 2) }}</span>
                                    @else
                                        <span class="current-price">৳{{ number_format($product->price, 2) }}</span>
                                    @endif
                                </div>
                                <form action="{{ route('cart.add') }}" method="POST" class="add-to-cart-form mt-auto">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <div class="row gx-2">
                                        <div class="col-6">
                                            <button type="submit" class="btn-add-cart w-100">
                                                <i class="fas fa-shopping-cart"></i> Cart
                                            </button>
                                        </div>
                                        <div class="col-6">
                                            <button type="submit" name="buy_now" value="1" class="btn-buy-now w-100">
                                                <i class="fas fa-bolt"></i> Buy
                                            </button>
                                        </div>
                                    </div>
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

@push('scripts')
<script>
    $(document).ready(function() {
        // Auto submit form when category is changed
        $('input[name="category"]').on('change', function() {
            $(this).closest('form').submit();
        });
    });
</script>
@endpush

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

    /* Button Styles */
    .btn-add-cart, .btn-buy-now {
        width: 100%;
        padding: 8px 5px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 13px;
        cursor: pointer;
        transition: all 0.3s;
        margin-top: auto;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        height: 38px;
    }

    /* Add to Cart Button */
    .btn-add-cart {
        background: linear-gradient(135deg, #0066ff, #00c6ff);
        border: none;
        color: #fff;
    }

    .btn-add-cart:hover {
        background: linear-gradient(135deg, #0052cc, #00a8e0);
        transform: translateY(-2px);
        color: #fff;
    }

    /* Buy Now Button */
    .btn-buy-now {
        background: #fff;
        border: 1px solid #0066ff;
        color: #0066ff;
    }

    .btn-buy-now:hover {
        background: #0066ff;
        color: #fff;
        transform: translateY(-2px);
    }

    .btn-add-cart i, .btn-buy-now i {
        margin-right: 4px;
        font-size: 12px;
    }
</style>
@endpush
