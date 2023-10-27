@extends('layouts.app')

@section('scripts')
  @vite('resources/js/registration-from-validation.js')
@endsection

@section('content')
  <div class="container mt-4">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header second-color fw-semibold">Registrazione</div>

          <div class="card-body">
            <form method="POST" action="{{ route('register') }}" id="registration-form" novalidate>
              @csrf

              <div class="mb-4 row">

                {{-- First name --}}
                <div class="col-md-6">
                  <label for="first_name" class="form-label text-md-right main-color">Nome</label>
                  <input id="name" type="text"
                    class="form-control main-color @error('first_name') is-invalid @enderror" name="first_name"
                    value="{{ old('first_name') }}">
                  <div id="first_name_feedback" class="invalid-feedback">
                    @error('first_name')
                      {{ $message }}
                    @enderror
                  </div>
                </div>

                {{-- Last name --}}
                <div class="col-md-6">
                  <label for="last_name" class="form-label text-md-right main-color">Cognome</label>
                  <input id="last_name" type="text"
                    class="form-control main-color @error('last_name') is-invalid @enderror" name="last_name"
                    value="{{ old('last_name') }}">
                  <div id="last_name_feedback" class="invalid-feedback">
                    @error('last_name')
                      {{ $message }}
                    @enderror
                  </div>
                </div>
              </div>

              <div class="mb-4 row">

                {{-- Email --}}
                <div class="col-md-6">
                  <label for="email" class="form-label text-md-right main-color">Email *</label>
                  <input id="email" type="email"
                    class="form-control main-color @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}">
                  <div id="email_feedback" class="invalid-feedback">
                    @error('email')
                      {{ $message }}
                    @enderror
                  </div>
                </div>

                {{-- Birthday --}}
                <div class="col-md-6">
                  <label for="birthday" class="form-label text-md-right main-color">Data di nascita</label>
                  <input id="birthday" type="date"
                    class="form-control main-color @error('birthday') is-invalid @enderror" name="birthday"
                    value="{{ old('birthday') }}">
                  <div id="birthday_feedback" class="invalid-feedback">
                    @error('birthday')
                      {{ $message }}
                    @enderror
                  </div>
                </div>
              </div>

              <div class="mb-4 row">

                {{-- Password --}}
                <div class="col-md-6">
                  <label for="password" class="form-label text-md-right main-color">{{ __('Password') }} *</label>
                  <input id="password" type="password"
                    class="form-control main-color @error('password') is-invalid @enderror" name="password">
                  <div id="password_feedback" class="invalid-feedback">
                    @error('password')
                      {{ $message }}
                    @enderror
                  </div>
                </div>

                {{-- Password confirm --}}
                <div class="col-md-6">
                  <label for="password_confirm" class="form-label text-md-right main-color">Conferma password
                    *</label>
                  <input id="password_confirm" type="password" class="form-control main-color"
                    name="password_confirmation">
                  <div id="password_confirmation_feedback" class="invalid-feedback">
                    @error('password_confirmation')
                      {{ $message }}
                    @enderror
                  </div>
                </div>
              </div>

              {{-- Register button --}}
              <div class="text-end">
                <button type="submit" class="btn btn-second">
                  Crea account
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
