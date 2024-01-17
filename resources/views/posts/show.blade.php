<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <a href="{{ route('dashboard') }}" class="hover:text-gray-400 dark:focus:border-blue-700 mr-3 text-xl">
                <i class="uil uil-angle-left"></i>
            </a>
            {{ __('Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100" id="edit">
                    <div class="mt-3 flex justify-center items-center">
                        <p class="font-semibold text-2xl">{{ $post->title }}</p>
                    </div>
                    <div class="mt-3">
                        <p>{!! $post->body !!}</p>
                    </div>
                </div>
                @can('edit posts')
                    @if(Auth::user()->id == $post->author_id)
                    <div class="p-6 text-gray-900 dark:text-gray-100" id="updated" hidden>
                        <form class="max-w-7xl mx-auto sm:px-6 lg:px-8" action="{{ route('posts.updated', $post->id) }}"
                              method="post">
                            @csrf
                            @method('put')
                            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 text-gray-900 dark:text-gray-100">
                                    <div class="mt-3 flex justify-center items-center">
                                        <p class="font-semibold text-2xl">Update your Post: {{ $post->title }}</p>
                                    </div>
                                    <div class="mt-3">
                                        <x-input-label for="title" :value="__('Title')"/>
                                        <x-text-input class="block mt-1 w-full" type="text" name="title"
                                                      :value="old('title', $post->title)" required/>
                                    </div>
                                    <div class="mt-3">
                                        <x-input-label for="body" :value="__('Body')"/>
                                        <input id="x" type="hidden" name="body" value="{{ $post->body }}">
                                        <trix-editor input="x"></trix-editor>
                                    </div>

                                    <div class="flex items-center justify-center mt-4">
                                        <x-primary-button class="ms-3">
                                            {{ __('Submit') }}
                                        </x-primary-button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <x-primary-button onclick="changeVisibility()" class="m-5" id="btn-edit">
                        {{ __('Editar') }}
                    </x-primary-button>
                    <script type="application/javascript">
                        function changeVisibility() {
                            let show = document.getElementById('updated')
                            let disable = document.getElementById('edit')
                            let btn = document.getElementById('btn-edit')

                            disable.hidden = !disable.hidden
                            show.hidden = !show.hidden
                            if (show.hidden) {
                                btn.textContent = "Edit";
                            } else {
                                btn.textContent = "Cancel";
                            }
                        }
                    </script>
                    @endif
                @endcan
            </div>
        </div>
    </div>

</x-app-layout>
