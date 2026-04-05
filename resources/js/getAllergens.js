function getAllergenColors(name) {
    const colors = {
        'Glutén': { text: 'text-amber-300', hover: 'group-hover:text-amber-400' },
        'Mustár': { text: 'text-amber-300', hover: 'group-hover:text-amber-400' },
        'Szezámmag': { text: 'text-amber-300', hover: 'group-hover:text-amber-400' },
        'Szója': { text: 'text-amber-300', hover: 'group-hover:text-amber-400' },
        'Hal': { text: 'text-blue-500', hover: 'group-hover:text-blue-600' },
        'Laktóz': { text: 'text-blue-500', hover: 'group-hover:text-blue-600' },
        'Zeller': { text: 'text-lime-400', hover: 'group-hover:text-lime-500' },
        'Mogyoró': { text: 'text-lime-400', hover: 'group-hover:text-lime-500' },
        'Tojás': { text: 'text-slate-300', hover: 'group-hover:text-slate-400' }
    };

    return colors[name] || { text: 'text-red-400', hover: 'group-hover:text-red-500' };
}

async function fetchAllergens() {
    try {
        const response = await fetch('/api/allergens');
        if (!response.ok) {
            throw new Error(`Hálózati hiba történt: ${response.status}`);
        }
        const responseData = await response.json();
        return Array.isArray(responseData) ? responseData : (responseData.data || []);
    } catch (error) {
        console.error('Hiba az allergének lekérdezésekor:', error);
        return [];    
    }
}

window.deleteAllergen = async function(id) {
    if (!confirm('Biztosan törölni szeretnéd ezt az allergént?')) return;

    try {
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';
        
        const response = await fetch(`/api/allergens/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        });

        if (response.ok) {
            alert('Sikeres törlés!');
            location.reload();
        } else if (response.status === 403 || response.status === 401) {
            alert('Nincs jogosultságod a törléshez (Admin jog szükséges)!');
        } else {
            alert('Hiba történt a törlés során.');
        }
    } catch (error) {
        console.error('Hiba:', error);
    }
};

async function renderAllergens() {
    const container = document.getElementById('allergens-container');
    if (!container) return;

    const isAdmin = container.getAttribute('data-is-admin') === 'true';
    const allergens = await fetchAllergens();

    const htmlContent = allergens.map(allergen => {
        const { text: textColor, hover: hoverColor } = getAllergenColors(allergen.name);

        return `
            <div class="bg-gray-200 dark:bg-zinc-900 border border-black/2 dark:border-white/10 rounded-xl p-6 flex flex-col transition-all duration-300 hover:-translate-y-1 hover:border-emerald-500 hover:shadow-[0_0_15px_rgba(52,211,153,0.15)] group">
            
            ${isAdmin ? `
            <div class="text-right">
                <button onclick="deleteAllergen(${allergen.id})" class="text-xl p-2 bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white border border-red-500/50 rounded-lg transition-all">
                    🗑️
                </button>
            </div>
            ` : ''}
            
            <h3 class="text-2xl font-bold ${textColor} mb-4 ${hoverColor} transition-colors">
                ${allergen.name}
            </h3>

            <div class="mt-auto pt-4 border-t border-gray-700/50">
                <p class="dark:text-gray-300 text-gray-500 mb-4">
                    ${allergen.desc}
                </p>
            </div>

            <div class="mt-auto pt-4 border-t border-gray-700/50">
                <p class="text-sm font-semibold text-gray-400 mb-2 italic">Helyettesítők:</p>
                <h3 class="text-xl font-bold mb-4 transition-colors">
                    ${allergen.replist}
                </h3>
            </div>
            </div>
        `;
    }).join('');
    container.innerHTML = htmlContent;
}

window.getAllergens = renderAllergens;

if (document.readyState === 'complete' || document.readyState === 'interactive') {
    renderAllergens();
} else {
    document.addEventListener('DOMContentLoaded', renderAllergens);
}