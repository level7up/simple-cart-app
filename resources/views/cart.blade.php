@extends('layouts.app')

<style type="text/css">
    body{margin-top:20px;}
    select.form-control:not([size]):not([multiple]) {
        height: 44px;
    }
    select.form-control {
        padding-right: 38px;
        background-position: center right 17px;
        background-image: url(data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNv…9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8Zz4KPC9nPgo8L3N2Zz4K);
        background-repeat: no-repeat;
        background-size: 9px 9px;
    }
    .form-control:not(textarea) {
        height: 44px;
    }
    .form-control {
        padding: 0 18px 3px;
        border: 1px solid #dbe2e8;
        border-radius: 22px;
        background-color: #fff;
        color: #606975;
        font-family: "Maven Pro",Helvetica,Arial,sans-serif;
        font-size: 14px;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
    }

    .shopping-cart,
    .wishlist-table,
    .order-table {
        margin-bottom: 20px
    }

    .shopping-cart .table,
    .wishlist-table .table,
    .order-table .table {
        margin-bottom: 0
    }

    .shopping-cart .btn,
    .wishlist-table .btn,
    .order-table .btn {
        margin: 0
    }

    .shopping-cart>table>thead>tr>th,
    .shopping-cart>table>thead>tr>td,
    .shopping-cart>table>tbody>tr>th,
    .shopping-cart>table>tbody>tr>td,
    .wishlist-table>table>thead>tr>th,
    .wishlist-table>table>thead>tr>td,
    .wishlist-table>table>tbody>tr>th,
    .wishlist-table>table>tbody>tr>td,
    .order-table>table>thead>tr>th,
    .order-table>table>thead>tr>td,
    .order-table>table>tbody>tr>th,
    .order-table>table>tbody>tr>td {
        vertical-align: middle !important
    }

    .shopping-cart>table thead th,
    .wishlist-table>table thead th,
    .order-table>table thead th {
        padding-top: 17px;
        padding-bottom: 17px;
        border-width: 1px
    }

    .shopping-cart .remove-from-cart,
    .wishlist-table .remove-from-cart,
    .order-table .remove-from-cart {
        display: inline-block;
        color: #ff5252;
        font-size: 18px;
        line-height: 1;
        text-decoration: none
    }

    .shopping-cart .count-input,
    .wishlist-table .count-input,
    .order-table .count-input {
        display: inline-block;
        width: 100%;
        width: 86px
    }

    .shopping-cart .product-item,
    .wishlist-table .product-item,
    .order-table .product-item {
        display: table;
        width: 100%;
        min-width: 150px;
        margin-top: 5px;
        margin-bottom: 3px
    }

    .shopping-cart .product-item .product-thumb,
    .shopping-cart .product-item .product-info,
    .wishlist-table .product-item .product-thumb,
    .wishlist-table .product-item .product-info,
    .order-table .product-item .product-thumb,
    .order-table .product-item .product-info {
        display: table-cell;
        vertical-align: top
    }

    .shopping-cart .product-item .product-thumb,
    .wishlist-table .product-item .product-thumb,
    .order-table .product-item .product-thumb {
        width: 130px;
        padding-right: 20px
    }

    .shopping-cart .product-item .product-thumb>img,
    .wishlist-table .product-item .product-thumb>img,
    .order-table .product-item .product-thumb>img {
        display: block;
        width: 100%
    }

    @media screen and (max-width: 860px) {
        .shopping-cart .product-item .product-thumb,
        .wishlist-table .product-item .product-thumb,
        .order-table .product-item .product-thumb {
            display: none
        }
    }

    .shopping-cart .product-item .product-info span,
    .wishlist-table .product-item .product-info span,
    .order-table .product-item .product-info span {
        display: block;
        font-size: 13px
    }

    .shopping-cart .product-item .product-info span>em,
    .wishlist-table .product-item .product-info span>em,
    .order-table .product-item .product-info span>em {
        font-weight: 500;
        font-style: normal
    }

    .shopping-cart .product-item .product-title,
    .wishlist-table .product-item .product-title,
    .order-table .product-item .product-title {
        margin-bottom: 6px;
        padding-top: 5px;
        font-size: 16px;
        font-weight: 500
    }

    .shopping-cart .product-item .product-title>a,
    .wishlist-table .product-item .product-title>a,
    .order-table .product-item .product-title>a {
        transition: color .3s;
        color: #374250;
        line-height: 1.5;
        text-decoration: none
    }

    .shopping-cart .product-item .product-title>a:hover,
    .wishlist-table .product-item .product-title>a:hover,
    .order-table .product-item .product-title>a:hover {
        color: #0da9ef
    }

    .shopping-cart .product-item .product-title small,
    .wishlist-table .product-item .product-title small,
    .order-table .product-item .product-title small {
        display: inline;
        margin-left: 6px;
        font-weight: 500
    }

    .wishlist-table .product-item .product-thumb {
        display: table-cell !important
    }

    @media screen and (max-width: 576px) {
        .wishlist-table .product-item .product-thumb {
            display: none !important
        }
    }

    .shopping-cart-footer {
        display: table;
        width: 100%;
        padding: 10px 0;
        border-top: 1px solid #e1e7ec
    }

    .shopping-cart-footer>.column {
        display: table-cell;
        padding: 5px 0;
        vertical-align: middle
    }

    .shopping-cart-footer>.column:last-child {
        text-align: right
    }

    .shopping-cart-footer>.column:last-child .btn {
        margin-right: 0;
        margin-left: 15px
    }

    @media (max-width: 768px) {
        .shopping-cart-footer>.column {
            display: block;
            width: 100%
        }
        .shopping-cart-footer>.column:last-child {
            text-align: center
        }
        .shopping-cart-footer>.column .btn {
            width: 100%;
            margin: 12px 0 !important
        }
    }

    .coupon-form .form-control {
        display: inline-block;
        width: 100%;
        max-width: 235px;
        margin-right: 12px;
    }

    .form-control-sm:not(textarea) {
        height: 36px;
    }



