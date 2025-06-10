<x-app-layout>

    <div class="py-4">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                <h1 class="text-2xl mb-4">{{ $post->title }}</h1>
                {{-- User Avatar --}}
                <div class="flex gap-4">
                    <x-user-avatar :user="$post->user" />
                    {{-- User Avatar --}}

                    <div>
                        <x-follow-ctr :user="$post->user" class="flex gap-2">
                            <a href="{{ route('profile.show', $post->user) }}" class="hover:underline">
                                {{ $post->user->name }}
                            </a>

                            @auth
                                &middot;
                                <button href="#" :class="following ? 'text-red-500' : 'text-emerald-600'"
                                    x-text="following ? 'Unfollow' : 'Follow' " @click="follow()">
                                </button>
                            @endauth
                        </x-follow-ctr>
                        <div class="flex gap-2 text-gray-500 text-sm">
                            {{ $post->readTime() }} min read
                            &middot;
                            {{ $post->created_at->format('M d, Y') }}
                        </div>
                    </div>
                </div>
                {{-- User Avatar --}}

                @if ($post->user_id === Auth::id())
                    <div class="py-4 mt-8 border-t border-gray-200">
                        <x-primary-button href="{{ route('post.edit' ,$post->slug) }}">
                            Edit Post
                        </x-primary-button>

                        <form action="{{ route('post.destroy', $post) }}" method="POST" class="inline-block">
                            @csrf
                            @method('delete')
                            <x-danger-button>
                                Delete Post
                            </x-danger-button>
                        </form>

                    </div>
                @endif

                {{-- Clap Section --}}
                <x-clap-button :post="$post" />

                {{-- Content Section --}}
                <div class="mt-8">
                    <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" class="w-full">
                    <div class="mt-4">
                        {{ $post->content }}
                    </div>
                </div>
                {{-- Content Section --}}

                {{--  Category --}}
                <div class="mt-8">
                    <span class="px-4 py-2 bg-gray-300 rounded-xl">
                        {{ $post->category->name }}
                    </span>
                </div>

                {{-- Clap Section --}}
                <x-clap-button :post="$post" />

            </div>
        </div>
    </div>
</x-app-layout>
