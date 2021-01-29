@component('mail::message')
# New Follower

Hi {{ $user->name }},
<br>

{{ $auth_user->username }} is now following you!

@component('mail::button', ['url' => config('app.url').'/'.$auth_user->username])
Follow Back
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
