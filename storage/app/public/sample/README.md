# Sample Documents - DOKEMA System

Folder ini berisi file-file sample yang digunakan untuk keperluan demo dan testing sistem DOKEMA.

## File yang Tersedia

### 📄 Documents PDF
- `sample_permohonan.pdf` - Sample surat permohonan magang
- `sample_balasan.pdf` - Sample surat balasan permohonan
- `sample_lampiran.pdf` - Sample lampiran laporan kegiatan  
- `sample_surat_nilai.pdf` - Sample surat penilaian akhir

### 📝 Documentation
- `sample_dokumentasi.md` - Sample dokumentasi teknis laporan

## Penggunaan

File-file ini digunakan oleh database seeders untuk:
- Mengisi data dummy saat development
- Testing fitur upload/download dokumen
- Demo sistem tanpa perlu file dokumen asli

## Path dalam Database

File-file ini akan disimpan dengan path relatif:
```
sample/sample_permohonan.pdf
sample/sample_balasan.pdf  
sample/sample_lampiran.pdf
sample/sample_surat_nilai.pdf
```

## Catatan untuk Production

⚠️ **PENTING**: Pada environment production:
- Hapus folder `sample/` ini
- Pastikan folder `storage/app/public/documents/` tersedia
- Konfigurasi proper file upload validation
- Implementasi file security scanning

## File Structure

```
public/sample/
├── README.md                 # Dokumentasi ini
├── sample_permohonan.pdf     # Surat permohonan magang
├── sample_balasan.pdf        # Surat balasan permohonan  
├── sample_lampiran.pdf       # Lampiran laporan kegiatan
├── sample_surat_nilai.pdf    # Surat penilaian akhir
└── sample_dokumentasi.md     # Dokumentasi teknis
```

## Security Notes

- File PDF menggunakan basic PDF structure
- Tidak mengandung JavaScript atau konten berbahaya
- Safe untuk testing dan demo purposes
- File size minimal untuk performance

---
*Generated untuk DOKEMA v1.0.0 - Demo purposes only*
