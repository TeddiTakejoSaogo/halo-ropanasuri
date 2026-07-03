<?php

namespace App\Services;

class WhatsAppNotificationService
{
    /**
     * Format WhatsApp message for a service order.
     *
     * @param  mixed  $service  The service or package being ordered
     * @param  array|object  $customerData  The data of the customer (name, phone, email, message)
     * @return string
     */
    public function formatOrderMessage($service, $customerData)
    {
        $defaultMessage = "Halo, saya ingin memesan paket layanan:\n\n";
        $defaultMessage .= "📋 *{$service->name}*\n";
        $defaultMessage .= "💵 Harga: {$service->formatted_price}\n";
        
        if ($service->discount_price) {
            $defaultMessage .= "💵 Harga Diskon: {$service->formatted_discount_price}\n";
            $defaultMessage .= "🎁 Diskon: {$service->discount_percentage}%\n";
        }
        
        $defaultMessage .= "\n📝 *Data Pemesan:*\n";
        
        // Handle array or object
        $name = is_array($customerData) ? ($customerData['name'] ?? '-') : ($customerData->name ?? '-');
        $phone = is_array($customerData) ? ($customerData['phone'] ?? '-') : ($customerData->phone ?? '-');
        $email = is_array($customerData) ? ($customerData['email'] ?? '-') : ($customerData->email ?? '-');
        $message = is_array($customerData) ? ($customerData['message'] ?? null) : ($customerData->message ?? null);

        $defaultMessage .= "👤 Nama: {$name}\n";
        $defaultMessage .= "📞 Telepon: {$phone}\n";
        $defaultMessage .= "📧 Email: {$email}\n";
        
        if ($message) {
            $defaultMessage .= "\n💬 Pesan Tambahan:\n{$message}\n";
        }
        
        $defaultMessage .= "\n_Saya memesan melalui website RS Sehat Sentosa_";
        
        return $defaultMessage;
    }

    /**
     * Generate WhatsApp redirect URL.
     *
     * @param  string  $phoneNumber
     * @param  string  $message
     * @return string
     */
    public function generateUrl($phoneNumber, $message)
    {
        // Clean phone number (remove non-digits if necessary, ensure country code)
        // For simplicity, directly using the provided number
        return "https://wa.me/{$phoneNumber}?text=" . urlencode($message);
    }
}
