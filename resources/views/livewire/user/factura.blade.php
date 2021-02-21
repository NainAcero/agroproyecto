<x-guest-layout>

<main id="main" class="main-site">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="#" class="link">home</a></li>
                <li class="item-link"><span><a href="/facturas" class="link">Facturas</a></span></li>
            </ul>
        </div>

        <table class="table">
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
            <tbody id="category-lista">
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

    </div><!--end container-->

</main>


</x-guest-layout>

