<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Threads') }}
        </h2>
        <div>
            <a href="{{route('threads.create')}}">{{__('New Thread')}}</a>
        </div>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto sm:px-6 lg:px-8 grid gap-y-2">
        <div class="search">
            <h2>お気に入りのトラックを見つけよう</h2>
            <input type="text" placeholder="Explore new sounds">
            <button type="submit">Search</button>
        </div>
    </div>
    <?php
    // (B1) GET ALL SONGS
    $songs = glob("audio/*", GLOB_BRACE);
    ?>

    <div class="py-12 max-w-4xl mx-auto sm:px-6 lg:px-8 grid gap-y-2 items-center">
        <div class="flex justify-between items-center">
            <h2>トレンドのトラック</h2>
            <span class="text-right">SEE MORE>></span>
        </div>
        <div class="flex gap-x-4">
            @foreach(range(1, 5) as $index)
            <div class="trackBox">
                <img src="https://placehold.jp/150x150.png" alt="">
                <span>￥2000</span>・<span>80BPM</span>
                <h3 class="trackTitle">Command</h3>
                <h4 class="artistName">BLANC</h4>

                <div id="demoList">
                    <button class='song border-2 border-solid border-gray-400 text-gray-400 hover:text-white hover:bg-gray-400 text-gray font-bold py-1 px-2 rounded-full text-xs' data-src='audiosample.wav'>Preview</button>
                </div>
            </div>
            @endforeach
        </div>
    </div>


    <div class="py-12 max-w-4xl mx-auto sm:px-6 lg:px-8 grid gap-y-2">
        @if($threads->count())
        @foreach($threads as $thread)
        <x-thread-card :thread="$thread" />
        @endforeach
        @else
        There is no thread.
        @endif
    </div>

    <div class="py-12 max-w-4xl mx-auto sm:px-6 lg:px-8 grid gap-y-2">
        <h2>お知らせ</h2>
        <div>
            <p>2024.02.01-楽曲○○を追加しました。</p>
            <p>2024.01.01-サイトを開設しました。</p>
        </div>
    </div>


    <div class="py-12 max-w-4xl mx-auto sm:px-6 lg:px-8 grid gap-y-2">
        <!-- (A) AUDIO TAG -->
        <div class="fixed bottom-0 left-0 right-0 bg-gray-100 p-4">
            <audio id="demoAudio" controls class="w-full"></audio>
        </div>


    </div>
</x-app-layout>