<x-layout>
    <x-slot:title>Étteremkereső</x-slot:title>
    
    <x-slot>
        <div class="relative py-12 mb-10 overflow-hidden rounded-2xl bg-gradient-to-br from-emerald-800 via-teal-700 to-blue-900 shadow-2xl">
            <div class="relative z-10 text-center">
                <h1 class="text-5xl md:text-7xl font-extrabold text-white tracking-tight drop-shadow-md">
                    Étteremkereső
                </h1>
                <p class="mt-4 text-emerald-100 text-lg font-medium">Találd meg a legjobb ízeket a környéken!</p>
            </div>
            <div class="absolute -top-10 -right-10 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-2xl mx-auto mb-16">
            <form class="relative group">
                <input name="search" id="search" 
                    placeholder="Keress rá egy étteremre..." 
                    class="w-full bg-[#24221f] border-2 border-[#3b3834] text-white text-lg rounded-full py-4 px-8 pl-14 
                           focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 outline-none transition-all duration-300
                           group-hover:border-[#4d4a45]">
                <div class="absolute left-5 top-1/2 -translate-y-1/2 text-2xl grayscale group-focus-within:grayscale-0 transition-all">
                    🔎
                </div>
                <button type="submit" class="absolute right-3 top-1/2 -translate-y-1/2 bg-emerald-600 hover:bg-emerald-500 text-white px-6 py-2 rounded-full font-bold transition-colors">
                    Keresés
                </button>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-10">
            @foreach ($restaurants as $r)
                <div class="group bg-[#24221f] border border-[#3b3834] rounded-2xl overflow-hidden shadow-lg 
                            hover:-translate-y-2 hover:border-emerald-500/50 hover:shadow-emerald-900/20 transition-all duration-300 flex flex-col">
                    
                    <div class="p-6 flex-grow text-center">
                        <div class="w-16 h-16 bg-emerald-900/30 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                            <span class="text-3xl">🍽️</span>
                        </div>
                        
                        <h3 class="text-2xl font-bold text-white mb-2 group-hover:text-emerald-400 transition-colors">
                            {{ $r->name }}
                        </h3>
                        
                        <div class="flex items-center justify-center gap-2 text-gray-400 mb-6">
                            <span class="text-emerald-500">★</span>
                            <span>{{ count($r->reviews) }} vélemény</span>
                        </div>
                    </div>

                    <div class="p-4 bg-[#1c1a17] border-t border-[#3b3834]">
                        <a href="/restaurants/{{ $r->id }}" 
                           class="block w-full text-center py-3 rounded-xl bg-transparent border border-emerald-500/30 text-emerald-400 font-semibold
                                  hover:bg-emerald-500 hover:text-white transition-all duration-300">
                            Részletek megtekintése
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        @if(count($restaurants) == 0)
            <div class="text-center py-20">
                <p class="text-gray-500 text-xl">Sajnos nem találtunk ilyen éttermet az adatbázisunkban! 😕</p>
            </div>
        @endif

    </x-slot>
</x-layout>