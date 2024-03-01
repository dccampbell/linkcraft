<x-app-layout>
    <div class="py-12 text-gray-900 dark:text-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (\Session::has('success'))
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-3">
                <div class="p-6">
                    {!! \Session::get('success') !!}
                </div>
            </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-3">
                <h2 class="text-xl font-bold m-4 mb-2">
                    Create/Import New Links
                </h2>

                <div class="columns-2 gap-4">
                    <form action="{{ action(\App\Http\Controllers\LinkCreate::class) }}" method="POST" class="p-6">
                        @csrf
                        <x-text-input name="url" placeholder="Long URL" class="w-full" required />
                        <x-primary-button class="my-2">Add Link</x-primary-button>
                        @error('url')
                            <div class="text-red-400">{{ $message }}</div>
                        @enderror
                    </form>

                    <form action="{{ action(\App\Http\Controllers\LinkImport::class) }}" method="POST" class="p-6" enctype="multipart/form-data">
                        @csrf
                        <x-file-input name="file" class="w-full" accept=".csv" required />
                        <x-primary-button class="my-2">Import Links</x-primary-button>
                        @error('file')
                            <div class="text-red-400">{{ $message }}</div>
                        @enderror
                    </form>
                </div>

            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg my-3">

                <h2 class="text-xl font-bold m-4">
                    Shortened Links
                </h2>

                <div class="flex flex-col">
                    <div class="overflow-x-auto mx-0.5">
                        <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8 mb-4">
                            <table class="table-auto min-w-full text-sm text-gray-900">
                                <thead class="bg-gray-500">
                                <tr class="text-left">
                                    <th scope="col" class="px-6 py-4 w-32">             Short URL    </th>
                                    <th scope="col" class="px-6 py-4">                  Original URL </th>
                                    <th scope="col" class="px-6 py-4 w-20 text-center"> Hits         </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(\Auth::user()->links as $link)
                                    <tr class="{{ $loop->even ? 'bg-gray-300' : 'bg-gray-400' }} border-b">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ $link->short_url }}" target="_blank" class="hover:text-indigo-800">
                                                {{ \App\Models\Link::SLUG_PREFIX }}{{ $link->slug }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <a href="{{ $link->url }}" target="_blank" class="hover:text-indigo-800">
                                                {{ $link->url }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            {{ $link->hits }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
