<x-layout>
    <x-slot:title>{{$restaurant->name}}</x-slot:title>
    <x-slot:heading>{{$restaurant->name}}</x-slot:heading>
    <x-slot>
        <div class="restaurant-details">
        <div class="header-section">
            <div class="relative py-12 mb-10 overflow-hidden rounded-2xl bg-gradient-to-br from-emerald-800 via-teal-700 to-blue-900 shadow-2xl text-5xl text-black dark:text-white">
                <h1 class="mb-5"><strong>{{ $restaurant->name }}</strong></h1>
            </div>
            <p class="text-3xl mb-2 text-black dark:text-white">Cím: {{ $restaurant->address }}</p>
            <span>
            <span class="text-black dark:text-white">{{ number_format($restaurant->average_rating,1) }}</span>
            @for($i=1;$i<=5;++$i)
                @if($i<=floor($restaurant->average_rating))
                    <span class="text-yellow-400 text-2xl">★</span>
                
                @elseif($i==ceil($restaurant->average_rating) && ($restaurant->average_rating-floor($restaurant->average_rating) >= 0.1))
                    <span class="text-yellow-400 text-2xl" style="position: relative; display: inline-block;">
                        <span style="position: absolute; overflow: hidden; width: 50%;">★</span>
                        <span class="text-gray-300">★</span>
                    </span>
                
                @else
                <span class="text-gray-300 text-2xl">★</span>
                @endif
            @endfor

            <span class="text-slate-600">({{ count($restaurant->reviews) }} vélemény)</span>
            </span>
            
        </div>

        <div class="button-wrapper">
            <button class="btn-new-review text-black dark:text-white" onclick="beginReviewWriting()">✍️ Új vélemény írása...</button>
        </div>
        <div id="container">

        </div>

        <hr class="separator">

        <div class="comment-wall text-black dark:text-white bg-white dark:bg-zinc-950" id="restaurant-comment-wall" data-is-admin="{{ auth()->check() && auth()->user()->is_admin ? 'true' : 'false' }}">
            
        @foreach($restaurant->reviews as $review)
            <div class="comment-card bg-white dark:bg-zinc-950 mb-4 p-4 rounded-lg shadow">
                <div class="comment-header flex justify-between">
                    <span class="user-name font-bold">{{ $review->user->username }}</span>
                    <span class="comment-date text-sm text-gray-500">
                        {{ \Carbon\Carbon::parse($review->created_at)->format('Y.m.d H:i') }}
                    </span>
                </div>

                <div class="comment-body text-black dark:text-white my-2">
                    {{ $review->comment }}
                </div>
                <div class="flex items-center justify-center leading-none">
                    @php
                    $star = "★";
                    @endphp
                    <span class="text-yellow-400 text-2xl space-x-0.5">{{ str_repeat($star,$review->rating) }}</span>
                    @if (5-$review->rating!=0)
                    <span class="inline-flex text-gray-300 text-2xl space-x-0.5">{{ str_repeat($star,5-$review->rating) }}</span>
                    @endif
                </div>

                @if(Auth::check() && (Auth::user()->is_admin || Auth::user()->id == $review->user_id))
                    <div class="text-right">
                        <button class="p-2 bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white border border-red-500/50 rounded-lg transition-all transform active:scale-95 shadow-sm">
                            <span class="text-xl">🗑️</span>
                        </button>
                    </div>
                @endif
            </div>
        @endforeach
            
            </div>
        </div>
    </x-slot>
</x-layout>