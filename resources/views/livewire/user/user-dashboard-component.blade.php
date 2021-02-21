<div>
    <main class="main-site" >
        <div class="container">
            <div class="card bg-light">
                <br>
                @if(session('status'))
                   <div class="alert alert-success" id="alerta">
                        <strong>Mensaje</strong> {{ session('status') }}
                    </div>
                @endif
                <div class="card-header"><h3>
                <b>CONFIRMAR COMPRA</b>
                </h3></div>

                <div class="card-body">
                    <ul class="list-group my-2">
                        <li class="list-group-item list-group-item-primary primary " style="background-color: #EEEFF0"><b>Datos del Cliente</b></li>
                        <li class="list-group-item"><b>Usuario: </b>{{ Auth::user()->name }}</li>
                        <li class="list-group-item"><b>Email: </b>{{ Auth::user()->email }}</li>
                        <li class="list-group-item"><b>Creación cuenta: </b>{{ Auth::user()->created_at }}</li>
                    </ul>
                </div>

                <div class="card-body">
                    <li class="list-group-item list-group-item-primary primary " style="background-color: #EEEFF0"><b>Productos</b></li>
                    <br>
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">PRECIO</th>
                            <th scope="col">CANTIDAD</th>
                            <th scope="col">SUBTOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(Cart::content() as $item)
                            <tr>
                                <td>
                                    <div class="product-image" style="display:inline-block">
                                        <figure><img src="{{ asset('assets/images/products' ) }}/{{ $item->model->image }}" alt="{{ $item->model->name }}" width="60px"></figure>
                                    </div>
                                </td>
                                <td>
                                    <a class="link-to-product" href="{{ route('product.details', ['slug'=>$item->model->slug]) }}">{{ $item->model->name }}</a>
                                </td>
                                <td>
                                    <p class="price">${{ $item->model->regular_price }}</p>
                                </td>
                                <td>
                                    <p class="price">{{ $item->qty }}</p>
                                </td>
                                <td>
                                    <p class="price">${{ $item->subtotal }}</p>
                                </td>
                            </tr>
                           @endforeach
                        </tbody>
                    </table>
                    <div class="summary">
                        <div class="order-summary">
                            <h4 class="title-box">Order Summary</h4>
                            <p class="summary-info"><span class="title">Subtotal</span><b class="index">${{Cart::subtotal()}}</b></p>
                            <p class="summary-info"><span class="title">Impuesto</span><b class="index">${{Cart::tax()}}</b></p>
                            <p class="summary-info total-info "><span class="title">Total</span><b class="index">${{ $total }}</b></p>
                            <p class="summary-info total-info "><span class="title">Total Descuento</span><b class="index">${{ $desc }}</b></p>
                            <br>
                            <a class="btn btn-lg btn-block btn-primary" href="/paypal/pay">COMPRAR</a>
                            <br>
                        </div>

                     </div>
                </div>
            </div>

        </div>
    </main>
</div>

@section('livewireScripts')

@endsection
{{--
    <div class="product-image" style="display:inline-block">
                                    <figure><img src="{{ asset('assets/images/products' ) }}/{{ $item->model->image }}" alt="{{ $item->model->name }}" width="60px"></figure>
                                </div>
                                <div class="product-name" style="display:inline-block">
                                    <a class="link-to-product" href="{{ route('product.details', ['slug'=>$item->model->slug]) }}">{{ $item->model->name }}</a>
                                </div>
                                <div class="price-field produtc-price" style="display:inline-block"><p class="price">${{ $item->model->regular_price }}</p></div>
                                <div class="price-field sub-total" style="display:inline-block"><p class="price">${{ $item->subtotal }}</p></div>
                            --}}
