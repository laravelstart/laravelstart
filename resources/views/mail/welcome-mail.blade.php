<x-mail::message>
# Welcome to {{ config('app.name') }} 🎉

Hey **{{ "@$user->name" }}** 👋

We're thrilled to have you join our community. Your account has been successfully created and you're all set to get started.

Here are a few things you can do now:
* [Explore starter kits available]({{ url('/browse/official') }})
* Create a fresh Laravel project with a Starter Kit of your choice
* [Craft a custom Starter Kit]({{ url('/browse/my') }})
* Publish your first custom Starter Kit to the [Community Starter Kits]({{ url('/browse/community') }})

<x-mail::button :url="url('/dashboard')" color="primary">
Go to dashboard
</x-mail::button>

If you have any questions, feel free to reach out to [our support team](mailto:support@laravelstart.app). We're here to help!

With all respect,<br>
The {{ config('app.name') }} Team
</x-mail::message>
