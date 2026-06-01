<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title>KosFinder - Authentication</title>

        <!-- Link Bootstrap & FontAwesome CDN (Sama seperti di app.blade buatan kawanmu) -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

        <style>
            :root {
                --merah: #C0392B;
                --biru: #2C3E6B;
                --krem: #F5F0E8;
            }
            body {
                background-color: var(--krem);
                font-family: 'Segoe UI', sans-serif;
            }
            .auth-card {
                background: white;
                border-radius: 12px;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
                border: none;
                padding: 2.5rem 2rem;
                width: 100%;
                max-width: 450px;
            }
            .btn-primary-custom {
                background-color: var(--biru);
                color: white;
                font-weight: 600;
                border: none;
                transition: background 0.2s;
            }
            .btn-primary-custom:hover {
                background-color: #1F2D52;
                color: white;
            }
            .text-custom-link {
                color: var(--merah);
                text-decoration: none;
                font-weight: 600;
            }
            .text-custom-link:hover {
                text-decoration: underline;
                color: #A93226;
            }
        </style>
    </head>
    
    <body class="d-flex align-items-center justify-content-center p-3" style="min-height: 100vh;">
        
        <div class="d-flex flex-column align-items-center justify-content-center w-100 py-4">
            
            <div class="text-center mb-4">
                <a href="/" class="text-decoration-none">
                    <span style="color: var(--biru); font-weight: 800; font-size: 2.5rem; letter-spacing: -1px;">Kos</span><span style="color: var(--merah); font-weight: 800; font-size: 2.5rem; letter-spacing: -1px;">Finder</span>
                </a>
                <div class="text-muted small text-uppercase tracking-wider" style="letter-spacing: 2px; font-size: 0.72rem; margin-top: -5px; font-weight: 600;">
                    Sistem Informasi Kos
                </div>
            </div>

            <div class="auth-card">
                <?php echo e($slot); ?>

            </div>

        </div>

    </body>
</html><?php /**PATH D:\laragon\www\UASPRAKPBW_KLP4-main\resources\views/layouts/guest.blade.php ENDPATH**/ ?>