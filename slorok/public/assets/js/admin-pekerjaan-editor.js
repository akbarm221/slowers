import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-app.js";
import { getFirestore, collection, onSnapshot, doc, getDocs, getDoc, updateDoc } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-firestore.js";

async function getFirebaseConfig() {
    try {
        const response = await fetch('/firebase/config');
        if (!response.ok) throw new Error("Gagal mengambil konfigurasi Firebase.");
        console.log("✅ Konfigurasi Firebase berhasil diambil."); // DEBUG
        return await response.json();
    } catch (error) {
        console.error("❌ Gagal mengambil konfigurasi Firebase:", error); // DEBUG
        return null;
    }
}

document.addEventListener('DOMContentLoaded', async () => {
    console.log("🚀 DOMContentLoaded: Memulai skrip editor."); // DEBUG
    const firebaseConfig = await getFirebaseConfig();
    if (!firebaseConfig) {
        console.error('Tidak dapat memuat konfigurasi Firebase. Fitur tidak akan berjalan.');
        return;
    }

    const app = initializeApp(firebaseConfig);
    const db = getFirestore(app);
    
    // === LOGIKA UNTUK HALAMAN DISPLAY (INFOGRAFIS) ===
    const pekerjaanDisplaySection = document.getElementById('tabel-pekerjaan-container');
    if (pekerjaanDisplaySection) {
        console.log("📊 Halaman infografis terdeteksi. Memulai logika display pekerjaan."); // DEBUG
        const pekerjaanCollectionRef = collection(db, 'pekerjaan');
        const tabelContainer = document.getElementById('tabel-pekerjaan-container');
        const kartuContainer = document.getElementById('kartu-pekerjaan-container');
        const filterButtons = document.querySelectorAll('.filter-btn-pekerjaan');

        onSnapshot(pekerjaanCollectionRef, (querySnapshot) => {
            console.log(`[Display] Menerima update dari Firestore, ${querySnapshot.size} dokumen diterima.`); // DEBUG
            const dataPekerjaan = [];
            querySnapshot.forEach((doc) => {
                const data = doc.data();
                dataPekerjaan.push({
                    id: doc.id,
                    jenis: data.nama,
                    laki_laki: data.jumlah_laki_laki || 0,
                    perempuan: data.jumlah_perempuan || 0,
                    total: (data.jumlah_laki_laki || 0) + (data.jumlah_perempuan || 0)
                });
            });

            const renderTampilan = (filter = 'semua') => {
                console.log(`[Display] Merender tampilan dengan filter: ${filter}`); // DEBUG
                // 1. Render Tabel Kiri (urut abjad)
                tabelContainer.innerHTML = '';
                const sortedAlphabetically = [...dataPekerjaan].sort((a, b) => a.jenis.localeCompare(b.jenis));
                sortedAlphabetically.forEach(item => {
                    const row = document.createElement('div');
                    row.className = 'flex items-center p-3 border-b border-gray-200 dark:border-gray-700';
                    let jumlahTampilDiTabel = item.total;
                     if (filter === 'laki_laki') jumlahTampilDiTabel = item.laki_laki;
                     if (filter === 'perempuan') jumlahTampilDiTabel = item.perempuan;
                    row.innerHTML = `<span class="text-sm flex-1">${item.jenis}</span><span class="text-sm font-semibold text-right">${jumlahTampilDiTabel.toLocaleString('id-ID')}</span>`;
                    tabelContainer.appendChild(row);
                });

                // 2. Render Kartu Kanan (Top 6 berdasarkan filter)
                kartuContainer.innerHTML = '';
                let sortedForCards;
                if (filter === 'laki_laki') sortedForCards = [...dataPekerjaan].sort((a, b) => b.laki_laki - a.laki_laki);
                else if (filter === 'perempuan') sortedForCards = [...dataPekerjaan].sort((a, b) => b.perempuan - a.perempuan);
                else sortedForCards = [...dataPekerjaan].sort((a, b) => b.total - a.total);
                
                const top6 = sortedForCards.slice(0, 6);
                console.log("[Display] Menampilkan Top 6:", top6); // DEBUG
                top6.forEach(item => {
                    const card = document.createElement('div');
                    card.className = 'bg-white dark:bg-gray-900 p-6 rounded-xl shadow-lg text-center';
                    let jumlahTampilDiKartu = item.total;
                    if (filter === 'laki_laki') jumlahTampilDiKartu = item.laki_laki;
                    if (filter === 'perempuan') jumlahTampilDiKartu = item.perempuan;
                    card.innerHTML = `<p class="text-sm text-gray-500 dark:text-gray-400 mb-2 truncate">${item.jenis}</p><p class="text-4xl font-bold">${jumlahTampilDiKartu.toLocaleString('id-ID')}</p>`;
                    kartuContainer.appendChild(card);
                });
            };

            filterButtons.forEach(button => {
                button.onclick = () => {
                    filterButtons.forEach(btn => {
                        btn.classList.remove('bg-blue', 'text-white');
                        btn.classList.add('bg-white', 'dark:bg-gray-700');
                    });
                    button.classList.add('bg-blue', 'text-white');
                    button.classList.remove('bg-white', 'dark:bg-gray-700');
                    renderTampilan(button.dataset.filter);
                };
            });
            renderTampilan('semua');
        });
    }

    // === LOGIKA UNTUK HALAMAN FORM EDIT (edit_pekerjaan.blade.php) ===
    const pekerjaanForm = document.getElementById('pekerjaan-form');
    if (pekerjaanForm) {
        console.log("📄 Form edit pekerjaan ditemukan. Memulai logika form."); // DEBUG
        const dropdown = document.getElementById('pekerjaan-dropdown');
        const lakiInput = document.getElementById('laki_laki_pekerjaan_form');
        const perempuanInput = document.getElementById('perempuan_pekerjaan_form');
        const simpanButton = document.getElementById('simpan-perubahan-pekerjaan');
        let pekerjaanList = [];

        // Ambil semua data pekerjaan dan isi dropdown
        (async () => {
            try {
                console.log("📡 [Edit Form] Mengambil data dari Firestore..."); // DEBUG
                const querySnapshot = await getDocs(collection(db, 'pekerjaan'));
                console.log(`✅ [Edit Form] Data diterima. Ditemukan ${querySnapshot.size} dokumen.`); // DEBUG

                querySnapshot.forEach(doc => {
                    pekerjaanList.push({ id: doc.id, ...doc.data() });
                });
                
                console.log("📦 [Edit Form] Data pekerjaan yang sudah diproses:", pekerjaanList); // DEBUG

                const sortedJobs = pekerjaanList.sort((a, b) => a.nama.localeCompare(b.nama));
                dropdown.innerHTML = '<option value="">-- Pilih Jenis Pekerjaan --</option>';
                sortedJobs.forEach(job => {
                    const option = document.createElement('option');
                    option.value = job.id;
                    option.textContent = job.nama;
                    dropdown.appendChild(option);
                });
                console.log("✅ [Edit Form] Dropdown berhasil diisi."); // DEBUG

            } catch (error) {
                console.error("❌ [Edit Form] Gagal mengambil data pekerjaan:", error); // DEBUG
            }
        })();

        // Saat pekerjaan dipilih dari dropdown, isi input
        dropdown.addEventListener('change', () => {
            const selectedJobId = dropdown.value;
            console.log(`👤 [Edit Form] Pengguna memilih pekerjaan dengan ID: ${selectedJobId}`); // DEBUG
            const selectedJob = pekerjaanList.find(p => p.id === selectedJobId);
            
            if (selectedJob) {
                console.log("🔍 [Edit Form] Data ditemukan:", selectedJob); // DEBUG
                lakiInput.value = selectedJob.jumlah_laki_laki || 0;
                perempuanInput.value = selectedJob.jumlah_perempuan || 0;
                lakiInput.disabled = false;
                perempuanInput.disabled = false;
                lakiInput.classList.remove('bg-gray-100', 'dark:bg-gray-600');
                perempuanInput.classList.remove('bg-gray-100', 'dark:bg-gray-600');
            } else {
                console.log("⚠️ [Edit Form] Tidak ada pilihan, input dinonaktifkan."); // DEBUG
                lakiInput.value = '';
                perempuanInput.value = '';
                lakiInput.disabled = true;
                perempuanInput.disabled = true;
                lakiInput.classList.add('bg-gray-100', 'dark:bg-gray-600');
                perempuanInput.classList.add('bg-gray-100', 'dark:bg-gray-600');
            }
        });

        // Simpan perubahan ke Firestore
        simpanButton.addEventListener('click', async (e) => {
            e.preventDefault();
            const selectedJobId = dropdown.value;
            const lakiValue = parseInt(lakiInput.value);
            const perempuanValue = parseInt(perempuanInput.value);

            if (!selectedJobId) { alert('Pilih jenis pekerjaan terlebih dahulu.'); return; }
            if (isNaN(lakiValue) || isNaN(perempuanValue)) { alert('Jumlah harus berupa angka.'); return; }

            console.log(`💾 [Edit Form] Menyimpan data untuk ID: ${selectedJobId}`, { jumlah_laki_laki: lakiValue, jumlah_perempuan: perempuanValue }); // DEBUG
            simpanButton.disabled = true;
            simpanButton.textContent = 'Menyimpan...';
            
            const docToUpdateRef = doc(db, 'pekerjaan', selectedJobId);
            try {
                await updateDoc(docToUpdateRef, {
                    jumlah_laki_laki: lakiValue,
                    jumlah_perempuan: perempuanValue
                });
                console.log("✅ [Edit Form] Data berhasil diupdate."); // DEBUG
                alert('Data berhasil diperbarui!');
                window.location.href = '/admin/infografis';
            } catch (error) {
                console.error("❌ [Edit Form] Gagal menyimpan:", error); // DEBUG
                alert('Gagal menyimpan: ' + error.message);
                simpanButton.disabled = false;
                simpanButton.textContent = 'Simpan Perubahan';
            }
        });
    }
});