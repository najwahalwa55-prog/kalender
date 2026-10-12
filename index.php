<?php
date_default_timezone_set('Asia/Jakarta');

$month = isset($_GET['month']) ? (int)$_GET['month'] : date('n');
$year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');

if ($month < 1) { $month = 12; $year--; }
if ($month > 12) { $month = 1; $year++; }

$firstDay = mktime(0,0,0,$month,1,$year);
$daysInMonth = date('t', $firstDay);
$dayOfWeek = date('w', $firstDay); // 0 = Minggu
$today = date('j');
$currentMonth = date('n');
$currentYear = date('Y');

$bulanIndo = [1=>'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Aesthetic Calendar</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif}
body{
    min-height:100vh;
    background: #f5f1eb;
    background-image: radial-gradient(#e8ddd0 1.5px, transparent 1.5px);
    background-size: 24px 24px;
    display:flex; justify-content:center; align-items:center;
    padding:20px;
}
.card{
    background:white;
    width:100%; max-width:420px;
    border-radius:32px;
    padding:28px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.08), 0 0 0 1px rgba(0,0,0,0.03);
}
.header{
    display:flex; justify-content:space-between; align-items:center;
    margin-bottom:24px;
}
.header h1{
    font-size:22px; font-weight:600; color:#2d2d2d;
}
.header h1 span{ font-weight:300; color:#a8a29e }
.nav a{
    text-decoration:none;
    width:36px; height:36px;
    display:inline-flex; justify-content:center; align-items:center;
    background:#f5f1eb; border-radius:50%;
    color:#2d2d2d; font-size:18px; transition:.2s;
}
.nav a:hover{ background:#2d2d2d; color:white }

.weekdays{
    display:grid; grid-template-columns:repeat(7,1fr);
    text-align:center; font-size:11px; font-weight:600;
    letter-spacing:1px; color:#c4b8ab; margin-bottom:12px;
}
.days{
    display:grid; grid-template-columns:repeat(7,1fr);
    gap:6px;
}
.day{
    aspect-ratio:1;
    display:flex; justify-content:center; align-items:center;
    border-radius:50%;
    font-size:14px; font-weight:400; color:#5a5a5a;
    position:relative;
}
.day.empty{ background:transparent }
.day.today{
    background:#2d2d2d; color:white; font-weight:600;
    box-shadow: 0 8px 20px rgba(45,45,45,0.25);
}
.day.today::after{
    content:'HARI INI';
    position:absolute; bottom:-16px; font-size:7px; letter-spacing:1px; color:#2d2d2d; font-weight:600;
}
.day.other-month{ color:#ddd }
.day:not(.empty):not(.today):hover{
    background:#f5f1eb; cursor:pointer;
}
.footer{
    margin-top:36px; padding-top:20px;
    border-top:1px dashed #e8ddd0;
    display:flex; justify-content:space-between; align-items:center;
}
.footer .time{ font-size:28px; font-weight:300; color:#2d2d2d }
.footer .time b{ font-weight:600 }
.footer .desc{ font-size:11px; color:#a8a29e; text-align:right; line-height:1.4 }
</style>
</head>
<body>

<div class="card">
    <div class="header">
        <h1><?= $bulanIndo[$month] ?> <span><?= $year ?></span></h1>
        <div class="nav">
            <a href="?month=<?= $month-1 ?>&year=<?= $year ?>">‹</a>
            <a href="?month=<?= $month+1 ?>&year=<?= $year ?>">›</a>
        </div>
    </div>

    <div class="weekdays">
        <div>MIN</div><div>SEN</div><div>SEL</div><div>RAB</div><div>KAM</div><div>JUM</div><div>SAB</div>
    </div>

    <div class="days">
        <?php for($i=0; $i<$dayOfWeek; $i++): ?>
            <div class="day empty"></div>
        <?php endfor; ?>

        <?php for($d=1; $d<=$daysInMonth; $d++): 
            $isToday = ($d==$today && $month==$currentMonth && $year==$currentYear);
        ?>
            <div class="day <?= $isToday ? 'today' : '' ?>"><?= $d ?></div>
        <?php endfor; ?>
    </div>

    <div class="footer">
        <div class="time" id="clock">00:00</div>
        <div class="desc">Surabaya, ID<br><?= date('l') ?> • aesthetic calendar</div>
    </div>
</div>

<script>
function updateClock(){
    const now = new Date();
    document.getElementById('clock').innerHTML = 
        `<b>${String(now.getHours()).padStart(2,'0')}:${String(now.getMinutes()).padStart(2,'0')}</b>:${String(now.getSeconds()).padStart(2,'0')}`;
}
setInterval(updateClock,1000); updateClock();
</script>

</body>
</html>
