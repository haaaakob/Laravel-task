{{--@component('mail::message')--}}
{{--# Change Password--}}

{{--You can reset your password by clicking the link bellow--}}

{{--@component('mail::button', ['url' => 'http://127.0.0.1:8000/changePassword'])--}}
{{--Reset Password--}}
{{--@endcomponent--}}

{{--Thanks,<br>--}}
{{--{{ config('app.name') }}--}}
{{--@endcomponent--}}

<div style="width: 100%; height: 380px;background-color: lightsteelblue; padding-top: 90px">
    <div style="padding-top: 10px; margin: 0 auto; background-color: white; width: 555px; height: 200px">
        <h3 style="margin: 0 0 5px  20px">Reset Password</h3>
        <p style="margin: 0 0 5px 20px">You can reset password from bellow link:</p>
        <button style="margin: 10px 0 30px 200px; background-color: #2d3748; width: 130px; height: 40px; border-radius: 5px">
            <a style="text-decoration: none; color: white; font-size: 14px" href="{{ route('change',$token) }}">Reset Password</a>
        </button>
        <p style="margin: 0 0 0 20px">Thanks.</p>
    </div>
</div>

