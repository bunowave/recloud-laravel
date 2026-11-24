@once
<script src="{{ $scriptUrl }}" async defer></script>
@endonce
<div {{ $attributes->merge(['class' => 'recloud']) }} data-sitekey="{{ $siteKey }}"@if($theme) data-theme="{{ $theme }}"@endif @if($size) data-size="{{ $size }}"@endif @if($align) data-align="{{ $align }}"@endif @if($accent) data-accent="{{ $accent }}"@endif @if($language) data-language="{{ $language }}"@endif @if($callback) data-callback="{{ $callback }}"@endif @if($errorCallback) data-error-callback="{{ $errorCallback }}"@endif></div>
