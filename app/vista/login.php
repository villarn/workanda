<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
    <div class="row">
        <div class="column">
        </div>
        <div class="column">
            <div class="container">
                <form action="app/controlador/CtrlLogin.php" method="POST">

                    <label for="usu">Usuario</label>
                    <input type="text" id="usu" name="usu" placeholder="Ingrese usuario.." required>

                    <label for="pass">Contraseña</label>
                    <input type="password" id="pass" name="pass" placeholder="Ingrese contraseña.." required>

                    <button type="submit" name="login" value="Iniciar sesión">Iniciar sesión</button>
                </form>
                <button onclick="document.getElementById('id01').style.display='block'">Registrarse</button>
            </div>
        </div>
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

                <div class="clearfix">
                    <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                    <button type="submit" class="signupbtn" name="registrar" value="registrarse">Registrarse</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