</style>

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Home') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        {{-- @foreach ($products as $product)
                            <button style="margin-bottom: 10px" class="btn btn-primary">{{$product->name}}</button>
                        @endforeach --}}



                        <div class="container padding-bottom-3x mb-1">
                            <!-- Shopping Cart-->
                            <div class="table-responsive shopping-cart">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th class="text-center">Price</th>
                                            <th class="text-center">Discount</th>
                                            <th class="text-center">subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>
                                                    <div class="product-item">
                                                        <a class="product-thumb" href="#"><img src="https://img1.g-star.com/product/c_fill,f_auto,h_630,q_80/v1614686111/D14143-336-6484-M05/g-star-raw-raw-graphic-slim-t-shirt-black.jpg" alt="Product"></a>
                                                        <div class="product-info">
                                                            <h4 class="product-title"><a href="#">{{$product->name}}</a></h4><span><em>Size:</em> 10.5</span><span><em>Color:</em> Dark Blue</span>
                                                        </div>
                                                    </div>
                                                </td>
                                            
                                                <td class="text-center text-lg text-medium">${{$product->price}}</td>
                                                <td class="text-center text-lg text-medium">${{$product->discount}}</td>
                                                <td class="text-center text-lg text-medium">{{number_format($summ[]= $product->price -($product->price * $product->discount /100),1) }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <div class="shopping-cart-footer">
                                
                                <div class="column text-lg">Subtotal: <span class="text-medium">{{array_sum($summ)}}</span></div>
                            </div>
                            <div class="shopping-cart-footer">
                                <div class="column"><a class="btn btn-outline-secondary" href="#"><i class="icon-arrow-left"></i>&nbsp;Back to Shopping</a></div>
                                <div class="column"><a class="btn btn-primary" href="#" data-toast="" data-toast-type="success" data-toast-position="topRight" data-toast-icon="icon-circle-check" data-toast-title="Your cart" data-toast-message="is updated successfully!">Update Cart</a><a class="btn btn-success" href="#">Checkout</a></div>
                            </div>
                        </div>

                   


                        




                </div>
            </div>
        </div>
    </div>
</div>
@endsection
