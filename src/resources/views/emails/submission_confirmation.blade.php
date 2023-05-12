@component('mail::message')
# Form Submission Confirmation

Thank you for submitting the form! Here are the details of your submission:

- Company Symbol: {{ $emailData['symbol'] }}
- Start Date: {{ $emailData['start_date'] }}
- End Date: {{ $emailData['end_date'] }}
- Email: {{ $emailData['email'] }}

We appreciate your participation.

Thanks,<br>
{{ config('app.name') }}
@endcomponent