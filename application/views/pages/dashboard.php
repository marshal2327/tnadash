<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CR GARMENTS | DASHBOARD</title>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
/* ═══════════════════════════════════════════
   THEME TOKENS
═══════════════════════════════════════════ */
:root {
  --gold:     #f0a500;
  --gold2:    #ffd166;
  --gold3:    #b87a00;
  --teal:     #00c48c;
  --teal2:    #00e6a5;
  --red:      #ff4e4e;
  --red2:     #ff8a8a;
  --blue:     #3b9eff;
  --blue2:    #7dc0ff;
  --purple:   #9b6dff;
  --font-h:   'Bebas Neue', sans-serif;
  --font-b:   'Outfit', sans-serif;
  --r:        12px;
  --r2:       8px;
  --nav-w:    240px;
  --nav-coll: 64px;
  --top-h:    60px;
  --trans:    .35s cubic-bezier(.22,1,.36,1);
}

/* DARK */
[data-theme="dark"] {
  --bg:        #090e18;
  --bg2:       #0f1825;
  --bg3:       #162030;
  --bg4:       #1d2d42;
  --line:      rgba(255,255,255,0.07);
  --line2:     rgba(255,255,255,0.13);
  --text:      #e8edf5;
  --text2:     #8a9bb5;
  --text3:     #4a5f7a;
  --nav-bg:    #0b1220;
  --nav-item:  rgba(255,255,255,0.04);
  --nav-act:   rgba(240,165,0,0.12);
  --top-bg:    rgba(9,14,24,0.85);
  --card:      #0f1825;
  --orb-op:    0.07;
  --shadow:    0 4px 24px rgba(0,0,0,0.4);
}

/* LIGHT */
[data-theme="light"] {
  --bg:        #f0f4fb;
  --bg2:       #ffffff;
  --bg3:       #e8edf8;
  --bg4:       #dce4f0;
  --line:      rgba(0,0,0,0.07);
  --line2:     rgba(0,0,0,0.12);
  --text:      #0f1825;
  --text2:     #445572;
  --text3:     #8a9bb5;
  --nav-bg:    #ffffff;
  --nav-item:  rgba(0,0,0,0.03);
  --nav-act:   rgba(240,165,0,0.1);
  --top-bg:    rgba(240,244,251,0.9);
  --card:      #ffffff;
  --orb-op:    0.04;
  --shadow:    0 4px 20px rgba(0,0,0,0.08);
}

/* ═══════════════════════════════════════════
   RESET & BASE
═══════════════════════════════════════════ */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; }
body {
  background: var(--bg);
  color: var(--text);
  font-family: var(--font-b);
  min-height: 100vh;
  overflow-x: hidden;
  transition: background var(--trans), color var(--trans);
}

/* ═══════════════════════════════════════════
   ANIMATED BG
═══════════════════════════════════════════ */
.bg-canvas {
  position: fixed; inset: 0;
  pointer-events: none; z-index: 0; overflow: hidden;
}
.bg-orb {
  position: absolute; border-radius: 50%;
  filter: blur(80px);
  opacity: var(--orb-op);
  animation: orbFloat 14s ease-in-out infinite;
  transition: opacity var(--trans);
}
.bg-orb:nth-child(1){width:700px;height:700px;background:var(--gold);top:-200px;left:-100px;animation-delay:0s;}
.bg-orb:nth-child(2){width:500px;height:500px;background:var(--teal);bottom:-100px;right:0;animation-delay:-5s;}
.bg-orb:nth-child(3){width:350px;height:350px;background:var(--blue);top:35%;left:40%;animation-delay:-10s;}
.grid-lines {
  position: absolute; inset: 0;
  background-image:
    linear-gradient(rgba(128,128,128,0.04) 1px,transparent 1px),
    linear-gradient(90deg,rgba(128,128,128,0.04) 1px,transparent 1px);
  background-size: 56px 56px;
}
@keyframes orbFloat {
  0%,100%{transform:translate(0,0) scale(1);}
  33%{transform:translate(40px,-30px) scale(1.06);}
  66%{transform:translate(-25px,35px) scale(0.94);}
}

/* ═══════════════════════════════════════════
   APP SHELL
═══════════════════════════════════════════ */
.shell {
  display: flex;
  min-height: 100vh;
  position: relative;
  z-index: 1;
}

/* ═══════════════════════════════════════════
   SIDEBAR / NAV
═══════════════════════════════════════════ */
.sidebar {
  width: var(--nav-w);
  min-height: 100vh;
  background: var(--nav-bg);
  border-right: 1px solid var(--line);
  display: flex;
  flex-direction: column;
  position: fixed;
  left: 0; top: 0; bottom: 0;
  z-index: 200;
  transition: width var(--trans), transform var(--trans), background var(--trans);
  overflow: hidden;
}
.sidebar.collapsed { width: var(--nav-coll); }

/* mobile overlay */
.nav-overlay {
  display: none;
  position: fixed; 
  /* inset: 0;  */
  top: 0;
  bottom: 0;
  left: var(--nav-w); 
  right: 0;
  z-index: 199;
  backdrop-filter: blur(2px);
  /* background: rgba(0,0,0,0.4);  */
  animation: fadeIn .3s ease;
}
.nav-overlay.show { display: block; }
@keyframes fadeIn{from{opacity:0;}to{opacity:1;}}

/* Logo area */
.nav-logo {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 20px 16px;
  border-bottom: 1px solid var(--line);
  min-height: var(--top-h);
  overflow: hidden;
}
.logo-mark {
  width: 36px; height: 36px;
  border-radius: 10px;
  background: linear-gradient(135deg, var(--gold3), var(--gold));
  display: flex; align-items: center; justify-content: center;
  font-family: var(--font-h); font-size: 16px; color: #000;
  flex-shrink: 0;
  box-shadow: 0 0 20px rgba(240,165,0,0.35);
  animation: logoPulse 3s ease-in-out infinite;
}
@keyframes logoPulse{
  0%,100%{box-shadow:0 0 16px rgba(240,165,0,0.3);}
  50%{box-shadow:0 0 30px rgba(240,165,0,0.55);}
}
.logo-text {
  overflow: hidden;
  white-space: nowrap;
  transition: opacity var(--trans), width var(--trans);
}
.logo-title {
  font-family: var(--font-h);
  font-size: 20px; letter-spacing: 2px; line-height: 1;
  color: var(--text);
}
.logo-title span { color: var(--gold); }
.logo-sub {
  font-size: 9px; color: var(--text3);
  letter-spacing: 1.5px; text-transform: uppercase; margin-top: 2px;
}
.sidebar.collapsed .logo-text { opacity: 0; width: 0; pointer-events: none; }

/* Nav section */
.nav-section { padding: 10px 8px; }
.nav-section-label {
  font-size: 9px; letter-spacing: 2px; text-transform: uppercase;
  color: var(--text3); padding: 6px 10px 4px;
  white-space: nowrap; overflow: hidden;
  transition: opacity var(--trans);
}
.sidebar.collapsed .nav-section-label { opacity: 0; }

.nav-item {
  display: flex; align-items: center; gap: 12px;
  padding: 10px 12px; border-radius: 8px;
  cursor: pointer; color: var(--text2);
  transition: all .25s; white-space: nowrap;
  position: relative; overflow: hidden;
  margin-bottom: 2px;
  text-decoration: none;
}
.nav-item::before {
  content: '';
  position: absolute; left: 0; top: 20%; bottom: 20%;
  width: 3px; border-radius: 2px;
  background: var(--gold);
  transform: scaleY(0); transition: transform .25s;
}
.nav-item:hover {
  background: var(--nav-item);
  color: var(--text);
}
.nav-item.active {
  background: var(--nav-act);
  color: var(--gold);
}
.nav-item.active::before { transform: scaleY(1); }
.nav-item.active .nav-icon { color: var(--gold); }

.nav-icon {
  width: 20px; height: 20px; flex-shrink: 0;
  display: flex; align-items: center; justify-content: center;
  font-size: 16px; transition: color .25s;
}
.nav-label {
  font-size: 13px; font-weight: 500;
  transition: opacity var(--trans);
  overflow: hidden;
}
.sidebar.collapsed .nav-label { opacity: 0; pointer-events: none; }

.nav-badge {
  margin-left: auto;
  background: var(--red); color: #fff;
  font-size: 9px; font-weight: 700;
  padding: 2px 6px; border-radius: 10px;
  flex-shrink: 0;
  transition: opacity var(--trans);
}
.sidebar.collapsed .nav-badge { opacity: 0; }

/* Tooltip on collapsed */
.nav-item .nav-tip {
  position: absolute; left: calc(var(--nav-coll) + 8px);
  background: var(--bg4); border: 1px solid var(--line2);
  color: var(--text); font-size: 11px; font-weight: 600;
  padding: 5px 10px; border-radius: 6px;
  white-space: nowrap; pointer-events: none;
  opacity: 0; transform: translateX(-6px);
  transition: all .2s;
  z-index: 999;
  box-shadow: var(--shadow);
}
.sidebar.collapsed .nav-item:hover .nav-tip { opacity: 1; transform: none; }

/* Nav footer */
.nav-footer {
  margin-top: auto;
  padding: 12px 8px;
  border-top: 1px solid var(--line);
}

/* Collapse toggle button */
.nav-toggle {
  display: flex; align-items: center; gap: 12px;
  padding: 10px 12px; border-radius: 8px;
  cursor: pointer; color: var(--text3);
  transition: all .25s; white-space: nowrap;
  background: none; border: none; font-family: var(--font-b);
  width: 100%;
}
.nav-toggle:hover { background: var(--nav-item); color: var(--text2); }
.nav-toggle .nav-icon { transition: transform var(--trans); }
.sidebar.collapsed .nav-toggle .nav-icon { transform: rotate(180deg); }
.nav-toggle .nav-label { font-size: 12px; transition: opacity var(--trans); }
.sidebar.collapsed .nav-toggle .nav-label { opacity: 0; }

/* ═══════════════════════════════════════════
   MAIN CONTENT AREA
═══════════════════════════════════════════ */
.main-wrap {
  flex: 1;
  margin-left: var(--nav-w);
  display: flex; flex-direction: column;
  min-height: 100vh;
  transition: margin-left var(--trans);
}
.main-wrap.nav-coll { margin-left: var(--nav-coll); }

/* ═══════════════════════════════════════════
   TOP NAVBAR
═══════════════════════════════════════════ */
.topbar {
  height: var(--top-h);
  background: var(--top-bg);
  /* backdrop-filter: blur(16px); */
  /* -webkit-backdrop-filter: blur(16px); */
  border-bottom: 1px solid var(--line);
  display: flex; align-items: center;
  padding: 0 20px;
  position: sticky; top: 0; z-index: 100;
  gap: 12px;
  transition: background var(--trans);
}

/* Hamburger */
.hamburger {
  width: 36px; height: 36px;
  border-radius: 8px; border: 1px solid var(--line2);
  background: none; cursor: pointer;
  display: none; flex-direction: column;
  align-items: center; justify-content: center; gap: 5px;
  flex-shrink: 0; transition: all .2s;
}
.hamburger:hover { background: var(--nav-item); border-color: var(--line2); }
.ham-line {
  width: 16px; height: 1.5px;
  background: var(--text2); border-radius: 2px;
  transition: all .3s;
}
.hamburger.open .ham-line:nth-child(1){ transform:translateY(6.5px) rotate(45deg); }
.hamburger.open .ham-line:nth-child(2){ opacity:0; transform:scaleX(0); }
.hamburger.open .ham-line:nth-child(3){ transform:translateY(-6.5px) rotate(-45deg); }

/* Breadcrumb */
.breadcrumb {
  display: flex; align-items: center; gap: 6px;
  font-size: 12px; color: var(--text3);
  flex: 1; overflow: hidden;
}
.breadcrumb-sep { opacity: .4; }
.breadcrumb-cur { color: var(--text); font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }

