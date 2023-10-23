@extends('layouts.app')

@section('content')

  @if ($errors->any())
    <div class="alert alert-warning mt-5">
      <ul class="list-unstyled">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif()

  <div class="my-5" style="max-width: 500px; margin: 0 auto">

    <a class="mb-4 btn btn-second fw-semibold" href="{{ route('admin.apartments.show', $apartment) }}">
      <i class="fa-solid fa-arrow-left"></i>
      <span class="d-none ms-2 d-md-inline">Torna indietro</span>
    </a>

    {{-- SPONSORSHIPS --}}
    <div class="col px-2">
      <div class="card shadow">

        <div class="card-header">
          <h5 class="mb-0 second-color">Seleziona la sponsorizzazione</h5>
        </div>


        <div class="card-body">
          <form id="payment-form" method="POST" action="{{ route('admin.sponsorship.payment', $apartment) }}">
            @csrf
            @foreach ($sponsorships as $sponsorship)
              <div class="form-check main-color">
                <input class="form-check-input" type="radio" name="sponsorship_id" id="{{ $sponsorship->name }}"
                  value="{{ $sponsorship->id }}" @if ($loop->first) checked @endif>
                <label class="form-check-label" for="{{ $sponsorship->name }}">
                  {{ $sponsorship->name }} - € {{ $sponsorship->price }} - Durata:
                  @if ($sponsorship->name === 'Test')
                    <strong class="second-color">30 secondi</strong>
                  @else
                    <strong class="second-color">{{ $sponsorship->hours }} ore</strong>
                  @endif
                </label>
              </div>
            @endforeach

            <hr>

            <div id="dropin-container"></div>
            <input class="btn btn-second my-3" type="submit" id="submit-button" />
            <input type="hidden" id="nonce" name="nonce" />
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- loader --}}
  @include('includes.loader')
@endsection

@section('scripts')
  <script>
    const form = document.getElementById('payment-form');

    const loader = document.getElementById('loader');
    loader.classList.add('d-none');


    braintree.dropin.create({
      authorization: '{{ $token }}',
      locale: 'it_IT',
      container: '#dropin-container'
    }, (error, instance) => {
      if (error) console.error(error);

      form.addEventListener('submit', e => {
        e.preventDefault();

        instance.requestPaymentMethod((error, payload) => {
          if (error) console.error(error);

          document.getElementById('nonce').value = payload.nonce;
          form.submit();
          loader.classList.remove('d-none');
        })
      })
    });
  </script>
@endsection
