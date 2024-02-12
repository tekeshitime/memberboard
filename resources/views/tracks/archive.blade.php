<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Result
        </h2>
        <a href="{{ route('tracks.create')}}" class="bg-gray-500 rounded font-medium px-4 py-2 text-white">Sell New Track</a>
    </div>
    </x-slot>
    <?php
    // (B1) GET ALL SONGS
    $songs = glob("/storage/audio/sample/*", GLOB_BRACE);
    ?>

<x-main-contents>
        
        <div class="flex justify-between items-center">
            <h2>トラック一覧</h2>
        </div>
        <div class="flex flex-wrap gap-x-4 gap-y-4">
            @if($tracks->count())
            @foreach($tracks as $track)
            <div class="trackBox">
                <a href="{{ route('tracks.show', ['track' => $track->id]) }}">
                    <img src="{{ asset($track->pathArtwork) }}" alt="">
                    <span>￥{{$track->price}}</span>・<span>{{$track->bpm}}</span>
                    <h3 class="trackTitle">{{$track->trackTitle}}</h3>
                </a>
                {{-- <h4 class="artistName"></h4> --}}

                <div id="demoList">
                    <button class='song border-2 border-solid border-gray-400 text-gray-400 hover:text-white hover:bg-gray-400 text-gray font-bold py-1 px-2 rounded-full text-xs' data-src='audiosample.wav'>Preview</button>
                </div>
            </div>
            @endforeach
            @else
            There is no Track.
            @endif

        </div>
    </x-main-contents>
    
    <div class="py-12 max-w-4xl mx-auto sm:px-6 lg:px-8 grid gap-y-2">
        <!-- (A) AUDIO TAG -->
        <div class="fixed bottom-0 left-0 right-0 bg-gray-100 p-4">
            <audio id="demoAudio" controls class="w-full"></audio>
        </div>
    </div>

    
</x-app-layout>