/* FILTER BOX */
.filter-box{
  display:flex;
  align-items:center;
  justify-content:flex-end;
  gap:15px;
  /* border:1px solid grey;  */
  flex: 1 1 0; 
}

.seasonf, .buyerf, .companyf{
  transition:all .25s ease-in-out;
  position:relative;
}

#seasonbtn, #buyerbtn, #companybtn{
  display:flex;
  flex-direction:row; 
  gap:5px;
  font-family:var(--font-b);
  font-size:12px;
  border:1px solid var(--line);
  /* padding:5px 8px; */
  border-radius:8px;
  align-items:center;
  padding:5px 8px;
  transition:all .25s ease-in-out;
  outline:none;
  cursor:pointer;
}

#seasonbtn:active, #buyerbtn:active, #companybtn:active{
    border:1px solid var(--gold);
}

.season-opt{
  position:absolute;
  width:max-content;
  max-height:0;
  overflow-y:scroll;
  top: 29px;
  left:0;
  border:1px solid var(--line);
  /* padding: 5px 0px; */
  border-radius:8px;
  box-shadow:0px 0px 5px lightgrey; 
  background:#f0f4fb;
  transition:all .25s ease-in-out;
  opacity:0;
  /* display:none; */
}

.season-opt.show, .buyer-opt.show, .company-opt.show{
  opacity:1;
  max-height:190px;
}


.buyer-opt{
  position:absolute;
  width:max-content;
  max-height:0;
  overflow-y:scroll;
  top: 29px;
  left:0;
  border:1px solid var(--line);
  /* padding: 5px 0px; */
  border-radius:8px;
  box-shadow:0px 0px 5px lightgrey; 
  background:#f0f4fb;
  opacity:0;
  transition:all .25s ease-in-out;
}

.company-opt{
  position:absolute;
  width:max-content;
  max-height:0;
  overflow-y:scroll;
  top: 29px;
  left:0;
  border:1px solid var(--line);
  /* padding: 5px 0px; */
  border-radius:8px;
  box-shadow:0px 0px 5px lightgrey; 
  background:#f0f4fb;
  opacity:0;
  transition:all .25s ease-in-out;
}


.seas_search, .buy_search, .comp_search{
  position:sticky;
  top: 0px; 
  background:#f0f4fb;
  padding:3px 5px;
  flex:1;
}

#seas_searchbox, #buy_searchbox, #comp_searchbox{
  border:1px solid grey;
  width:100px;
  border-radius:5px;
  padding:3px 3px;
  font-family:var(--font-b);
  font-size:12px;
  outline:none;
  margin:3px 0px;
  border:1px solid grey;
  transition:all .25s;
}

#comp_searchbox{
  width:100%;
}

#seas_searchbox:focus, #buy_searchbox:focus, #comp_searchbox:focus{
  border-color:var(--gold);
}

.season-opt-itm, .buyer-opt-itm, .company-opt-itm{
  display:flex;
  flex-direction:row;
  justify-content:space-between;
  padding:5px 5px;
  gap:8px;
  font-size:12px;
  transition:all .5s ease-in-out;
  cursor:pointer;
  max-height:100px;
  opacity:1;
  transition:all .3s ease-in-out;
}

.season-opt-itm.hide, .buyer-opt-itm.hide, .company-opt-itm.hide{
  max-height:0;
  opacity:0;
}

.season-opt-itm label, .buyer-opt-itm label, .company-opt-itm label{
  flex: 1 1 auto;
  cursor:pointer;
  font-family:var(--font-b);
  font-size:11px;
}


.seas_footer, .buy_footer, .comp_footer{
  position:sticky;
  bottom: 0px; 
  background:#f0f4fb;
  padding:3px 5px;
  flex:1;
  display:flex;
  justify-content:space-between;
  align-items:center;
}

#seas_clear, #buy_clear, #comp_clear{
  font-family:var(--font-b);
  font-size:11px;
  border-radius:5px;
  padding:1px 4px;
  border:1px solid grey;
  background:whitesmoke;
  cursor:pointer;
}

#seas_apply, #buy_apply, #comp_apply{
  font-family:var(--font-b);
  font-size:11px;
  border-radius:5px;
  padding:1px 4px;
  border:1px solid grey;
  background:#97ffe2;
  cursor:pointer;
}


/* Sear ch bar */
.top-search {
  display: flex; align-items: center; gap: 8px;
  background: var(--bg3); border: 1px solid var(--line);
  border-radius: 20px; padding: 6px 14px;
  transition: all .25s; width: 200px;
}
.top-search:focus-within {
  border-color: var(--gold); width: 260px;
  box-shadow: 0 0 0 3px rgba(240,165,0,0.12);
}
.top-search input {
  background: none; border: none; outline: none;
  color: var(--text); font-family: var(--font-b);
  font-size: 12px; width: 100%; min-width: 0;
}
.top-search input::placeholder { color: var(--text3); }
.search-icon { color: var(--text3); font-size: 13px; flex-shrink: 0; }

/* Notification bell */
.top-btn {
  width: 36px; height: 36px;
  border-radius: 8px; border: 1px solid var(--line2);
  background: none; cursor: pointer;
  display: flex; align-items: center; justify-content: center;
  font-size: 16px; color: var(--text2);
  transition: all .2s; flex-shrink: 0; position: relative;
}
.top-btn:hover { background: var(--nav-item); color: var(--text); border-color: var(--gold); }
.top-btn .notif-badge {
  position: absolute; top: 4px; right: 4px;
  width: 8px; height: 8px; border-radius: 50%;
  background: var(--red);
  box-shadow: 0 0 6px var(--red);
  animation: blinkDot 2s ease-in-out infinite;
}
@keyframes blinkDot{0%,100%{opacity:1;}50%{opacity:.3;};}

/* Dark/Light Toggle */
.theme-toggle {
  display: flex; align-items: center; gap: 6px;
  background: var(--bg3); border: 1px solid var(--line);
  border-radius: 20px; padding: 4px 10px; cursor: pointer;
  transition: all .2s; flex-shrink: 0;  
}
.theme-toggle:hover { border-color: var(--gold); }
.toggle-track {
  width: 32px; height: 18px;
  background: var(--bg4); border-radius: 9px;
  position: relative; transition: background .3s;
  border: 1px solid var(--line2);
}
[data-theme="light"] .toggle-track { background: var(--gold); border-color: var(--gold3); }
.toggle-thumb {
  width: 12px; height: 12px; border-radius: 50%;
  background: var(--text2);
  position: absolute; top: 2px; left: 2px;
  transition: transform .3s, background .3s;
}
[data-theme="light"] .toggle-thumb { transform: translateX(14px); background: #fff; }
.toggle-icon { font-size: 13px; }

/* Live time */
.live-wrap {
  display: flex; align-items: center; gap: 6px; flex-shrink: 0;
}
.live-dot {
  width: 7px; height: 7px; border-radius: 50%;
  background: var(--teal); box-shadow: 0 0 7px var(--teal);
  animation: livePulse 2s ease-in-out infinite;
}
@keyframes livePulse{0%,100%{opacity:1;transform:scale(1);}50%{opacity:.4;transform:scale(1.5);};}
.live-time { font-size: 11px; color: var(--text2); font-weight: 600; letter-spacing: .5px; }

/* User avatar / dropdown */
.user-wrap { position: relative; flex-shrink: 0; }
.user-btn {
  display: flex; align-items: center; gap: 8px;
  padding: 4px 10px 4px 4px;
  border-radius: 20px; border: 1px solid var(--line2);
  cursor: pointer; transition: all .2s; background: none;
  font-family: var(--font-b); color: var(--text);
}
.user-btn:hover { border-color: var(--gold); background: var(--nav-item); }
.user-av {
  width: 30px; height: 30px; border-radius: 50%;
  background: linear-gradient(135deg, var(--gold3), var(--gold));
  display: flex; align-items: center; justify-content: center;
  font-family: var(--font-h); font-size: 13px; color: #000;
  flex-shrink: 0; position: relative;
}
.user-av::after {
  content: '';
  position: absolute; bottom: 0; right: 0;
  width: 8px; height: 8px; border-radius: 50%;
  background: var(--teal); border: 1.5px solid var(--top-bg);
}
.user-name { font-size: 12px; font-weight: 600; }
.user-role { font-size: 10px; color: var(--text3); line-height: 1; }
.user-caret { font-size: 9px; color: var(--text3); margin-left: 2px; transition: transform .3s; }
.user-btn.open .user-caret { transform: rotate(180deg); }

/* Dropdown */
.user-dropdown {
  position: absolute; top: calc(100% + 10px); right: 0;
  background: var(--bg2); border: 1px solid var(--line2);
  border-radius: 12px; min-width: 220px;
  box-shadow: 0 16px 50px rgba(0,0,0,0.3);
  overflow: hidden; z-index: 999;
  transform: translateY(-8px) scale(.97);
  opacity: 0; pointer-events: none;
  transition: all .25s cubic-bezier(.22,1,.36,1);
}
.user-dropdown.open {
  transform: none; opacity: 1; pointer-events: all;
}
.dd-header {
  padding: 16px; border-bottom: 1px solid var(--line);
  display: flex; align-items: center; gap: 12px;
}
.dd-av-lg {
  width: 42px; height: 42px; border-radius: 12px;
  background: linear-gradient(135deg, var(--gold3), var(--gold));
  display: flex; align-items: center; justify-content: center;
  font-family: var(--font-h); font-size: 18px; color: #000; flex-shrink: 0;
}
.dd-uname { font-size: 14px; font-weight: 600; color: var(--text); }
.dd-urole { font-size: 11px; color: var(--text3); margin-top: 2px; }
.dd-dept { font-size: 10px; color: var(--gold); margin-top: 1px; font-weight: 600; letter-spacing: .5px; }
.dd-body { padding: 8px; }
.dd-item {
  display: flex; align-items: center; gap: 10px;
  padding: 9px 12px; border-radius: 8px; cursor: pointer;
  font-size: 12px; font-weight: 500; color: var(--text2);
  transition: all .2s; white-space: nowrap;
}
.dd-item:hover { background: var(--nav-item); color: var(--text); }
.dd-item.danger { color: var(--red2); }
.dd-item.danger:hover { background: rgba(255,78,78,0.1); }
.dd-sep { height: 1px; background: var(--line); margin: 6px 0; }
.dd-icon { font-size: 14px; width: 18px; text-align: center; }

/* ═══════════════════════════════════════════
   CONTENT AREA
═══════════════════════════════════════════ */
.content {
  flex: 1;
  padding: 24px;
  overflow-x: hidden;
}

/* ═══════════════════════════════════════════
   KPI CARDS
═══════════════════════════════════════════ */
.kpi-row {
  display: grid;
  grid-template-columns: repeat(4,1fr);
  gap: 16px;
  margin-bottom: 22px;
}
.kpi {
  background: var(--card);
  border: 1px solid var(--line);
  border-radius: var(--r);
  padding: 20px 22px;
  position: relative; overflow: hidden;
  transition: transform .3s, border-color .3s, box-shadow .3s, background var(--trans);
  animation: fadeUp .6s ease both;
  cursor: default;
}
.kpi:nth-child(1){animation-delay:.08s;}
.kpi:nth-child(2){animation-delay:.16s;}
.kpi:nth-child(3){animation-delay:.24s;}
.kpi:nth-child(4){animation-delay:.32s;}
.kpi:hover { transform: translateY(-4px); }
.kpi-glow {
  position: absolute; top: -50px; right: -50px;
  width: 140px; height: 140px; border-radius: 50%;
  filter: blur(40px); opacity: .12; transition: opacity .3s;
}
.kpi:hover .kpi-glow { opacity: .25; }
.kpi-total:hover  { border-color:rgba(59,158,255,.4); box-shadow:0 8px 28px rgba(59,158,255,.1); }
.kpi-ontime:hover{ border-color:rgba(0,196,140,.4);  box-shadow:0 8px 28px rgba(0,196,140,.1); }
.kpi-delayed:hover{ border-color:rgba(255,78,78,.4);  box-shadow:0 8px 28px rgba(255,78,78,.1); }
.kpi-running:hover { border-color:rgba(240,165,0,.4);  box-shadow:0 8px 28px rgba(240,165,0,.1); }
.kpi-total  .kpi-glow { background:var(--blue); }
.kpi-ontime .kpi-glow{ background:var(--teal); }
.kpi-delayed .kpi-glow{ background:var(--red); }
.kpi-running .kpi-glow { background:var(--gold); }
.kpi-stripe {
  position:absolute;left:0;top:0;bottom:0;width:3px;border-radius:3px 0 0 3px;
}
.kpi-total  .kpi-stripe{background:linear-gradient(to bottom,var(--blue),transparent);}
.kpi-ontime .kpi-stripe{background:linear-gradient(to bottom,var(--teal),transparent);}
.kpi-delayed .kpi-stripe{background:linear-gradient(to bottom,var(--red),transparent);}
.kpi-running .kpi-stripe{background:linear-gradient(to bottom,var(--gold),transparent);}
.kpi-label { font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--text3);margin-bottom:10px;font-weight:500; }
.kpi-num {
  font-family:var(--font-h);font-size:50px;line-height:1;
  -webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;
}
.kpi-total  .kpi-num{background-image:linear-gradient(135deg,var(--blue2),var(--blue));}
.kpi-ontime .kpi-num{background-image:linear-gradient(135deg,var(--teal2),var(--teal));}
.kpi-delayed .kpi-num{background-image:linear-gradient(135deg,var(--red2),var(--red));}
.kpi-running .kpi-num{background-image:linear-gradient(135deg,var(--gold2),var(--gold));}
.kpi-sub { font-size:11px;color:var(--text3);margin-top:6px; }
.kpi-bar { height:3px;background:rgba(128,128,128,.1);border-radius:2px;margin-top:14px;overflow:hidden; }
.kpi-bar-fill { height:100%;border-radius:2px;transition:width 1.4s cubic-bezier(.22,1,.36,1); }
.kpi-total  .kpi-bar-fill{background:var(--blue);}
.kpi-ontime .kpi-bar-fill{background:var(--teal);}
.kpi-delayed .kpi-bar-fill{background:var(--red);}
.kpi-running .kpi-bar-fill{background:var(--gold);}

