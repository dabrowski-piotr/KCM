<?php
/**
 * Krakowskie Centrum Medyczne — obsługa formularza kontaktowego.
 * Odbiera dane z formularz.html i wysyła je mailem na adres rejestracji.
 * Nie wymaga bazy danych, composera ani żadnych bibliotek.
 */

// ─── konfiguracja ───────────────────────────────────────────────
$ODBIORCA   = 'kontakt@krakowskiecentrummedyczne.pl';
$TEMAT      = 'Nowe zgłoszenie ze strony — Krakowskie Centrum Medyczne';
$PRZEKIERUJ = 'formularz-ok.html';           // strona po udanym wysłaniu
$BLAD       = 'formularz-blad.html';         // strona gdy wysyłka się nie uda
// ────────────────────────────────────────────────────────────────

// tylko POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: formularz.html');
    exit;
}

// honeypot — bot wypełnia ukryte pole
if (!empty($_POST['_gotcha'])) {
    header('Location: ' . $PRZEKIERUJ);
    exit;
}

// ── walidacja ──
$imie    = trim($_POST['imie'] ?? '');
$telefon = trim($_POST['telefon'] ?? '');
$email   = trim($_POST['email'] ?? '');
$temat   = trim($_POST['temat'] ?? '');
$tresc   = trim($_POST['wiadomosc'] ?? '');
$zgoda   = isset($_POST['zgoda']);

$bledy = [];
if (mb_strlen($imie) < 2)                          $bledy[] = 'brak imienia';
if (preg_match_all('/\d/', $telefon) < 9)           $bledy[] = 'za krótki telefon';
if ($email !== '' && !filter_var($email, FILTER_VALIDATE_EMAIL)) $bledy[] = 'niepoprawny e-mail';
if (!$zgoda)                                        $bledy[] = 'brak zgody';

if ($bledy) {
    header('Location: formularz.html?blad=' . urlencode(implode(', ', $bledy)));
    exit;
}

// ── treść maila ──
$data = date('d.m.Y, H:i');
$body  = "Nowe zgłoszenie z formularza na stronie\n";
$body .= str_repeat('─', 46) . "\n\n";
$body .= "Imię i nazwisko:  {$imie}\n";
$body .= "Telefon:          {$telefon}\n";
if ($email) $body .= "E-mail:           {$email}\n";
$body .= "Temat:            {$temat}\n";
if ($tresc) $body .= "\nWiadomość:\n{$tresc}\n";
$body .= "\n" . str_repeat('─', 46) . "\n";
$body .= "Data zgłoszenia:  {$data}\n";
$body .= "IP:               {$_SERVER['REMOTE_ADDR']}\n";

// ── nagłówki ──
$naglowki  = "From: formularz@krakowskiecentrummedyczne.pl\r\n";
$naglowki .= "Reply-To: " . ($email ?: 'formularz@krakowskiecentrummedyczne.pl') . "\r\n";
$naglowki .= "Content-Type: text/plain; charset=UTF-8\r\n";
$naglowki .= "X-Mailer: KCM-Formularz/1.0\r\n";

// ── wysyłka ──
$wyslano = @mail($ODBIORCA, $TEMAT, $body, $naglowki);

if ($wyslano) {
    header('Location: ' . $PRZEKIERUJ);
} else {
    header('Location: ' . $BLAD);
}
exit;
