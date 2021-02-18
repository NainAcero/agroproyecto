$(function () {
    $('#categoria-create').submit(registerCategoria);

    const bottom_register = document.getElementById("bottom-register");
    const table_categoria = document.getElementById("table-categorias");
    const formulario_categoria = document.getElementById("formulario-categoria");
    const buscar = document.getElementById("buscar");
    const error_body = document.getElementById("error-body");
    const register_catg = document.getElementById("categoria-create");

    buscar.addEventListener("keyup", function(event) {
        if (event.keyCode === 13) {
            table_categoria.style.display="none";
            formulario_categoria.style.display="block";
        }else if(buscar.value == ""){
            table_categoria.style.display="block";
            formulario_categoria.style.display="none";
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
                html += `<li>Categoria ${resp.data.name} registrado con éxito</li>`;
                html += `</ul> </div> `;

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