/* ═══════════════════════════════════════════
   DASHBOARD GRID
═══════════════════════════════════════════ */
.dash-grid {
  display: grid;
  grid-template-columns: 1fr 340px;
  gap: 18px;
}

/* ═══════════════════════════════════════════
   PANEL
═══════════════════════════════════════════ */
.panel {
  max-height:600px;
  background: var(--card);
  border: 1px solid var(--line);
  border-radius: var(--r);
  padding: 20px;
  position: relative; overflow-x: scroll;
  transition: background var(--trans), border-color var(--trans);
}
.panel::before {
  content:'';position:absolute;top:0;left:0;right:0;height:1px;
  background:linear-gradient(90deg,transparent,rgba(240,165,0,.25),transparent);
}
.sec-title {
  font-size:10px;letter-spacing:2.5px;text-transform:uppercase;
  color:var(--gold);font-weight:600;margin-bottom:10px;
  display:flex;align-items:center;gap:10px;
}
.sec-title::after{content:'';flex:1;height:1px;background:var(--line);}

/* ═══════════════════════════════════════════
   FILTER PILLS
═══════════════════════════════════════════ */
.filter-row { display:flex;gap:8px;margin-bottom:16px;flex-wrap:wrap; }
.fpill {
  background:transparent;border:1px solid var(--line2);color:var(--text2);
  font-size:11px;font-weight:600;padding:5px 16px;border-radius:20px;
  cursor:pointer;font-family:var(--font-b);letter-spacing:.5px;
  transition:all .25s;
}
.fpill.active { background:var(--gold);color:#000;border-color:var(--gold);box-shadow:0 0 14px rgba(240,165,0,.3); }
.fpill:not(.active):hover { border-color:var(--gold);color:var(--gold); }

/* ═══════════════════════════════════════════
   ORDER TABLE
═══════════════════════════════════════════ */
.tbl-wrap { overflow-x:auto; }
.otbl { width:100%;border-collapse:collapse;font-size:12px;min-width:640px; }
.otbl th {
  text-align:left;font-size:10px;letter-spacing:1.5px;text-transform:uppercase;
  color:var(--text3);padding:0 10px 12px;font-weight:500;
  border-bottom:1px solid var(--line);
}
.otbl td { padding:11px 10px;border-bottom:1px solid var(--line);vertical-align:middle; }
.otbl tbody tr { cursor:pointer;transition:background .18s; }
.otbl tbody tr:hover td { background:rgba(240,165,0,.04); }
.otbl tbody tr.sel td { background:rgba(240,165,0,.09); }
.otbl tbody tr:last-child td { border-bottom:none; }
.order-no { font-weight:700;color:var(--gold);font-size:13px; }
.buyer-nm { font-weight:600;color:var(--text); }
.style-nm { color:var(--text2); }
.merch-ch {
  font-size:10px;background:rgba(128,128,128,.08);
  border:1px solid var(--line);padding:2px 8px;border-radius:4px;color:var(--text2);
}
.ship-dt { font-size:11px;color:var(--text3); }
.pill {
  display:inline-flex;align-items:center;gap:5px;
  font-size:10px;font-weight:700;letter-spacing:.8px;text-transform:uppercase;
  padding:3px 10px;border-radius:20px;
}
.pill-delayed{background:rgba(255,78,78,.15);color:var(--red2);border:1px solid rgba(255,78,78,.3);}
.pill-ontime {background:rgba(0,196,140,.15);color:var(--teal2);border:1px solid rgba(0,196,140,.3);}
.pill-running{background:rgba(59,158,255,.15);color:var(--blue2);border:1px solid rgba(59,158,255,.3);}
.pill-dot{width:5px;height:5px;border-radius:50%;}
.pd-delayed{background:var(--red);animation:blinkDot 2s ease-in-out infinite;}
.pd-ontime {background:var(--teal);}
.pd-running{background:var(--blue);animation:blinkDot 1.5s ease-in-out infinite;}

.stage-tag {
  display:inline-block;font-size:10px;font-weight:700;letter-spacing:.5px;
  text-transform:uppercase;padding:3px 10px;border-radius:6px;cursor:pointer;
  background:rgba(255,78,78,.1);color:var(--red2);border:1px solid rgba(255,78,78,.35);
  transition:all .2s;position:relative;overflow:hidden;
}
.stage-tag::after {
  content:'';position:absolute;inset:0;
  background:rgba(255,78,78,.15);transform:translateX(-100%);transition:transform .3s;
}
.stage-tag:hover::after { transform:translateX(0); }
.stage-tag:hover { box-shadow:0 0 10px rgba(255,78,78,.25); }

/* ═══════════════════════════════════════════
   DETAIL PANEL
═══════════════════════════════════════════ */
.detail-panel {
  background:var(--card);border:1px solid var(--line);border-radius:var(--r);
  padding:20px;margin-top:16px;
  display:none;
  transition:background var(--trans);
}
.detail-panel.show {
  display:block;
  animation:panelIn .4s cubic-bezier(.22,1,.36,1) both;
}

/* DETAIL PROCESS CSS */

.del-detail-box{
  flex: 1 1 auto;
  display:grid;
  grid-template-columns:70% 30%;
  /* border:1px solid grey; */
  gap:15px;
  justify-content:start;
  justify-items:flex-start;
  box-sizing:border-box;
}

.del-desc-box{
  flex: 1 1 auto;
  /* border:1px solid blue; */
  /* border-right:1px solid whitesmoke; */
}


#proc-table{
  min-width:0px;
}

#proc-table tbody tr td{
  font-size:10px;
  text-align:center;
  padding:9px;
  
}
#proc-table tbody tr th{
  text-align:center;
}


/* MERCH FILTER CHANGES */

#merch_filter_btn{
  flex: 1 1 auto;
  display:flex;
  justify-content:center;
  padding:0;
  gap:10px;
}

#merch_voice_btn:active{
  transform:scale(0.95);
  opacity:0.7;
}

#merchfbtn, #merchfreset{
  padding:4px 10px;
  border:1px solid var(--line);
  border-radius:5px;
  color:white;
  font-family:var(--font-b);
  font-size:12px;
  background:var(--teal);
  transition:all .25s;
  cursor:pointer;
}

#merchfbtn:active, #merchfreset:active{
  transform:scale(0.95);
  opacity:0.8;
}

#merchfreset{
  background:grey;
}

#merchfilt_box{
  flex: 1 1 auto;
  display:flex;
  flex-direction:row;
  justify-content:center;
  align-items:center;
  gap:10px;
}

#merchfinput{
  max-width:140px;
  border-radius:8px;
  border:1px solid lightgrey;
  padding:3px 5px;
  outline:none;
  transition: all .25s;
  font-size:12px;
}













@keyframes panelIn{from{opacity:0;transform:translateY(12px);}to{opacity:1;transform:none;}}
.dp-hdr { display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:16px; }
.dp-no { font-family:var(--font-h);font-size:26px;letter-spacing:2px;color:var(--gold); }
.dp-buyer { font-size:12px;color:var(--text2);margin-top:2px; }
.close-x {
  background:none;border:1px solid var(--line2);color:var(--text3);
  width:28px;height:28px;border-radius:8px;cursor:pointer;
  font-size:13px;display:flex;align-items:center;justify-content:center;
  transition:all .2s;flex-shrink:0;
}
.close-x:hover { background:rgba(255,78,78,.2);color:var(--red2);border-color:rgba(255,78,78,.4); }
.dp-meta { display:grid;grid-template-columns:repeat(4,1fr);gap:8px;margin-bottom:16px; }
.meta-box { background:var(--bg3);border-radius:8px;padding:10px 12px;border:1px solid var(--line);transition:background var(--trans); }
.meta-lbl { font-size:9px;letter-spacing:1.5px;text-transform:uppercase;color:var(--text3);margin-bottom:4px; }
.meta-val { font-size:13px;font-weight:600;color:var(--text); }
.prog-head { display:flex;justify-content:space-between;font-size:11px;color:var(--text2);margin-bottom:8px; }
.prog-track { height:8px;background:rgba(128,128,128,.1);border-radius:4px;overflow:hidden;position:relative; }
.prog-fill {
  height:100%;border-radius:4px;
  background:linear-gradient(90deg,var(--gold3),var(--gold),var(--gold2));
  transition:width 1.2s cubic-bezier(.22,1,.36,1);
  position:relative;
}
.prog-fill::after {
  content:'';position:absolute;right:0;top:0;bottom:0;width:24px;
  background:rgba(255,255,255,.45);filter:blur(8px);
  animation:shimmer 2s ease-in-out infinite;
}
@keyframes shimmer{0%,100%{opacity:0;}50%{opacity:1;};}

/* TNA timeline */
.tna-wrap { display:flex; flex-direction:column; gap:25px;overflow-x:auto;padding-bottom:8px; padding-left:30px; margin-top:20px; }
.tna-node {
  display:flex;flex-direction:row; gap:8px; align-items:flex-start;
  position:relative;
  flex:1;min-width:68px;
  animation:nodeIn .5s ease both;
}
@keyframes nodeIn{from{opacity:0;transform:scale(.7);}to{opacity:1;transform:scale(1);}}
.tna-node:not(:last-child)::after {
  content:'';position:absolute;top:100%;left:11.5px;
  height:100%; width:2px; background:rgba(128,128,128,.12);z-index:0;
}
.tna-node.done:not(:last-child)::after { background:var(--teal);opacity:.35; }
.tna-node.delay:not(:last-child)::after { background:var(--red);opacity:.4; }
.tna-dot {
  width:28px;height:28px;border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  font-size:10px;font-weight:700;z-index:1;
  border:2px solid rgba(128,128,128,.15);
  transition:all .3s;
}
.tna-node.done .tna-dot {
  background:#13c693c4;border-color:var(--teal);color:#ffffff;
  box-shadow:0 0 10px rgba(0,196,140,.3);
}
.tna-node.delay .tna-dot {
  background:#ff4343a8;border-color:var(--red);color:#ffffff;
  animation:delayPulse 1.6s ease-in-out infinite;
}
@keyframes delayPulse{0%,100%{box-shadow:0 0 8px rgba(255,78,78,.3);}50%{box-shadow:0 0 22px rgba(255,78,78,.65);};}
.tna-node.pending .tna-dot { background:rgba(128,128,128,.06);border-color:rgba(128,128,128,.15);color:var(--text3); }
.tna-lbl { font-size:8px;text-align:center;margin-top:6px;color:var(--text3);letter-spacing:.5px;line-height:1.3; }
.tna-node.done .tna-lbl { color:var(--teal); }
.tna-node.delay .tna-lbl { color:var(--red2); }

