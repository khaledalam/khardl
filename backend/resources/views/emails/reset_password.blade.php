<x-mail::message>
# Introduction

The body of your message.

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
    <br><br><small><i>This email was sent from an email address that can't receive emails. Please don't reply to this email.</i></small>
    {{ config('app.name') }}
</x-mail::message>
