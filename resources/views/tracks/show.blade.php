<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Track') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto sm:px-6 lg:px-8 grid gap-y-2 items-center">
        <div class="flex justify-between items-center">
            <h2>{{$track->trackTitle}}</h2>
        </div>
        <img src="{{ asset($track->pathArtwork) }}" alt="">
        <p>{{$track->bpm}}</p>
        <p>{{$track->key}}</p>
        <p>{{$track->price}}</p>
        <p>{{$track->additionalInfo}}</p>
        <p>{{$track->created_at}}</p>
        <p>{{$track->updated_at}}</p>
    </div>



    <div class="py-12 max-w-4xl mx-auto sm:px-6 lg:px-8 grid gap-y-2">
        <!-- (A) AUDIO TAG -->
        <div class="fixed bottom-0 left-0 right-0 bg-gray-100 p-4">
            <audio id="demoAudio" controls class="w-full"></audio>
        </div>


    </div>
</x-app-layout>