/* ═══════════════════════════════════════════
   DELAY PANEL
═══════════════════════════════════════════ */
.delay-panel {
  background:var(--card);border:1px solid rgba(255,78,78,.2);border-radius:var(--r);
  padding:20px;margin-top:16px;display:none;position:relative;
  transition:background var(--trans);
}
.delay-panel::before {
  content:'';position:absolute;top:0;left:0;right:0;height:1px;
  background:linear-gradient(90deg,transparent,rgba(255,78,78,.5),transparent);
}
.delay-panel.show {
  display:block;
  animation:panelIn .4s cubic-bezier(.22,1,.36,1) both;
}
.dp2-hdr { display:flex;align-items:center;justify-content:space-between;margin-bottom:14px; }
.dp2-title { font-family:var(--font-h);font-size:20px;letter-spacing:2px;color:var(--red2); }
.dp2-ref { font-size:10px;color:var(--text3);margin-top:2px; }
.delay-stage-pill {
  font-size:10px;font-weight:700;letter-spacing:1px;text-transform:uppercase;
  padding:4px 12px;border-radius:20px;
  background:rgba(255,78,78,.15);color:var(--red2);border:1px solid rgba(255,78,78,.4);
}
.delay-item {
  background:var(--bg3);border:1px solid var(--line);border-radius:8px;
  padding:14px;margin-bottom:10px;
  animation:fadeUp .4s ease both;
  transition:border-color .25s,background var(--trans);
}
.delay-item:last-child { margin-bottom:0; }
.delay-item:hover { border-color:rgba(255,78,78,.3); }
.di-hdr { display:flex;justify-content:space-between;align-items:center;margin-bottom:10px; }
.di-action { font-size:13px;font-weight:600;color:var(--text); }
.di-days { font-family:var(--font-h);font-size:18px;color:var(--red);letter-spacing:1px; }
.tl-wrap { display:flex;align-items:center;margin-bottom:10px; }
.tl-plan { height:5px;border-radius:2px 0 0 2px;background:var(--blue);opacity:.5; }
.tl-gap {
  height:5px;border-radius:0 2px 2px 0;background:var(--red);
  position:relative;overflow:hidden;
}
.tl-gap::after {
  content:'';position:absolute;inset:0;
  background:linear-gradient(90deg,transparent,rgba(255,255,255,.45),transparent);
  animation:scanline 1.6s ease-in-out infinite;
}
@keyframes scanline{from{transform:translateX(-100%);}to{transform:translateX(100%)};}
.di-dates { display:flex;gap:16px;margin-bottom:10px; }
.di-date { display:flex;flex-direction:column;gap:2px; }
.di-date-lbl { font-size:9px;letter-spacing:1.5px;text-transform:uppercase;color:var(--text3); }
.di-date-val { font-size:12px;font-weight:600; }
.plan-c { color:var(--blue2); }
.actual-c { color:var(--red2); }
.gap-c { color:var(--gold); }
.di-reason {
  font-size:11px;color:var(--text2);
  background:rgba(255,78,78,.05);
  border-left:2px solid rgba(255,78,78,.5);
  padding:7px 10px;border-radius:0 6px 6px 0;line-height:1.6;
}

/* ═══════════════════════════════════════════
   RIGHT COLUMN PANELS
═══════════════════════════════════════════ */
.right-col { display:flex;flex-direction:column;gap:16px; }

/* Merch */
.merch-item {
  display:flex;align-items:center;gap:12px;
  padding:9px 8px;border-radius:8px;cursor:pointer;
  transition:background .2s,transform .2s;
  animation:fadeUp .5s ease both;
}
.merch-item:hover { background:rgba(240,165,0,.06);transform:translateX(4px); }
.m-av {
  width:34px;height:34px;border-radius:10px;
  display:flex;align-items:center;justify-content:center;
  font-family:var(--font-h);font-size:13px;font-weight:700;flex-shrink:0;
  letter-spacing:.5px;transition:box-shadow .3s;
}
.merch-item:hover .m-av { box-shadow:0 0 12px currentColor; }
.m-body { flex:1;min-width:0; }
.m-name { font-size:13px;font-weight:600;color:var(--text); }
.m-meta { font-size:10px;color:var(--text3);margin-top:2px; }
.m-delayed { color:var(--red2); }
.m-right { display:flex;flex-direction:column;align-items:flex-end;gap:4px;width:70px; }
.m-bar-bg { width:70px;height:4px;background:rgba(128,128,128,.1);border-radius:2px;overflow:hidden; }
.m-bar-fg { height:100%;border-radius:2px;transition:width 1.2s cubic-bezier(.22,1,.36,1); }
.m-pct { font-size:10px;color:var(--text3); }

/* Chart */
.bar-row { display:flex;align-items:flex-end;gap:6px;height:80px;padding-top:8px; }
.bar-col { flex:1;display:flex;flex-direction:column;align-items:center;gap:4px; }
.bar-body {
  width:100%;border-radius:4px 4px 0 0;
  min-height:4px;transition:height .8s cubic-bezier(.22,1,.36,1);
}
.bar-lbl { font-size:9px;color:var(--text3);text-align:center; }

/* Heatmap */
.hm-row { display:flex;align-items:center;gap:10px;margin-bottom:9px; }
.hm-label { font-size:11px;color:var(--text2);width:76px;flex-shrink:0; }
.hm-track { flex:1;height:6px;background:rgba(128,128,128,.08);border-radius:3px;overflow:hidden; }
.hm-fill { height:100%;border-radius:3px;transition:width 1.1s ease; }
.hm-val { font-size:10px;color:var(--red2);width:36px;text-align:right;font-weight:600; }

/* ═══════════════════════════════════════════
   NOTIFICATION TOAST
═══════════════════════════════════════════ */
.toast {
  position:fixed;bottom:24px;right:24px;z-index:999;
  background:var(--bg4);border:1px solid var(--line2);border-radius:12px;
  padding:12px 18px;font-size:12px;color:var(--text);
  box-shadow:0 8px 30px rgba(0,0,0,.35);
  transform:translateY(80px) scale(.95);opacity:0;
  transition:all .4s cubic-bezier(.22,1,.36,1);
  display:flex;align-items:center;gap:10px;max-width:300px;
}
.toast.show { transform:none;opacity:1; }
.toast-dot { width:8px;height:8px;border-radius:50%;flex-shrink:0; }

/* ═══════════════════════════════════════════
   ANIMATIONS
═══════════════════════════════════════════ */
@keyframes fadeUp{from{opacity:0;transform:translateY(14px);}to{opacity:1;transform:none;}}
@keyframes slideRight{from{opacity:0;transform:translateX(-10px);}to{opacity:1;transform:none;}}

/* ═══════════════════════════════════════════
   SCROLLBAR
═══════════════════════════════════════════ */
::-webkit-scrollbar{width:5px;height:5px;}
::-webkit-scrollbar-track{background:transparent;}
::-webkit-scrollbar-thumb{background:rgba(128,128,128,.18);border-radius:3px;}
::-webkit-scrollbar-thumb:hover{background:rgba(128,128,128,.35);}

/* ═══════════════════════════════════════════
   RESPONSIVE
═══════════════════════════════════════════ */
@media(max-width:1200px){
  .dash-grid{grid-template-columns:1fr;}
  .right-col{display:grid;grid-template-columns:repeat(3,1fr);}
}
@media(max-width:900px){
  .sidebar{transform:translateX(-100%);}
  .sidebar.mobile-open{transform:none;}
  .main-wrap{margin-left:0 !important;}
  .right-col{display:flex;flex-direction:column;}
  .kpi-row{grid-template-columns:repeat(2,1fr);}
  .dp-meta{grid-template-columns:repeat(2,1fr);}
  .top-search{display:none;}
}
@media(max-width:600px){
  .kpi-row{grid-template-columns:1fr 1fr;}
  .content{padding:14px;}
  .live-wrap{display:none;}
  .user-name,.user-role{display:none;}
}
@media(max-width:400px){
  .kpi-row{grid-template-columns:1fr;}
}
</style>
</head>
<body>

<!-- <?php echo '<pre>'; print_r($merch);?> -->

<!-- BG -->
<div class="bg-canvas">
  <div class="grid-lines"></div>
  <div class="bg-orb"></div>
  <div class="bg-orb"></div>
  <div class="bg-orb"></div>
</div>

<!-- TOAST -->
<div id="toast" class="toast">
  <div class="toast-dot" id="toastDot"></div>
  <span id="toastMsg"></span>
</div>

<!-- NAV OVERLAY (mobile) -->
<div class="nav-overlay" id="navOverlay" onclick="closeMobileNav()"></div>

