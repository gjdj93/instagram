@component('mail::message')
# Welcome to Instagram!

Thanks for registering with us.
Time to share your favourite pics!

Click the button below to verify your email address.
<br>
@component('mail::button', ['url' => config('app.url').'/email/verify'])
Verify Email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
