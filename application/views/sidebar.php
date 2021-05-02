<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse" aria-expanded="true"
        aria-controls="collapseTwo">
        <i class="ti-wallet"></i>
        <span>Simpanan</span>
    </a>
    <div id="collapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?=base_url()?>Simpanan/simpanan/<?=$this->session->id_anggota?>"
                style="text-decoration: none">Form Simpan</a>
            <a class="collapse-item" href="<?=base_url()?>Simpanan/show_simpananPokok/<?=$this->session->id_anggota?>"
                style="text-decoration: none">Cek Simpanan Pokok</a>
            <a class="collapse-item" href="<?=base_url()?>Simpanan/show_simpananWajib/<?=$this->session->id_anggota?>"
                style="text-decoration: none">Cek Simpanan Wajib</a>
            <a class="collapse-item" href="<?=base_url()?>Simpanan/show_simpanan/<?=$this->session->id_anggota?>"
                style="text-decoration: none">Cek Simpanan Sukarela</a>
            <a class="collapse-item" href="<?=base_url()?>Simpanan/ambil_simpanan/<?=$this->session->id_anggota?>"
                style="text-decoration: none">Cek Pengambilan</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
        aria-controls="collapse">
        <i class="ti-credit-card"></i>
        <span>Pinjaman</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?=base_url()?>Pinjaman/pinjaman/<?=$this->session->id_anggota?>"
                style="text-decoration: none">Pinjaman</a>
            <a class="collapse-item" href="<?=base_url()?>Pinjaman/show_pinjaman/<?=$this->session->id_anggota?>"
                style="text-decoration: none">Daftar Pinjaman</a>
            <a class="collapse-item" href="<?=base_url()?>Pinjaman/riwayatPinjaman/<?=$this->session->id_anggota?>"
                style="text-decoration: none">Riwayat Pinjaman</a>
            <a class="collapse-item" href="<?=base_url()?>Pinjaman/bungaMenurun/" style="text-decoration: none">Bunga
                Menurun</a>
        </div>
    </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true"
        aria-controls="collapse">
        <i class="ti-id-badge"></i>
        <span>Angsuran</span>
    </a>
    <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?=base_url()?>Angsuran/show_angsuran/<?=$this->session->id_anggota?>"
                style="text-decoration: none">Daftar Angsuran</a>
        </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true"
        aria-controls="collapse">
        <i class="ti-user"></i>
        <span>Akun</span>
    </a>
    <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?=base_url()?>Login/lihat_akun" style="text-decoration: none">Lihat
                Akun</a>
            <a class="collapse-item" href="<?=base_url()?>Login/v_bukti/<?=$this->session->id_anggota?>"
                style="text-decoration: none">Upload Kelengkapan</a>
        </div>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="<?php echo base_url() ?>Login/laporan/">
        <i class="ti-agenda"></i>
        <span>Laporan</span>
    </a>

</li>
<li class="nav-item">
    <a class="nav-link collapsed" href="<?php echo base_url() ?>Login/tentang/">
        <i class="ti-info-alt"></i>
        <span>Tentang</span>
    </a>

</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="<?=site_url('Login/logout')?>"
        onclick="return confirm('Anda Yakin Ingin Keluar ?')">
        <i class="ti-power-off"></i>
        <span onclick="">Logout</span>
    </a>
</li>
