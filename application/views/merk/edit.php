<script type="text/javascript">

$_base_url = '<?= base_url() ?>';
$_type = 'edit';

var $kode;
var $merk;

$(document).ready(function(){

  $kode = $('#kode')[0];
  $merk = $('#merk')[0];

  $kode.focus();

  $('#btn_simpan').click(function(){
    if ($.trim($kode.value) == '') {
      alert('Kode Merk tidak boleh kosong.');
      $kode.focus();
      return false;
    } else {
      if ($kode.value.search(' ') > -1) {
        alert('Kode Merk tidak boleh ada spasi.');
        $kode.select();
        $kode.focus();
        return false;
      }
    }

    if ($.trim($merk.value) == '') {
      alert('Merk tidak boleh kosong.');
      $Merk.focus();
      return false;
    }

    if ($_type == 'add') {
      $.post(
        $_base_url + 'index.php/merk/simpan_merk_ajax',
        {kode: $kode.value,
         merk: $merk.value
        },
        function(data) {
          if (data.result == 'false') {
            serr = 'Simpan data gagal.';
            try {
              serr = serr + ' ' + data.keterangan;
            } catch(e) {}
            alert(serr);
          } else {
            alert('Simpan berhasil.');
            window.location = $_base_url + 'index.php/merk';
          }
        },
        'json'
      );
    } else {
      $.post(
        $_base_url + 'index.php/merk/update_merk_ajax',
        {kode: $kode.value,
         merk: $merk.value
        },
        function(data) {
          if (data.result == 'false') {
            alert('Update data gagal.');
          } else {
            alert('Update berhasil.');
            window.location = $_base_url + 'index.php/merk';
          }
        },
        'json'
      );
    }
  });

  $('#btn_batal').click(function(){
    window.location = $_base_url + 'index.php/merk';
  });
});

</script>

<h2>Edit Merk</h2>

<p>
Kode <br/>
<input type="text" name="kode" id="kode" size="10" maxlength="10" value="<?= $kode ?>" disabled="disabled"/>
</p>

<p>
Merk <br/>
<input type="text" name="merk" id="merk" size="50" maxlength="50" value="<?= $merk ?>"/>
</p>

<p>
<input type="button" value="Simpan" id="btn_simpan"/>
<input type="button" value="Batal" id="btn_batal"/>
</p>