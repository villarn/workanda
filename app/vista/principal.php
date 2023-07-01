<html>
<head>
    <title></title>
</head>
<body>

<div class="topnav">
    <a class="active">Bienvenid@: <?php echo $_SESSION['nombre'] ?></a>
    <a type="button" onclick="document.getElementById('id01').style.display='block'">Nuevo Usuario</a>
    <a class="btnSalir" href="app/controlador/CtrlSalir.php">Salir</a>
</div>

<div class="centrado">
    <h2>Listado de usuarios en el sistema</h2>
</div>
<div class="centrado">

</div>

<div style="overflow-x:auto;">
    <table class="center" id="tabla">
        <thead class="thead">
            <tr>
                <td>#</td>
                <td>Apellido</td>
                <td>Nombre</td>
                <td>Usuario</td>
                <td>Accion</td>
            </tr>
        </thead>
            <tbody class="centrado">
                <?php foreach ($data as $item) { ?>
                    <tr>
                        <td><?php  echo $item['id_usuario'] ?></td>
                        <td><?php  echo $item['apellido'] ?></td>
                        <td><?php  echo $item['nombre'] ?></td>
                        <td><?php  echo $item['usuario'] ?></td>
                        <td hidden><?php  echo $item['id_persona'] ?></td>
                        <td>
                            <input class="button4 btn warning editar" onclick="document.getElementById('editarUsuario').style.display='block'"
                                       type="button" name="editar" value="Editar">
                            <input class="button4 btn danger eliminar" type="button" id="<?php  echo $item['id_usuario'] ?>" name="eliminar" value="Eliminar">
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
    </table>
</div>
<div id="editarUsuario" class="modal">
    <form class="modal-content" action="app/controlador/CtrlEditar" method="POST">
        <div class="container">
            <h1>Editar usuario</h1>
            <hr>
            <input class="inputEditar" type="hidden" placeholder="" name="id_usuario">

            <label for="email"><b>Apellido</b></label>
            <input class="inputEditar" type="text" placeholder="" name="apellido" required>

            <label for="psw-repeat"><b>Nombre</b></label>
            <input  class="inputEditar" type="text" placeholder="Ingrese apellido" name="nombre" required>

            <label for="psw-repeat"><b>Usuario</b></label>
            <input class="inputEditar" type="text" placeholder="Ingrese nombre" name="usu" required>

            <input class="inputEditar" type="hidden" placeholder="" name="id_persona">

            <div class="clearfix">
                <button type="button" onclick="document.getElementById('editarUsuario').style.display='none'" class="cancelbtn">Cancelar</button>
                <button type="submit" class="signupbtn" name="editar" value="editar">Editar</button>
            </div>
        </div>
    </form>
</div>

<!-- Formulario de Registro -->
<div id="id01" class="modal">
    <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    <form class="modal-content" action="app/controlador/CtrlRegistrar.php" method="POST">
        <div class="container">
            <h1>Registre su usuario</h1>
            <hr>
            <label for="usu"><b>Usuario</b></label>
            <input type="text" placeholder="Ingrese usuario" name="usu"  pattern="[A-Za-z0-9]{3,10}"
                   title="Solo letras y números, mínimo 3 caracteres maximo 10" required>

            <label for="pass"><b>Password</b></label>
            <input type="password" placeholder="Ingreser Password" id="pass" name="pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                   title="Debe contener al menos una mayúscula, una minúscula un número, y mínimo 8 caracteres" required>

            <label for="apellido"><b>Apellido</b></label>
            <input type="text" placeholder="Ingrese apellido" name="apellido" pattern="[a-zA-Z ]{3,254}"
                   title="Debe contener Solo letras, mínimo 3 caracteres" required>

            <label for="apellido"><b>Nombre</b></label>
            <input type="text" placeholder="Ingrese nombre" name="nombre" pattern="[a-zA-Z ]{3,254}"
                   title="Debe contener Solo letras, mínimo 3 caracteres"required>
            <input type="hidden" name="sesion" value="<?php echo $_SESSION['usu'] ?>">
            <div class="clearfix">
                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                <button type="submit" class="signupbtn" name="registrar" value="registrarse">Registrarse</button>
            </div>
        </div>
    </form>
</div>

</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>

/*Editar usuario*/
    const table = document.getElementById('tabla')
    const editar = document.getElementById('editarUsuario')
    const inputs = document.getElementsByClassName('inputEditar')
    let contador = 0;

    table.addEventListener('click', (e)=>{
        e.preventDefault();
        let data = e.target.parentElement.parentElement.children;
        obtenerDatos(data)
    })

    const obtenerDatos = (data) =>{
        for(let index of inputs){
            index.value = data[contador].textContent;
            contador += 1;
        }
        contador = 0;
    }


// Modal Registrar
    var modal = document.getElementById('id01');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    }

/* Eliminar Usuario */
    $(document).ready(function(){
        $('.eliminar').click(function(){
            var datos  =$(this).attr("id");
            if(confirm('Esta seguro que desea eliminar el usuario?')){
                $.ajax({
                    type:"POST",
                    url:"app/controlador/CtrlUsuario",
                    data:'eliminarId='+datos,
                    success:function(data){
                        window.location.reload();
                    }
                });
            }
            return false;
        });
    });
</script>
