<div>

    <main id="main" class="main-site">

    <div class="container">
        @php
            $con_prod=0;
            $con_user=0;
        @endphp
        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="/" class="link">home</a></li>
                <li class="item-link"><span>Dashboard</span></li>
            </ul>
        </div>
        <div class=" main-content-area">
            <div class="row">
                <div class="col-md-3">
                <div class="metric">
                    <span class="icon"><i class="fas fa-tag"></i></span>
                    <p>
                        <span class="number">
                            @foreach($productos as $producto)
                                @php
                                    $con_prod += $producto->quantity;
                                @endphp
                            @endforeach
                            {{ $con_prod }}
                        </span>
                        <span class="title">PRODUCTOS</span>
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="metric">
                    <span class="icon"><i class="fa fa-shopping-bag"></i></span>
                    <p>
                        <span class="number">{{ $total }}</span>
                        <span class="title">COMPRAS</span>
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="metric">
                    <span class="icon"><i class="fas fa-dollar-sign"></i></span>
                    <p>
                        <span class="number">{{ $facturas->count() }}</span>
                        <span class="title">PAGOS</span>
                    </p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="metric">
                    <span class="icon"><i class="fas fa-users"></i></i></span>
                    <p>
                        <span class="number">
                            @foreach($usuarios as $user)
                                @php
                                    $con_user += 1;
                                @endphp
                            @endforeach
                            {{ $con_user }}
                        </span>
                        <span class="title">USUARIOS</span>
                    </p>
                </div>
            </div>
        </div>

        <table class="table" >
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Subtotal</th>
                        <th scope="col">Impuesto</th>
                        <th scope="col">Total</th>
                        <th scope="col">Descuento</th>
                        <th scope="col">Tipo Descuento</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody id="producto-lista">
                    @foreach($facturas as $factura)
                    <tr>
                        <td>{{ $factura->id }}</td>
                        <td>$ {{ $factura->subtotal }}</td>
                        <td>$ {{ $factura->tax }}</td>
                        <td>$ {{ $factura->total }}</td>
                        @if($factura->historial == null)
                            <td>$ 0.00</td>
                            <td> --- </td>
                        @else
                            <td>{{ $factura->historial->descuento }}</td>
                            <td>{{ $factura->historial->type }}</td>
                        @endif

                        <td>{{ $factura->created_at }}</td>
                        <td>
                            <a href="{{ route('factura.show', [ "id" => $factura->id]) }}" class="btn btn-success"><i class="fas fa-eye"></i></a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div><!--end main content area-->
    </div><!--end container-->

</main>

</div>
