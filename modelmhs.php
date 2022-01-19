<?php
class ModelMahasiswa
{
    public function insertMhs($data)
    {
        $sql = "INSERT INTO mahasiswa( nim, nama,tahun, kota) 
        VALUES ('" . $data->nim . "','"
            . $data->nama .  "','"
            . $data->tahun . "','"
            . $data->kota .  "')";

        return $sql;
    }

    //bikin method untuk select , delete 
    //menampilkan data semua mahasiswa 
}
