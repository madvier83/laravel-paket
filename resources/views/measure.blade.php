<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')

    <title>Laravel Paket</title>
</head>
{{-- @dd($result) --}}
<body class="min-h-screen">
    <div class="flex flex-col">
        <p class="text-3xl font-bold mt-32 mx-auto">Kirim Paket</p>

        <div class="mx-auto w-96 flex justify-center items-end mt-16 bg-primary bg-opacity-5 pb-4 pt-1 rounded-xl">
            <div class="opacity-90 pb-2">
                <img src="/img/box.png" width="58" alt="paket">
            </div>
            <div class="flex">
                <div class="form-control w-full ml-8">
                    <label class="label text-white">
                        <span class="label-text">Berat Paket (kg)</span>
                    </label>
                    <input type="number" value="{{ $result['weight'] }}" class="input input-bordered text-zinc-300" disabled/>
                </div>
            </div>
        </div>

        <div class="mx-auto">
            <div class="flex flex-col w-96 gap-4 mt-4 bg-primary bg-opacity-5 py-6 px-4 rounded-xl">

                <div class="form-control max-w-lg">
                    <label class="label text-white">
                        <span class="label-text">Kota Pengirim</span>
                    </label>
                    <select class="select select-bordered font-normal text-white" disabled>
                        <option selected>{{ $result['city_a'] }}</option>
                    </select>
                </div>


                <div class="form-control max-w-lg">
                    <label class="label text-white">
                        <span class="label-text">Kota Tujuan</span>
                    </label>
                    <select class="select select-bordered font-normal text-white" disabled>
                        <option selected>{{ $result['city_b'] }}</option>
                    </select>
                </div>

            </div>

            <div class="flex flex-col w-96 gap-4 mt-4 bg-primary bg-opacity-40 text-zinc-100 py-6 px-6 rounded-xl">
                <h3 class="mx-auto font-bold text-xl">Ongkir: Rp. {{ number_format($result['ongkir']) }}</h3>
                <div class="flex flex-col font-normal text-zinc-300">
                    <p>Berat : {{ $result['weight'] }} Kg </p>
                    <p>Jarak : {{ $result['distance'] }} Km</p>
                    <p>Harga : ( Rp.{{ 500 }}/Km x Berat )</p>
                </div>
            </div>

            <form action="/" method="POST" class="flex flex-col">
                @csrf

                <input type="hidden" name="weight" value="{{ $result['weight'] }}">
                <input type="hidden" name="distance" value="{{ $result['distance'] }}">
                <input type="hidden" name="coordinate_a" value="{{ $result['coordinate_a'] }}">
                <input type="hidden" name="coordinate_b" value="{{ $result['coordinate_b'] }}">
                <input type="hidden" name="city_a" value="{{ $result['city_a'] }}">
                <input type="hidden" name="city_b" value="{{ $result['city_b'] }}">
                <input type="hidden" name="distance" value="{{ $result['distance'] }}">
                <input type="hidden" name="ongkir" value="{{ $result['ongkir'] }}">
                <input type="hidden" name="detail" value="{{ $result['detail'] }}">

                <button class="btn btn-primary w-96 mt-4">Cari Driver</button>
                <a href="/" class="btn btn-ghost w-96 mt-4">Kembali</a>
            </form>

        </div>
    </div>
</body>

</html>