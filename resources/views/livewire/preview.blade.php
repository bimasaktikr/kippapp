<div class="fixed inset-0 z-10 overflow-y-auto ease-out duration-400">
    <div class="flex items-end justify-center w-full h-full min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <!-- This element is to trick the browser into centering the modal contents. -->
        {{-- <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>? --}}
        <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl xxl:align-middle xl:w-full xl:h-full"
            role="dialog" aria-modal="true" aria-labelledby="modal-headline">
            <iframe src="{{url('/').$preview_url }}" style="width: 80%; height: 80%;" id="Iframe"></iframe>
            <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                <span class="flex w-full mt-3 rounded-md shadow-sm sm:mt-0 sm:w-auto">
                    <button wire:click="closeModal()" type="button"
                        class="inline-flex justify-center w-full px-4 py-2 text-base font-medium leading-6 text-gray-700 transition duration-150 ease-in-out bg-white border border-gray-300 rounded-md shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue sm:text-sm sm:leading-5">
                        Cancel
                    </button>
                </span>
            </div>
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
