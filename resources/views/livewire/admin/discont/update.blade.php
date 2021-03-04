<x-guest-layout>

<main id="main" class="main-site">

    <div class="container">

        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="/" class="link">Inicio</a></li>
                <li class="item-link"><span><a href="/admin/descuento" class="link">Descuentos</a></span></li>
            </ul>
        </div>

        <div class=" main-content-area">
            <div id="error-body"></div>
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                </div>
            @endif
             <div class="wrap-address-billing">

                <div >
                    <form action="{{ route('admin.descuento.update', ['id'=>$discount->id]) }}" method="post" name="frm-billing" id="producto-create">
                        @csrf
                        <p class="row-in-form" style="padding-right:10px; padding-left:10px">
                            <label for="pname">Ticket<span>*</span></label>
                            <input id="pname" type="text" name="ticket" value="{{ $discount->ticket }}" >
                        </p>
                        <p class="row-in-form" style="padding-right:10px; padding-left:10px">
                            <label for="pprecio">Cantidad<span>*</span></label>
                            <input id="pprecio" type="number" name="quantity" value="{{ $discount->quantity }}">
                        </p>

                        <p class="row-in-form" style="padding-right:10px; padding-left:10px">
                            <label for="pdescription">Descuento<span>*</span></label>
                             <input id="pprecio" type="number" name="discount" value="{{ $discount->discount }}">
                        </p>

                        <p class="row-in-form" style="padding-right:10px; padding-left:10px">
                            <label for="pshortdescription">Tipo de Descuento<span>*</span></label>
                            <select class="form-control" name="type">
                                @if($discount->type == "porcentage")
                                    <option value="porcentage" selected>PORCENTAJE</option>
                                    <option value="money">Moneda</option>
                                @else

                                    <option value="money" selected>Moneda</option>
                                    <option value="porcentage">PORCENTAJE</option>
                                @endif
                            </select>
                        </p>
                        <p class="row-in-form" style="padding-right:10px; padding-left:10px">
                            <label for="pquantity">Fecha Caducidad*<span>*</span></label>
                            <input class="form-control" type="date" name="fin_date" value="{{ $discount->fin_date }}">
                        </p>
                        <input type="hidden" id="pid" name="id" value="" >
                        <input type="submit" class="btn btn-success" id="bottom-register" value="Enviar">
                    </form>
                </div>

            </div>

        </div><!--end main content area-->
    </div><!--end container-->

</main>

</x-guest-layout>

