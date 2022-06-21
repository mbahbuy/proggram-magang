$(function() {

    $('.tombolTambahData').on('click', function() {

        $('#judulModal').html('Tambah Data Mahasiswa');
        $('.modal-footer button[type=submit]').html('Tambah Data');
        // $('.modal-body form').attr('action', 'http://localhost/Tugas/PHP-MVC/public/mahasiswa/ubah');
        $('#nama').val('');
        $('#nrp').val('');
        $('#email').val('');
        $('#jurusan').val('Ekonomi Pendidikan');

    });
    $('.tampilModalUbah').on('click', function() {

        $('#judulModal').html('Ubah Data Mahasiswa');
        $('.modal-footer button[type=submit]').html('Ubah Data');
        $('.modal-body form').attr('action', 'http://localhost/Tugas/PHP-MVC/public/mahasiswa/ubah');

        var id = $(this).data('id');

        $.ajax({
            url : 'http://localhost/Tugas/PHP-MVC/public/mahasiswa/getUbah',
            data : {id : id},
            method : 'post',
            dataType : 'json',
            success : function(data) {
                $('#nama').val(data.nama);
                $('#nrp').val(data.nrp);
                $('#email').val(data.email);
                $('#jurusan').val(data.jurusan);
                $('#id').val(data.id);
            }
        });

    });

});