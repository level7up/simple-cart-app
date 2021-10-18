@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Cart') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        @foreach ($products as $product)
                            <div>
                                <div>
                                    {{$product->name}}  &nbsp; &nbsp;   ${{$product->price}}
                                </div>
                            </div>
                        @endforeach
                        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
                        <p>Subtotal:  ${{$subtotal}}</p>
                        <p>Shipping:  ${{number_format($total_shipping, 2)}}</p>
                        <p>VAT:  ${{$vat}}</p>
                        @if ($cond = true)
                        <p>Discounts:</p>
                            
                        @endif
                        @if ($shoes_discount>0)
                        <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            10% off shoes: -${{$shoes_discount}}</p>
                        @endif
                        @if($jaket_discount>0)
                        <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            50% off jacket: -${{$jaket_discount}}</p>
                        @endif
                        @if ($shipping_discount>0)
                        <p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            $10 of shipping: -${{$shipping_discount}}</p>
                           
                        @endif
                        <p>Total: ${{$total}}</p>
                        


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
