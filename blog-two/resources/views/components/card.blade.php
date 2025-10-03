<div class="uk-card uk-card-default uk-card-hover uk-margin">
    <!-- Kép -->
    <div class="uk-card-media-top">
        <img src="{{ $image }}" alt="{{ $title }}" uk-img>
    </div>

    <!-- Kártya tartalom -->
    <div class="uk-card-body">
        <!-- Cím -->
        <h3 class="uk-card-title">{{ $title }}</h3>

        <!-- Dátum -->
        <p class="uk-text-meta uk-margin-remove-top">
            <time datetime="{{ $date }}">{{ $date }}</time>
        </p>

        <!-- Slot tartalom -->
        <div class="uk-margin-top">
            {{ $slot }}
        </div>
    </div>

    <!-- Card footer -->
    @if(isset($footer))
        <div class="uk-card-footer">
            {{ $footer }}
        </div>
    @endif
</div>