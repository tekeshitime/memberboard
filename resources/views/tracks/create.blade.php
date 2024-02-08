<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('CreateNewTrack') }}
        </h2>
    </x-slot>

    <div class="py-12 max-w-4xl mx-auto sm:px-6 lg:px-8 grid gap-y-2 items-center">

        <div class="mt-8">
            <form action="{{ route('tracks.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @foreach($errors->all() as $error)
                <div class="error-message">{{ $error }}</div>
                @endforeach
                <!-- タイトル -->
                <div class="mb-8">
                    <label for="trackTitle" class="text-sm block ">タイトル(32文字以内)</label>
                    <input type="text" name="trackTitle" id="trackTitle" class="w-full">
                </div>

                <!-- アートワーク -->
                <div class="mb-8">
                    <label for="artwork" class="text-sm block">アートワーク</label>
                    <input type="file" name="artwork" id="artwork">
                </div>
                <!-- ジャンル -->
                <!-- <div class="mb-8">
                    <label for="genre" class="text-sm block">ジャンル</label>
                    <input type="text" name="genre" id="genre">
                </div> -->
                <!-- BPM -->
                <div class="mb-8">
                    <label for="bpm" class="text-sm block">BPM</label>
                    <input type="number" name="bpm" id="bpm"> BPM
                </div>
                <!-- キー -->
                <div class="mb-8">
                    <label for="key" class="text-sm block">キー</label>
                    <input type="text" name="key" id="key">
                </div>
                <!-- タグ -->
                <!-- <div class="mb-8">
                    <label for="tags" class="text-sm block">タグ</label>
                    <input type="text" name="tags" id="tags">
                </div> -->
                <!-- ファイル拡張子 -->
                <!-- <div class="mb-8">
                    <label for="fileExtension" class="text-sm block">ファイル拡張子</label>
                    <input type="text" name="fileExtension" id="fileExtension">
                </div> -->
                <!-- サンプルファイル -->
                <div class="mb-8">
                    <label for="sampleFile" class="text-sm block">サンプルファイル</label>
                    <input type="file" name="sampleFile" id="sampleFile">
                </div>
                <!-- ダウンロードファイル -->
                <div class="mb-8">
                    <label for="downloadFile" class="text-sm block">ダウンロードファイル</label>
                    <input type="file" name="downloadFile" id="downloadFile">
                </div>
                <!-- 価格 -->
                <div class="mb-8">
                    <label for="price" class="text-sm block">価格</label>
                    <input type="number" name="price" id="price"> 円
                </div>
                <!-- 補足情報 -->
                <div class="mb-8">
                    <label for="additionalInfo" class="text-sm block">補足情報</label>
                    <textarea name="additionalInfo" id="additionalInfo" rows="4" class="w-full"></textarea>
                </div>
                <!-- 送信ボタン -->
                <div class="mb-8">
                    <button type="submit" class="bg-blue-500 rounded font-medium px-4 py-2 text-white">曲を投稿</button>
                </div>
            </form>

        </div>
    </div>

</x-app-layout>