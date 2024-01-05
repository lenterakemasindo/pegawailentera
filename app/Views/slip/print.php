<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Print Slip Gaji</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Roboto';
    }

    .text-center {
      text-align: center;
    }

    .title {
      text-align: center;
      font-size: 250%;
    }

    hr {
      text-align: center;
      width: 80%;
    }

    table {
      width: 75%;
      margin-left: auto;
      margin-right: auto;
    }

    table,
    th,
    td {
      border-collapse: collapse;
    }

    th,
    td {
      padding: 5px;
    }

    th.segment {
      text-align: start;
      padding-left: 10px;
    }

    td.content {
      text-align: end;
      padding-right: 10px;
    }

    .fixed-bottom {
      position: fixed;
      bottom: 0;
      text-align: center;
    }

    @media print {
      div.next_page {
        page-break-after: always;
        page-break-inside: avoid;
      }
    }
  </style>
</head>

<body>
  <?php foreach ($data as $r) : ?>
    <h1 class="title">Slip Gaji</h1>
    <hr>
    <table border="1">
      <tbody>
        <tr>
          <th class=" segment">
            Perusahaan
          </th>
          <th> : </th>
          <td class="content"><?= env('COMPANY'); ?></td>
        </tr>
        <tr>
          <th class="segment">
            Alamat
          </th>
          <th> : </th>
          <td class="content"><?= $c->find(3)['value'] ?></td>
        </tr>
        <tr>
          <th class="segment">
            Tanggal
          </th>
          <th> : </th>
          <td class="content"><?= formatDate($r['slip']['tgl']); ?></td>
        </tr>
        <tr>
          <th class="segment">
            Nama
          </th>
          <th> : </th>
          <td class="content"><?= $r['pegawai']['nama']; ?></td>
        </tr>
        <tr>
          <th class="segment">
            NIP.
          </th>
          <th> : </th>
          <td class="content"><?= $r['pegawai']['unicode']; ?></td>
        </tr>
      </tbody>
    </table><br><br><br>
    <table style="width: 50%;" border="1">
      <?php $total = 0 ?>
      <tbody>
        <tr>
          <th class="segment">Kehadiran</th>
          <td class="content"><?= $r['slip']['kehadiran']; ?> hari x <?= formatCurrency($r['pegawai']['gaji']); ?> </td>
        </tr>
        <tr>
          <th class="segment">Gaji</th>
          <td class="content"><?= formatCurrency($total += $r['slip']['kehadiran'] * $r['slip']['gaji']); ?></td>
        </tr>
        <tr>
          <th class="segment" rowspan="2">Lembur</th>
          <td class="content"><?= $r['slip']['jamlembur']; ?> jam x <?= formatCurrency($r['slip']['lembur']); ?></td>
        </tr>
        <tr>
          <td class="content"><?= formatCurrency($r['slip']['jamlembur'] * $r['slip']['lembur']); ?></td>
          <?php $total += $r['slip']['jamlembur'] * $r['slip']['lembur'] ?>
        </tr>
        <?php if ($r['slip']['bonus'] != 'null') :
          $expl_bonus = explode(';', $r['slip']['bonus']);
          $num = 0;
          foreach ($expl_bonus as $k) :
            $res = explode(',', $expl_bonus[$num++]);
            if (isset($res[1])) : ?>
              <tr>
              <tr>
                <th class="segment">Bonus <?= $res[0]; ?></th>
                <td class="content"><?= formatCurrency($res[1]); ?></td>
                <?php $total += $res[1] ?>
              </tr>
              </tr>
        <?php endif;
          endforeach;
        endif; ?>
        <?php if ($r['slip']['potongan'] != 'null') :
          $expl_potongan = explode(';', $r['slip']['potongan']);
          $num = 0;
          foreach ($expl_potongan as $k) :
            $res = explode(',', $expl_potongan[$num++]);
            if (isset($res[1])) : ?>
              <tr>
              <tr>
                <th class="segment">Potongan <?= $res[0]; ?></th>
                <td class="content"><?= formatCurrency($res[1]); ?></td>
                <?php $total -= $res[1] ?>
              </tr>
              </tr>
        <?php endif;
          endforeach;
        endif; ?>
        <tr>
          <th class="segment">Total</th>
          <td class="content"><?= formatCurrency($total); ?></td>
        </tr>
      </tbody>
    </table>
    <div class="next_page"></div>
  <?php endforeach ?>
  <table class="fixed-bottom" style="width: 100%;">
    <tr>
      <td class="text-center">(............................................................................................)</td>
      <td class="text-center">(............................................................................................)</td>
    </tr>
    <tr>
      <td class="text-center"></td>
      <td class="text-center"><?= env('COMPANY'); ?> </td>
    </tr>
  </table>
  <script type="text/javascript">
    window.print();
    window.onfocus = function() {
      window.close();
    }
  </script>
</body>

</html>