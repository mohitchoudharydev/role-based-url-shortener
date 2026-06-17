@extends('layouts.app')

@section('content')

<div class="max-w-xl  p-6 rounded shadow">

    <h2 class="text-xl font-bold mb-4">
        Create Short URL
    </h2>

    @if ($errors->any())
        <div class="mb-4 text-red-500">
            {{ $errors->first() }}
        </div>
    @endif

    <form method="POST"
          action="{{ route('urls.store') }}">

        @csrf

        <label class="block mb-2">
            Original URL
        </label>

        <input
            type="url"
            name="original_url"
            class="w-full border p-2 rounded form-control"
            placeholder="https://google.com"
            required
        >

        <button
            class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">

            Create URL

        </button>

    </form>

</div>

@endsection