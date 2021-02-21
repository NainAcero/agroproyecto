const proveedor_lista = document.getElementById("proveedor-lista");
const paginador = document.getElementById("paginador");
const alerta = document.getElementById("alerta");
const table_proveedor = document.getElementById("table-proveedores");
const formulario_proveedor = document.getElementById("formulario-proveedor");
const error_body = document.getElementById("error-body");

const pruc = document.getElementById("pruc");
const pnombre = document.getElementById("pnombre");
const padress = document.getElementById("padress");
const ptelefono = document.getElementById("ptelefono");
const pid = document.getElementById("pid");
const encodings = document.getElementById("encodings");

var skip = 0;

$(function () {
    $('#proveedor-create').submit(registerProveedor);

    const bottom_register = document.getElementById("bottom-register");
    const buscar = document.getElementById("buscar");
    const register_prov = document.getElementById("proveedor-create");

    const url = `/admin/proveedor/ajax/${skip}`;
    $.getJSON(url, ajaxGet);

    let timeout;

    buscar.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            encodings.innerHTML = "";
            pruc.value = null;
            pnombre.value = null;
            padress.value = null;
            ptelefono.value = null;
            pid.value = null;
            pruc.disabled = false;

            table_proveedor.style.display="none";
            error_body.innerHTML = "";
            formulario_proveedor.style.display="block";
            const url = `/admin/proveedor/show/${buscar.value}`;
            $.getJSON(url, ajaxGetProveedor);
        }else if(buscar.value == ""){
            table_proveedor.style.display="block";
            formulario_proveedor.style.display="none";
            error_body.innerHTML = "";
            const url = `/admin/proveedor/ajax/${skip}`;
            $.getJSON(url, ajaxGet);
        }else{
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                const url = `/admin/proveedor/all/${buscar.value}`;
                $.getJSON(url, ajaxGetAll);
            },1000)
        }
      });

    function registerProveedor(e) {
        e.preventDefault();

        var $form = $(this);
        var html = "";

        bottom_register.disabled=true;

        var options = {
            url: $form.attr("action"),
            type: $form.attr("method"),
            data: $form.serialize(),
            dataType: 'JSON'
        };

        $.ajax(options).done(function (resp) {
            if(resp.data != null){
                register_prov.reset();

                html += ` <div class="alert alert-success" role="alert"> <ul>`;
                html += `<li>Proveedor  ${resp.data.nombre} Enviado con éxito</li>`;
                html += `</ul> </div> `;

                error_body.innerHTML = html;
                bottom_register.disabled=false;
                pruc.disabled = false;

            }else if(resp.error != null){
                html += ` <div class="alert alert-danger" role="alert"> <ul>`;
                resp.error.forEach(function(error) { html += `<li>${error}</li>`; });
                html += `</ul> </div> `;

                error_body.innerHTML = html;
                bottom_register.disabled=false;
            }

        });
    }

});

function changepage(i){
    skip = (i-1)*5;
    const url = `/admin/proveedor/ajax/${skip}`;
    $.getJSON(url, ajaxGet);
}

function update(ruc){
    table_proveedor.style.display="none";
    formulario_proveedor.style.display="block";
    const url = `/admin/proveedor/edit/${ruc}`;
    $.getJSON(url, ajaxGetProveedor);
}

function deleteP(ruc){
    Swal.fire({
        title: 'Eliminar Proveedor',
        text: "Esta seguro de eliminar " + ruc,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = `/admin/proveedor/destroy/${ruc}`;
            $.getJSON(url, ajaxDestroyProveedor);

            changepage(1);
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            )
        }
      });
}

function ajaxDestroyProveedor(data){
    console.log(data);
}

function back(){
    pruc.value = null;
    pnombre.value = null;
    padress.value = null;
    ptelefono.value = null;
    pid.value = null;
    pruc.disabled = false;
    table_proveedor.style.display="block";
    formulario_proveedor.style.display="none";
    error_body.innerHTML = "";
    this.buscar.value = null;

    changepage(1);
}

function ajaxGet(data){
    alerta.style.display = "none";
    var html = "";
    var pag = "";
    data.data.forEach(element => {
        html += ` <tr> <td>`;
        html += (element.imagen == null)? `<img src="/img/photo.jpg" width="40px"/>` : "";
        html += `</td>
            <td>${element.ruc}</td>
            <td>${element.nombre}</td>
            <td>${element.adress}</td>
            <td>${element.telefono}</td>
            <td>
                <button type="button" class="btn btn-warning" onclick="update(${element.ruc})"><i class="fas fa-edit"></i></button>
                <button type="button" class="btn btn-danger" onclick="deleteP(${element.ruc})"><i class="far fa-trash-alt"></i></button>
            </td></tr>`;
    });
    proveedor_lista.innerHTML = html;
    pag += `
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item disabled">
            <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
            </li>`;
            for (var i = 1; i <= Math.ceil(data.total/5); i++) {
                if(skip == (i-1)*5){
                    pag += `<li class="page-item active" onclick="changepage(${i})"><a class="page-link" href="#">${i}</a></li>`;
                }else{
                    pag += `<li class="page-item" onclick="changepage(${i})"><a class="page-link" href="#">${i}</a></li>`;
                }
            }

            pag += `<li class="page-item disabled">
            <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
            </li>
        </ul>
    </nav>`;
    paginador.innerHTML = pag;
}

function ajaxGetProveedor(data){
    if(data != null){
        pruc.value = data.data.ruc;
        pruc.disabled = true;
        pnombre.value = data.data.nombre;
        padress.value = data.data.adress;
        ptelefono.value = data.data.telefono;
        pid.value = data.data.id;
    }

}

function ajaxGetAll(data){
    var html = "";
    if(data.data.length > 0){
        data.data.forEach(element => {
            html += `<option value="${element.nombre}">`;
        });
    }
    encodings.innerHTML = html;
}
