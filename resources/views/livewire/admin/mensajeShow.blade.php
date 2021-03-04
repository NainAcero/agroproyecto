<x-guest-layout>
<main id="main" class="main-site">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="#" class="link">Inicio</a></li>
                <li class="item-link"><span><a href="/contacto" class="link">Mensajes</a></span></li>
            </ul>
        </div>

        <div class="card bg-light">

             <div class="card-body">
                <ul class="list-group my-2">
                    <li class="list-group-item list-group-item-primary primary " style="background-color: #EEEFF0"><b>Datos del Cliente</b></li>
                    <li class="list-group-item"><b>Usuario: </b>{{ $contacto->name }}</li>
                    <li class="list-group-item"><b>Email: </b>{{ $contacto->email }}</li>
                    <li class="list-group-item"><b>Creación cuenta: </b>{{ $contacto->created_at }}</li>
                    <li class="list-group-item"><b>Mensaje: </b>{{ $contacto->comentario }}</li>
                </ul>
            </div>

            <div class="card-body">
                <h3 class="box-title" style="font-size:24px"><b>Enviar Mensaje</b></h3>
                <form action="{{ route('admin.gmail') }}" method="post" name="frm-billing" id="producto-create">
                    @csrf
                    <p class="row-in-form" style="padding-right:10px; padding-left:10px">
                        <label for="pname">Titulo<span>*</span></label>
                        <input id="pname" class="form-control" type="text" name="titulo" value="" placeholder="Titulo">
                    </p>
                    <p class="row-in-form" style="padding-right:10px; padding-left:10px">
                        <label for="pname">Descripción<span>*</span></label>
                        <textarea name="descripcion" class="form-control"  rows="10"></textarea>
                    </p>
                    <input type="hidden" id="pid" name="email" value="{{ $contacto->email }}" >
                    <input type="submit" class="btn btn-success" id="bottom-register" value="Enviar">
                </form>
            </div>
        </div>
    </div><!--end container-->
</main>

</x-guest-layout>
