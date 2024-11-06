function auth_post(tombol, form, url) {
    // Disable tombol dan tambahkan indikator loading
    $(tombol).prop("disabled", true);
    $(tombol).attr("data-kt-indicator", "on");

    // Kirim request AJAX
    $.ajax({
        type: "POST",
        url: url,
        data: $(form).serialize(),
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Menambahkan CSRF token
        },
        success: function(result) {
            // Cek status hasil request
            if (result.alert === "success") {
                Lobibox.notify('success', {
                    pauseDelayOnHover: true, 
                    icon: 'bi bi-check2-circle', 
                    continueDelayOnInactiveTab: false,
                    position: 'top right',
                    msg: result.message,  
                    sound: false,
                });
                
                // Redirect atau panggil callback jika ada
                if (result.callback) {
                    location.href = result.callback;
                } else {
                    content_auth(result.callback, result.title);
                }
            } else {
                // Tampilkan pesan error jika gagal login
                Lobibox.notify('error', {
                    pauseDelayOnHover: true, 
                    icon: 'bi bi-x-circle', 
                    continueDelayOnInactiveTab: false,
                    position: 'top right',
                    msg: result.message,    
                    sound: false,
                });
            }
        },
        error: function(xhr, status, error) {
            // Menangani error dari sisi AJAX
            let errorMsg = xhr.responseJSON && xhr.responseJSON.message 
                            ? xhr.responseJSON.message 
                            : "Terjadi kesalahan. Silakan coba lagi.";
            Lobibox.notify('error', {
                pauseDelayOnHover: true,
                size: 'mini',
                rounded: true,
                icon: 'bi bi-x-circle',
                delayIndicator: false,
                continueDelayOnInactiveTab: false,
                position: 'top right',
                msg: errorMsg
            });
        },
        complete: function() {
            // Enable kembali tombol dan hapus indikator loading
            $(tombol).prop("disabled", false);
            $(tombol).removeAttr("data-kt-indicator");
        }
    });
}
