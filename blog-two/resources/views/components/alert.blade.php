@props(['type' => 'info'])

<div class="uk-alert uk-alert-{{ $type === 'info' ? 'primary' : $type }}" uk-alert>
    <a class="uk-alert-close" uk-close></a>
    {{ $slot }}
</div>