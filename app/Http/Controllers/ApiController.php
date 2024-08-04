<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    //
    public function fetch_playlists(Request $request)
    {

        $url = $request->input('url');

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => "https://spotify-downloader9.p.rapidapi.com/downloadSong?songId={$url}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "x-rapidapi-host: spotify-downloader9.p.rapidapi.com",
                "x-rapidapi-key: 42f503244cmsh53f60704eda2911p158869jsnd555cbfa525f"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $data = json_decode($response, true);

            if (isset($data['data']) && is_array($data['data'])) {
                $artist = $data['data']['artist'];
                $title = $data['data']['title'];
                $cover = $data['data']['cover'];

                $downloadLink = $data['data']['downloadLink'];

                return view('home', compact('artist', 'title', 'cover', 'downloadLink'));
            } else {
                return view('home', ['error' => 'Invalid URL']);
            }return redirect()->back()->with('error', 'Failed to retrieve data');
        }
    }
}
