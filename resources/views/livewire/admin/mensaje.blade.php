<x-guest-layout>

<main id="main" class="main-site">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="#" class="link">Inicio</a></li>
                <li class="item-link"><span><a href="/contacto" class="link">Mensajes</a></span></li>
            </ul>
        </div>

        @if (session('notification'))
            <div class="alert alert-success">
                <strong>Success</strong> {{ session('notification') }}
            </div>
        @endif

        <div>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Email</th>
                    <th scope="col">Comentario</th>
                    <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody id="category-lista">
                    @foreach($mensajes as $mensaje)
                    <tr>
                        <td>{{ $mensaje->name }}</td>
                        <td>{{ $mensaje->email }}</td>
                        <td>{{ $mensaje->comentario }}</td>
                        <td>
                            <a href="{{ route('admin.enviar', ['id'=>$mensaje->id]) }}" class="btn btn-warning" ><i class="fas fa-send"></i></a>
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
