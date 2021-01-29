@component('mail::message')
# Welcome to Instagram!

Thanks for registering with us.
Time to share your favourite pics!

@component('mail::button', ['url' => config('app.url').'/login'])
Log In
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
