
<x-layout>
    <x-slot:title>Kezdőlap</x-slot:title>
    <x-slot:heading> 
        <section class="relative w-full min-h-[50vh] md:min-h-[60vh] flex flex-col items-center justify-center bg-[#121212] overflow-hidden">
  
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,_rgba(45,212,191,0.15)_0%,_transparent_60%)]"></div>

            <div class="absolute inset-0 opacity-[0.03] bg-[linear-gradient(to_right,#ffffff_1px,transparent_1px),linear-gradient(to_bottom,#ffffff_1px,transparent_1px)] bg-[size:4rem_4rem]"></div>

            <div class="relative z-10 flex items-center justify-center gap-3 text-4xl sm:text-5xl md:text-6xl font-extrabold tracking-tight dark:text-white text-white">

              <span>Mentes</span>

              <div id="rotating-text-root" class="flex items-center"></div>

            </div>
  
        </section>
        @push('scripts')
            @vite(['resources/js/rotate.jsx'])
        @endpush
    </x-slot:heading>
    <x-slot>
        <div class="bg-[#121212] min-h-screen p-10 font-sans text-white flex flex-col items-center">
  
            <h1 class="text-3xl text-center mb-16 uppercase text-gray-100">
              Üdvözlünk a Mentesch weboldalán!
            </h1>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl w-full">
              
              <div class="bg-[#24221f] border border-[#3b3834] p-5 flex flex-col text-center">
                <img src="/elet.jpeg" alt="Élet" class="w-full h-56 object-cover mb-6 shadow-md">
                <h2 class="text-lg font-bold mb-4 uppercase tracking-widest text-white">Élet</h2>
                <p class="text-sm text-gray-300 mb-8 leading-relaxed flex-grow">
                  Ez az oldal azért jött létre hogy allergiás embereket segíthessünk a mindennapjaik megkönnyítésében, legyen szó főzésről, bevásárlásról vagy éppenséggel megfelelő étterem megtalálásáról.
                </p>
              </div>
            
              <div class="bg-[#24221f] border border-[#3b3834] p-5 flex flex-col text-center">
                <img src="/elmeny.jpg" alt="Élmény" class="w-full h-56 object-cover mb-6 shadow-md">
                <h2 class="text-lg font-bold mb-4 uppercase tracking-widest text-white">Élmény</h2>
                <p class="text-sm text-gray-300 mb-8 leading-relaxed flex-grow">
                  Keress a saját allergiádhoz igazított éttermeket, tudasd a pincérrel az allergiáidat a saját egyéni allergia listáddal, vagy csak egyszerűen könnyítsd meg az otthoni főzést a hozzávaló-alternatíva listával!
                </p>
              </div>
            
              <div class="bg-[#24221f] border border-[#3b3834] p-5 flex flex-col text-center">
                <img src="/segitseg.jpg" alt="Segítség" class="w-full h-56 object-cover mb-6 shadow-md">
                <h2 class="text-lg font-bold mb-4 uppercase tracking-widest text-white">Segítség</h2>
                <p class="text-sm text-gray-300 mb-8 leading-relaxed flex-grow">
                    Mire vársz még? Próbáld ki a funkciókat még ma!*
                </p>
                <p class="text-xs text-gray-400 mb-8 leading-relaxed flex-grow flex items-center justify-center">
                  *Az oldal funkcióinak eléréséhez regisztráció szükséges.
                </p>
              </div>
            
            </div>
        </div>
    </x-slot>
</x-layout>