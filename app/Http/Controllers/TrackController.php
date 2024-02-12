<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Track;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use File;


class TrackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $blogs = Blog::latest()->get();;
        $tracks = Track::latest()->paginate(20);
        return view('tracks.index', [
            'tracks' => $tracks,
            'blogs' => $blogs,
        ]);
    }

    public function archive(Request $request)
    {
        /* テーブルから全てのレコードを取得する */
        $Tracks = Track::query();
        /* キーワードから検索処理 */
        $keyword = $request->input('keyword');
        if (!empty($keyword)) { //$keyword　が空ではない場合、検索処理を実行します
            $Tracks->where('trackTitle', 'LIKE', "%{$keyword}%")->get();
        }

        /* ページネーション */
        $tracks = $Tracks->paginate(5);
        return view('tracks.archive', ['tracks' => $tracks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tracks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sampleFile' => 'required|mimes:mp3,wav', // 必須で、拡張子が mp3 または wav のファイル
            'downloadFile' => 'required|mimes:mp3,wav', // 必須で、拡張子が mp3 または wav のファイル
        ]);

        $dirArtwork = 'image';
        $dirSample = 'audio/sample';
        $dirDownload = 'audio/original';

        // アップロードされたファイル名を取得
        $artwork_name = $request->file('artwork')->getClientOriginalName();
        $samplefile_name = $request->file('sampleFile')->getClientOriginalName();
        $downloadFile_name = $request->file('downloadFile')->getClientOriginalName();

        // 取得したファイル名で保存
        $request->file('artwork')->storeAs('public/' . $dirArtwork, $artwork_name);
        $request->file('sampleFile')->storeAs('public/' . $dirSample, $samplefile_name);
        $request->file('downloadFile')->storeAs('public/' . $dirDownload, $downloadFile_name);

        // dd([
        //     'trackTitle' => $request->trackTitle,
        //     'pathArtwork' => 'storage/' . $dirArtwork . '/' . $artwork_name,
        //     'bpm' => $request->bpm,
        //     'key' => $request->key,
        //     'pathSampleFile' => 'storage/' . $dirSample . '/' . $samplefile_name,
        //     'pathDownloadFile' => 'storage/' . $dirDownload . '/' . $downloadFile_name,
        //     'price' => $request->price,
        //     'additionalInfo' => $request->additionalInfo,
        // ]);
        $user_id = $request->user()->id;
        Track::create([
            'user_id' => $user_id,
            'trackTitle' => $request->trackTitle,
            'pathArtwork' => 'storage/' . $dirArtwork . '/' . $artwork_name,
            'bpm' => $request->bpm,
            'key' => $request->key,
            'pathSampleFile' => 'storage/' . $dirSample . '/' . $samplefile_name,
            'pathDownloadFile' => 'storage/' . $dirDownload . '/' . $downloadFile_name,
            'price' => $request->price,
            'additionalInfo' => $request->additionalInfo,
        ]);
        return redirect()->route('tracks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $track = Track::find($id);
        return view('tracks.show')->with('track', $track);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $track = Track::find($id);
        // if (auth()->user()->id != $track->user_id) {
        //     return redirect(route('tracks.index'))->with('error', '許可されていない操作です');
        // }
        return view('tracks.edit')->with('track', $track);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $tracks = Track::find($id);
        // if (auth()->user()->id != $tracks->user_id) {
        //     return redirect(route('posts.index'))->with('error', '許可されていない操作です');
        // }

        $tracks->trackTitle = $request->trackTitle;
        // $artwork_name = $request->file('artwork')->getClientOriginalName();
        if ($request->file('artwork')) {
            $pathArtwork = $request->file('artwork')->getClientOriginalName();
            $tracks->pathArtwork = "storage/image/" . $pathArtwork;
            $request->file('artwork')->storeAs('image', 'public');
        }

        $tracks->bpm = $request->bpm;
        $tracks->key = $request->key;

        if ($request->file('sampleFile')) {
            $sampleFile = $request->file('sampleFile')->getClientOriginalName();
            $tracks->pathSampleFile = "storage/audio/sample/" . $sampleFile;
            $request->file('sampleFile')->storeAs('public/audio/sample', $sampleFile);
        }

        if ($request->file('downloadFile')) {
            $downloadFile = $request->file('downloadFile')->getClientOriginalName();
            $tracks->pathDownloadFile = "storage/audio/original/" . $downloadFile;
            $request->file('downloadFile')->storeAs('public/audio/original',  $downloadFile);
        }
        $tracks->price = $request->price;
        $tracks->additionalInfo = $request->additionalInfo;

        $tracks->save();

        return redirect(route('tracks.index'))->with('success', 'トラックを更新しました');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tracks = Track::find($id);
        $tracks->delete();

        return redirect(route('tracks.index'))->with('success', 'ブログ記事を削除しました');
    }
}
