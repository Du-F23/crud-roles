<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-wrap">
        @foreach($posts as $post)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg m-2" style="width: 24.3rem;">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mt-3 flex justify-center items-center">
                        <p class="font-semibold text-2xl">{{ $post->title }}</p>
                    </div>
                    <div class="mt-3">
                        <p>{!! $post->body !!}</p>
                    </div>
                    <div class="flex flex-wrap mt-2 mt-auto justify-end">
                        @can('delete posts')
                            <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <x-danger-button class="m-2">
                                    {{ __('Delete') }}
                                </x-danger-button>
                            </form>
                        @endcan
                        <a class="m-2 inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-800 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                           href="{{ route('posts.show', $post->id) }}">
                            {{ __('Show') }}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @role('Escritor')
    <div class="py-12">
        <form class="max-w-7xl mx-auto sm:px-6 lg:px-8" action="{{ route('posts.store') }}" method="post">
            @csrf
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="mt-3 flex justify-center items-center">
                        <p class="font-semibold text-2xl">Create Post</p>
                    </div>
                    <div class="mt-3">
                        <x-input-label for="title" :value="__('Title')"/>
                        <x-text-input class="block mt-1 w-full" type="text" name="title" :value="old('title')"
                                      required/>
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>
                    <div class="mt-3">
                        <x-input-label for="body" :value="__('Body')"/>
                        <input id="x" type="hidden" name="body">
                        <trix-editor input="x"></trix-editor>
                        <x-input-error :messages="$errors->get('body')" class="mt-2" />
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
    @endrole
</x-app-layout>


