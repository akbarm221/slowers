import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-app.js";
import {
    getFirestore,
    doc,
    onSnapshot,
    collection,
} from "https://www.gstatic.com/firebasejs/10.12.2/firebase-firestore.js";

async function getFirebaseConfig() {
    try {
        const response = await fetch("/firebase/config");
        if (!response.ok)
            throw new Error("Gagal mengambil konfigurasi Firebase.");
        return await response.json();
    } catch (error) {
        console.error(error);
        return null;
    }
}

document.addEventListener("DOMContentLoaded", async function () {
    console.log("🚀 charts.js: DOMContentLoaded, memulai inisialisasi."); // DEBUG
    const firebaseConfig = await getFirebaseConfig();
    if (!firebaseConfig) {
        console.error(
            "❌ charts.js: Gagal memuat konfigurasi Firebase, skrip dihentikan."
        ); // DEBUG
        return;
    }

    const buttons = document.querySelectorAll(".tab-button");
    const contents = document.querySelectorAll(".tab-content");

 // --- Variabel Global untuk menyimpan instance Chart ---
    let pendidikanChartInstance = null;
    let pendapatanChartInstance = null;
    let belanjaChartInstance = null;
    let renderedCharts = {};

    buttons.forEach((button) => {
        button.addEventListener("click", () => {
            const targetId = button.dataset.target;
            contents.forEach((content) => content.classList.add("hidden"));
            const targetContent = document.querySelector(targetId);
            if (targetContent) targetContent.classList.remove("hidden");

            buttons.forEach((btn) => {
                btn.classList.remove("bg-primary-600", "text-white");

                btn.classList.add(
                    "bg-white",
                    "dark:bg-gray-700",
                    "text-gray-800",
                    "dark:text-gray-200",
                    "hover:bg-gray-100"
                );
            });
            button.classList.add("bg-primary-600", "text-white");

            button.classList.remove(
                "bg-white",
                "dark:bg-gray-700",
                "text-gray-800",
                "dark:text-gray-200",
                "hover:bg-gray-100"
            );

            observeVisibleContent();
        });
    });

    // LOGIKA ANIMASI ANGKA ---

    const animateNumber = (element) => {
        const target = parseFloat(element.dataset.value);
        const format = element.dataset.format;
        const duration = 1500;
        let startTimestamp = null;

        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min(
                (timestamp - startTimestamp) / duration,
                1
            );
            const current = progress * target;
            let formattedText =
                format === "currency"
                    ? "Rp" + Math.floor(current).toLocaleString("id-ID")
                    : Math.floor(current).toLocaleString("id-ID");
            element.innerText = formattedText;
            if (progress < 1) window.requestAnimationFrame(step);
        };
        window.requestAnimationFrame(step);
    };

    // KONFIGURASI DAN PEMBUATAN GRAFIK (CHART) ---


    const createChart = (canvasId, config) => {
        if (renderedCharts[canvasId]) return;
        const canvas = document.getElementById(canvasId);
        if (!canvas) return;
        new Chart(canvas.getContext("2d"), config);
        renderedCharts[canvasId] = true;
    };

    // Fungsi bantuan untuk format mata uang di sumbu grafik
    const formatAsShortCurrency = (value) => {
        if (value >= 1.0e9) return "Rp " + (value / 1.0e9).toFixed(2) + " M";
        if (value >= 1.0e6) return "Rp " + (value / 1.0e6).toFixed(1) + " Jt";
        if (value >= 1.0e3) return "Rp " + (value / 1.0e3).toFixed(1) + " Rb";
        return "Rp " + value;
    };

    const chartData = {
        years: ["2018", "2019", "2020", "2021", "2022"],
        colors: {
            peternakan: ["#4caf50", "#8dd18d", "#bce5bc"],
            perkebunan: ["#4caf50", "#8dd18d", "#bce5bc"],
            tanamanPangan: [
                "#D4AF37",
                "#4caf50",
                "#2e7d32",
                "#8dd18d",
                "#bce5bc",
            ],
            apbd: {
                pendapatan: ["#2e7d32", "#4caf50", "#8dd18d"],
                belanja: [
                    "#ff6b35",
                    "#ff8a5c",
                    "#ffab8a",
                    "#ffcba8",
                    "#ffe8d6",
                ],
            },
        },
    };

    const app = initializeApp(firebaseConfig);
    const db = getFirestore(app);
    console.log("🔥 charts.js: Firebase Firestore berhasil diinisialisasi."); // DEBUG
    // Chart Logic

    const chartConfigs = {
        peternakanChart: {
            type: "bar",
            data: {
                labels: chartData.years,
                datasets: [
                    {
                        label: "Sapi",
                        data: [1235, 1236, 1240, 1240, 1240],
                        backgroundColor: chartData.colors.peternakan[0],
                    },
                    {
                        label: "Kambing",
                        data: [153, 155, 160, 160, 160],
                        backgroundColor: chartData.colors.peternakan[1],
                    },
                    {
                        label: "Ayam",
                        data: [1720, 1700, 1750, 1750, 1750],
                        backgroundColor: chartData.colors.peternakan[2],
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: "top" } },
                scales: { y: { beginAtZero: true } },
            },
        },
        perkebunanChart: {
            type: "bar",
            data: {
                labels: chartData.years,
                datasets: [
                    {
                        label: "Kelapa",
                        data: [2, 2, 2, 2, 2],
                        backgroundColor: chartData.colors.perkebunan[0],
                    },
                    {
                        label: "Karet",
                        data: [0, 0, 0, 0, 0],
                        backgroundColor: chartData.colors.perkebunan[1],
                    },
                    {
                        label: "Kopi",
                        data: [0, 0, 0, 0, 0],
                        backgroundColor: chartData.colors.perkebunan[2],
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: "top" } },
                scales: { y: { beginAtZero: true } },
            },
        },
        tanamanPanganChart: {
            type: "line",
            data: {
                labels: chartData.years,
                datasets: [
                    {
                        label: "Padi",
                        data: [118, 120, 120, 120, 120],
                        borderColor: chartData.colors.tanamanPangan[0],
                        tension: 0.1,
                    },
                    {
                        label: "Jagung",
                        data: [93, 96, 96, 96, 96],
                        borderColor: chartData.colors.tanamanPangan[1],
                        tension: 0.1,
                    },
                    {
                        label: "Kacang Tanah",
                        data: [5, 5, 5, 5, 5],
                        borderColor: chartData.colors.tanamanPangan[2],
                        tension: 0.1,
                    },
                    {
                        label: "Tomat",
                        data: [13, 15, 15, 15, 15],
                        borderColor: chartData.colors.tanamanPangan[3],
                        tension: 0.1,
                    },
                    {
                        label: "Cabe",
                        data: [24, 25, 25, 25, 25],
                        borderColor: chartData.colors.tanamanPangan[4],
                        tension: 0.1,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: "top" } },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 150,
                    },
                },
            },
        },
        pendidikanChart: {
            type: "bar",
            data: {
                labels: [
                    ["Tidak/Belum", "Sekolah"],
                    ["Belum Tamat", "SD/Sederajat"],
                    ["Tamat", "SD/Sederajat"],
                    "SLTP/Sederajat",
                    "SLTA/Sederajat",
                    "Diploma I/II",
                    ["AKADEMI/DIPL.III/S. MUDA"],
                    ["DIPLOMA IV/STRATA I"],
                    "Strata II",
                    "Strata III",
                ],
                datasets: [
                    {
                        label: "Jumlah Penduduk",
                        data: [], // Data akan diisi dari Firestore
                        backgroundColor: [
                            "#BBDEFB",
                            "#90CAF9",
                            "#64B5F6",
                            "#42A5F5",
                            "#2196F3",
                            "#1E88E5",
                            "#1976D2",
                            "#1565C0",
                            "#0D47A1",
                            "#0A3882",
                        ],
                        borderRadius: 5,
                    },
                ],
            },
            options: {
                animation: { duration: 1200, easing: "easeInOutCubic" },
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 2500,
                    },
                },
            },
        },

        // Section APBD
        pendapatanDetailChart: {
            type: "bar",
            data: {
                labels: [
                    "Pendapatan Asli Desa",
                    "Pendapatan Transfer",
                    "Pendapatan Lain-lain",
                ],
                datasets: [
                    {
                        label: "Anggaran (Rp)",
                        data: [],
                        backgroundColor: ["#2e7d32", "#4caf50", "#8dd18d"],
                        borderRadius: 5,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: formatAsShortCurrency,
                        },
                    },
                },
            },
        },

        belanjaDetailChart: {
            type: "bar",
            data: {
                labels: [
                    "Penyelenggaraan Pemerintahan Desa",
                    "Pelaksanaan Pembangunan Desa",
                    "Pembinaan Kemasyarakatan",
                    "Pemberdayaan Masyarakat Desa",
                    "Penanggulangan Bencana, Keadaan Darurat dan Mendesak",
                ],
                datasets: [
                    {
                        label: "Anggaran (Rp)",
                        data: [],
                        backgroundColor: [
                            "#D32F2F",
                            "#F44336",
                            "#EF5350",
                            "#E57373",
                            "#FFCDD2",
                        ],
                        borderRadius: 5,
                    },
                ],
            },
            options: {
                indexAxis: "y",
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            callback: formatAsShortCurrency,
                        },
                    },
                },
            },
        },

        // Section APBD END
    };

    // LOGIKA ANIMASI SAAT SCROLL

    const observer = new IntersectionObserver(
        (entries, observerInstance) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    if (entry.target.classList.contains("animate-number")) {
                        animateNumber(entry.target);
                    }

                    if (chartConfigs[entry.target.id]) {
                        createChart(
                            entry.target.id,
                            chartConfigs[entry.target.id]
                        );
                    }

                    observerInstance.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.3 }
    );

    const observeVisibleContent = () => {
        document
            .querySelectorAll(
                ".tab-content:not(.hidden) .animate-number, .tab-content:not(.hidden) canvas"
            )
            .forEach((el) => {
                observer.observe(el);
            });
    };

    // --- LOGIKA GRAFIK PENDIDIKAN ---
    const pendidikanChartCanvas = document.getElementById('pendidikanChart');
    if (pendidikanChartCanvas) {
        const pendidikanDocRef = doc(db, 'rekap_pendidikan', 'terbaru');
        onSnapshot(pendidikanDocRef, (docSnap) => {
            if (docSnap.exists()) {
                const data = docSnap.data();
                const chartData = [data.tidak_sekolah, data.belum_tamat_sd, data.tamat_sd, data.sltp, data.slta, data.d1_d2, data.d3, data.d4_s1, data.s2, data.s3];

                if (pendidikanChartInstance) {
                    // Jika chart sudah ada, UPDATE datanya
                    pendidikanChartInstance.data.datasets[0].data = chartData;
                    pendidikanChartInstance.update();
                } else {
                    // Jika chart belum ada, BUAT BARU
                    chartConfigs.pendidikanChart.data.datasets[0].data = chartData;
                    pendidikanChartInstance = new Chart(pendidikanChartCanvas.getContext('2d'), chartConfigs.pendidikanChart);
                }
            }
        });
    }

    // --- LOGIKA DINAMIS UNTUK BAGIAN APBD ---
    const apbdTab = document.getElementById("content-apbd");
    if (apbdTab) {
        const tahunDisplayEl = document.getElementById("display-tahun-apbd");
        const tahunSelectEl = document.getElementById("tahun-apbd-select");
        const totalPendapatanEl = document.getElementById("display-total-pendapatan");
        const totalBelanjaEl = document.getElementById("display-total-belanja");
        const updateBtn = document.getElementById("update-apbd-button");
        const updateBtnYear = document.getElementById("update-apbd-button-year");
        const apbdCollectionRef = collection(db, "rekap_apbd");

        onSnapshot(apbdCollectionRef, (snapshot) => {
            const apbdDataCache = {};
            const tahunTersedia = [];
            snapshot.forEach((doc) => {
                apbdDataCache[doc.id] = doc.data();
                tahunTersedia.push(doc.id);
            });

            tahunSelectEl.innerHTML = "";
            tahunTersedia.sort((a, b) => b - a).forEach((tahun) => {
                const option = new Option(tahun, tahun);
                tahunSelectEl.add(option);
            });

            const updateUI = (tahun) => {
                const data = apbdDataCache[tahun];
                if (!data) return;

                tahunDisplayEl.textContent = tahun;
                updateBtnYear.textContent = tahun;
                updateBtn.href = `/admin/infografis/apbd/${tahun}/edit`;

                const totalPendapatan = (data.pendapatan_asli_desa || 0) + (data.pendapatan_transfer || 0) + (data.pendapatan_lain_lain || 0);
                const totalBelanja = (data.belanja_pemerintahan || 0) + (data.belanja_pembangunan || 0) + (data.belanja_kemasyarakatan || 0) + (data.belanja_pemberdayaan || 0) + (data.belanja_darurat || 0);
                totalPendapatanEl.textContent = "Rp" + totalPendapatan.toLocaleString("id-ID");
                totalBelanjaEl.textContent = "Rp" + totalBelanja.toLocaleString("id-ID");

                const dataPendapatan = [data.pendapatan_asli_desa, data.pendapatan_transfer, data.pendapatan_lain_lain];
                const dataBelanja = [data.belanja_pemerintahan, data.belanja_pembangunan, data.belanja_kemasyarakatan, data.belanja_pemberdayaan, data.belanja_darurat];

                if (pendapatanChartInstance) {
                    pendapatanChartInstance.data.datasets[0].data = dataPendapatan;
                    pendapatanChartInstance.update();
                } else {
                    const canvas = document.getElementById("pendapatanDetailChart");
                    if (canvas) {
                        chartConfigs.pendapatanDetailChart.data.datasets[0].data = dataPendapatan;
                        pendapatanChartInstance = new Chart(canvas, chartConfigs.pendapatanDetailChart);
                    }
                }

                if (belanjaChartInstance) {
                    belanjaChartInstance.data.datasets[0].data = dataBelanja;
                    belanjaChartInstance.update();
                } else {
                    const canvas = document.getElementById("belanjaDetailChart");
                    if (canvas) {
                        chartConfigs.belanjaDetailChart.data.datasets[0].data = dataBelanja;
                        belanjaChartInstance = new Chart(canvas, chartConfigs.belanjaDetailChart);
                    }
                }
            };

            tahunSelectEl.addEventListener("change", (e) => updateUI(e.target.value));

            if (tahunTersedia.length > 0) {
                updateUI(tahunTersedia[0]);
            }
        });
    }


    observeVisibleContent();
});
