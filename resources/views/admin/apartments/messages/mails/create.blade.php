@extends('layouts.app')

@section('scripts')
  @vite('resources/js/mail-reply-validation.js')
@endsection


@section('content')
  {{-- back button --}}
  <a class="btn btn-second fw-semibold mt-4" href="{{ route('admin.apartments.messages', $message->apartment) }}">
    <i class="fa-solid fa-arrow-left"></i>
    <span class="d-none ms-2 d-md-inline">Torna ai messaggi</span>
  </a>
  <form class="row g-3 mt-5" id="mail-form" method="POST"
    action="{{ route('admin.apartments.messages.mails.reply', $message) }}">
    @csrf
    <p class="mb-4 text-end main-color" novalidate>
      * I campi sono obbligatori
    </p>
    <div class="col-md-6">
      <label for="subject" class="form-label second-color @error('subject') is-invalid @enderror">Oggetto*</label>
      <input type="text" class="form-control main-color" id="subject" name="subject">
      <div id="subject_feedback" class="invalid-feedback">
        @error('subject')
          {{ $message }}
        @enderror
      </div>
    </div>
    <div class="col-md-6">
      <label for="admin_email" class="form-label second-color">Email*</label>
      <input type="email" class="form-control main-color @error('admin_email') is-invalid @enderror" id="admin_email"
        name="admin_email" value="{{ Auth::user()->email }}">
      <div id="admin_email_feedback" class="invalid-feedback">
        @error('admin_email')
          {{ $message }}
        @enderror
      </div>
    </div>
    <div class="col-md-6 d-none">
      <input type="email" class="form-control" id="user_email" name="user_email" value="{{ $message->email }}">
      <input type="text" class="form-control" id="user_message_id" name="user_message_id" value="{{ $message->id }}">
    </div>

    <div class="col-12">
      <label for="content" class="form-label second-color">Messaggio*</label>
      <textarea name="content" id="content" cols="30" rows="10"
        class="form-control main-color @error('content') is-invalid @enderror"></textarea>
      <div id="content_feedback" class="invalid-feedback">
        @error('content')
          {{ $message }}
        @enderror
      </div>
    </div>
    <div class="col-12">
      {{-- send button --}}
      <div class="d-flex justify-content-end mt-4">
        <button type="submit" class="btn btn-second">Invia Mail</button>
      </div>
    </div>
  </form>
@endsection
