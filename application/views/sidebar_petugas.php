<li class="nav-item">
      <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse" aria-expanded="true" aria-controls="collapseTwo">
         <i class="ti-wallet"></i>
          <span>Simpanan</span>
        </a>
        <div id="collapse" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?= base_url() ?>index.php/Simpanan/laporan_simpananPokok" style="text-decoration: none">Laporan Simpanan Pokok</a>
            <a class="collapse-item" href="<?= base_url() ?>index.php/Simpanan/laporan_simpanan" style="text-decoration: none">Laporan Simpanan Sukarela</a>
            <a class="collapse-item" href="<?= base_url() ?>index.php/Simpanan/laporan_simpananWajib" style="text-decoration: none">Laporan Simpanan Wajib</a>
            <a class="collapse-item" href="<?= base_url() ?>index.php/Simpanan/riwayat_simpanan" style="text-decoration: none">Riwayat Simpanan</a>
            <a class="collapse-item" href="<?= base_url() ?>index.php/Simpanan/riwayat_pengambilan" style="text-decoration: none">Riwayat Pengambilan</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapsee">
         <i class="ti-credit-card"></i>
          <span>Pinjaman</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?= base_url() ?>index.php/Pinjaman/acc_pinjaman/<?= $this->session->userdata('id_anggota')?>" style="text-decoration: none">Approval Pinjaman</a>
            <a class="collapse-item" href="<?= base_url() ?>index.php/Pinjaman/laporan_pinjaman/<?= $this->session->userdata('id_anggota')?>" style="text-decoration: none">Laporan Pinjaman</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapsee">
         <i class="ti-id-badge"></i>
          <span>Anggota</span>
        </a>
        <div id="collapseFour" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?= base_url() ?>index.php/Simpanan/lihat_anggota/" style="text-decoration: none">Lihat Anggota</a>
            <a class="collapse-item" href="<?= base_url() ?>index.php/Simpanan/lihat_statusanggota/" style="text-decoration: none">Status Anggota</a>
          </div>
        </div>
      </li>

       <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapsee">
         <i class="ti-user"></i>
          <span>Akun</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="<?= base_url() ?>index.php/Login/lihat_akun_petugas/<?= $this->session->userdata('id_petugas')?>" style="text-decoration: none">Lihat Akun</a>

          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?php echo base_url() ?>index.php/Login/tentangPetugas/" >
         <i class="ti-info-alt"></i>
          <span>Tentang</span>
        </a>
        
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?= site_url('Login/logout') ?>" onclick="return confirm('Anda Yakin Ingin Keluar ?')">
         <i class="ti-power-off"></i>
          <span onclick="">Logout</span>
        </a>
      </li>

