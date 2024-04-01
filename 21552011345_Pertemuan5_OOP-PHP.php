<?php
/* Nama    : Indi Yuni Masi Sabon
   NIM     : 21552011345
   Judul   : Aplikasi Sederhana Perpustakaan */

// membuat sebuah objek buku
class Buku {
    public $judul;
    public $penulis;
    public $tahunTerbit;
    public $status;

    // membuat constructor untuk objek buku
    public function __construct($judul, $penulis, $tahunTerbit, $status){
        $this->judul = $judul;
        $this->penulis = $penulis;
        $this->tahunTerbit = $tahunTerbit;
        $this->status = $status;
    }

    // Fungsi template untuk menampilkan informasi buku
    public function tampilkanInformasi(){
        echo "-----" . $this->judul . "-----" . PHP_EOL;
        echo "   » Penulis : " . $this->penulis . PHP_EOL;
        echo "   » Terbit  : " . $this->tahunTerbit . PHP_EOL;
        echo "   » Status  : " . ($this->status ? "Dipinjam" : "Tersedia") . PHP_EOL;
        echo "------------------------------------" . PHP_EOL;
    }
}

class Perpustakaan{
    // membuat rak buku berupa array
    public $rakBuku = array();

    // Fungsi untuk menambahkan buku kedalam rak buku
    public function tambahBuku($judul, $penulis, $tahunTerbit, $status){
        $bukuBaru = new Buku($judul, $penulis, $tahunTerbit, $status);
        $this->rakBuku[] = $bukuBaru;
        echo "↠ Berhasil menambahkan buku $judul" . PHP_EOL;
    }

    // fungsi untuk meminjam buku dalam rak buku
    public function pinjamBuku($judul) {
        foreach ($this->rakBuku as $buku) {
            if ($buku->judul == $judul && !$buku->status) {
                $buku->status = true;
                echo "↠ Berhasil meminjam buku $judul" . PHP_EOL;
                echo PHP_EOL;
                return;
            }
        }
        echo "↠ Buku: '$judul' sudah dipinjam:)" . PHP_EOL;
        echo PHP_EOL;
    }
    
    // fungsi untuk mengembalikan buku dalam rak buku
    public function kembalikanBuku($judul) {
        foreach ($this->rakBuku as $buku) {
            if ($buku->judul == $judul && $buku->status) {
                $buku->status = false;
                echo "↠ Berhasil mengembalikan buku $judul" . PHP_EOL;
                echo PHP_EOL;
                return;
            }
        }
        echo "↠ Buku: '$judul' belum ada yang pinjam:)" . PHP_EOL;
        echo PHP_EOL;
    }

    // fungsi untuk menampilkan buku yang tersedia
    public function cetakBukuTersedia(){
        echo "----- Buku Tersedia ------" . PHP_EOL;
        foreach($this->rakBuku as $buku) {
            if (!$buku->status){
                $buku->tampilkanInformasi();
            }
        }
        echo PHP_EOL;
    }

    // fungsi untuk menampilkan buku yang tidak tersedia
    public function cetakBukuTidakTersedia(){
        echo "----- Buku Tidak Tersedia ------" . PHP_EOL;
        foreach($this->rakBuku as $buku) {
            if ($buku->status){
                $buku->tampilkanInformasi();
            }
        }
    }
}

// membuat objek perpustakaan baru
$perpustakaan = new Perpustakaan();

// membuat data array untuk dimasukkan kedalam rak buku
$dataBuku = [
    ["judul" => "Olympus Has Fallen", "penulis" => "Cal Beausang", "tahunTerbit" => 2005, "statusPinjam" => true],
    ["judul" => "Hateship Loveship", "penulis" => "Abraham Beckley", "tahunTerbit" => 2017, "statusPinjam" => false],
    ["judul" => "Private Romeo", "penulis" => "Gualterio Cowern", "tahunTerbit" => 2018, "statusPinjam" => true],
    ["judul" => "The Boyfriend School", "penulis" => "Ambur Mayor", "tahunTerbit" => 2020, "statusPinjam" => false],
    ["judul" => "Arlington Road", "penulis" => "Jennifer Danniell", "tahunTerbit" => 2019, "statusPinjam" => true],
    ["judul" => "Grande école", "penulis" => "Bertine Shuter", "tahunTerbit" => 2008, "statusPinjam" => false],
];

// Menambahkan beberapa buku ke dalam rak buku menggunakan perulangan
foreach($dataBuku as $dataBuku){
    $perpustakaan->tambahBuku($dataBuku["judul"], $dataBuku["penulis"], $dataBuku["tahunTerbit"], $dataBuku["statusPinjam"]);
}

// menampilkan buku yang tersedia
$perpustakaan->cetakBukuTersedia();

// menampilkan buku yang tidak tersedia
$perpustakaan->cetakBukuTidakTersedia();

// meminjam buku didalam rak buku
$perpustakaan->pinjamBuku("Grande école");

// mengembalikan buku kedalam rak buku
$perpustakaan->kembalikanBuku("Grande école");

// menampilkan failure ketika buku tidak tersedia
$perpustakaan->pinjamBuku("Ketika cinta bertasbih");

// menampilkan failure ketika buku sudah dipinjam
$perpustakaan->pinjamBuku("Arlington Road");