<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('tracks.index') }}">
            << </a>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{$track->trackTitle}}
                </h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto sm:px-6 lg:px-8 grid gap-y-2 items-center">
        <div class="flex gap-8">
            <div class="items p-8 bg-white rounded-md">
                <img src="{{ asset($track->pathArtwork) }}" alt="">
                <p class="flex justify-between py-4"><span>BPM</span><span>{{$track->bpm}}</span></p>
                <p class="flex justify-between py-4"><span>Key</span><span>{{$track->key}}</span></p>
                <p class="flex justify-between py-4"><span>Price</span><span>{{$track->price}}</span></p>
                <p class="flex justify-between py-4"><span>公開日</span><span>{{$track->created_at}}</span></p>
                <p class="flex justify-between py-4"><span>更新日</span><span>{{$track->updated_at}}</span></p>
                <p class="flex justify-between py-4"><span>About</span>
                <div class="">{{$track->additionalInfo}}</div>
                </p>
            </div>
            <div class="items p-8 bg-white rounded-md grow">
                <!-- (A) AUDIO TAG -->
                <div class="bg-gray-100 p-4">
                    <audio id="demoAudio" controls class="w-full"></audio>
                </div>
                <div class="mt-10">
                    <div class="flex items-center justify-between">
                        <p>{{$track->trackTitle}}</p>
                        <span>￥{{$track->price}}</span>
                        <button type="submit" class="bg-blue-500 rounded font-medium px-4 py-2 text-white">購入する</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>