@extends('layouts.app')

@section('content')
  {{-- back button --}}
  <a class="btn btn-second mt-4" href="{{ route('admin.apartments.messages', $message->apartment) }}">
    <i class="fa-solid fa-arrow-left"></i>
    <span class="d-none ms-2 d-md-inline">Torna ai messaggi</span>
  </a>

  <div class="d-flex justify-content-center align-items-center">
    <div class="card mt-5 w-75">
      <div class="card-header">
        <h5 class="my-2"><span class="second-color">Appartamento : </span> <span
            class="main-color ps-2">{{ $message->apartment->name }}
            -
            {{ $message->apartment->address }}</span> </h5>
        @if ($message->replied_at)
          <div class="badge text-bg-success ms-4">Risposta inviata</div>
        @endif
      </div>
      <div class="card-body">
        <p class="card-title"><span class="second-color">Inviata da : </span><span
            class="main-color">{{ $message->name }}</span> <br>
          <span class="second-color">Email: </span><span class="main-color">{{ $message->email }}</span>
        </p>
        <p class="card-text mt-3 fs-5">
          <span class="second-color">Messaggio : </span> <br>
          <span class="main-color">{{ $message->content }}</span>
        </p>
        <div class="d-flex justify-content-center mt-4">
          <a href="{{ route('admin.apartments.messages.mails.create', $message) }}"
            class="btn btn-second fw-semibold">Rispondi</a>
        </div>

      </div>
    </div>
  </div>
@endsection
