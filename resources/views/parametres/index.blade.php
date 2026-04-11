@extends('layouts.app')

@section('title', 'Paramètres système')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h4 class="mb-0">Paramètres système</h4>
        </div>
        <div class="card-body">
            <p class="text-muted">Informations de l’application et paramètres simples pour votre interface.</p>

            <div class="row gy-4">
                <div class="col-12 col-lg-6">
                    <div class="card h-100 shadow-sm border-light">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Informations de l’application</h5>

                            <div class="d-flex align-items-center mb-3">
                                <div class="me-3">
                                    <img src="{{ asset('assets/img/EcoFlux1.svg') }}" alt="Logo EcoFlux" class="rounded" style="width: 72px; height: auto;"> 
                                </div>
                                <div>
                                    <p class="mb-1 fw-semibold">Logo de l’application</p>
                                    <p class="text-muted mb-0">EcoFlux</p>
                                </div>
                            </div>

                            <dl class="row mb-0">
                                <dt class="col-sm-5 text-muted">Nom de l’application</dt>
                                <dd class="col-sm-7">EcoFlux</dd>

                                <dt class="col-sm-5 text-muted">Email administrateur</dt>
                                <dd class="col-sm-7">admin@ecoflux.com</dd>

                                <dt class="col-sm-5 text-muted">Téléphone</dt>
                                <dd class="col-sm-7">+223 XXXXXXXX</dd>

                                <dt class="col-sm-5 text-muted">Adresse</dt>
                                <dd class="col-sm-7">Bamako, Mali</dd>
                            </dl>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="card h-100 shadow-sm border-light">
                        <div class="card-body">
                            <h5 class="card-title mb-3">Paramètres simples</h5>

                            <dl class="row mb-0">
                                <dt class="col-sm-5 text-muted">Langue</dt>
                                <dd class="col-sm-7">Français</dd>

                                <dt class="col-sm-5 text-muted">Fuseau horaire</dt>
                                <dd class="col-sm-7">UTC+0</dd>

                                <dt class="col-sm-5 text-muted">Devise</dt>
                                <dd class="col-sm-7">FCFA</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
