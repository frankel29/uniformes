<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RM Sports</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .card img {
            height: 150px;
            width: 150px;
            object-fit: cover;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="container mx-auto p-4">
        <header class="flex items-center justify-between py-4 border-b">
            <div class="flex items-center space-x-4">
                <div class="avatar">
                    <img src="{{ asset('images/RM logotipo.png') }}" alt="Logo" class="rounded-full h-20 w-20">
                </div>
                <input type="search" placeholder="Buscar..." class="form-control w-64">
            </div>
            <div class="flex items-center space-x-4">
                <button class="btn btn-outline-secondary">Mis Compras</button>
                @auth
                <a href="{{ url('/home') }}" class="btn btn-outline-secondary">Home</a>
                @else
                <a href="{{ route('login') }}" class="btn btn-outline-secondary">Login</a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                @endif
                @endauth
            </div>
        </header>
        <nav class="flex justify-center space-x-4 py-4 border-b">
            <button class="btn btn-link">Colegios</button>
            <button class="btn btn-link">Uniformes</button>
            <button class="btn btn-link">Acerca de</button>
            <button class="btn btn-link">Contacto</button>
        </nav>
        <main class="grid grid-cols-5 gap-4 py-4">
            <div class="card text-center">
                <div class="card-header">
                    <h5 class="card-title">Unidad educativa Ramón Barba Naranjo</h5>
                </div>
                <div class="card-body">
                    <img src="{{ asset('images/Ramon Barbara Naranjo.png') }}" alt="Unidad educativa Ramón Barba Naranjo">
                    <p>Descripción</p>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">Ir</button>
                </div>
            </div>
            <div class="card text-center">
                <div class="card-header">
                    <h5 class="card-title">Unidad educativa Primero de Abril</h5>
                </div>
                <div class="card-body">
                    <img src="{{ asset('images/Unidad educativa Primero de Abril.jpg') }}" alt="Unidad educativa Primero de Abril">
                    <p>Descripción</p>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">Ir</button>
                </div>
            </div>
            <div class="card text-center">
                <div class="card-header">
                    <h5 class="card-title">Unidad educativa Isidro Ayora</h5>
                </div>
                <div class="card-body">
                    <img src="{{ asset('images/Unidad educativa Isidro Ayora.jpg') }}" alt="Unidad educativa Isidro Ayora">
                    <p>Descripción</p>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">Ir</button>
                </div>
            </div>
            <div class="card text-center">
                <div class="card-header">
                    <h5 class="card-title">Unidad educativa Victoria Vascones Cuvi</h5>
                </div>
                <div class="card-body">
                    <img src="{{ asset('images/Unidad educativa Victoria Vascones Cuvi.jpg') }}" alt="Unidad educativa Victoria Vascones Cuvi">
                    <p>Descripción</p>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">Ir</button>
                </div>
            </div>
            <div class="card text-center">
                <div class="card-header">
                    <h5 class="card-title">Unidad educativa Vicente León</h5>
                </div>
                <div class="card-body">
                    <img src="{{ asset('images/Unidad educativa Vicente Leon.jpg') }}" alt="Unidad educativa Vicente León">
                    <p>Descripción</p>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">Ir</button>
                </div>
            </div>
            <div class="card text-center">
                <div class="card-header">
                    <h5 class="card-title">Unidad educativa Hermano Miguel</h5>
                </div>
                <div class="card-body">
                    <img src="{{ asset('images/Unidad educativa Hermano Miguel.jpg') }}" alt="Unidad educativa Hermano Miguel">
                    <p>Descripción</p>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">Ir</button>
                </div>
            </div>
            <div class="card text-center">
                <div class="card-header">
                    <h5 class="card-title">Unidad educativa La Salle</h5>
                </div>
                <div class="card-body">
                    <img src="{{ asset('images/Unidad educativa La Salle.png') }}" alt="Unidad educativa La Salle">
                    <p>Descripción</p>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">Ir</button>
                </div>
            </div>
            <div class="card text-center">
                <div class="card-header">
                    <h5 class="card-title">Unidad educativa Luis Fernando Ruiz</h5>
                </div>
                <div class="card-body">
                    <img src="{{ asset('images/Unidad educativa Luis Fernando Ruiz.png') }}" alt="Unidad educativa Luis Fernando Ruiz">
                    <p>Descripción</p>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">Ir</button>
                </div>
            </div>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
