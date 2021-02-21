const table_producto = document.getElementById("table-productos");
const formulario_producto = document.getElementById("formulario-producto");
const alerta = document.getElementById("alerta");
const producto_lista = document.getElementById("producto-lista");
const paginador = document.getElementById("paginador");
const error_body = document.getElementById("error-body");

const pname = document.getElementById("pname");
const pprecio = document.getElementById("pprecio");
const pdescription = document.getElementById("pdescription");
const short_description = document.getElementById("short_description");
const pshu = document.getElementById("pshu");
const pquantity = document.getElementById("pquantity");
const category_id = document.getElementById("category_id");
const id = document.getElementById("id");
const encodings = document.getElementById("encodings");

var skip = 0;

$(function () {

    $('#producto-create').submit(registerProducto);

    const bottom_register = document.getElementById("bottom-register");
    const buscar = document.getElementById("buscar");
    const register_product = document.getElementById("producto-create");

    const url = `/admin/producto/ajax/${skip}`;
    $.getJSON(url, ajaxGet);

    let timeout;

    buscar.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            encodings.innerHTML = "";
            pname.value = null;
            pprecio.value =  null;
            pdescription.value =  null;
            short_description.value =  null;
            pshu.value =  null;
            pquantity.value =  null;
            pid.value = null;

            pname.disabled = false;
            pshu.disabled = false;
            error_body.innerHTML = "";
            table_producto.style.display="none";
            formulario_producto.style.display="block";
            const url = `/admin/producto/show/${buscar.value}`;
            $.getJSON(url, ajaxGetProducto);
        }else if(buscar.value == ""){
            table_producto.style.display="block";
            formulario_producto.style.display="none";
            error_body.innerHTML = "";
            const url = `/admin/producto/ajax/${skip}`;
            $.getJSON(url, ajaxGet);
        }else{
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                const url = `/admin/producto/all/${buscar.value}`;
                $.getJSON(url, ajaxGetAll);
            },1000)
        }
      });

    function registerProducto(e) {
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
                register_product.reset();

                html += ` <div class="alert alert-success" role="alert"> <ul>`;
                html += `<li>Producto ${resp.data.name} enviado con éxito</li>`;
                html += `</ul> </div> `;

                error_body.innerHTML = html;
                pname.disabled = false;
                pshu.disabled = false;
                bottom_register.disabled=false;

            }else if(resp.error != null){
                html += ` <div class="alert alert-danger" role="alert"> <ul>`;
                resp.error.forEach(function(error) { html += `<li>${error}</li>`; });
                html += `</ul> </div> `;

                error_body.innerHTML = html;
                bottom_register.disabled=false;
            }

        });
        bottom_register.disabled=false;
    }

});

function changepage(i){
    skip = (i-1)*10;
    const url = `/admin/producto/ajax/${skip}`;
    $.getJSON(url, ajaxGet);
}

function update(id){
    table_producto.style.display="none";
    formulario_producto.style.display="block";
    const url = `/admin/producto/edit/${id}`;
    $.getJSON(url, ajaxGetProducto);
}

function back(){
    pname.value = null;
    pprecio.value =  null;
    pdescription.value =  null;
    short_description.value =  null;
    pshu.value =  null;
    pquantity.value =  null;
    pid.value = null;
    error_body.innerHTML = "";
    this.buscar.value = null;

    table_producto.style.display="block";
    formulario_producto.style.display="none";

    changepage(1);
}

function deleteP(id){
    Swal.fire({
        title: 'Eliminar Producto',
        text: "Esta seguro de eliminar " + id,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = `/admin/producto/destroy/${id}`;
            $.getJSON(url, ajaxDestroyProducto);

            changepage(1);
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            )
        }
      });
}

function ajaxDestroyProducto(data){
    // console.log(data);
}


function ajaxGet(data){
    alerta.style.display = "none";
    var html = "";
    var pag = "";
    data.data.forEach(element => {
        html += ` <tr> <td>`;
        html += (element.pimagen == null)? `<img src="/img/photo.jpg" width="40px"/>` : `<img src="/assets/images/products/${element.pimagen}" width="60px"/>`;
        html += `</td>
            <td>${element.pname}</td>
            <td>$.${element.pprice}</td>
            <td>${element.psdk}</td>
            <td>${element.cname}</td>
            <td>
                <button type="button" class="btn btn-warning" onclick="update(${element.pid})"><i class="fas fa-edit"></i></button>
                <button type="button" class="btn btn-danger" onclick="deleteP(${element.pid})"><i class="far fa-trash-alt"></i></button>
            </td></tr>`;
    });
    producto_lista.innerHTML = html;
    pag += `
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item disabled">
            <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
            </li>`;
            for (var i = 1; i <= Math.ceil(data.total/10); i++) {
                if(skip == (i-1)*10){
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

function ajaxGetProducto(data){
    if(data != null){
        var datos = "";
        pname.value = data.data.name;
        pprecio.value =  data.data.regular_price;
        pdescription.value =  data.data.description;
        short_description.value =  data.data.short_description;
        pshu.value =  data.data.SKU;
        pquantity.value =  data.data.quantity;
        datos += `<select name="category_id"  class="form-control" >`;
        pname.disabled = true;
        pshu.disabled = true;
        data.categories.forEach(dato => {
            console.log(dato);
            (dato.id == data.data.category_id)?
                datos = datos + `<option value="${dato.id}" selected>${dato.name}</option>`:
                datos = datos + `<option value="${dato.id}">${dato.name}</option>`;
        });
        datos += `</select>`;
        category_id.innerHTML = datos;
        pid.value = data.data.id;
    }

}

function ajaxGetAll(data){
    var html = "";
    if(data.data.length > 0){
        data.data.forEach(element => {
            html += `<option value="${element.name}">`;
        });
    }
    encodings.innerHTML = html;
}
