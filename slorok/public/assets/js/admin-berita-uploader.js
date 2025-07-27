import { createClient } from 'https://cdn.jsdelivr.net/npm/@supabase/supabase-js@2/+esm'

let supabase = null;
(async () => {
    try {
        const response = await fetch('/supabase/config');
        const config = await response.json();
        supabase = createClient(config.url, config.key);
    } catch (error) {
        console.error("Gagal inisialisasi Supabase:", error);
    }
})();

const beritaForm = document.getElementById('berita-form');
if (beritaForm) {
    const simpanBtn = document.getElementById('simpan-berita');
    const gambarInput = document.getElementById('gambar');
    const urlGambarInput = document.getElementById('url_gambar');
    const tanggalInput = document.getElementById('tanggal_pembuatan');
    const formPesan = document.getElementById('form-pesan');

    beritaForm.addEventListener('submit', async (e) => {
        e.preventDefault();

        if (!supabase) {
            alert("Supabase belum siap. Coba beberapa saat lagi.");
            return;
        }

        const file = gambarInput.files[0];
        
        // Cek jika ini form edit dan tidak ada file baru
        const isEditMode = beritaForm.querySelector('input[name="_method"]')?.value === 'PUT';
        if (isEditMode && !file) {
            simpanBtn.disabled = true;
            simpanBtn.textContent = 'Menyimpan data...';
            beritaForm.submit(); // Langsung submit tanpa upload gambar baru
            return;
        }

        if (!file) {
            alert("Pilih gambar terlebih dahulu!");
            return;
        }

        simpanBtn.disabled = true;
        simpanBtn.textContent = 'Mengupload gambar...';

        const fileName = `${Date.now()}-${file.name}`;
        
        // --- PERBAIKAN DI SINI ---
        const { data, error } = await supabase.storage
            .from('media-desa') // Ganti nama bucket menjadi 'media-desa'
            .upload(fileName, file);

        if (error) {
            formPesan.textContent = 'Gagal upload: ' + error.message;
            formPesan.classList.remove('hidden');
            simpanBtn.disabled = false;
            simpanBtn.textContent = 'Simpan Berita';
            return;
        }
        
        // --- PERBAIKAN DI SINI ---
        const { data: { publicUrl } } = supabase.storage
            .from('media-desa') // Ganti nama bucket menjadi 'media-desa'
            .getPublicUrl(data.path);
        
        urlGambarInput.value = publicUrl;

        // Hanya set tanggal jika ini form create
        if(tanggalInput) {
            tanggalInput.value = new Date().toISOString();
        }

        simpanBtn.textContent = 'Menyimpan data...';
        beritaForm.submit();
    });
}