<?php
function cariKombinasi($soal, $target, $index = 0, $kombinasi = [], $hasil = [])
{
    $total = array_sum(array_column($kombinasi, 'poin'));

    if ($total == $target) {
        $hasil[] = $kombinasi;
    }

    for ($i = $index; $i < count($soal); $i++) {
        if ($total + $soal[$i]['poin'] <= $target) {
            $hasil = array_merge($hasil, cariKombinasi(
                $soal,
                $target,
                $i + 1,
                array_merge($kombinasi, [$soal[$i]]),
                []
            ));
        }
    }

    return $hasil;
}

$target = intval($_POST['target']);
$jumlah = intval($_POST['jumlah']);
$namaSoal = $_POST['soal'];
$poinSoal = $_POST['poin'];

$soal = [];

for ($i = 0; $i < $jumlah; $i++) {
    $soal[] = [
        'soal' => htmlspecialchars($namaSoal[$i]),
        'poin' => intval($poinSoal[$i])
    ];
}

$kombinasi = cariKombinasi($soal, $target);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Hasil Kombinasi Soal</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h1>Hasil Kombinasi Soal</h1>
        <p><strong>Total poin target:</strong> <?= $target ?></p>
        <p><strong>Jumlah soal:</strong> <?= $jumlah ?></p>

        <?php if (count($kombinasi) === 0): ?>
            <p><strong>Tidak ada kombinasi yang memenuhi.</strong></p>
        <?php else: ?>
            <ul>
                <?php foreach ($kombinasi as $i => $set): ?>
                    <li>
                        <strong>Kombinasi <?= $i + 1 ?>:</strong>
                        <ul>
                            <?php foreach ($set as $item): ?>
                                <li><?= $item['soal'] ?> (<?= $item['poin'] ?> poin)</li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <a href="index.php"><button>Kembali</button></a>
    </div>
</body>

</html>