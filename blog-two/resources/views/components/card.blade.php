<div class="uk-card uk-card-default uk-card-hover uk-margin">
    <div class="uk-card-media-top">
        <img src="{{ $image }}" alt="{{ $title }}" uk-img>
    </div>

    <div class="uk-card-body">
        <h3 class="uk-card-title">{{ $title }}</h3>

        <p class="uk-text-meta uk-margin-remove-top">
            <time datetime="{{ $date }}">{{ $date }}</time>
        </p>

        <div class="uk-margin-top">
            {{ $slot }}
        </div>
    </div>

    @if(isset($footer))
        <div class="uk-card-footer">
            {{ $footer }}
        </div>
    @endif
</div>