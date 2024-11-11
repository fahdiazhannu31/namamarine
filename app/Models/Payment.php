<?php

namespace App\Models;

use CodeIgniter\Model;

class Payment extends Model
{
    protected $table            = 'payments';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'checkout_link', 'external_id', 'jml_pax', 'rute', 'status', 'qr_code', 'attendance', 'created_at', 'updated_at'];
    protected $useTimestamps = true;

    public function getQRCode($userId)
    {
        // Retrieve the latest payment with status 'PAID' or 'SETTLED' for the given user
        $payment = $this->where('user_id', $userId)
            ->whereIn('status', ['PAID', 'SETTLED'])
            ->orderBy('id', 'DESC')
            ->first();

        // Check if payment exists and if it has a QR code generated
        return $payment && !empty($payment['qr_code']) ? $payment['qr_code'] : null;
    }

    public function getPaymentByQRCode($qrCode)
    {
        return $this->where('qr_code', $qrCode)->first();  // Mengambil data berdasarkan QR Code
    }
}
