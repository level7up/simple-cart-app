@extends('layouts.app')

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




                    <div class="tab-content" id="myTabContent">
                        <!-- Start Single Tab -->
                        <div class="tab-pane fade show active" id="man" role="tabpanel">
                            <div class="tab-single">
                                <div class="row">

                                    @foreach ($products as $product)
                                        <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                                            <div class="single-product">
                                                <div class="product-img">
                                                    <a href="{{url('posts/'. $product['id'] .'')}}">
                                                        <img class="default-img"width="150px" src="https://assets.ajio.com/medias/sys_master/root/20210403/GEud/606885be7cdb8c1f14774922/-473Wx593H-461575169-maroon-MODEL.jpg" alt="#">
                                                    </a>
                                                    <div class="button-head">
                                                        <div class="product-action">
                                                           
                                                        </div>
                                                        <div class="product-action-2">
                                                            <a title="Add to cart" href="#">{{ $product['price'] }}$</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="product-content">
                                                    <h3><a href="{{url('posts/'. $product['id'] .'')}}">{{ $product['name'] }}</a></h3>
                                                    <div class="product-price">
                                                        <span>{{ $product['descreption'] }}</span>
                                                        <form action="/add_to_cart" method="POST">
                                                            {{csrf_field()}}
                                                            <input type="hidden" name="product_id" value="{{$product['id']}}" >
                                                            <button style="margin-bottom: 10px" class="btn btn-primary">Add to cart</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                 
                                </div>
                            </div>
                        </div>
                        <!--/ End Single Tab -->
                       
                    </div>
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
