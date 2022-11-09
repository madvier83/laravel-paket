<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')

    <title>Laravel Paket</title>
</head>

<body class="min-h-screen">
    
    <div class="flex flex-col">
        <p class="text-3xl font-bold mt-8 md:mt-32 mx-auto">History</p>
        <p class="text-3xl font-bold mt-8 mx-auto">
            <a href="/" class="btn btn-primary w-96">+ Kirim Paket</a>
        </p>
        <div class="overflow-x-auto mx-auto mt-8 pb-32">

            <table class="table w-full">
                <thead>
                    <tr>
                        <th></th>
                        <th>Kota Pengirim</th>
                        <th>Kota Tujuan</th>
                        <th>Detail</th>
                        <th>Jarak</th>
                        <th>Berat</th>
                        <th>Ongkir</th>
                        <th>Driver</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($histories as $history)
                    <tr>
                        <th>{{ $loop->iteration }}</th>
                        <td>{{ $history->city_a }}</td>
                        <td>{{ $history->city_b }}</td>
                        <td>{{ substr($history->detail, 0, 70) }}</td>
                        <td>{{ $history->distance }} Km</td>
                        <td>{{ $history->weight }} Kg</td>
                        <td>Rp. {{ number_format($history->ongkir) }}</td>
                        <td>{{ $history->driver->name }} Kg</td>
                        <td>{{ $history->created_at->diffForHumans() }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</body>

</html>