<!-- SHELL -->
<div class="shell">

  <!-- ═══ SIDEBAR ═══ -->
  <aside class="sidebar" id="sidebar">
    <!-- Logo --> 
    <div class="nav-logo">
      <div><img src="<?php echo base_url()?>assets/images/crlogo3.png" width='30' height="25" alt=""></div>
      <div class="logo-text">
        <div class="logo-title">CR Garments <span></span></div>
        <div class="logo-sub">Production Control</div>
      </div>
    </div>

    <!-- Main Nav -->
    <div class="nav-section">
      <div class="nav-section-label">Main</div>
      <div class="nav-item active" onclick="notify('Dashboard','#f0a500')">
        <div class="nav-icon">◈</div>
        <span class="nav-label">Dashboard</span>
        <div class="nav-tip">Dashboard</div>
      </div>
      <div class="nav-item" onclick="notify('Orders module coming soon','#3b9eff')">
        <div class="nav-icon">◻</div>
        <span class="nav-label">Orders</span>
        <span class="nav-badge">12</span>
        <div class="nav-tip">Orders</div>
      </div>
      <div class="nav-item" onclick="notify('TNA Tracker coming soon','#00c48c')">
        <div class="nav-icon">◷</div>
        <span class="nav-label">TNA Tracker</span>
        <div class="nav-tip">TNA Tracker</div>
      </div>
      <div class="nav-item" onclick="notify('Delays module coming soon','#ff4e4e')">
        <div class="nav-icon">⚠</div>
        <span class="nav-label">Delays</span>
        <span class="nav-badge">5</span>
        <div class="nav-tip">Delays</div>
      </div>
    </div>

    <div class="nav-section">
      <div class="nav-section-label">Reports</div>
      <div class="nav-item" onclick="notify('Buyer Reports coming soon','#9b6dff')">
        <div class="nav-icon">◑</div>
        <span class="nav-label">Buyer Reports</span>
        <div class="nav-tip">Buyer Reports</div>
      </div>
      <div class="nav-item" onclick="notify('Merch Summary coming soon','#f0a500')">
        <div class="nav-icon">◐</div>
        <span class="nav-label">Merch Summary</span>
        <div class="nav-tip">Merch Summary</div>
      </div>
      <div class="nav-item" onclick="notify('Analytics coming soon','#00c48c')">
        <div class="nav-icon">◉</div>
        <span class="nav-label">Analytics</span>
        <div class="nav-tip">Analytics</div>
      </div>
    </div>

    <div class="nav-section">
      <div class="nav-section-label">Config</div>
      <div class="nav-item" onclick="openSettings()">
        <div class="nav-icon">⚙</div>
        <span class="nav-label">Settings</span>
        <div class="nav-tip">Settings</div>
      </div>
    </div>

    <!-- Footer: collapse toggle -->
    <div class="nav-footer">
      <button class="nav-toggle" id="navToggle" onclick="toggleSidebar()">
        <div class="nav-icon">◁</div>
        <span class="nav-label">Collapse</span>
      </button>
    </div>
  </aside>

  <!-- ═══ MAIN WRAP ═══ -->
  <div class="main-wrap" id="mainWrap">

    <!-- TOP BAR -->
    <header class="topbar">
      <!-- Hamburger -->
      <button class="hamburger" id="hamburger" onclick="toggleMobileNav()">
        <div class="ham-line"></div>
        <div class="ham-line"></div>
        <div class="ham-line"></div>
      </button>

      <!-- Breadcrumb -->
      <div class="breadcrumb">
        <span>Home</span>
        <span class="breadcrumb-sep">›</span>
        <span class="breadcrumb-cur">TNA Dashboard</span>
      </div>


      <!-- FILTER BOX -->
       <div class="filter-box">

        <div class="seasonf">
            
          <div id="seasonbtn">
            <span>Season</span>
            <img width="10" height="8" src="<?php echo base_url()?>assets/images/down-arrow.png" alt="">
          </div>

            <div id='season-opt' class="season-opt">

              <div class="seas_search">
                <input type="text" id="seas_searchbox">
              </div>

              <div class="season-opt-itm">
                  <label for="sitm_all" style="font-weight:bold;">All</label>
                  <input type="checkbox" name="seasons[]" id="sitm_all" value="all">
              </div>
      
              <?php foreach($seasons as $idx => $season){?>
                <div class="season-opt-itm">
                  <label for="sitm<?=$idx?>"><?=$season['SEASON']?></label>
                  <input type="checkbox" name="seasons[]" id="sitm<?=$idx?>" value="<?= $season['SEASON']?>">
                </div>
              <?php }?>

              <div class="seas_footer">
                <button id="seas_clear" type="button">Clear</button>
                <button id="seas_apply" type="button">Apply</button>
              </div>

            </div>

        </div>  

        <div class="buyerf">

          <div id="buyerbtn">
            <span>Buyer</span>
            <img width="10" height="8" src="<?php echo base_url()?>assets/images/down-arrow.png" alt="">
          </div>

          <div id="buyer-opt" class="buyer-opt">

              <div class="buy_search">
                <input type="text" id="buy_searchbox">
              </div>

              <div class="buyer-opt-itm">
                  <label for="bitm_all" style="font-weight:bold;">All</label>
                  <input type="checkbox" checked name="buyers[]" id="bitm_all" value="all">
              </div>
      
              <?php foreach($buyers as $idx1 => $buyer){?>
                <div class="buyer-opt-itm">
                  <label for="bitm<?=$idx1?>"><?=$buyer['BUYERNAME']?></label>
                  <input type="checkbox" name="buyers[]" id="bitm<?=$idx1?>" value="<?= $buyer['BUYERNAME']?>">
                </div>
              <?php }?>

              <div class="buy_footer">
                <button id="buy_clear" type="button">Clear</button>
                <button id="buy_apply" type="button">Apply</button>
              </div>

            </div>

        </div>

        <div class="companyf">

          <div id="companybtn">
            <span>Company</span>
            <img width="10" height="8" src="<?php echo base_url()?>assets/images/down-arrow.png" alt="">
          </div>

          <div id="company-opt" class="company-opt">

              <div class="comp_search">
                <input type="text" id="comp_searchbox">
              </div>

              <div class="company-opt-itm">
                  <label for="citm_all" style="font-weight:bold;">All</label>
                  <input type="checkbox" checked name="company[]" id="citm_all" value="all">
              </div>
      
              <?php foreach($company as $idx1 => $comp){?>
                <div class="company-opt-itm">
                  <label for="citm<?=$idx1?>"><?=$comp['COMPANYID']?></label>
                  <input type="checkbox" name="company[]" id="citm<?=$idx1?>" value="<?= $comp['COMPANYID']?>">
                </div>
              <?php }?>

              <div class="comp_footer">
                <button id="comp_clear" type="button">Clear</button>
                <button id="comp_apply" type="button">Apply</button>
              </div>

            </div>

        </div>

       </div>

      <!-- Search --> 
      <div class="top-search">
        <span class="search-icon">⌕</span>
        <input type="text" placeholder="Search orders, buyers…" id="searchInput" oninput="doSearch(this.value)">
      </div>

      <!-- Bell -->
      <button class="top-btn" onclick="notify('5 orders need attention','#ff4e4e')" title="Alerts">
        🔔
        <div class="notif-badge"></div>
      </button>

      <!-- Dark/Light Toggle -->
      <div class="theme-toggle" onclick="toggleTheme()" title="Toggle theme">
        <span class="toggle-icon" id="themeIcon">☀</span>
        <div class="toggle-track"><div class="toggle-thumb"></div></div>
      </div>

      <!-- Live time -->
      <div class="live-wrap">
        <div class="live-dot"></div>
        <div class="live-time" id="liveTime"></div>
      </div>

      <!-- User -->
      <div class="user-wrap">
        <button class="user-btn" id="userBtn" onclick="toggleDropdown()">
          <div class="user-av">ERP</div>
          <div>
            <div class="user-name">ERP</div>
            <!-- <div class="user-role">Prod Manager</div> -->
          </div>
          <span class="user-caret">▾</span>
        </button>
        <div class="user-dropdown" id="userDropdown">
          <div class="dd-header">
            <div class="dd-av-lg">MA</div>
            <div>
              <div class="dd-uname">Marshal Augustine A</div>
              <div class="dd-urole">Production Manager</div>
              <div class="dd-dept">Factory A · SS 2025</div>
            </div>
          </div>
          <div class="dd-body">
            <div class="dd-item" onclick="notify('Profile page coming soon','#3b9eff');closeDropdown()">
              <span class="dd-icon">◷</span> My Profile
            </div>
            <div class="dd-item" onclick="openSettings()">
              <span class="dd-icon">⚙</span> Settings
            </div>
            <div class="dd-item" onclick="notify('Notifications opened','#f0a500');closeDropdown()">
              <span class="dd-icon">🔔</span> Notifications
              <span style="margin-left:auto;background:var(--red);color:#fff;font-size:9px;padding:1px 6px;border-radius:10px;font-weight:700;">5</span>
            </div>
            <div class="dd-item" onclick="notify('Help & Support coming soon','#9b6dff');closeDropdown()">
              <span class="dd-icon">◉</span> Help & Support
            </div>
            <div class="dd-sep"></div>
            <div class="dd-item danger" onclick="notify('Logging out…','#ff4e4e');closeDropdown()">
              <span class="dd-icon">⎋</span> Sign Out
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- CONTENT -->
    <main class="content">

      <!-- KPI Row -->
      <div class="kpi-row">
        <div class="kpi kpi-total">
          <div class="kpi-glow"></div><div class="kpi-stripe"></div>
          <div class="kpi-label">Total Orders</div>
          <div class="kpi-num" id="kTotal">0</div>
          <div class="kpi-sub" id="merch_total"></div>
          <div class="kpi-bar"><div class="kpi-bar-fill" id="kb0" style="width:0"></div></div>
        </div>
        <div class="kpi kpi-ontime">
          <div class="kpi-glow"></div><div class="kpi-stripe"></div>
          <div class="kpi-label">On-Time Orders</div>
          <div class="kpi-num" id="kOntime">0</div>
          <div class="kpi-sub" id="kSub">– on-time rate</div>
          <div class="kpi-bar"><div class="kpi-bar-fill" id="kb3" style="width:0"></div></div>
        </div>
        <div class="kpi kpi-delayed">
          <div class="kpi-glow"></div><div class="kpi-stripe"></div>
          <div class="kpi-label">Delayed Orders</div>
          <div class="kpi-num" id="kDelayed">0</div>
          <div class="kpi-sub" id='delperc'></div>
          <div class="kpi-bar"><div class="kpi-bar-fill" id="kb2" style="width:0"></div></div>
        </div>
        <div class="kpi kpi-running">
          <div class="kpi-glow"></div><div class="kpi-stripe"></div>
          <div class="kpi-label">Running Orders</div>
          <div class="kpi-num" id="kRunning">0</div >
          <div class="kpi-sub" id="runperc"></div>
          <div class="kpi-bar"><div class="kpi-bar-fill" id="kb1" style="width:0"></div></div>
        </div>
      </div>

      <!-- Dashboard Grid -->
      <div class="dash-grid">

        <!-- LEFT -->
        <div>
          <!-- Orders Panel -->
          <div class="panel" style="animation:fadeUp .6s .15s ease both">
            <div class="sec-title">Order List</div>
            <div class="filter-row">
              <button class="fpill active" onclick="setFilter('all',this)">All Orders</button>
              <button class="fpill" onclick="setFilter('delayed',this)">Delayed</button>
              <button class="fpill" onclick="setFilter('ontime',this)">On Time</button>
              <button class="fpill" onclick="setFilter('running',this)">Running</button>
            </div>
            <div class="tbl-wrap">
              <table class="otbl">
                <thead>
                  <tr>
                    <th>Order No</th><th>Buyer</th><th>Season</th><th>Company</th><th>Merch</th>
                    <th>Qty</th><th>Ship Date</th><th>Status</th>
                  </tr>
                </thead>  
                <tbody id="tbody"></tbody>
              </table>
            </div>
          </div>

          <!-- Order Detail -->
          <div class="detail-panel" id="detailPanel">
            <div class="sec-title">Order Details</div>
            <div class="dp-hdr">
              <div>
                <div class="dp-no" id="dpNo"></div>
                <div class="dp-buyer" id="dpBuyer"></div>
              </div>
              <button class="close-x" onclick="closeDetail()">✕</button>
            </div>
            <div class="dp-meta" id="dpMeta"></div>
            <div>
              <div class="prog-head"><span>Production Progress</span><span id="dpPct" style="color:var(--gold);font-weight:600;"></span></div>
              <div class="prog-track"><div class="prog-fill" id="dpFill" style="width:0"></div></div>
            </div>


            <div class="del-detail-box" style="margin-top:25px;">

              <div class="del-desc-box">
                <h5 class="sec-title">Process Details</h5>

                <div class="proc-box">
                    <table id="proc-table" class="otbl">
                      <thead>
                        <tr>
                          <th>Process Name</th>
                          <th>Plan EDt</th>
                          <th>Actual EDt</th>
                          <th>Comp Perc</th>
                          <th>Status</th>
                        </tr>
                      </thead>

                      <tbody>
                      </tbody>

                    </table>

                </div>

              </div>

              <div class="del-timeline">
                <h5 class="sec-title">TNA Stage Timeline</h5>

                <!-- <div class="sec-title" style="margin-top:18px;">TNA Stage Timeline</div> -->
                <div class="tna-wrap" id="tnaWrap"></div>

              </div>

            </div>

          </div>


          <!-- Delay Panel -->
          <div class="delay-panel" id="delayPanel">
            <div class="sec-title">Delay Analysis</div>
            <div class="dp2-hdr">
              <div>
                <div class="dp2-title">Delay Details</div>
                <div class="dp2-ref" id="dp2Ref"></div>
              </div>
              <div style="display:flex;flex-direction:column;align-items:flex-end;gap:8px;">
                <div class="delay-stage-pill" id="dp2Stage"></div>
                <button class="close-x" onclick="closeDelay()">✕</button>
              </div>
            </div>
            <div id="delayItems"></div>
          </div>
        </div>

        <!-- RIGHT -->
        <div class="right-col">

          <!-- Merch -->
          <div class="panel" style="animation:fadeUp .6s .25s ease both">
            <div class="sec-title">Merch Groups <span id="merchfilt_box"><input id="merchfinput" type="text" ><img style="transition:all .25s;" id="merch_voice_btn" src="<?php echo base_url()?>assets/images/mic.png" width="15" height="15" alt=""></span></div>
            <div id='merch_filter_btn' class="merch_filter_btn"><button id="merchfbtn" type='button'>Filter</button><button id='merchfreset' type='button'>Reset</button></div>
            <div id="merchWrap"></div>  
          </div>

          <!-- Chart -->
          <div class="panel" style="animation:fadeUp .6s .35s ease both">
            <div class="sec-title">Status by Buyer</div>
            <div style="display:flex;flex-wrap:wrap;gap:10px;margin-bottom:10px;" id="chartLeg"></div>
            <div class="bar-row" id="chartBars"></div>
          </div>

          <!-- Heatmap -->  
          <!-- <div class="panel" style="animation:fadeUp .6s .45s ease both">
            <div class="sec-title">Delay Stage Heatmap</div>
            <div id="heatWrap"></div>
          </div> -->

        </div>
      </div>
    </main>
  </div><!-- /main-wrap -->
