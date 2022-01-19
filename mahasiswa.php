<?php
require('form.php');
require('modelmhs.php');

Class Mahasiswa{
    public $nim;
    var $nama;
    var $tahun;
    var $kota;

    //method dipanggil ketika object di create(new)
    public function __construct($nim="V3420028",$nama="Devi",$tahun=2002,$kota="Semarang")
    {
        $this-> nim = $nim;
        $this-> nama = $nama;
        $this-> tahun = $tahun;
        $this-> kota = $kota;
    }
       
    public function isiData($nim,$nama,$tahunlahir,$kotatinggal){
        $this-> nim = $nim;
        $this-> nama = $nama;
        $this-> tahun = $tahunlahir;
        $this-> kota = $kotatinggal;
    }

    public function cetakData() {
        $txt= "----------------------------------------" ."</br>";
        $txt.= "Nim Mahasiswa :".$this->nim."</br>" ;
        $txt.= "Nama Mahasiswa :".$this->nama."</br>" ;
        $txt.= "Tahun Mahasiswa :".$this->tahun."</br>" ;
        $txt.= "Kota Mahasiswa :".$this->kota."</br>" ;
        $txt.= "Umur Mahasiswa :".$this->hitungUmur()."</br>" ;
        $txt.= "----------------------------------------"."</br>" ;
        return $txt;
    }

    //method void java menggunakan java 
    //method non void 
    //untuk membedakan method void dan non void di php dengan adanya return atau tidak 

    protected function hitungumur()
    {
        $umur= date('Y')-$this -> tahun;
        return $umur;
    }

    public function inputForm(){
        $formmhs = new Form('','Input Mahasiswa');
        $formmhs->addField('nim','Nim Mahasiswa');
        $formmhs->addField('nama','Nama Mahasiswa');
        $formmhs->addField('tahun','Tahun Lahir Mahasiswa');
        $formmhs->addField('kota','Kota Tinggal Mahasiswa');
       //$formmhs->addField('nomor telepon','Nomor Telepon Mahasiswa');

       // post tombol dengan nanti aksinya dari name tombol yakni button
       // button Input Mahasiswa
       // bisa juga dengan name = submit 
       // yang biasanya digunakan pada button submit 
        if(isset($_POST['tombol']))
        {
            $data= $formmhs->getData();
            $this-> nim = $data[0];
            $this-> nama = $data[1];
            $this-> tahun = $data[2];
            $this-> kota = $data[3];
            //$this-> cetakData();
            //mengambil data dari echo untuk di cetak di view 
            $cetak = $this -> cetakData();
            require('viewmahasiswa/tampilinput.php');

            require("koneksi.php");
            $modelmhs = new ModelMahasiswa();
            $sql=$modelmhs->insertMhs($this);
            
            // $result = mysqli_query ($conn,$simpan);
            if ($conn->query($sql) === TRUE) {
                echo "New record creared seccessfully";
            }else{
                echo "Error : " .$sql . "<br>".$conn->error;
            }
        }
        else
        {
            //$formmhs->displayForm(); --> menggunakan $cetak agar lebih mudah 
            $cetak=$formmhs->displayForm();

            //echo $cetak;
            //echo $cetak akan masuk ke folder view mahasiswa 
            // masuk ke file formmhs.php 

            require('viewmahasiswa/formmhs.php');
        }
    }
}   