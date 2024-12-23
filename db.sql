-- Membuat tabel servis log
CREATE TABLE servis_log (
    id INT AUTO_INCREMENT PRIMARY KEY,  -- ID yang auto increment
    servis VARCHAR(100) NOT NULL,       -- Jenis Servis
    kendaraan VARCHAR(100) NOT NULL,    -- Jenis Kendaraan
    tanggal VARCHAR(50) NOT NULL        -- tanggal Servis
);

-- Menyisipkan data dummy ke dalam tabel servis log
INSERT INTO servis_log (servis, kendaraan, tanggal) VALUES 
('Oli', 'Motor Beat', '15 November'),
('Ganti Ban', 'Mobil Avanza', '18 November'),
('Servis Rutin', 'Mobil Vario', '28 November'),
('Oli Mesin', 'Mobil Jazz', '3 Desember');
