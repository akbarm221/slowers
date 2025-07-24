// Langkah 1: Impor semua fungsi yang kita butuhkan dari Firebase SDK
// INI BAGIAN YANG HILANG DAN MENYEBABKAN ERROR
import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-app.js";
import { getAuth, signInWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-auth.js";

fetch('/firebase/config')
    .then(response => response.json())
    .then(firebaseConfig => {
        const app = initializeApp(firebaseConfig);
        const auth = getAuth(app);
        console.log("Firebase berhasil diinisialisasi.");

        // Pindahkan logika login ke sini agar berjalan setelah inisialisasi
        const loginForm = document.getElementById('login-form');

        if (loginForm) {
            loginForm.addEventListener('submit', function(e) {
                e.preventDefault();
                console.log("Tombol login ditekan."); // DEBUG

                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;
                const errorMessage = document.getElementById('error-message');
                errorMessage.textContent = '';

                signInWithEmailAndPassword(auth, email, password)
                    .then((userCredential) => {
                        console.log("Login ke Firebase BERHASIL."); // DEBUG
                        return userCredential.user.getIdToken();
                    })
                    .then((idToken) => {
                        console.log("Mengirim token ke Laravel..."); // DEBUG
                        return fetch('/firebase/verify-token', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({ idToken: idToken })
                        });
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log("Respon dari Laravel:", data); // DEBUG
                        if (data.status === 'success') {
                            console.log("Verifikasi token berhasil, mengarahkan ke dashboard...");
                            window.location.href = '/admin/dashboard';
                        } else {
                            errorMessage.textContent = data.message || 'Gagal memverifikasi token.';
                        }
                    })
                    .catch(error => {
                        console.error("Error saat fetch ke backend:", error); // DEBUG
                        errorMessage.textContent = 'Terjadi kesalahan saat menghubungi server.';
                    });
            });
        }
    })
    .catch(error => {
        console.error("Gagal mengambil konfigurasi Firebase:", error);
        document.getElementById('error-message').textContent = 'Gagal memuat konfigurasi Firebase.';
    });


// Langkah 4: Logika untuk form login
const loginForm = document.getElementById('login-form');

if (loginForm) {
    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        console.log("Tombol login ditekan."); // DEBUG

        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const errorMessage = document.getElementById('error-message');
        errorMessage.textContent = '';

        // Memanggil fungsi signInWithEmailAndPassword yang sudah kita impor
        signInWithEmailAndPassword(auth, email, password)
            .then((userCredential) => {
                console.log("Login ke Firebase BERHASIL."); // DEBUG
                return userCredential.user.getIdToken();
            })
            .then((idToken) => {
                console.log("Mengirim token ke Laravel..."); // DEBUG

                // Kirim token ke backend Laravel
                fetch('/firebase/verify-token', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ idToken: idToken })
                })
                .then(response => response.json())
                .then(data => {
                    console.log("Respon dari Laravel:", data); // DEBUG
                    if (data.status === 'success') {
                        console.log("Verifikasi token berhasil, mengarahkan ke dashboard...");
                        window.location.href = '/admin/dashboard';
                    } else {
                        errorMessage.textContent = data.message || 'Gagal memverifikasi token.';
                    }
                })
                .catch(error => {
                    console.error("Error saat fetch ke backend:", error); // DEBUG
                    errorMessage.textContent = 'Terjadi kesalahan saat menghubungi server.';
                });
            })
            .catch((error) => {
                console.error("Login ke Firebase GAGAL:", error.message); // DEBUG
                errorMessage.textContent = 'Email atau password salah.';
            });
    });
}