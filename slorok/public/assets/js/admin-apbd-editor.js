import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-app.js";
import { getFirestore, collection, onSnapshot, doc, getDoc, setDoc } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-firestore.js";

async function getFirebaseConfig() {
    try {
        const response = await fetch('/firebase/config');
        if (!response.ok) throw new Error("Gagal mengambil konfigurasi Firebase.");
        return await response.json();
    } catch (error) {
        console.error(error);
        return null;
    }
}

document.addEventListener('DOMContentLoaded', async () => {
    const firebaseConfig = await getFirebaseConfig();
    if (!firebaseConfig) return;

    const app = initializeApp(firebaseConfig);
    const db = getFirestore(app);
    const apbdCollectionRef = collection(db, 'rekap_apbd');

    // --- LOGIKA UNTUK HALAMAN DISPLAY (INFOGRAFIS) ---
    const tahunSelectEl = document.getElementById('tahun-apbd-select');
    if (tahunSelectEl) {
        const tahunDisplayEl = document.getElementById('display-tahun-apbd');
        const totalPendapatanEl = document.getElementById('display-total-pendapatan');
        const totalBelanjaEl = document.getElementById('display-total-belanja');
        const updateBtn = document.getElementById('update-apbd-button');
        const updateBtnYear = document.getElementById('update-apbd-button-year');

        onSnapshot(apbdCollectionRef, (snapshot) => {
            const apbdDataCache = {};
            const tahunTersedia = [];
            snapshot.forEach(doc => {
                apbdDataCache[doc.id] = doc.data();
                tahunTersedia.push(doc.id);
            });
            
            tahunSelectEl.innerHTML = '';
            tahunTersedia.sort((a, b) => b - a).forEach(tahun => {
                const option = new Option(tahun, tahun);
                tahunSelectEl.add(option);
            });
            
            const updateDisplayUI = (tahun) => {
                const data = apbdDataCache[tahun];
                if (!data) return;

                tahunDisplayEl.textContent = tahun;
                updateBtnYear.textContent = tahun;
                updateBtn.href = `/admin/infografis/apbd/${tahun}/edit`;

                const totalPendapatan = (data.pendapatan_asli_desa || 0) + (data.pendapatan_transfer || 0) + (data.pendapatan_lain_lain || 0);
                const totalBelanja = (data.belanja_pemerintahan || 0) + (data.belanja_pembangunan || 0) + (data.belanja_kemasyarakatan || 0) + (data.belanja_pemberdayaan || 0) + (data.belanja_darurat || 0);
                totalPendapatanEl.textContent = 'Rp' + totalPendapatan.toLocaleString('id-ID');
                totalBelanjaEl.textContent = 'Rp' + totalBelanja.toLocaleString('id-ID');
            };
            
            tahunSelectEl.addEventListener('change', (e) => updateDisplayUI(e.target.value));
            
            if (tahunTersedia.length > 0) {
                updateDisplayUI(tahunTersedia[0]);
            }
        });
    }

    // --- LOGIKA UNTUK HALAMAN FORM (CREATE & EDIT) ---
    const apbdForm = document.getElementById('apbd-form');
    if (apbdForm) {
        const formPesan = document.getElementById('form-pesan');
        const simpanBtn = document.getElementById('simpan-apbd');
        const tahunInput = document.getElementById('tahun');

        const isEditMode = !tahunInput; // Jika tidak ada input tahun, berarti mode edit
        let editTahun = isEditMode ? apbdForm.querySelector('input[type=hidden][id=tahun]').value : null;
        
        if (isEditMode) {
            const docRef = doc(db, 'rekap_apbd', editTahun);
            const docSnap = await getDoc(docRef);
            if (docSnap.exists()) {
                const data = docSnap.data();
                Object.keys(data).forEach(key => {
                    const input = apbdForm.querySelector(`[name="${key}"]`);
                    if(input) input.value = data[key];
                });
            }
        } else {
            tahunInput.min = new Date().getFullYear();
        }

        simpanBtn.addEventListener('click', async (e) => {
            e.preventDefault();
            const tahun = isEditMode ? editTahun : tahunInput.value;
            if (!tahun) { alert('Tahun wajib diisi!'); return; }

            const docRef = doc(db, 'rekap_apbd', tahun);
            
            if (!isEditMode) {
                const docSnap = await getDoc(docRef);
                if (docSnap.exists()) {
                    alert(`Data untuk tahun ${tahun} sudah ada. Silakan gunakan fitur update.`);
                    return;
                }
            }
            
            const dataToSave = {};
            const inputs = apbdForm.querySelectorAll('input[type="number"]');
            inputs.forEach(input => {
                dataToSave[input.name] = parseInt(input.value) || 0;
            });
            
            simpanBtn.disabled = true;
            simpanBtn.textContent = 'Menyimpan...';

            try {
                await setDoc(docRef, dataToSave);
                formPesan.textContent = `Data APBD tahun ${tahun} berhasil disimpan!`;
                formPesan.className = 'p-4 mb-4 text-sm rounded-lg bg-green-100 text-green-800';
                formPesan.classList.remove('hidden');
                setTimeout(() => window.location.href = '/admin/infografis', 1500);
            } catch (error) {
                // ... (handling error) ...
                simpanBtn.disabled = false;
                simpanBtn.textContent = isEditMode ? 'Simpan Perubahan' : 'Simpan Data';
            }
        });
    }
});