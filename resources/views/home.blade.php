@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            
            <div class="card shadow-lg border-0">
                <div class="card-header bg-dark text-white text-center py-3">
                    <h5 class="mb-0 text-uppercase tracking-wider">Mi Perfil</h5>
                </div>
                
                <div class="card-body p-4">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold mb-1">¡Hola, {{ Auth::user()->nombre }}!</h2>
                        <p class="text-muted">Estado actual:</p>
                    </div>

                    <div class="row g-0 bg-light rounded shadow-sm overflow-hidden text-center mb-4">
                        <div class="col-6 py-3 border-end border-2">
                            <span class="text-uppercase text-muted x-small d-block fw-bold" style="font-size: 0.75rem;">Peso Actual</span>
                            <span class="h3 mb-0 fw-bold text-primary">{{ Auth::user()->peso_base }}</span>
                            <small class="text-muted">kg</small>
                        </div>
                        <div class="col-6 py-3">
                            <span class="text-uppercase text-muted x-small d-block fw-bold" style="font-size: 0.75rem;">Altura</span>
                            <span class="h3 mb-0 fw-bold text-primary">{{ Auth::user()->altura_base }}</span>
                            <small class="text-muted">cm</small>
                        </div>
                    </div>

                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex justify-content-between align-items-center px-2 py-3">
                            <span class="text-muted"><i class="bi bi-person-badge me-2"></i>Apellidos</span>
                            <span class="fw-semibold">{{ Auth::user()->apellidos }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-2 py-3">
                            <span class="text-muted"><i class="bi bi-envelope me-2"></i>Email</span>
                            <span class="fw-semibold text-truncate ms-3">{{ Auth::user()->email }}</span>
                        </div>
                        <div class="list-group-item d-flex justify-content-between align-items-center px-2 py-3 border-bottom-0">
                            <span class="text-muted"><i class="bi bi-calendar-event me-2"></i>Nacimiento</span>
                            <span class="fw-semibold">{{ Auth::user()->fecha_nacimiento->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-white text-center py-3 border-top-0">
                    <a href="./editarperfil" class="btn btn-outline-primary btn-sm rounded-pill px-4 link">
                        Actualizar mis datos
                    </button>
                </div>
            </div>

            <div id="body" class="mt-4"></div>
            
        </div>
    </div>
</div>

<script src="{{ asset('js/Main_layout.js') }}"></script>
@endsection