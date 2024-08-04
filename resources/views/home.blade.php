<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Spotify Music Downloader</title>

    <link rel="shortcut icon" href="{{ asset('assets/icons/icons8.png') }}" type="image/x-icon">

    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="mb-4">

    <div class="container d-flex justify-content-center align-items-center">
        <div class="text-center">
            <img src="{{ asset('assets/icons/Spotify-Logo.svg') }}" alt="Spotify Music Downloader" class="w-25">

            <form action="{{ route('fetch_playlists') }}" method="post">

                @csrf
                <div class="input-group mb-3" data-bs-theme="dark">
                    <input type="text" class="form-control shadow-none rounded-0"
                        placeholder="Paste Spotify Playlist URL" style="font-size: 15px;"
                        aria-label="Recipient's username" aria-describedby="button-addon2" name="url" @required(true)>

                    <button class="btn btn-outline-secondary border-0 rounded-0" type="submit" id="button-addon2"><i
                            class="fa fa-arrow-right" aria-hidden="true"></i></button>
                </div>
            </form>
        </div>

    </div>

    <div class="container">
        <div class="mt-5">
            @unless (empty($downloadLink))
                <div class="row m-auto text-center border p-2 rounded mt-2">
                    <div class="col-xl-3">
                        <img src="{{ $cover }}" class="img-fluid w-25 rounded-circle" alt="">
                    </div>

                    <div class="col-xl-3 mt-3">
                        <h6>{{ $artist }}</h6>
                    </div>

                    <div class="col-xl-3 mt-3">
                        <h6>{{ $title }}</h6>
                    </div>

                    <div class="col-xl-3 mt-2">
                        <a href="{{ $downloadLink }}" class="btn btn-outline-primary">Download</a>
                    </div>
                </div>
            @endunless


        </div>
    </div>

</body>

</html>
