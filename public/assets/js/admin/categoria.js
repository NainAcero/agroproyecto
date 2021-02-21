const category_lista = document.getElementById("category-lista");
const paginador = document.getElementById("paginador");
const alerta = document.getElementById("alerta");
const table_categoria = document.getElementById("table-categorias");
const formulario_categoria = document.getElementById("formulario-categoria");
const error_body = document.getElementById("error-body");

const encodings = document.getElementById("encodings");
const cname = document.getElementById("cname");
const pid = document.getElementById("pid");

var skip = 0;

$(function () {
    $('#categoria-create').submit(registerCategoria);

    const bottom_register = document.getElementById("bottom-register");
    const buscar = document.getElementById("buscar");
    const register_catg = document.getElementById("categoria-create");
    const agregar = document.getElementById("agregar");
    const add = document.getElementById("add");
    const remove = document.getElementById("remove");

    const url = `/admin/categoria/ajax/${skip}`;
    $.getJSON(url, ajaxGet);

    add.addEventListener("click", changeText);
    remove.addEventListener("click", deleteText);
    var id = 0;
    var dato = 100;

    function changeText(){
        id += 1;
        dato += 1;
        var input = document.createElement("input");
        var br = document.createElement("br");
        br.id = dato;
        input.type = 'text';
        input.className= "form-control";
        input.id= id;
        input.name= "name[]";
        input.placeholder = "Nueva Categoria";
        agregar.appendChild(br);
        agregar.appendChild(input);
    }

    function deleteText(){
        var input = document.getElementById(id);
        var br = document.getElementById(dato);
        agregar.removeChild(input);
        agregar.removeChild(br);
        id -= 1;
        dato -= 1;
    }

    let timeout;

    buscar.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            encodings.innerHTML = "";
            cname.value = null;
            pid.value = null;

            table_categoria.style.display="none";
            error_body.innerHTML = "";
            formulario_categoria.style.display="block";
            const url = `/admin/categoria/show/${buscar.value}`;
            $.getJSON(url, ajaxGetCategoria);
            error_body.innerHTML = "";
        }else if(buscar.value == ""){
            changepage(1);
            table_categoria.style.display="block";
            error_body.innerHTML = "";
            formulario_categoria.style.display="none";
        }else{
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                const url = `/admin/categoria/all/${buscar.value}`;
                $.getJSON(url, ajaxGetAll);
            },1000)
        }
      });

    function registerCategoria(e) {
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
                register_catg.reset();

                html += ` <div class="alert alert-success" role="alert"> <ul>`;
                resp.data.forEach(function(error) { html += `<li>${error.name} Enviado con éxito</li>`; });
                html += `</ul> </div> `;

                while(dato > 100){
                    var input = document.getElementById(id);
                    var br = document.getElementById(dato);
                    agregar.removeChild(input);
                    agregar.removeChild(br);
                    id -= 1;
                    dato -= 1;
                }

                error_body.innerHTML = html;
                bottom_register.disabled=false;


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


function deleteP(id){
    Swal.fire({
        title: 'Eliminar Category',
        text: "Esta seguro de eliminar " + id,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
            const url = `/admin/categoria/destroy/${id}`;
            $.getJSON(url, ajaxDestroyCategory);

            changepage(1);
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            )
        }
      });
}

function ajaxDestroyCategory(data){

}

function update(id){
    table_categoria.style.display="none";
    formulario_categoria.style.display="block";
    const url = `/admin/categoria/edit/${id}`;
    $.getJSON(url, ajaxGetCategoria);
}

function changepage(i){
    skip = (i-1)*5;
    console.log(skip);
    const url = `/admin/categoria/ajax/${skip}`;
    $.getJSON(url, ajaxGet);
}

function back(){
    cname.value = null;
    pid.value = null;
    table_categoria.style.display="block";
    formulario_categoria.style.display="none";
    error_body.innerHTML = "";
    this.buscar.value = null;

    changepage(1);
}

function ajaxGet(data){
    console.log(data);
    alerta.style.display = "none";
    var html = "";
    var pag = "";
    data.data.forEach(element => {
        html += ` <tr>
            <td>${element.id}</td>
            <td>${element.name}</td>
            <td>${element.slug}</td>
            <td>
                <button type="button" class="btn btn-warning" onclick="update(${element.id})"><i class="fas fa-edit"></i></button>
                <button type="button" class="btn btn-danger" onclick="deleteP(${element.id})"><i class="far fa-trash-alt"></i></button>
            </td></tr>`;
    });
    category_lista.innerHTML = html;
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

function ajaxGetCategoria(data){
    if(data != null){
        cname.value = data.data.name;
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
