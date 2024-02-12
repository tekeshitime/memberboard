<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Blog
        </h2>
        <a href="{{ route('blog.create')}}" class="bg-gray-500 rounded font-medium px-4 py-2 text-white">Add New Post</a>
    </div>
    </x-slot>

<x-main-contents>
    <form action="{{route('blog.store')}}" method="POST">
        @csrf
        <div class="flex flex-col">
            <label for="title">タイトル</label>
            <input type="text" name="title">
            <label for="content" class="mt-4">コンテンツ</label>
            <textarea type="text" name="content"></textarea>
            <button type="submit" class="bg-gray-500 rounded font-medium px-4 py-2 text-white mt-4">投稿する</button>
        </div>
    </form>
</x-main-contents>

</x-app-layout>