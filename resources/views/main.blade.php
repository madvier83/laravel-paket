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
    <form action="/ongkir" method="POST" class="flex flex-col">
        @csrf
        <p class="text-3xl font-bold mt-8 md:mt-32 mx-auto">Kirim Paket</p>

        <div class="mx-auto w-96 flex justify-center items-end mt-16 bg-success bg-opacity-5 pb-4 pt-1 rounded-xl">
            <div class="opacity-90 pb-2">
                <img src="/img/box.png" width="58" alt="paket">
            </div>
            <div class="flex">
                <div class="form-control w-full ml-8">
                    <label class="label text-white">
                        <span class="label-text">Berat Paket (kg)</span>
                    </label>
                    <input type="text" name="weight" value="1"
                        class="bg-opacity-60 input input-bordered w-full @error('weight') border-error @enderror" />
                    @error('weight')
                    <label class="label">
                        <span class="label-text text-error">{{ $message }}</span>
                    </label>
                    @enderror
                </div>
            </div>
        </div>

        <div class="mx-auto">
            <div class="flex flex-col w-96 gap-4 mt-4 bg-success bg-opacity-5 py-6 px-4 rounded-xl">

                <div class="form-control max-w-lg">
                    <label class="label text-white">
                        <span class="label-text">Kota Pengirim</span>
                    </label>
                    <select name="coordinate_a"
                        class="select select-bordered font-normal text-zinc-400 @error('coordinate_a') border-error @enderror">
                        <option disabled selected>-- select ---</option>
                        @foreach($cities as $city)
                        <option value="{{ $city->lat . " ," . $city->lng . "," . $city->city}}"
                            {{ old('coordinate_a') == $city->lat . "," . $city->lng . "," . $city->city ? 'selected' :
                            ''}}>
                            {{ $city->city }}
                        </option>
                        @endforeach
                    </select>
                </div>


                <div class="form-control max-w-lg">
                    <label class="label text-white">
                        <span class="label-text">Kota Tujuan</span>
                    </label>
                    <select name="coordinate_b"
                    class="select select-bordered font-normal text-zinc-400 @error('coordinate_b') border-error @enderror">
                    <option disabled selected>-- select ---</option>
                    @foreach($cities as $city)
                    <option value="{{ $city->lat . " ," . $city->lng . "," . $city->city}}">{{ $city->city }}
                    </option>
                    @endforeach
                    </select>
                    @error('coordinate_b')
                    <label class="label">
                        <span class="label-text text-error">{{ $message }}</span>
                    </label>
                    @enderror
                </div>
                
                <div class="form-control max-w-lg">
                    <label class="label text-white">
                        <span class="label-text">Detail alamat</span>
                    </label>
                    <textarea name="detail" class="input input-bordered h-28 py-2 @error('detail') border-error @enderror" cols="30" rows="10"></textarea>
                </div>
                @error('detail')
                <label class="label">
                    <span class="label-text text-error">{{ $message }}</span>
                </label>
                @enderror
            </div>

            <div class="flex flex-col">
                <button class="btn btn-success w-96 mt-4">Cek Ongkos Kirim</button>
                <a href="/histori" class="btn btn-ghost w-96 mt-4">Cek Histori</a>
            </div>
        </div>
    </form>

</body>

</html>