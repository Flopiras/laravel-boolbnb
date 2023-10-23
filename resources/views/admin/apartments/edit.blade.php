@extends('layouts.app')

@section('title', "Modifica $apartment->name")

@section('content')
  {{-- back button --}}
  <a href="{{ url()->previous() }}" class="btn btn-second fw-semibold my-4">
    <i class="fa-solid fa-arrow-left"></i>
    <span class="d-none ms-2 d-md-inline">Torna alla lista</span>
  </a>

  {{-- form --}}
  @include('includes.form')
@endsection
