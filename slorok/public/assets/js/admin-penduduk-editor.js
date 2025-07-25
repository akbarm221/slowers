import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-app.js";
import { getFirestore, doc, onSnapshot, getDoc, setDoc } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-firestore.js";

// Fungsi untuk mengambil konfigurasi Firebase (tidak berubah)
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

// Inisialisasi utama setelah DOM dimuat
document.addEventListener('DOMContentLoaded', async () => {
    const firebaseConfig = await getFirebaseConfig();
    if (!firebaseConfig) {
        console.error('Tidak dapat memuat konfigurasi Firebase. Fitur tidak akan berjalan.');
        return;
    }

    // Inisialisasi Firebase & Firestore
    const app = initializeApp(firebaseConfig);
    const db = getFirestore(app);
    const pendudukDocRef = doc(db, 'rekap_penduduk', 'terbaru');

    // === LOGIKA UNTUK HALAMAN DISPLAY (kependudukan.blade.php) ===
    const displayTotal = document.getElementById('display-total-penduduk');
    const displayLaki = document.getElementById('display-laki-laki');
    const displayPerempuan = document.getElementById('display-perempuan');

    if (displayTotal && displayLaki && displayPerempuan) {
        // Mendengarkan perubahan data di Firestore secara real-time
        onSnapshot(pendudukDocRef, (docSnap) => {
            if (docSnap.exists()) {
                const data = docSnap.data();
                const laki = data.laki_laki || 0;
                const perempuan = data.perempuan || 0;
                
                displayLaki.textContent = laki.toLocaleString('id-ID');
                displayPerempuan.textContent = perempuan.toLocaleString('id-ID');
                displayTotal.textContent = (laki + perempuan).toLocaleString('id-ID');
            } else {
                console.log("Dokumen 'terbaru' tidak ditemukan!");
                displayLaki.textContent = '0';
                displayPerempuan.textContent = '0';
                displayTotal.textContent = '0';
            }
        });
    }

    // === LOGIKA UNTUK HALAMAN FORM EDIT (edit_jumlah_penduduk.blade.php) ===
    const formLaki = document.getElementById('laki_laki_form');
    const formPerempuan = document.getElementById('perempuan_form');
    const simpanButton = document.getElementById('simpan-perubahan-penduduk');
    const formPesan = document.getElementById('form-pesan');

    if (formLaki && formPerempuan && simpanButton) {
        // Ambil data terkini sekali untuk mengisi form
        (async () => {
            const docSnap = await getDoc(pendudukDocRef);
            if (docSnap.exists()) {
                const data = docSnap.data();
                formLaki.value = data.laki_laki || '';
                formPerempuan.value = data.perempuan || '';
            }
        })();

        // Event listener untuk tombol simpan
        simpanButton.addEventListener('click', async (e) => {
            e.preventDefault();
            const lakiValue = parseInt(formLaki.value);
            const perempuanValue = parseInt(formPerempuan.value);

            if (isNaN(lakiValue) || isNaN(perempuanValue)) {
                // ... (logika pesan error tidak berubah) ...
                return;
            }
            
            simpanButton.disabled = true;
            simpanButton.textContent = 'Menyimpan...';

            try {
                // Menyimpan atau mengupdate data di Firestore
                await setDoc(pendudukDocRef, {
                    laki_laki: lakiValue,
                    perempuan: perempuanValue
                });

                formPesan.textContent = 'Data berhasil diperbarui!';
                formPesan.className = 'p-4 mb-4 text-sm rounded-lg bg-green-100 text-green-800';
                formPesan.classList.remove('hidden');
                
                setTimeout(() => {
                    window.location.href = '/admin/infografis'; 
                }, 1500);

            } catch (error) {
                // ... (logika pesan error tidak berubah) ...
                simpanButton.disabled = false;
                simpanButton.textContent = 'Simpan Perubahan';
            }
        });
    }
});