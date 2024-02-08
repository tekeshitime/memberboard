<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Track;


class TrackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tracks = Track::latest()->paginate(20);
        return view('tracks.index', [
            'tracks' => $tracks
        ]);
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
        Track::create([
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
