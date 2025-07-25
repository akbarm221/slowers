import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-app.js";
import { getFirestore, doc, getDoc, setDoc } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-firestore.js";

async function getFirebaseConfig() {
    try {
        const response = await fetch('/firebase/config');
        if (!response.ok) throw new Error("Gagal mengambil konfigurasi Firebase.");
        return await response.json();
    } catch (error) { console.error(error); return null; }
}

document.addEventListener('DOMContentLoaded', async () => {
    const firebaseConfig = await getFirebaseConfig();
    if (!firebaseConfig) return;

    const app = initializeApp(firebaseConfig);
    const db = getFirestore(app);
    const pendidikanDocRef = doc(db, 'rekap_pendidikan', 'terbaru');

    const pendidikanForm = document.getElementById('pendidikan-form');
    if (pendidikanForm) {
        const simpanButton = document.getElementById('simpan-perubahan-pendidikan');
        const formPesan = document.getElementById('form-pesan');
        const inputs = pendidikanForm.querySelectorAll('input');

        // Ambil data terkini untuk mengisi form
        (async () => {
            const docSnap = await getDoc(pendidikanDocRef);
            if (docSnap.exists()) {
                const data = docSnap.data();
                inputs.forEach(input => {
                    if (data[input.name] !== undefined) {
                        input.value = data[input.name];
                    }
                });
            } else {
                console.log("Dokumen 'terbaru' untuk pendidikan tidak ditemukan!");
            }
        })();

        // Event listener untuk tombol simpan
        simpanButton.addEventListener('click', async (e) => {
            e.preventDefault();
            const dataToSave = {};
            let isValid = true;

            inputs.forEach(input => {
                const value = parseInt(input.value);
                if (isNaN(value)) {
                    isValid = false;
                }
                dataToSave[input.name] = value;
            });

            if (!isValid) {
                formPesan.textContent = 'Semua kolom harus diisi dengan angka.';
                formPesan.className = 'p-4 mb-4 text-sm rounded-lg bg-red-100 text-red-800';
                formPesan.classList.remove('hidden');
                return;
            }

            simpanButton.disabled = true;
            simpanButton.textContent = 'Menyimpan...';

            try {
                await setDoc(pendidikanDocRef, dataToSave);
                formPesan.textContent = 'Data pendidikan berhasil diperbarui!';
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