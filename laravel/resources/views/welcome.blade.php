<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Inicio</title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f3f4f6;
            margin: 0;
            padding: 0;
        }
        header {
            background: #111827;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        main {
            padding: 40px;
        }
        button, a {
            background: #2563eb;
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 4px;
            text-decoration: none;
            cursor: pointer;
        }
        button:hover, a:hover {
            background: #1d4ed8;
        }
    </style>
</head>
<body>

<header>
    <div>
        <strong>Entrenamientos</strong>
    </div>

    <div>
        @auth
            <form method="POST" action="/logout" style="display:inline;">
                @csrf
                <button type="submit">Cerrar sesión</button>
            </form>
        @endauth
    </div>
</header>

<main>
    <h1>Bienvenido 🎉</h1>
    <p>Has iniciado sesión correctamente.</p>

    <p>Desde aquí podrás acceder al resto de funcionalidades de la aplicación.</p>
</main>

</body>
</html>
