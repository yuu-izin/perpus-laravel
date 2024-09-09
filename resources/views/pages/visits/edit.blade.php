<x-app-layout>
    <x-slot name="header">
    <div class="flex justify-between">
    <div>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
    Halaman Edit Pengunjung
    </h2>
    <div class="text-sm text-gray-500">Halaman untuk mengedit Data Pengunjung</div>
    </div>
    <div>
    <a href="{{ route('visits.index') }}"
    class="bg-blue-950 text-white rounded-md py-2 px-4 text-sm">Kembali</a>
    </div>
    </div>
    </x-slot>
    <div class="py-12">
    @if ($errors->any())
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-3">
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
    <strong class="font-bold">Terjadi Kesalahan!</strong>
    <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
    </ul>
    </div>
    </div>
    @endif
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
    <form action="{{ route('visits.update', $visits->id) }}" method="POST" class="max-w-sm mx-auto">
    @csrf
    @method('PUT')
    <div class="mb-5">
    <label for="name"
    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama</label>
    <input type="text" name="name" value="{{ $visits->name }}"
    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
    placeholder="Masukkan Nama" required />
    </div>
    <div class="mt-5">
    <label for="date"
    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal</label>
    <input type="date" name="date" value="{{ $visits->date }}"
    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
    placeholder="Masukkan Tanggal" />
    </div>
    <div class="mt-5">
    <label for="phone"
    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
    <input type="text" name="phone" value="{{ $visits->phone }}"
    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
    placeholder="Masukkan No.Telepon" />
    </div>
    <div class="mt-5">
    <label for="=agency"
    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Agency</label>
    <input type="text" name="agency" value="{{ $visits->agency }}"
    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
    placeholder="Masukkan Agency" />
    </div>
    <div class="mt-5">
    <button type="submit"
    class="bg-blue-950 text-white rounded-md py-2 px-4 text-sm">Simpan</button>
    </div>
    </form>
    </div>
    </div>
    </div>
    </div>
    </x-app-layout>
