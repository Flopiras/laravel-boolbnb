@extends('layouts.app')

@section('title', 'Apartment')

@section('content')

  <div id="show" class="container pt-5">

    <!-- HEADER: -->
    <header>
      <div class="container">
        {{-- back button --}}
        <a class="btn btn-second fw-semibold" href="{{ route('admin.apartments.index') }}">
          <i class="fa-solid fa-arrow-left"></i>
          <span class="d-none ms-2 d-md-inline">Torna agli appartamenti</span>
        </a>

        {{-- apartment's title --}}
        <h1 class="py-4 text-center main-color">{{ $apartment->name }}</h1>
      </div>
      <hr>
    </header>

    <div class="row row-cols-1 row-cols-md-2 mb-4 align-items-center">
      @if ($apartment->thumbnail)
        <div class="col mb-2">
          <img src="{{ $apartment->getPathImage() }}" class="img-fluid" alt="{{ $apartment->name }}">
        </div>
      @endif
      <div class="col mb-2">

        {{-- sponsorship --}}
        <div class="card">
          <h5 class="card-header main-color text-center">Sponsorizzazioni</h5>
          <div class="card-body p-4">
            <h5 class="card-title second-color">Promozioni attive:</h5>
            @if ($apartment->sponsored)
              <p class="main-color ms-3 mb-4">
                Il tuo Appartamento sarà sponsorizzato fino al <span class="fw-semibold second-color"
                  id="sponsorship-expiration"></span>.
              </p>
            @else
              <p class="main-color ms-3 mb-4">
                Nessuna
              </p>
            @endif
            <hr>

            <p class="my-4 main-color text-center fw-semibold">
              Sponsorizza il tuo appartamento per avere maggiore visibilità! <br>
              Gli appartamenti sponsorizzati appariranno nella pagina principale del nostro sito e saranno i primi ad
              apparire durante le ricerche! <br>
              Che aspetti? Clicca il bottone per scegliere il tuo piano di sponsorizzazione! <br>
              Non perdere l'occasione!
            </p>
            {{-- sponsor button --}}
            <div class="d-flex justify-content-center align-items-center">
              <a href="{{ route('admin.sponsorship', $apartment) }}" class="fw-semibold btn btn-second"
                id="sponsor-button">
                Sponsorizza
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row row-cols-1 row-cols-md-2 py-4">
      <div class="col">

        <h6 class="second-color mb-2">Indirizzo dell'appartamento</h6>
        <p class="main-color ms-2">{{ $apartment->address }}</p>

        <h6 class="second-color mb-2">Descrizione dell'appartamento:</h6>
        <p class="main-color ms-2">{{ $apartment->description }}</p>
      </div>
      <div class="col ps-4">
        <div class="d-flex flex-wrap justify-content-between">

          {{-- apartment's details --}}
          <div class="mb-4">
            <div class="d-flex align-items-baseline">
              <h6 class="second-color pe-2">
                <i class="fa-solid fa-door-closed me-2"></i>
                Stanze:
              </h6>
              <span class="main-color fw-semibold">{{ $apartment->rooms }}</span>
            </div>

            <div class="d-flex align-items-baseline">
              <h6 class="second-color pe-2">
                <i class="fa-solid fa-bed me-2"></i>
                Stanze da letto:
              </h6>
              <span class="main-color fw-semibold">{{ $apartment->bedrooms }}</span>
            </div>

            <div class="d-flex align-items-baseline">
              <h6 class="second-color pe-2">
                <i class="fa-solid fa-shower me-2"></i>
                Bagni:
              </h6>
              <span class="main-color fw-semibold">{{ $apartment->bathrooms }}</span>
            </div>

            <div class="d-flex align-items-baseline">
              <h6 class="second-color pe-2">
                <i class="fa-solid fa-house me-2"></i>
                Metri quadri:
              </h6>
              <span class="main-color fw-semibold">{{ $apartment->square_meters }}</span>
            </div>
          </div>

          {{-- apartment's services --}}
          <div>
            <h6 class="second-color">SERVIZI :</h6>

            <ul>
              @forelse($apartment->services as $service)
                <li class="main-color">
                  <i class="fa-solid fa-{{ $service->icon }} me-2"></i>
                  {{ $service->name }}
                </li>
              @empty
                <p class="main-color">Non è presente nessun servizio per questo appartamento</p>
              @endforelse
            </ul>
          </div>
        </div>

      </div>

    </div>


    {{-- visits --}}
    <h5 class="my-3 fw-semibold text-center main-color">Statistiche delle visualizzazioni:</h5>
    <div id="visits"></div>

    {{-- buttons --}}
    <div class="d-flex justify-content-end align-items-center mt-4">

      {{-- edit button --}}
      <a class="fw-semibold text-decoration-none btn btn-second m-2 "
        href="{{ route('admin.apartments.edit', $apartment) }}">
        <span class="d-none d-md-inline">Modifica</span>
      </a>

      {{-- delete modal --}}
      <form data-bs-toggle="modal" data-bs-target="#modal" class="d-inline delete-form m-2"
        action="{{ route('admin.apartments.destroy', $apartment) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class=" btn btn-danger ">
          <span class=" fw-semibold text-decoration-none" href="#">
            <span class="d-none d-md-inline">Elimina</span>
          </span>
        </button>
      </form>
    </div>
  </div>


  @columnchart('Visits', 'visits')

@endsection

@section('scripts')
  @vite('resources/js/delete-confirmation.js')
  <script>
    // script for button of sponsorship 
    document.getElementById('sponsor-button').addEventListener('click', () => {
      document.body.style.cursor = "wait";
    })

    // script for sponsorship's expiration
    const utcExpiration = '{{ $apartment->sponsorshipExpiration }} UTC';
    const localizedExpiration = new Date(utcExpiration).toLocaleString();

    document.getElementById('sponsorship-expiration').innerText = localizedExpiration;
  </script>
@endsection