</div><!-- /shell -->

<script>
/* ──────────────────────────────────────────
   DATA
────────────────────────────────────────── */
// for get initials from name
function get_initials(name){
  let parts = name.trim().split(".");  
  return parts.length > 1 ? parts[0][0]+parts[1] : parts[0][0];
}

// for change date format
function dtformat(dt){
  let date = new Date(dt);
  return date.toLocaleDateString('en-GB');
}

// console.log(get_initials('RAKKIYAPPAN.S'));



let orders_json = <?php echo json_encode($orders)?>;

let ORDERS = [];
let MERCH = [];
let TNA = [];
// let TNA = ["REQUIRMENT", "PRE COSTING", "TRIMS PURCHASE", "YARN PURCHASE", "DYEING SEND", "DYEING RECIEVED", "PP SAMPLE", "PRINTING SENT", "PRINTING RECIEVED"];

function getOrders(seas, buy, comp, merch){
  
  console.log(seas, buy, comp, merch);

  ORDERS = [];
  MERCH = [];
  TNA = [];

  ORDERS = orders_json.filter(ol => 
  (seas.includes('all') || seas.includes(ol.SEASON)) &&
   (buy.includes('all') || buy.includes(ol.BUYERNAME.trim().toLowerCase())) && 
   (comp.includes('all') || comp.includes(ol.COMPANYID.trim().toLowerCase()))&&
   (merch.includes('all')|| merch.includes(ol.MERCH))
  )

  const uniqmerch = [...new Set(ORDERS.map(ol => ol.MERCH))]

  // console.log(uniqmerch);

  MERCH = uniqmerch.map(um => ({
    name : um?um:'No Name',
    initials : um?get_initials(um):null,
    color : '#3b9eff',
    orders : ORDERS.filter(ol => ol.MERCH === um).length,
    delayed : ORDERS.filter(ol => ol.MERCH === um && ol.STATUS ==='delayed').length
  }));


  console.log(ORDERS);
  console.log(MERCH);


  /* ── INIT ── */
  initKPIs();
  renderOrders();
  renderMerch();
  renderChart();
  // renderHeat();

}


let seasons = <?php echo json_encode($seasons)?>;
let buyers = <?php echo json_encode($buyers)?>;
let company = <?php echo json_encode($company)?>;

seasons = [...seasons.map(s=>s.SEASON)];
buyers = [...buyers.map(b=>b.BUYERNAME)];
company = [...company.map(c=>c.COMPANYID)];


// const ORDERS=[
//   {id:'PO-2501',buyer:'H&M', season:'MS-25', style:'Woven Shirt',merch:'Sarah K',qty:3200,ship:'2025-04-10',status:'delayed',progress:55,delayStage:'Cutting',

//    dd:[
//       {action:'Fabric In-house',plan:'2025-03-05',actual:'2025-03-14',reason:'Supplier delayed fabric delivery due to port congestion at Colombo.',days:9},

//       {action:'Cutting Start',plan:'2025-03-06',actual:'2025-03-16',reason:'Line not allocated — awaiting fabric arrival from supplier.',days:10}
//       ]
//   },

//   {id:'PO-2502',buyer:'Zara',season:'MS-25',style:'Jersey Dress',merch:'Mike T',qty:1800,ship:'2025-04-15',status:'ontime',progress:72,delayStage:null,dd:[]},
//   {id:'PO-2503',buyer:'M&S',season:'MS-25',style:'Chino Trouser',merch:'Priya R',qty:2500,ship:'2025-04-20',status:'running',progress:40,delayStage:null,dd:[]},
//   {id:'PO-2504',buyer:'Next',season:'MS-25',style:'Polo Tee',merch:'Sarah K',qty:4000,ship:'2025-04-08',status:'delayed',progress:65,delayStage:'Sewing',
//    dd:[{action:'Sewing Start',plan:'2025-03-10',actual:'2025-03-18',reason:'Power outage — 3-day production halt; no backup generator available.',days:8},
//        {action:'Inline QC',plan:'2025-03-20',actual:'2025-03-28',reason:'High defect rate (15%) required full rework of seam allowances.',days:8}]},
//   {id:'PO-2505',buyer:'ASOS',season:'MS-25',style:'Linen Blazer',merch:'James O',qty:900,ship:'2025-05-01',status:'ontime',progress:30,delayStage:null,dd:[]},
//   {id:'PO-2506',buyer:'GAP',season:'MS-25',style:'Denim Jacket',merch:'Lena V',qty:1500,ship:'2025-04-25',status:'delayed',progress:48,delayStage:'Finishing',
//    dd:[{action:'Washing',plan:'2025-03-22',actual:'2025-03-29',reason:'Wash machine breakdown — process outsourced causing schedule slip.',days:7},
//        {action:'Finishing',plan:'2025-03-25',actual:'2025-04-02',reason:'Outsourced wash return delayed; pressing line was not ready.',days:8}]},
//   {id:'PO-2507',buyer:'H&M',season:'MS-25',style:'Knit Sweater',merch:'Sarah K',qty:2200,ship:'2025-04-30',status:'running',progress:25,delayStage:null,dd:[]},
//   {id:'PO-2508',buyer:'Primark',season:'MS-25',style:'Casual Shorts',merch:'Raj M',qty:5000,ship:'2025-04-12',status:'ontime',progress:80,delayStage:null,dd:[]},
//   {id:'PO-2509',buyer:'Zara',season:'MS-25',style:'Maxi Skirt',merch:'Mike T',qty:1200,ship:'2025-04-18',status:'delayed',progress:35,delayStage:'PP Sample',
//    dd:[{action:'PP Sample Submission',plan:'2025-03-01',actual:'2025-03-12',reason:'Buyer requested 3 rounds of colour corrections on fabric shade.',days:11},
//        {action:'PP Approval',plan:'2025-03-03',actual:'2025-03-15',reason:'Approval delayed pending buyer internal QA review board.',days:12}]},
//   {id:'PO-2510',buyer:'C&A',season:'MS-25',style:'Fleece Jacket',merch:'Lena V',qty:800,ship:'2025-05-05',status:'running',progress:15,delayStage:null,dd:[]},
//   {id:'PO-2511',buyer:'Primark',season:'MS-25',style:'Hoodie Fleece',merch:'Raj M',qty:3600,ship:'2025-04-22',status:'ontime',progress:60,delayStage:null,dd:[]},
//   {id:'PO-2512',buyer:'M&S',season:'MS-25',style:'Oxford Shirt',merch:'Priya R',qty:2100,ship:'2025-04-28',status:'delayed',progress:42,delayStage:'Final QC',
//    dd:[{action:'Final QC',plan:'2025-04-01',actual:'2025-04-08',reason:'Multiple shade variation issues found — fabric lot retest required.',days:7}]},
// ];

// const MERCH=[
//   {name:'Sarah K',initials:'SK',color:'#3b9eff',orders:3,delayed:1},
//   {name:'Mike T', initials:'MT',color:'#00c48c',orders:2,delayed:1},
//   {name:'Priya R',initials:'PR',color:'#f0a500',orders:2,delayed:1},
//   {name:'James O',initials:'JO',color:'#9b6dff',orders:1,delayed:0},
//   {name:'Lena V', initials:'LV',color:'#ff4e4e',orders:2,delayed:1},
//   {name:'Raj M',  initials:'RM',color:'#00e6a5',orders:2,delayed:0},
// ];

// const TNA=['Fabric Ord','Fabric In','PP Sample','PP Apprvl','Cutting','Sewing','Inline QC','Washing','Finishing','Final QC','Ex-Factory'];

let activeFilter='all', selOrder=null, navCollapsed=false, mobileNavOpen=false;

/* ── Clock ── */
function tick(){
  const n=new Date();
  document.getElementById('liveTime').textContent=
    n.toLocaleTimeString('en-GB',{hour:'2-digit',minute:'2-digit',second:'2-digit', hour12:true});
}
setInterval(tick,1000); tick();

/* ── CountUp ── */
function countUp(el,target,dur=500){
  let v=0,step=target/Math.ceil(dur/16);
  const t=setInterval(()=>{v=Math.min(v+step,target);el.textContent=Math.round(v);if(v>=target)clearInterval(t);},16);
}

/* ── KPI init ── */
function initKPIs(){
  const total=ORDERS.length;
  const delayed=ORDERS.filter(o=>o.STATUS==='delayed').length;
  const ontime=ORDERS.filter(o=>o.STATUS==='ontime').length;
  const running=ORDERS.filter(o=>o.STATUS==='running').length;
  setTimeout(()=>countUp(document.getElementById('kTotal'),total),200);
  setTimeout(()=>countUp(document.getElementById('kRunning'),running),300);
  setTimeout(()=>countUp(document.getElementById('kDelayed'),delayed),400);
  setTimeout(()=>countUp(document.getElementById('kOntime'),ontime),500);
  document.getElementById('merch_total').textContent = `Across ${MERCH.length} Merch Groups`;
  document.getElementById('kSub').textContent=Math.round(ontime/total*100)+'% on-time rate';
  document.getElementById('delperc').textContent=Math.round(delayed/total*100)+'% delayed rate';
  document.getElementById('runperc').textContent=Math.round(running/total*100)+'% runnning rate';


  
  setTimeout(()=>{
    document.getElementById('kb0').style.width='100%';
    document.getElementById('kb1').style.width=(running/total*100)+'%';
    document.getElementById('kb2').style.width=(delayed/total*100)+'%';
    document.getElementById('kb3').style.width=(ontime/total*100)+'%';
  },500);
}

/* ── Render orders ── */
function renderOrders(list){
  const data=list||(activeFilter==='all'?ORDERS:ORDERS.filter(o=>o.STATUS===activeFilter));
  const tbody=document.getElementById('tbody');
  if(!data.length){
    tbody.innerHTML=`<tr><td colspan="9" style="text-align:center;padding:32px;color:var(--text3);font-size:13px;">No orders found</td></tr>`;
    return;
  }
  tbody.innerHTML=data.map((o,i)=>`
    <tr class="${selOrder===o.PONO?'sel':''}" onclick="selOrderFn('${o.PONO}')" style="animation:slideRight .3s ${i*.03}s ease both">
      <td><span class="order-no ">${o.PONO}</span></td>
      <td><span class="buyer-nm">${o.BUYERNAME}</span></td>
      <td><span class="style-nm">${o.SEASON}</span></td>
      <td><span class="style-nm">${o.COMPANYID? o.COMPANYID : '-'}</span></td>
      <td><span class="merch-ch">${o.MERCH? o.MERCH : '-'}</span></td>
      <td style="font-weight:600;color:var(--text); text-align:right;">${o.QTY.toLocaleString()}</td>
      <td><span class="ship-dt">${o.SHIPDT? o.SHIPDT :  '-'}</span></td>
      <td><span class="pill pill-${o.STATUS}"><span class="pill-dot pd-${o.STATUS}"></span>${o.STATUS}</span></td>
    </tr>`).join('');
}

function setFilter(f,btn){

  activeFilter=f;
  document.querySelectorAll('.fpill').forEach(b=>b.classList.remove('active'));
  btn.classList.add('active');
  renderOrders();
}

