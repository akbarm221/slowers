import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-app.js";
import { getFirestore, doc, onSnapshot, getDoc, setDoc } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-firestore.js";

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
    if (!firebaseConfig) {
        console.error('Tidak dapat memuat konfigurasi Firebase.');
        return;
    }

    const app = initializeApp(firebaseConfig);
    const db = getFirestore(app);
    const agamaDocRef = doc(db, 'rekap_agama', 'terbaru');

    // === LOGIKA UNTUK HALAMAN DISPLAY (kependudukan.blade.php) ===
    const agamaDisplayContainer = document.getElementById('agama-display-container');
    if (agamaDisplayContainer) {
        onSnapshot(agamaDocRef, (docSnap) => {
            if (docSnap.exists()) {
                const data = docSnap.data();
                for (const key in data) {
                    const el = document.getElementById(`display-${key}`);
                    if (el) {
                        el.textContent = (data[key] || 0).toLocaleString('id-ID');
                    }
                }
            } else {
                console.log("Dokumen data agama 'terbaru' tidak ditemukan!");
            }
        });
    }

    // === LOGIKA UNTUK HALAMAN FORM EDIT (edit_agama.blade.php) ===
    const agamaForm = document.getElementById('agama-form');
    if (agamaForm) {
        const simpanButton = document.getElementById('simpan-perubahan-agama');
        const formPesan = document.getElementById('form-pesan');

        // Isi form dengan data terkini
        (async () => {
            const docSnap = await getDoc(agamaDocRef);
            if (docSnap.exists()) {
                const data = docSnap.data();
                for (const key in data) {
                    const input = document.getElementById(`form-${key}`);
                    if (input) {
                        input.value = data[key] || 0;
                    }
                }
            }
        })();

        // Event listener untuk tombol simpan
        simpanButton.addEventListener('click', async (e) => {
            e.preventDefault();
            
            const dataToSave = {};
            const inputs = agamaForm.querySelectorAll('input');
            let isValid = true;

            inputs.forEach(input => {
                const value = parseInt(input.value);
                if (isNaN(value)) {
                    isValid = false;
                }
                dataToSave[input.name] = value;
            });

            if (!isValid) {
                formPesan.textContent = 'Harap isi semua kolom dengan angka yang valid.';
                formPesan.className = 'p-4 mb-4 text-sm rounded-lg bg-red-100 text-red-800';
                formPesan.classList.remove('hidden');
                return;
            }

            simpanButton.disabled = true;
            simpanButton.textContent = 'Menyimpan...';

            try {
                await setDoc(agamaDocRef, dataToSave);
                formPesan.textContent = 'Data agama berhasil diperbarui!';
                formPesan.className = 'p-4 mb-4 text-sm rounded-lg bg-green-100 text-green-800';
                formPesan.classList.remove('hidden');
                
                setTimeout(() => {
                    window.location.href = '/admin/infografis'; 
                }, 1500);

            } catch (error) {
                formPesan.textContent = 'Terjadi kesalahan: ' + error.message;
                formPesan.className = 'p-4 mb-4 text-sm rounded-lg bg-red-100 text-red-800';
                formPesan.classList.remove('hidden');
                simpanButton.disabled = false;
                simpanButton.textContent = 'Simpan Perubahan';
            }
        });
    }
});