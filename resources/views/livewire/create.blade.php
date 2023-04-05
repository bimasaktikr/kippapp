<div class="fixed inset-0 z-10 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <!-- This element is to trick the browser into centering the modal contents. -->
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>?
        <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
            role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <form>
                <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                    <div class="">
                        <div class="mb-4">
                            <label for="exampleFormControlInput1"
                                class="block mb-2 text-sm font-bold text-gray-700">Judul:</label>
                            <input type="text"
                                class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                id="exampleFormControlInput1" placeholder="Enter Title" wire:model="name">
                            @error('name')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="exampleFormControlInput1"
                                class="block mb-2 text-sm font-bold text-gray-700">Tanggal Kegiatan:</label>
                            <input type="date"
                                class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                id="exampleFormControlInput1" placeholder="Enter Title" wire:model="date">
                            @error('date')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="exampleFormControlInput1" class="block mb-2 text-sm font-bold text-gray-700">Tim
                                Kerja:</label>
                            <div>
                                <select wire:model="team" id="team"
                                class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                >
                                    @foreach ($teams as $team)
                                        <option value="{{ $team->id }}">{{ $team->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('team')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror

                        </div>
                        <div class="mb-4">
                            <label for="exampleFormControlInput1" class="block mb-2 text-sm font-bold text-gray-700">Tipe Bukti:</label>
                            <div>
                                <select wire:model="type" id="type"
                                class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                >
                                        <option value="1">Pribadi</option>
                                        <option value="2">Umum</option>

                                </select>
                            </div>
                            @error('type')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror

                        </div>
                        <div class="mb-4">
                            <label for="exampleFormControlInput2"
                                class="block mb-2 text-sm font-bold text-gray-700">Description:</label>
                            <textarea
                                class="w-full px-3 py-2 leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline"
                                id="exampleFormControlInput2" wire:model="description" placeholder="Enter Description"></textarea>
                            @error('description')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="exampleInputName">File</label>
                            <input wire:model="file" type="file" class="form-control" id="exampleInputName" >
                            <div wire:loading wire:target="file">Uploading...</div>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>
                </div>
                <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                    <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                        <button wire:click.prevent="submit()" type="button"
                            class="inline-flex justify-center w-full px-4 py-2 text-base font-medium leading-6 text-white transition duration-150 ease-in-out bg-green-600 border border-transparent rounded-md shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green sm:text-sm sm:leading-5">
                            Save
                        </button>
                    </span>
                    <span class="flex w-full mt-3 rounded-md shadow-sm sm:mt-0 sm:w-auto">
                        <button wire:click="closeModal()" type="button"
                            class="inline-flex justify-center w-full px-4 py-2 text-base font-medium leading-6 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue sm:text-sm sm:leading-5">
                            Cancel
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- @push('scripts') --}}
    {{-- <script>

    $(document).ready(function() {

        $('#team').Activities();

        $('#team').on('change', function (e) {

            var data = $('#team').Activities("val");

            @this.set('team', data);

        });

    });

</script> --}}
{{-- @endpush --}}
