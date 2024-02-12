<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{$blog->title}}
            </h2>
            <a href="{{ route('blog.create')}}" class="bg-gray-500 rounded font-medium px-4 py-2 text-white">Add New Post</a>
        </div>
    </x-slot>

    <x-main-contents>
        <div class="">
            <p class="text-gray-400">{{ $blog->updated_at->format('Y年m月d日') }}</p>
            <h2>{{ $blog->content }}</h2>
            <div class="mt-10">
            <a href="#" class="bg-gray-500 rounded font-medium px-4 py-2 text-white" onclick='window.history.back(-1);'>戻る</a>
        </div>
        </div>
    </x-main-contents>

</x-app-layout>