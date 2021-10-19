@extends('layouts.front.app')
@section('content')
@livewireStyles
<link href="{{asset('css/wizard.css')}}" rel="sttlesheet"/>
<livewire:register/>
@livewireScripts

@endsection
