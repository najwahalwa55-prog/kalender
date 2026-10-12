<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="manifest" href="manifest.json">
<meta name="theme-color" content="#ff9abf">
<title>Mochi Calendar - Kalender Lucu</title>
<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@400;600&display=swap" rel="stylesheet">
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Fredoka',sans-serif}
body{min-height:100vh;background:#fff0f5;display:flex;justify-content:center;align-items:center;padding:16px}
.phone{
  width:100%;max-width:380px;background:white;border-radius:40px;
  padding:24px; box-shadow:0 20px 50px rgba(255,154,191,0.3);
  border:8px solid #2d2d2d;
}
.top{display:flex;justify-content:space-between;align-items:center;margin-bottom:10px}
.top h1{font-size:24px} .top h1 span{color:#ff9abf}
.badge{background:#2d2d2d;color:white;padding:6px 14px;border-radius:20px;font-size:12px}
.mochi{font-size:40px;text-align:center;margin:10px 0}
.weekdays{display:grid;grid-template-columns:repeat(7,1fr);text-align:center;font-size:11px;color:#ffb3cc;font-weight:600;margin:14px 0 8px}
.days{display:grid;grid-template-columns:repeat(7,1fr);gap:4px}
.day{aspect-ratio:1;display:flex;justify-content:center;align-items:center;border-radius:18px;font-size:14px;color:#5a5a5a;background:#fff6f9}
.day.today{background:#ff9abf;color:white;font-weight:600;transform:scale(1.1);box-shadow:0 6px 15px rgba(255,154,191,0.5)}
.day.empty{background:transparent}
.footer{margin-top:20px;background:#2d2d2d;border-radius:20px;padding:14px 18px;display:flex;justify-content:space-between;color:white}
.btn-nav{border:none;background:#ffecf2;width:36px;height:36px;border-radius:12px;cursor:pointer}
</style>
</head>
<body>
<div class="phone">
  <div class="top">
    <h1 id="monthYear"></h1>
    <div>
      <button class="btn-nav" onclick="changeMonth(-1)">‹</button>
      <button class="btn-nav" onclick="changeMonth(1)">›</button>
    </div>
  </div>
  <div class="mochi"> (｡˃ ᵕ ˂ )ﾉ♡ </div>
  <div class="badge" id="todayBadge" style="text-align:center;display:block">memuat...</div>
  <div class="weekdays"><div>MIN</div><div>SEN</div><div>SEL</div><div>RAB</div><div>KAM</div><div>JUM</div><div>SAB</div></div>
  <div class="days" id="days"></div>
  <div class="footer">
    <div>Jam Mochi<br><b id="clock" style="font-size:20px">00:00</b></div>
    <div style="text-align:right;font-size:11px;opacity:.7">tap tanggal<br>buat jadi to-do lucu!</div>
  </div>
</div>
<script>
const bulan=["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
let now=new Date(), cm=now.getMonth(), cy=now.getFullYear();
function render(){
  const first=new Date(cy,cm,1).getDay(), total=new Date(cy,cm+1,0).getDate(), today=new Date();
  document.getElementById('monthYear').innerHTML=`${bulan[cm]}<br><span style="font-size:14px;color:#aaa">${cy}</span>`;
  document.getElementById('todayBadge').innerText=`Hari ini: ${today.getDate()} ${bulan[today.getMonth()]} ${today.getFullYear()} ♡`;
  let h=""; for(let i=0;i<first;i++) h+=`<div class="day empty"></div>`;
  for(let d=1;d<=total;d++){ 
    const isToday=d===today.getDate()&&cm===today.getMonth()&&cy===today.getFullYear();
    h+=`<div class="day ${isToday?'today':''}">${d}</div>`; 
  }
  document.getElementById('days').innerHTML=h;
}
function changeMonth(s){cm+=s; if(cm<0){cm=11;cy--} if(cm>11){cm=0;cy++} render()}
setInterval(()=>{ const n=new Date(); document.getElementById('clock').innerText=n.toLocaleTimeString('id-ID') },1000);
render();
if('serviceWorker' in navigator){ navigator.serviceWorker.register('sw.js') }
</script>
</body>
</html>
