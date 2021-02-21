<x-guest-layout>

<main id="main" class="main-site">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="#" class="link">home</a></li>
                <li class="item-link"><span><a href="/factura" class="link">Facturas</a></span></li>
            </ul>
        </div>


        <div class="card bg-light">

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
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detallefacturas as $item)
                            <tr>
                                <td>
                                    <div class="product-image" style="display:inline-block">
                                        <figure><img src="{{ asset('assets/images/products' ) }}/{{ $item->imagen }}" alt="{{ $item->nombre }}" width="60px"></figure>
                                    </div>
                                </td>
                                <td>
                                    <a class="link-to-product" href="#">{{ $item->nombre }}</a>
                                </td>
                                <td>
                                    <p class="price">${{ $item->precio }}</p>
                                </td>
                                <td>
                                    <p class="price">{{ $item->cantidad }}</p>
                                </td>
                            </tr>
                           @endforeach
                        </tbody>
                    </table>
                    <div class="summary">
                        <div class="order-summary">
                            <h4 class="title-box">Order Summary</h4>
                            <p class="summary-info"><span class="title">Subtotal</span><b class="index">${{ $factura->subtotal }}</b></p>
                            <p class="summary-info"><span class="title">Impuesto</span><b class="index">${{ $factura->total }}</b></p>
                            <p class="summary-info total-info "><span class="title">Total</span><b class="index">${{ $factura->total }}</b></p>
                            @if($factura->historial == null)
                                <p class="summary-info total-info "><span class="title">Sin descuento</p>
                                <br>
                            @else
                                <p class="summary-info total-info "><span class="title">Total Descuento</span><b class="index">${{ $desc }}</b></p>
                                <br>
                            @endif

                        </div>

                     </div>
                </div>

        </div>

    </div><!--end container-->

</main>


</x-guest-layout>

