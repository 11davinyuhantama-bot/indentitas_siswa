<?php
header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    echo json_encode(['success' => false, 'message' => 'Metode permintaan tidak diizinkan.'], JSON_UNESCAPED_UNICODE);
    exit;
}

$nama = trim($_POST['nama'] ?? '');
$kelas = trim($_POST['kelas'] ?? '');
$jurusan = trim($_POST['jurusan'] ?? '');

if ($nama === '' || $kelas === '' || $jurusan === '') {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => 'Semua kolom wajib diisi.'], JSON_UNESCAPED_UNICODE);
    exit;
}

// Respons ini memvalidasi dan mengembalikan data; penyimpanan permanen dapat ditambahkan melalui database.
echo json_encode([
    'success' => true,
    'message' => 'Identitas berhasil dicatat.',
    'data' => ['nama' => $nama, 'kelas' => $kelas, 'jurusan' => $jurusan],
], JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE);
