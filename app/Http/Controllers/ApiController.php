<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class ApiController extends Controller
{
    //
    public function fetch_playlists(Request $request)
    {

        $url = $request->input('url');

        // Ensure URL is not empty
        if (empty($url)) {
            return response()->json(['error' => 'URL is required'], 400);
        }

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
                "x-rapidapi-key: 19712ae800msh39302756eeef1abp1b8019jsnc7967b2210ac"
            ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            // echo "cURL Error #:" . $err;

            return response()->json(['error' => 'cURL Error #:' . $err]);
        } else {
            $data = json_decode($response, true);

            if (isset($data['data']) && is_array($data['data'])) {
                $artist = $data['data']['artist'];
                $title = $data['data']['title'];
                $cover = $data['data']['cover'];

                $downloadLink = $data['data']['downloadLink'];

                return view('home', compact('artist', 'title', 'cover', 'downloadLink'));

            } else {
                return redirect()->back()->with('error', 'Could not fetch song');
            }
        }
    }
}
