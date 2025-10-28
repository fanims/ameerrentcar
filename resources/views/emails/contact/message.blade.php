@component('mail::message')
# New Contact Message

**Name:** {{ $contact->name }}  
**Email:** {{ $contact->email }}

**Message:**  
{{ $contact->message }}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
