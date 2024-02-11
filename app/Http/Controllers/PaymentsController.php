<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Models\Track;


class PaymentsController extends Controller
{
    public function payment(Request $request)
    {
        // dd($request);
        try {
            $line_items = [
                'price_data' => [
                    'currency' => 'jpy',
                    'unit_amount' => $request->amount,
                    'product_data' => [
                        'name' => $request->title,
                        'description' => 'test',
                    ],
                ],
                'quantity'    => 1,
            ];
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items'           => [$line_items],
                'success_url'          => route('complete'),
                'cancel_url'           => route('tracks.index'),
                'mode'                 => 'payment',
            ]);

            return view('tracks.checkout', [
                'trackId' => session()->put('trackId', $request->trackId),
                'session' => $session,
                'publicKey' => env('STRIPE_KEY')
            ]);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function complete()
    {
        $userEmail = Auth::user()->email;
        $trackId = session()->get('trackId');
        $record = Track::where('id', $trackId)->first();
        if ($record) {
            // レコードが見つかった場合、pathdownloadfileの値を取得
            $pathDownloadFile = $record->pathDownloadFile;
        } else {
            echo "ない";
        }

        $data = array();
        $data['text'] = "http://localhost/pulsegarden/public/" . $pathDownloadFile . " 右クリックしてダウンロード";

        Mail::send(
            'tracks.mail',
            $data,
            function ($message) use ($userEmail) {
                $message->to($userEmail)
                    ->subject('[ダウンロードリンク]ご購入ありがとうございます。');
            }
        );
        return view('tracks.complete');
    }
}
