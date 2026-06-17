@extends('layouts.app')

@section('content')

<div class="flex justify-between mb-4">

    <h2 class="text-xl font-bold">
        Generated URLs
    </h2>

@can('create', App\Models\ShortUrl::class)
    <a href="{{ route('urls.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
        Create URL
    </a>
@endcan

</div>

<table class="w-full  shadow table-striped">

    <thead>
    <tr class="bg-gray-200">

        <th class="p-3 text-left">
            Original URL
        </th>

        <th class="p-3 text-left">
            Short Code
        </th>

        <th class="p-3 text-left">
            Created By
        </th>

    </tr>
    </thead>

    <tbody>

    @foreach($urls as $url)

        <tr class="border-t">

            <td class="p-3">
                {{ $url->original_url }}
            </td>

            <td class="p-3">
                {{ $url->short_code }}
            </td>

            <td class="p-3">
                {{ $url->user->name }}
            </td>

        </tr>

    @endforeach

    </tbody>

</table>

@endsection