function doSearch(q){
  q=q.trim().toLowerCase();
  console.log(q);

  if(!q){renderOrders();return;}
  const filtered=ORDERS.filter(o=>
    o.PONO.toLowerCase().includes(q)||
    o.BUYERNAME.toLowerCase().includes(q)||
    o.COMPANYID.toLowerCase().includes(q)||
    o.MERCH.toLowerCase().includes(q)
  );
  renderOrders(filtered);   
}


/* ── Select order ── */
async function selOrderFn(id){
  selOrder=id;
  renderOrders();
  const o=ORDERS.find(x=>x.PONO===id);
  console.log(o);
  const panel=document.getElementById('detailPanel');
  document.getElementById('dpNo').textContent=o.PONO;
  document.getElementById('dpBuyer').textContent=`${o.BUYERNAME} · ${o.QTY.toLocaleString()} pcs`;
  document.getElementById('dpMeta').innerHTML=`
    <div class="meta-box"><div class="meta-lbl">Ship Date</div><div class="meta-val">${o.SHIPDT}</div></div>
    <div class="meta-box"><div class="meta-lbl">Merchandiser</div><div class="meta-val">${o.MERCH}</div></div>
    <div class="meta-box"><div class="meta-lbl">Status</div><div class="meta-val"><span class="pill pill-${o.STATUS}">${o.STATUS}</span></div></div>
    <div class="meta-box"><div class="meta-lbl">Progress</div><div class="meta-val" style="color:var(--gold)">${Math.round(o.PROGRESS)}%</div></div>`;
  document.getElementById('dpPct').textContent=Math.round(o.PROGRESS)+'%';
  panel.classList.remove('show');
  void panel.offsetWidth;
  panel.classList.add('show');
  requestAnimationFrame(()=>requestAnimationFrame(()=>{ 
    document.getElementById('dpFill').style.width=o.PROGRESS+'%';
  }));

  // GET STYLE BASED DETAILS
  try{
    const res = await fetch(`<?php echo base_url()?>Dashboard/getdelayDetails?pono=${encodeURIComponent(id)}`)
    const datas = await res.json();

    let proc_tb_body = document.querySelector('#proc-table tbody');

    if(datas){

      TNA = [...new Set(datas.map(dt => dt.PRONAME))];

      proc_tb_body.innerHTML = datas.map((dt, i) => {
        return `<tr style="animation:slideRight .3s ${i*.03}s ease both">
        <td style='text-align:left; '>${dt.PRONAME||'-'}</td>
        <td style='text-align:center;'>${dt.REVPLANED?dtformat(dt.REVPLANED):'-'}</td>
        <td style='text-align:center;'>${dt.ACTEDDT?dtformat(dt.ACTEDDT):'-'}</td>
        <td style='text-align:center;'>${Math.round(dt.COMPPER)+'%'||'-'}</td>
        <td><span class="pill pill-${dt.STATUS.trim().toLowerCase().replace(' ','')}"><span class='pill-dot pd-${dt.STATUS.trim().toLowerCase().replace(' ','')}'></span>${dt.STATUS||'-'}</span></td>
        </tr>`
      }).join('');

      console.log(datas);
      console.log(TNA);

      const done=Math.round(TNA.length*o.PROGRESS/100);
      document.getElementById('tnaWrap').innerHTML=datas.map((s,i)=>{
      // const isDelay=o.STATUS&&s.toLowerCase().includes(o.STATUS.toLowerCase().slice(0,4));
      const status = (s.STATUS || '').trim().toLowerCase().replace(' ', '');    
      console.log(status);
      // const cls=isDelay?'delay':i<done?'done':'pending';
      const cls = status === 'delayed' ? 'delay' : status === 'ontime' ? 'done' : 'pending';
      // const icon=isDelay?'!':i<done?'✓':(i+1)+'';  
      const icon = status === 'delayed' ? '!' : status === 'ontime' ? '✓' : (i+1)+'';
      return`<div class="tna-node ${cls}" style="animation-dela :${i*.05}s">
        <div class="tna-dot">${icon}</div>
        <div class="tna-lbl">${s.PRONAME}</div>
      </div>`;
    }).join('');


  } 


  }catch(err){
    console.error('DELAY DETAILS FETCH ERRO : ',err)
  }
  



  notify(`Viewing ${o.id} — ${o.buyer}`,'#3b9eff');
  panel.scrollIntoView({behavior:'smooth',block:'nearest'});
}

function closeDetail(){
  document.getElementById('detailPanel').classList.remove('show');
  selOrder=null; renderOrders();
}

/* ── Delay panel ── */
function openDelay(id){
  const o=ORDERS.find(x=>x.id===id);
  const panel=document.getElementById('delayPanel');
  document.getElementById('dp2Ref').textContent=`${o.id} · ${o.buyer} · ${o.style}`;
  document.getElementById('dp2Stage').textContent=o.delayStage;
  document.getElementById('delayItems').innerHTML=o.dd.map((d,i)=>{
    const pw=Math.round(60*(d.days)/(d.days+4));  
    const gw=100-pw;
    return`<div class="delay-item" style="animation-delay:${i*.1}s">
      <div class="di-hdr">
        <div class="di-action">${d.action}</div>
        <div class="di-days">+${d.days}d</div>
      </div>
      <div class="tl-wrap"> 
        <div class="tl-plan" style="flex:${pw}"></div>
        <div class="tl-gap" style="flex:${gw}"></div>
      </div>
      <div class="di-dates">
        <div class="di-date"><div class="di-date-lbl">Plan</div><div class="di-date-val plan-c">${d.plan}</div></div>
        <div class="di-date"><div class="di-date-lbl">Actual</div><div class="di-date-val actual-c">${d.actual}</div></div>
        <div class="di-date"><div class="di-date-lbl">Gap</div><div class="di-date-val gap-c">+${d.days} days</div></div>
      </div>
      <div class="di-reason">${d.reason}</div>
    </div>`;
  }).join('');
  panel.classList.remove('show'); 
  void panel.offsetWidth;
  panel.classList.add('show');
  notify(`Delay: ${o.delayStage} — ${o.id}`,'#ff4e4e');
  panel.scrollIntoView({behavior:'smooth',block:'nearest'});
}

function closeDelay(){ document.getElementById('delayPanel').classList.remove('show'); }

/* ── Merch ── */
function renderMerch(){
  const maxO=Math.max(...MERCH.map(m=>m.orders));
  document.getElementById('merchWrap').innerHTML=MERCH.map((m,i)=>{
    const delperc = Math.round(m.delayed/m.orders*100);
   return `<div class="merch-item" style="animation-delay:${i*.07}s" ">
   <div id='mfil_check' style='color:green; display:none;'>✓</div>
    <div class="m-av" style="background:${m.color}18;color:${m.color};border:1px solid ${m.color}33;">${m.initials}</div>
    <div class="m-body">
    <div class="m-name">${m.name}</div>
    <div class="m-meta">${m.orders} orders · <span class="m-delayed">${m.delayed} delayed</span></div>
    </div>
    <div class="m-right">
    <div class="m-bar-bg"><div class="m-bar-fg" style="width:0;background:${ delperc > 50 ? m.color : delperc < 50 ? 'orange' : delperc < 30 ? 'red' : ''}" data-w="${delperc}"></div></div>
    <div class="m-pct">${m.delayed>0?delperc+'% delay':'clean'}</div>
    </div>
    </div>`}).join('');
  setTimeout(()=>{
    document.querySelectorAll('.m-bar-fg').forEach(el=>{el.style.width=el.dataset.w+'%';});
  },600);
}

function filterByMerch(name){
  const list=ORDERS.filter(o=>o.MERCH===name);
  document.querySelectorAll('.fpill').forEach(b=>b.classList.remove('active'));
  document.querySelector('.fpill').classList.add('active');
  activeFilter='all';
  renderOrders(list);
  notify(`Orders for ${name}`,'#f0a500');
}

/* ── Chart ── */
function renderChart(){
  console.log(ORDERS);
  const buyers=[...new Set(ORDERS.map(o=>o.BUYERNAME))];
  const maxQty=Math.max(...buyers.map(b=>ORDERS.filter(o=>o.BUYERNAME===b).reduce((s,o)=>s+o.QTY,0)));
  document.getElementById('chartLeg').innerHTML=
    [['#00c48c','On Time'],['#3b9eff','Running'],['#ff4e4e','Delayed']].map(([c,l])=>
      `<span style="display:flex;align-items:center;gap:5px;font-size:10px;color:var(--text2)">
        <span style="width:8px;height:8px;border-radius:2px;background:${c};display:inline-block"></span>${l}
      </span>`).join('');
  document.getElementById('chartBars').innerHTML=buyers.map(b=>{
    const bO=ORDERS.filter(o=>o.BUYERNAME===b);
    const qty=bO.reduce((s,o)=>s+o.QTY,0);
    const h=Math.round(qty/maxQty*70)+4;
    const hasDelay=bO.some(o=>o.STATUS==='delayed');
    return`<div class="bar-col">
      <div class="bar-body" style="height:0;background:${hasDelay?'#ff4e4e88':'#3b9eff88'}" data-h="${h}px"></div>
      <div class="bar-lbl">${b}</div>
    </div>`;  
  }).join('');
  setTimeout(()=>{
    document.querySelectorAll('.bar-body').forEach((el,i)=>{
      setTimeout(()=>{el.style.height=el.dataset.h;},i*80);
    });
  },700);
}

/* ── Heatmap ── */
// function renderHeat(){
//   const stageD={};
//   ORDERS.filter(o=>o.delayStage).forEach(o=>{
//     stageD[o.delayStage]=(stageD[o.delayStage]||0)+o.dd.reduce((s,d)=>s+d.days,0);
//   });
//   const maxD=Math.max(...Object.values(stageD),1);
//   document.getElementById('heatWrap').innerHTML=Object.entries(stageD).map(([s,d])=>`
//     <div class="hm-row">
//       <div class="hm-label">${s}</div>
//       <div class="hm-track"><div class="hm-fill" style="width:0;background:rgba(255,78,78,${.3+d/maxD*.65})" data-w="${Math.round(d/maxD*100)}%"></div></div>
//       <div class="hm-val">+${d}d</div>
//     </div>`).join('');
//   setTimeout(()=>{
//     document.querySelectorAll('.hm-fill').forEach(el=>{el.style.width=el.dataset.w;});
//   },700);
// }

/* ── Toast ── */
function notify(msg,color='#f0a500'){
  const t=document.getElementById('toast');
  document.getElementById('toastMsg').textContent=msg;
  document.getElementById('toastDot').style.background=color;
  t.classList.add('show');
  clearTimeout(notify._t);
  notify._t=setTimeout(()=>t.classList.remove('show'),2800);
}

/* ── Sidebar toggle (desktop collapse) ── */
function toggleSidebar(){
  navCollapsed=!navCollapsed;
  const sb=document.getElementById('sidebar');
  const mw=document.getElementById('mainWrap');
  const hamburger = document.getElementById('hamburger');
  hamburger.style.display= navCollapsed ? "none" : "flex";
  sb.classList.toggle('collapsed',navCollapsed);
  mw.classList.toggle('nav-coll',navCollapsed);
}

/* ── Mobile nav ── */
function toggleMobileNav(){
  mobileNavOpen=!mobileNavOpen;
  document.getElementById('sidebar').classList.toggle('mobile-open',mobileNavOpen);
  document.getElementById('navOverlay').classList.toggle('show',mobileNavOpen);
  document.getElementById('hamburger').classList.toggle('open',mobileNavOpen);
}
function closeMobileNav(){
  mobileNavOpen=false;
  document.getElementById('sidebar').classList.remove('mobile-open');
  document.getElementById('navOverlay').classList.remove('show');
  document.getElementById('hamburger').classList.remove('open');
}

