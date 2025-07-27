import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-app.js";
import { getAuth, onAuthStateChanged } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-auth.js";
import { getFirestore, collection, onSnapshot, orderBy, query, doc, getDoc, addDoc, updateDoc, deleteDoc, serverTimestamp } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-firestore.js";
import { createClient } from 'https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2/+esm';

// --- Konfigurasi dan Inisialisasi ---
let supabase = null;
const BUCKET_NAME = 'media-desa'; // Pastikan nama bucket ini sesuai

async function getFirebaseConfig() { /* ... fungsi ini sama seperti sebelumnya ... */ }
async function getSupabaseConfig() { /* ... fungsi ini sama seperti sebelumnya ... */ }

document.addEventListener('DOMContentLoaded', async () => {
    const firebaseConfig = await getFirebaseConfig();
    if (!firebaseConfig) return;

    const app = initializeApp(firebaseConfig);
    const auth = getAuth(app);
    const db = getFirestore(app);

    onAuthStateChanged(auth, async (user) => {
        if (user) {
            const token = await user.getIdToken();
            const supabaseConfig = await getSupabaseConfig();
            if (supabaseConfig) {
                supabase = createClient(supabaseConfig.url, supabaseConfig.key, {
                    global: { headers: { Authorization: `Bearer ${token}` } }
                });
            }
            jalankanLogikaCRUD(db);
        }
    });
});

function jalankanLogikaCRUD(db) {
    const beritaCollectionRef = collection(db, 'berita');

    // --- LOGIKA UNTUK HALAMAN DAFTAR BERITA (index.blade.php) ---
    const beritaContainer = document.getElementById('berita-container');
    if (beritaContainer) {
        const q = query(beritaCollectionRef, orderBy("tanggal_pembuatan", "desc"));
        onSnapshot(q, (snapshot) => {
            beritaContainer.innerHTML = '';
            if (snapshot.empty) {
                beritaContainer.innerHTML = '<p class="text-center text-gray-500">Belum ada berita yang ditambahkan.</p>';
                return;
            }

            snapshot.forEach(doc => {
                const item = doc.data();
                const docId = doc.id;
                const tanggal = item.tanggal_pembuatan ? new Date(item.tanggal_pembuatan.toDate()).toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' }) : 'N/A';

                const beritaElement = document.createElement('div');
                beritaElement.className = 'flex items-start p-4 border dark:border-gray-700 rounded-lg';
                beritaElement.innerHTML = `
                    <img src="${item.url_gambar || 'https://via.placeholder.com/150'}" alt="${item.judul}" class="w-24 h-24 sm:w-32 sm:h-32 object-cover rounded-md mr-6 flex-shrink-0">
                    <div class="flex-grow">
                        <h3 class="text-lg font-bold">${item.judul}</h3>
                        <p class="text-gray-500 dark:text-gray-400 line-clamp-2 mt-1">${item.isi}</p>
                        <small class="text-gray-400">Dibuat pada: ${tanggal}</small>
                    </div>
                    <div class="flex-shrink-0 flex flex-col sm:flex-row items-center space-y-2 sm:space-y-0 sm:space-x-2 ml-4">
                        <a href="/admin/berita/${docId}/edit" class="btn-secondary w-full sm:w-auto text-center">Edit</a>
                        <button data-id="${docId}" data-gambar-url="${item.url_gambar}" class="btn-danger btn-delete w-full sm:w-auto">Delete</button>
                    </div>
                `;
                beritaContainer.appendChild(beritaElement);
            });
        });

        beritaContainer.addEventListener('click', async (e) => {
            if (e.target && e.target.classList.contains('btn-delete')) {
                const docId = e.target.dataset.id;
                const gambarUrl = e.target.dataset.gambarUrl;

                if (confirm('Apakah Anda yakin ingin menghapus berita ini?')) {
                    try {
                        await deleteDoc(doc(db, "berita", docId));
                        if (gambarUrl && supabase) {
                            const fileName = gambarUrl.split(`${BUCKET_NAME}/`).pop();
                            await supabase.storage.from(BUCKET_NAME).remove([fileName]);
                        }
                        alert('Berita berhasil dihapus!');
                    } catch (error) {
                        alert('Gagal menghapus berita: ' + error.message);
                    }
                }
            }
        });
    }

    // --- LOGIKA UNTUK HALAMAN FORM (create & edit) ---
    const beritaForm = document.getElementById('berita-form');
    if (beritaForm) {
        const simpanBtn = document.getElementById('simpan-berita');
        const gambarInput = document.getElementById('gambar');
        const judulInput = document.getElementById('judul');
        const isiInput = document.getElementById('isi');
        const beritaId = beritaForm.dataset.id;
        let urlGambarLama = beritaForm.dataset.gambarLama;
        const isEditMode = !!beritaId;

        if (isEditMode) {
            (async () => {
                const docRef = doc(db, "berita", beritaId);
                const docSnap = await getDoc(docRef);
                if (docSnap.exists()) {
                    const data = docSnap.data();
                    judulInput.value = data.judul;
                    isiInput.value = data.isi;
                    urlGambarLama = data.url_gambar;
                }
            })();
        }

        simpanBtn.addEventListener('click', async (e) => {
            e.preventDefault();
            if (!supabase) { alert("Supabase belum siap."); return; }

            simpanBtn.disabled = true;
            const file = gambarInput.files[0];
            let urlGambarBaru = urlGambarLama;

            if (file) {
                simpanBtn.textContent = 'Mengupload gambar...';
                const fileName = `${Date.now()}-${file.name.replace(/\s/g, '_')}`;
                try {
                    const { data, error } = await supabase.storage.from(BUCKET_NAME).upload(fileName, file);
                    if (error) throw error;
                    const { data: { publicUrl } } = supabase.storage.from(BUCKET_NAME).getPublicUrl(data.path);
                    urlGambarBaru = publicUrl;
                } catch (error) {
                    alert('Gagal upload: ' + error.message);
                    simpanBtn.disabled = false;
                    return;
                }
            } else if (!isEditMode) {
                alert('Harap pilih gambar untuk berita baru.');
                simpanBtn.disabled = false;
                return;
            }

            const dataBerita = {
                judul: judulInput.value,
                isi: isiInput.value,
                url_gambar: urlGambarBaru,
                ...(isEditMode ? {} : { tanggal_pembuatan: serverTimestamp() })
            };

            try {
                simpanBtn.textContent = 'Menyimpan data...';
                if (isEditMode) {
                    await updateDoc(doc(db, "berita", beritaId), dataBerita);
                    if (file && urlGambarLama) {
                        const oldFileName = urlGambarLama.split(`${BUCKET_NAME}/`).pop();
                        await supabase.storage.from(BUCKET_NAME).remove([oldFileName]);
                    }
                } else {
                    await addDoc(collection(db, "berita"), dataBerita);
                }
                alert('Berita berhasil disimpan!');
                window.location.href = '/admin/berita';
            } catch (error) {
                alert('Gagal menyimpan data: ' + error.message);
                simpanBtn.disabled = false;
                simpanBtn.textContent = isEditMode ? 'Simpan Perubahan' : 'Simpan Berita';
            }
        });
    }
}