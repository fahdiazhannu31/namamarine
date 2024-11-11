<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Berhasil</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>
    <div class="container text-center mt-5">
        <h2>Pembayaran Berhasil!</h2>
        <p>Terima kasih, pembayaran Anda telah berhasil diproses.</p>

        <!-- Generate QR Code Ticket Button -->
        <button id="generateQRCodeBtn" class="btn btn-success mt-3">Generate QR Code</button>

        <?php if (!empty($qrcode) && !empty($qrcode['qr_code'])): ?>
            <div class="text-center mt-5">
                <!-- Display the QR code image if it exists -->
                <img src="<?= base_url($qrcode['qr_code']); ?>" alt="QR Code Ticket">
            </div>
        <?php else: ?>
            <p>No QR code available.</p>
        <?php endif; ?>

        <a href="<?= base_url('/') ?>" class="btn btn-primary mt-3">Kembali ke Beranda</a>
    </div>

    <script>
        document.getElementById('generateQRCodeBtn').addEventListener('click', function() {
            fetch('<?= base_url('/generate-qrcode') ?>', {
                    method: 'POST'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'QR Code generated!',
                            text: data.success,
                            confirmButtonText: 'OK'
                        }).then(() => {
                            location.reload(); // Reload page to display the new QR code
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.error || 'An error occurred while generating the QR Code.',
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Failed to generate QR Code. Please try again later.',
                    });
                });
        });
    </script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>