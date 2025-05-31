<x-mail::message>
# New Starter Kit Available! 🚀

Hey **{{ "@$user->name" }}** 👋

We're excited to announce that a new starter kit "{{ $kit->title }}" is now available on {{ config('app.name') }}!

You can try it out right now:
* [Check out {{ $kit->title }}]({{ url('/kits/' . $kit->slug) }})
* Create a new Laravel project using this starter kit
* [Browse other starter kits]({{ url('/browse/official') }})

<x-mail::button :url="url('/kits/' . $kit->slug)" color="primary">
Try {{ $kit->title }}
</x-mail::button>

If you have any questions, feel free to reach out to [our support team](mailto:support@laravelstart.app). We're here to help!

Best regards,<br>
The {{ config('app.name') }} Team
</x-mail::message>
