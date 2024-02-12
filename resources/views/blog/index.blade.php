<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Blog
        </h2>
        <a href="{{ route('blog.create')}}" class="bg-gray-500 rounded font-medium px-4 py-2 text-white">New Post</a>
    </div>
    </x-slot>

<x-main-contents>
    @foreach($blogs as $blog)
    <a href="{{ route('blog.show',$blog->id) }}">
        <p class="text-gray-400">{{ $blog->updated_at->format('Y年m月d日') }}</p>
        <h2>{{ $blog->title }}</h2>
    </a>
    @endforeach
</x-main-contents>

</x-app-layout>