/* ── Theme toggle ── */
function toggleTheme(){
  const isDark=document.documentElement.dataset.theme==='dark';
  document.documentElement.dataset.theme=isDark?'light':'dark';
  document.getElementById('themeIcon').textContent=isDark?'☀':'🌙';
  notify(isDark?'Light mode on':'Dark mode on', isDark?'#f0a500':'#3b9eff');
}

/* ── User dropdown ── */
function toggleDropdown(){
  const btn=document.getElementById('userBtn');
  const dd=document.getElementById('userDropdown');
  btn.classList.toggle('open');
  dd.classList.toggle('open');
}
function closeDropdown(){
  document.getElementById('userBtn').classList.remove('open');
  document.getElementById('userDropdown').classList.remove('open');
}
document.addEventListener('click',e=>{
  if(!e.target.closest('.user-wrap'))closeDropdown();
});

function openSettings(){
  closeDropdown();
  notify('Settings panel coming soon','#9b6dff');
}

/* ── Handle desktop collapse toggle on resize ── */
function handleResize(){
  const w=window.innerWidth;
  if(w>900){
    document.getElementById('sidebar').classList.remove('mobile-open');
    document.getElementById('navOverlay').classList.remove('show');
    document.getElementById('hamburger').classList.remove('open');
    mobileNavOpen=false;
  } 
}
window.addEventListener('resize',handleResize);

/* ── INIT ── */
initKPIs();
renderOrders();
renderMerch();
renderChart();
// renderHeat();


// FILTER SEARCH BOX PROCESS

let svalues = [];
let bvalues = [];
let cvalues = [];
// getOrders(svalues, bvalues, cvalues, ['all']);

// FOR SEASON
let seasfil = document.getElementById('seasonbtn');
let seasopt = document.getElementById('season-opt');
let seas_searchbox = document.getElementById('seas_searchbox');
let seas_clear =  document.getElementById('seas_clear');
let seas_apply =  document.getElementById('seas_apply');

let seas_opt_itms = seasopt.querySelectorAll(".season-opt-itm");

seasfil.addEventListener('click', ()=>{
  seasopt.classList.toggle('show');
});

document.addEventListener('click', (e)=>{
  // console.log(e.target);
  if(!seasopt.contains(e.target) && !seas_searchbox.contains(e.target) && !seasfil.contains(e.target)) {
    seasopt.classList.remove('show');
  }
})

// CLEAR CHECKED
seas_clear.onclick = ()=>{
  let checked = document.querySelectorAll('input[name="seasons[]"]:checked');
  checked.forEach(cb => {
    cb.checked = false;
  });   
}

// FILTER CHECKED
seas_apply.onclick = ()=>{
   svalues = [];
   bvalues = [];
   cvalues = [];

  let seasChecked = document.querySelectorAll('input[name="seasons[]"]:checked');  
  seasChecked.forEach(cb => {
    svalues.push(cb.value);
  });

  let buyChecked = document.querySelectorAll('input[name="buyers[]"]:checked');  
  buyChecked.forEach(cb => {
    bvalues.push(cb.value);
  });

  let compChecked = document.querySelectorAll('input[name="company[]"]:checked');  
  compChecked.forEach(cb => {
    cvalues.push(cb.value);
  });

  let orders = getOrders(svalues, bvalues, cvalues, ['all']);
  seasopt.classList.remove('show');
}



let timeout1;
seas_searchbox.addEventListener('input',()=>{
  console.log(seas_searchbox.value);

  clearTimeout(timeout1);

  timeout = setTimeout(() => {

    const query = seas_searchbox.value  ;

    console.log(query);

    seas_opt_itms.forEach(itm => {
      const txt = itm.querySelector('label').textContent;
      if(txt.trim().toLowerCase().includes(query)){
        itm.style.display="flex"
      }else{
        itm.style.display="none";
      }
    });

  }, 100);
});


// FOR BUYER
let buyfil = document.getElementById('buyerbtn');
let buyopt = document.getElementById('buyer-opt');
let buy_searchbox = document.getElementById('buy_searchbox');
let buy_clear = document.getElementById('buy_clear');
let buy_apply = document.getElementById('buy_apply');

let buy_opt_itms = buyopt.querySelectorAll(".buyer-opt-itm");

buyfil.addEventListener('click', ()=>{
  buyopt.classList.toggle('show');
});

document.addEventListener('click', (e)=>{
  // console.log(e.target);
  if(!buyopt.contains(e.target) && !buy_searchbox.contains(e.target) && !buyfil.contains(e.target)) {
    buyopt.classList.remove('show');
  }
})

// CLEAR CHECKED
buy_clear.onclick = ()=>{
  let checked = document.querySelectorAll('input[name="buyers[]"]:checked');
  checked.forEach(cb => {
    cb.checked = false;
  });   
}


// FILTER CHECKED
buy_apply.onclick = ()=>{

  console.log('clicked');

   svalues = [];
   bvalues = [];
   cvalues = [];

  let seasChecked = document.querySelectorAll('input[name="seasons[]"]:checked');  
  seasChecked.forEach(cb => {
    svalues.push(cb.value.trim().toLowerCase());
  });

  let buyChecked = document.querySelectorAll('input[name="buyers[]"]:checked');  
  buyChecked.forEach(cb => {
    bvalues.push(cb.value.trim().toLowerCase());
  });

  let compChecked = document.querySelectorAll('input[name="company[]"]:checked');  
  compChecked.forEach(cb => {
    cvalues.push(cb.value.trim().toLowerCase());
  });

  let orders = getOrders(svalues, bvalues, cvalues, ['all']);
  buyopt.classList.remove('show');

  // console.log(orders);
}



let timeout2;
buy_searchbox.addEventListener('input',()=>{
  console.log(buy_searchbox.value);

  clearTimeout(timeout2);

  timeout2 = setTimeout(() => {

    const query = buy_searchbox.value.trim().toLowerCase();

    buy_opt_itms.forEach(itm => {
      const txt = itm.querySelector('label').textContent;
      if(txt.trim().toLowerCase().includes(query)){
        itm.style.display="flex"
      }else{
        itm.style.display="none";

      }
    });

  }, 100);
});


// FOR COMPANY
let compfil = document.getElementById('companybtn');
let compopt = document.getElementById('company-opt');
let comp_searchbox = document.getElementById('comp_searchbox');

let comp_opt_itms = compopt.querySelectorAll(".company-opt-itm");

compfil.addEventListener('click', ()=>{
  compopt.classList.toggle('show');
});

document.addEventListener('click', (e)=>{
  // console.log(e.target);
  if(!compopt.contains(e.target) && !comp_searchbox.contains(e.target) && !compfil.contains(e.target)) {
    compopt.classList.remove('show');
  }
})


// CLEAR CHECKED
comp_clear.onclick = ()=>{
  let checked = document.querySelectorAll('input[name="company[]"]:checked');
  checked.forEach(cb => {
    cb.checked = false;
  });   
}

// FILTER CHECKED
comp_apply.onclick = ()=>{

console.log('clicked');

 svalues = [];
 bvalues = [];
 cvalues = [];

let seasChecked = document.querySelectorAll('input[name="seasons[]"]:checked');  
seasChecked.forEach(cb => {
  svalues.push(cb.value.trim().toLowerCase());
});

let buyChecked = document.querySelectorAll('input[name="buyers[]"]:checked');  
buyChecked.forEach(cb => {
  bvalues.push(cb.value.trim().toLowerCase());
});

let compChecked = document.querySelectorAll('input[name="company[]"]:checked');  
compChecked.forEach(cb => {
  cvalues.push(cb.value.trim().toLowerCase());
});

let orders = getOrders(svalues, bvalues, cvalues, ['all']);
compopt.classList.remove('show');

// console.log(orders);
}




let timeout3;
comp_searchbox.addEventListener('input',()=>{
  console.log(buy_searchbox.value);

  clearTimeout(timeout3);

  timeout3 = setTimeout(() => {

    const query = comp_searchbox.value.trim().toLowerCase();

    comp_opt_itms.forEach(itm => {
      const txt = itm.querySelector('label').textContent;
      if(txt.trim().toLowerCase().includes(query)){
        itm.style.display="flex"
      }else{
        itm.style.display="none";

      }
    });

  }, 100);
});


// MERCH FILTER PROCESS

let merch_names = [];

let merchfinput = document.getElementById('merchfinput');
let merch_voice_btn = document.getElementById('merch_voice_btn');
let merchfbtn = document.getElementById('merchfbtn');

let timeout4;
merchfinput.oninput = ()=>{

  merch_names = [];

  let merchWrap = document.getElementById('merchWrap');
  let merchWrap_itms = merchWrap.querySelectorAll('.merch-item');

  clearTimeout(timeout4);

  timeout4 = setTimeout(() => {

    const query = merchfinput.value.trim().toLowerCase().replace(' ','');

    merchWrap_itms.forEach(itm => {
      const txt = itm?itm.querySelector('.m-body .m-name').textContent.trim().toLowerCase().replace(' ','') : '';
      if(txt.includes(query)){
        itm.style.display='flex';
      }else{
        itm.style.display='none';
      }
    });

  }, 100);

}


merchfbtn.onclick = ()=>{

  if(MERCH.length===0) return;

  let merchWrap_itms = merchWrap.querySelectorAll('.merch-item');

  console.log(merch_names);

  merchWrap_itms.forEach(itm => {
    let disp = window.getComputedStyle(itm).display;

    if(disp != 'none'){
      merch_names.push(itm.querySelector('.m-body .m-name').textContent);
    }
  });

  if(merch_names.length > 0){
      getOrders(svalues, bvalues, cvalues, merch_names);
    }

}

// FOR FILTER RESET
merchfreset.onclick = ()=>{

  merchfinput.value='';

  if(MERCH.length === 0) return;

  console.log('MERCH FILTER RESETED');
  getOrders(svalues, bvalues, cvalues, ['all']);

  
}


// MERCH VOICE FILTERING

let is_recognizing = false;

const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
const recognition = new SpeechRecognition();

recognition.continuous  = false;
recognition.lang = 'ta-IN';
recognition.interimResults = false;

merch_voice_btn.onclick = ()=>{
  console.log('recognition clicked'); 


  if(merchfinput.value){
    getOrders(svalues, bvalues, cvalues, ['all']);
    merchfinput.value = '';
    merchfinput.dispatchEvent(new Event('input'));
  }


  

  

  if(!is_recognizing && MERCH.length > 0){
    recognition.start();
  }else{
    recognition.abort();
  }

}


// RECOGNIZING EVENTS
recognition .onstart = ()=>{
  console.log('recognizing start');
  merch_voice_btn.src='assets/images/recording.png';
  merch_voice_btn.width='20';
  merch_voice_btn.height='20';
  is_recognizing = true;
}


recognition.onresult = async (res)=>{

  console.log('Voice Gathering..');

  let final_res = ''; 

  const last = res.resultIndex;
  if(res.results[last].isFinal){

      final_res = res.results[last][0].transcript;
      merchfinput.value = await translateTamil(final_res);
      // TRIGGER INPUT MANUALLY
      merchfinput.dispatchEvent(new Event('input')); 

      console.log(final_res); 
      setTimeout(() => {
        merchfbtn.click();
      }, 200);
  }

}

recognition.onend = ()=>{
        console.log('Recognition stopped');
        recognition.abort();
        is_recognizing = false;
        merch_voice_btn.width='15';
        merch_voice_btn.height='15';
        merch_voice_btn.src='assets/images/mic.png';
    }


recognition.onerror = (err)=>{
    console.log('Recognition Error !!'+err.error);
    merch_voice_btn.width='15';
    merch_voice_btn.height='15';
    merch_voice_btn.src='assets/images/mic.png';
    recognition.abort();    
    is_recognizing = false;
}


// TAMIL TO ENGLISH TRANSCRIPT
async function translateTamil(text) {
  const res = await fetch(
    `https://api.mymemory.translated.net/get?q=${encodeURIComponent(text)}&langpair=ta|en`
  );
  const data = await res.json();
  console.log(data.responseData.translatedText);
  return data.responseData.translatedText;
}


</script>
</body>
</html>
