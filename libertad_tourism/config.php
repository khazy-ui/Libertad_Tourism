<?php
session_start();
$db = new mysqli('localhost', 'root', '', 'libertad_tourism');
if ($db->connect_error) die('Database error. Start MySQL in XAMPP and import database.sql');
$db->set_charset('utf8mb4');

function e($s) { return htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8'); }
function setting($k) {
  global $db; static $c = null;
  if ($c === null) { $c = []; $r = $db->query("SELECT k,v FROM settings"); while ($x = $r->fetch_assoc()) $c[$x['k']] = $x['v']; }
  return $c[$k] ?? '';
}
function spot_bg($s) {
  if (!empty($s['image'])) return "background:linear-gradient(rgba(0,0,0,.35),rgba(0,0,0,.55)),url('uploads/".e($s['image'])."') center/cover";
  return "background:linear-gradient(135deg,".e($s['color']).",#0b2b26)";
}
