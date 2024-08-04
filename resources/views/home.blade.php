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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="mb-4">

    @if (session('error'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "error",
                title: "{{ session('error') }}"
            });
        </script>
    @endif

    <div class="container d-flex justify-content-center align-items-center">
        <div class="text-center">
            <img src="{{ asset('assets/icons/Spotify-Logo.svg') }}" alt="Spotify Music Downloader" class="w-25">

            <form action="{{ route('fetch_playlists') }}" method="post">

                @csrf
                <div class="input-group mb-3" data-bs-theme="dark">
                    <input type="text" class="form-control shadow-none rounded-0"
                        placeholder="Paste Spotify Playlist URL" style="font-size: 15px;"
                        aria-label="Recipient's username" id="spotify-url" aria-describedby="button-addon2"
                        name="url" @required(true)>

                    <button class="btn btn-outline-secondary border-0 rounded-0" type="submit" id="button-addon2"><i
                            class="fa fa-arrow-right" aria-hidden="true"></i></button>
                </div>

                <button type="button" class="btn btn-outline-success btn-sm" onclick="pasteClipboard()">Paste from
                    Clipboard</button>
            </form>
        </div>

    </div>

    <div class="container">
        <div class="mt-5 text-center">

            @unless (empty($downloadLink))
                <img src="{{ $cover }}" class="img-fluid w-25" alt="">
                <div class="row m-auto text-center border p-2 rounded mt-2">

                    <div class="col-xl-4 mt-3">
                        <h6>{{ $artist }}</h6>
                    </div>

                    <div class="col-xl-4 mt-3">
                        <h6>{{ $title }}</h6>
                    </div>

                    <div class="col-xl-4 mt-2">
                        <a href="{{ $downloadLink }}" class="btn btn-outline-primary">Download</a>
                    </div>
                </div>
            @endunless

            {{-- https://open.spotify.com/track/1qBYSqIg90x6055vz3m3pF?si=dad3750f46174d23 --}}
        </div>
    </div>

    <script>
        async function pasteClipboard() {
            try {
                const text = await navigator.clipboard.readText();
                const spotifyUrlPattern = /https:\/\/open\.spotify\.com\/track\/[a-zA-Z0-9]+/;
                if (spotifyUrlPattern.test(text)) {
                    document.getElementById('spotify-url').value = text;
                    document.getElementById('hidden-url').value = text;
                    document.getElementById('spotify-form').submit();
                } else {

                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({
                        icon: "error",
                        title: "Clipboard content is not a valid Spotify track URL"
                    });
                }
            } catch (err) {
                console.error('Failed to read clipboard contents: ', err);
            }
        }
    </script>
</body>

</html>
