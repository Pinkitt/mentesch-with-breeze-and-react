
<x-layout>
    <x-slot:title>Kezdőlap</x-slot:title>
    <x-slot:heading> 
        <div class="flex items-center justify-center gap-3 text-4xl sm:text-5xl md:text-6xl font-extrabold tracking-tight dark:text-white">
        
        <span>Mentes</span>
        
        <div id="rotating-text-root" class="flex items-center"></div>
        
        </div>
        @push('scripts')
            @vite(['resources/js/rotate.jsx'])
        @endpush
    </x-slot:heading>
    <x-slot>
        <h1 class="text-center text-xl">Üdvözlünk a Mentesch weboldalán!</h1><br>
        <div>
        <div class="bg-green-500 text-xl p-5 float-right">Élet...</div>
        <h2 class="text-right">Ez az oldal azért jött létre hogy allergiás embereket segíthessünk a mindennapjaik megkönnyebítésében, legyen szó főzésről, bevásárlásról vagy éppenséggel megfelelő étterem megtalálásáról.</h2>
        </div>
        <div>
        <div class="bg-green-500 text-xl p-5 float-left">Élmény...</div>
        <p class="text-left">Keress a saját allergiádhoz igazított éttermeket, tudasd a pincérrel az allergiáidat a saját egyéni allergia listáddal, vagy csak egyszerűen könnyítsd meg az otthoni főzést a hozzávaló-alternatíva listával!</p>
        </div>
        <div class="bg-green-500 text-xl p-5 float-right">Segítség...</div>
        <p class="text-right text-gray-500">Az oldal funkcióinak eléréséhez regisztráció szükséges.</p>
    </x-slot>
</x-layout>