<!doctype html>
<html lang="id">

<head>
    {{-- Meta --}}
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Icon --}}
    <link rel="icon" href="/logo.png" type="image/x-icon" />

    {{-- Judul --}}
    <title>Aplikasi Keuangan Imut 💕</title>

    {{-- Styles --}}
    @livewireStyles
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="/assets/vendor/bootstrap-5.3.8-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    @stack('styles')
</head>

<body>
    @yield('content')

    {{-- Scripts --}}
    <script src="/assets/vendor/bootstrap-5.3.8-dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("livewire:initialized", () => {
            // Modal Events
            Livewire.on("closeModal", (data) => {
                const modal = bootstrap.Modal.getInstance(
                    document.getElementById(data.id)
                );
                if (modal) {
                    modal.hide();
                }
            });

            Livewire.on("showModal", (data) => {
                const modal = bootstrap.Modal.getOrCreateInstance(
                    document.getElementById(data.id)
                );
                if (modal) {
                    modal.show();
                }
            });

            // SweetAlert2 Events dengan style imut
            Livewire.on("showAlert", (data) => {
                Swal.fire({
                    icon: data.icon || 'info',
                    title: data.title || 'Notifikasi 💕',
                    text: data.text || '',
                    confirmButtonText: 'OK ✨',
                    confirmButtonColor: '#FF69B4',
                    timer: data.timer || 3000,
                    timerProgressBar: true,
                    background: '#FFF0F5',
                    customClass: {
                        popup: 'cute-swal-popup',
                        confirmButton: 'cute-btn'
                    }
                });
            });
        });
    </script>
    
    <style>
        /* Custom SweetAlert2 Style */
        .cute-swal-popup {
            border-radius: 25px !important;
            border: 3px solid #FFB6C1 !important;
            box-shadow: 0 15px 40px rgba(255, 105, 180, 0.3) !important;
        }
        
        .cute-swal-popup .swal2-title {
            color: #FF69B4 !important;
            font-weight: 700 !important;
        }
        
        .cute-swal-popup .swal2-icon {
            border-color: #FFB6C1 !important;
        }
        
        .cute-swal-popup .swal2-success-ring {
            border-color: #90EE90 !important;
        }
        
        .cute-swal-popup .swal2-error [class^='swal2-x-mark-line'] {
            background-color: #FFB6C1 !important;
        }
    </style>
    
    @stack('scripts')
    @livewireScripts
</body>

</html>