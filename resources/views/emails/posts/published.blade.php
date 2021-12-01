@component('mail::message')
Hello, {{ $name }}

{{ $author }} was published new post!

@component('mail::button', ['url' => $url, 'color' => 'primary'])
You can check it now through this link!
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
