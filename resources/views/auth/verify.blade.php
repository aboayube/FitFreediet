@extends('layouts.front.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5 mb-5 text-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('يجيب عليك تفعيل حسابك معنا') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __(' تم ارسال رسالة تفعيل اخري اذهب وفعل     ') }}
                        </div>
                    @endif

                    {{ __('اذهب الي ايميلك الشخصي وفعل حسابك في موقعنا لتتمتع بمزايا fit free دمتم بود') }}
                    {{ __('If you did not receive the email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
