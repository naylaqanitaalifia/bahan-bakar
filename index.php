<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Bahan Bakar</title>
  <!-- Link Font -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <!-- CSS -->
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container pt-5 pb-5 my-5">
    <?php 
    
    class Shell {
        public $harga;
        public $jumlah;
        public $jenis;
        public $ppn;

        public function __construct($harga, $jumlah, $jenis, $ppn) {
            $this->harga = $harga;
            $this->jumlah = $jumlah;
            $this->jenis = $jenis;
            $this->ppn = $ppn;
        }

        public function totalHarga() {
            $total = $this->harga * $this->jumlah;
            $jumlahPpn = $total * ($this->ppn / 100);
            return $total + $jumlahPpn;
        }
    }

    class Beli extends Shell {
        public function __construct($harga, $jumlah, $jenis, $ppn) {
            parent::__construct($harga, $jumlah, $jenis, $ppn);
        }

        public function buktiTransaksi() {
            return "Anda membeli bahan bakar minyak tipe <b>" . $this->jenis . "</b> <br> Dengan jumlah <b>" . $this->jumlah . " liter</b> <br> Total yang harus Anda bayar <b>Rp" . number_format($this->totalHarga(), 2, ',', '.') . "</b>";
        }
    }

    $harga = 0;

    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        $ppn = 10;
        // $jenis = $_POST["jenis"];
        $jenis = isset($_POST["jenis"]) ? $_POST["jenis"] : "";
        $jumlah = $_POST["jumlah"];

        switch ($jenis) {
            case "Shell Super":
                $harga = 15420;
                break;
            case  "Shell V-Power":
                $harga = 16130;
                break;
            case "Shell V-Power Diesel":
                $harga = 18310;
                break;
            case "Shell V-Power Nitro":
                $harga = 16510;
                break;
            default:
                $harga = 0;
                break;
        }
    }
    ?>

    <img src="shell.png" alt="" class="mx-auto d-block mb-4">

    <?php 
    if ($harga > 0) {
        $beli = new Beli($harga, $jumlah, $jenis, $ppn);
        echo "<div class='text-center border border-danger border-custom p-3 mb-3 mx-auto'>";
        echo "<h3>-- BUKTI TRANSAKSI --</h3>";
        echo $beli->buktiTransaksi();
        echo "</div>";
    } else {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            echo "<div class='alert alert-danger alert-dismissible fade show text-center' role='alert' style='color: red;'>
                    Jenis bahan bakar tidak valid!
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
        }
    }
    ?>
    <div class="row justify-content-center">
        <div class="col-md-7">
            <form action="" method="post">
                <div class="form-group mb-4">
                    <label for="jumlah" class="form-label">Jumlah Liter</label>
                    <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Masukkan jumlah liter" required>
                </div>
                <div class="form-group mb-4">
                    <label for="jenis" class="form-label">Tipe Bahan Bakar</label>
                    <select class="form-control" id="jenis" name="jenis" required>
                        <option value="" disabled selected hidden>Pilih tipe bahan bakar</option>
                        <option value="Shell Super">Shell Super</option>
                        <option value="Shell V-Power">Shell V-Power</option>
                        <option value="Shell V-Power Diesel">Shell V-Power Diesel</option>
                        <option value="Shell V-Power Nitro">Shell V-Power Nitro</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100">Beli</button>
            </form>
        </div>
    </div>
  </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>