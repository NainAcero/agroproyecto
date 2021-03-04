<x-guest-layout>

<main id="main" class="main-site">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="#" class="link">Inicio</a></li>
                <li class="item-link"><span><a href="/admin/descuento" class="link">Descuentos</a></span></li>
            </ul>
        </div>

        @if (session('notification'))
            <div class="alert alert-success">
                <strong>Success</strong> {{ session('notification') }}
            </div>
        @endif

        <br>
            <div class="text-right">
                <a href="{{ route('admin.descuento.create') }}" class="btn btn-primary"> Crear Descuento</a>
            </div>
        <br>

        <div>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">Ticket</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Descuento</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Termina</th>
                    <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody id="category-lista">
                    @foreach($discounts as $discount)
                    <tr>
                        <td>{{ $discount->ticket }}</td>
                        <td>{{ $discount->quantity }}</td>
                        <td>{{ $discount->discount }}</td>
                        <td>{{ $discount->type }}</td>
                        <td>{{ $discount->fin_date }}</td>
                        <td>
                            <a href="{{ route('admin.descuento.edit', ['id'=>$discount->id]) }}" class="btn btn-warning" ><i class="fas fa-edit"></i></a>
                            <a href="{{ route('admin.descuento.destroy', ['id'=>$discount->id]) }}" class="btn btn-danger" ><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div id="paginador">

            </div>
        </div>
    </div><!--end container-->

</main>

</x-guest-layout>
