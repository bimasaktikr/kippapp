<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        Manage activity (Laravel 8 Jetstream Livewire CRUD Example - Tutsmake.com)
    </h2>
</x-slot>
<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="px-4 py-4 overflow-hidden bg-white shadow-xl sm:rounded-lg">
            @if (session()->has('message'))
                <div class="px-4 py-3 my-3 text-teal-900 bg-teal-100 border-t-4 border-teal-500 rounded-b shadow-md"
                    role="alert">
                    <div class="flex">
                        <div>
                            <p class="text-sm">{{ session('message') }}</p>
                        </div>
                    </div>
                </div>
            @endif
            <button wire:click="create()"
                class="px-4 py-2 my-3 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">Create activity</button>
            @if ($isOpen)
                @include('livewire.create')
            @endif
            @if ($isPreviewOpen)
                @include('livewire.preview')
            @endif

            <table id="myTable" class="w-full table-fixed">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="w-20 px-4 py-2">No.</th>
                        <th class="px-4 py-2">Judul Kegiatan</th>
                        <th class="px-4 py-2">Tanggal Kegiatan</th>
                        <th class="px-4 py-2">Tim Kerja</th>
                        <th class="px-4 py-2">File Path</th>
                        <th class="px-4 py-2">Tipe</th>
                        <th class="px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($activities as $activity)
                        <tr>
                            <td class="px-4 py-2 border">{{ $activity->id }}</td>
                            <td class="px-4 py-2 border">{{ $activity->name }}</td>
                            <td class="px-4 py-2 border">{{ $activity->date }}</td>
                            <td class="px-4 py-2 border">{{ $activity->team->name }}</td>
                            <td class="px-4 py-2 border">{{ $activity->file_path }}</td>
                            <td class="px-4 py-2 border">{{ $activity->type }}</td>
                            <td class="px-4 py-2 border">
                                {{-- <i class="bi-alarm"></i> --}}
                                <div class="btn-group btn-group-sm pe-2" role="group" aria-label="Basic example">
                                    <button wire:click="preview({{ $activity->id }})" target="_blank"
                                        class="px-2 py-1 mx-1 font-bold text-white bg-blue-500 rounded bi bi-eye hover:bg-blue-700"></button>
                                    <button wire:click="copyToClipboard({{ $activity->id }})"
                                            class="px-2 py-1 text-white bg-blue-500 rounded mx-1font-bold bi bi-clipboard hover:bg-blue-700">
                                            @if(session()->has('copied'))
                                                <div>Copied!</div>
                                            @endif
                                    </button>
                                    <button wire:click="edit({{ $activity->id }})"
                                        class="px-2 py-1 mx-1 font-bold text-white bg-blue-500 rounded bi bi-pencil hover:bg-blue-700"></button>
                                    <button wire:click="delete({{ $activity->id }})"
                                        class="px-2 py-1 font-bold text-white bg-red-500 rounded bi bi-trash hover:bg-red-700"></button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


{{-- @livewireScripts --}}
{{-- @stack('scripts') --}}
