<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ __('保存したツイート') }}
    </h2>
  </x-slot>

  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">

            @if ($savedTweets->isNotEmpty())
                    @foreach ($savedTweets as $tweet)
                    <div class="mb-4 p-4 bg-gray-100 dark:bg-gray-700 rounded-lg">
                        <p class="text-gray-800 dark:text-gray-300">{{ $tweet->tweet }}</p>
                        <a href="{{ route('profile.show', $tweet->user) }}">
                            <p class="text-gray-600 dark:text-gray-400 text-sm">投稿者: {{ $tweet->user->name }}</p>
                        </a>
                        <a href="{{ route('tweets.show', $tweet) }}" class="text-blue-500 hover:text-blue-700">詳細を見る</a>
                        <div class="flex mt-2">
                            @if ($tweet->liked->contains(auth()->id()))
                            <form action="{{ route('tweets.dislike', $tweet) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">dislike {{ $tweet->liked->count() }}</button>
                            </form>
                            @else
                            <form action="{{ route('tweets.like', $tweet) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-blue-500 hover:text-blue-700">like {{ $tweet->liked->count() }}</button>
                            </form>
                            @endif
                        </div>
                        <div class="flex">
                            @if ($tweet->savedByUsers->contains(auth()->id()))
                            <form action="{{ route('tweets.unsave', $tweet) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Unsave</button>
                            </form>
                            @else
                            <form action="{{ route('tweets.save', $tweet) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-blue-500 hover:text-blue-700">Save</button>
                            </form>
                            @endif
                        </div>
                    </div>
                    @endforeach

                    
                @else
                    <p class="text-gray-600">保存されたツイートはありません。</p>
                @endif
            </div>
        </div>
    </div>
</div>
</x-app-layout>