<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test reCAPTCHA - Laravel</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body style="padding: 50px; font-family: Arial;">
    <h1>🧪 Test reCAPTCHA di Laravel</h1>

    <div style="border: 2px solid #ddd; padding: 20px; margin: 20px 0; border-radius: 10px;">
        <h2>reCAPTCHA Widget:</h2>

        <!-- Pakai config Laravel -->
        <div class="g-recaptcha"
             data-sitekey="{{ config('services.recaptcha.site_key') }}">
        </div>

        <p style="margin-top: 20px;">
            <strong>Site Key:</strong> {{ config('services.recaptcha.site_key') ?: 'BELUM DIKONFIGURASI' }}
        </p>
    </div>

    <script>
        window.addEventListener('load', function() {
            setTimeout(function() {
                if (typeof grecaptcha !== 'undefined') {
                    console.log('✅ reCAPTCHA loaded!');
                } else {
                    console.error('❌ reCAPTCHA failed to load!');
                }
            }, 2000);
        });
    </script>
</body>
</html>
