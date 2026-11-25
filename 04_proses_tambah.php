<?php
// Legacy public endpoint: refuse all submissions so it cannot bypass the
// authenticated, CSRF-protected student_submission.php handler.
http_response_code(410);
header('Content-Type: text/plain; charset=utf-8');
echo 'Endpoint lama tidak lagi menerima pengajuan. Gunakan formulir pengajuan yang tersedia setelah masuk.';
exit;
