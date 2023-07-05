@extends('layout')

@section('content')
    @if ($profile == null)
        <span style="color: lightblue; font-size: 3vh;">UPPS! Ten formularz nie istnieje lub jest niekatywny skontaktuj sie
            ze swoim znajomym w tej sprawie!</span>
    @else
        @livewire('createrequest', ['profile' => $profile])
    @endif
@endsection
