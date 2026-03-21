<x-layout>
    <x-slot:title>Allergének</x-slot:title>
    <x-slot:heading>Allergének</x-slot:heading>
    <x-slot>
        <div class="relative py-12 mb-10 overflow-hidden rounded-2xl bg-gradient-to-br from-emerald-800 via-teal-700 to-blue-900 shadow-2xl">
            <h1 class="text-5xl md:text-7xl font-extrabold  tracking-tight drop-shadow-md">Allergének</h1>
        </div>
        <div id="allergens-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-4 max-w-7xl mx-auto">
    </div>

        <script>
            fetch('/api/allergens-data')
            .then(response => response.json())
            .then(data => {
                const container = document.getElementById('allergens-container');
                let htmlContent = '';

            data.forEach(allergen => { 
                let textColor = '';
                let hoverColor = '';

                if (['Glutén', 'Mustár', 'Szezámmag', 'Szója'].includes(allergen.name)) {
                    textColor = 'text-amber-300';
                    hoverColor = 'group-hover:text-amber-400';
                } 
                else if (['Hal', 'Laktóz'].includes(allergen.name)) {
                    textColor = 'text-blue-500';
                    hoverColor = 'group-hover:text-blue-600';
                } 
                else if (['Zeller', 'Mogyoró'].includes(allergen.name)) {
                    textColor = 'text-lime-400';
                    hoverColor = 'group-hover:text-lime-500';
                } 
                else if (allergen.name === 'Tojás') {
                    textColor = 'text-slate-300';
                    hoverColor = 'group-hover:text-slate-400';
                } 
                else {
                    textColor = 'text-red-400';
                    hoverColor = 'group-hover:text-red-500';
                }

                htmlContent += `
                    <div class="bg-gray-800 border border-gray-700 rounded-xl p-6 flex flex-col transition-all duration-300 hover:-translate-y-1 hover:border-emerald-500 hover:shadow-[0_0_15px_rgba(52,211,153,0.15)] group">
            
                    <h3 class="text-2xl font-bold ${textColor} mb-4 ${hoverColor} transition-colors">
                        ${allergen.name}
                    </h3>
            
                    <div class="mt-auto pt-4 border-t border-gray-700/50">
                        <h3 class="font-bold mb-4 transition-colors">
                        ${allergen.desc}
                        </h3>
                    </div>

                    <div class="mt-auto pt-4 border-t border-gray-700/50">
                        <h3 class="text-xl font-bold mb-4 transition-colors">
                        ${allergen.replist}
                        </h3>
                    </div>
                    </div>
                `;
            });

        container.innerHTML = htmlContent;
    })
    .catch(error => console.error('Hiba történt:', error));
</script>
    </x-slot>
</x-layout>