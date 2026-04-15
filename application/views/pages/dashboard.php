<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>CR GARMENTS | DASHBOARD</title>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url()?>assets/css/dashboard.css">
</head>
<body>

<!-- <?php echo '<pre>'; print_r($heat_orders);?> -->

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
      <div class="nav-item active" id='dashboard_nav' onclick="notify('Dashboard','#f0a500')">
        <div class="nav-icon">◈</div>
        <span class="nav-label">Dashboard</span>
        <div class="nav-tip">Dashboard</div>
      </div>
      <div class="nav-item" id='orders_nav' onclick="notify('Orders module coming soon','#3b9eff')">
        <div class="nav-icon">◻</div>
        <span class="nav-label">Orders</span>
        <span class="nav-badge">12</span>
        <div class="nav-tip">Orders</div>
      </div>
      <div class="nav-item" id='tna_tracker_nav' onclick="notify('TNA Tracker coming soon','#00c48c')">
        <div class="nav-icon">◷</div>
        <span class="nav-label">TNA Tracker</span>
        <div class="nav-tip">TNA Tracker</div>
      </div>
      <div class="nav-item" id='delays_mod_nav' onclick="notify('Delays module coming soon','#ff4e4e')">
        <div class="nav-icon">⚠</div>
        <span class="nav-label">Delays</span>
        <span class="nav-badge">5</span>
        <div class="nav-tip">Delays</div>
      </div>
    </div>

    <div class="nav-section">
      <div class="nav-section-label">Reports</div>
      <div class="nav-item" id='buyer_nav' onclick="notify('Buyer Reports coming soon','#9b6dff')">
        <div class="nav-icon">◑</div>
        <span class="nav-label">Buyer Reports</span>
        <div class="nav-tip">Buyer Reports</div>
      </div>
      <div class="nav-item" id='merch_nav'  onclick="notify('Merch Summary coming soon','#f0a500')">
        <div class="nav-icon">◐</div>
        <span class="nav-label">Merch Summary</span>
        <div class="nav-tip">Merch Summary</div>
      </div>
      <div class="nav-item" id='analitics_nav'  onclick="notify('Analytics coming soon','#00c48c')">
        <div class="nav-icon">◉</div>
        <span class="nav-label">Analytics</span>
        <div class="nav-tip">Analytics</div>
      </div>
    </div>

    <div class="nav-section">
      <div class="nav-section-label">Config</div>
      <div class="nav-item" id='setting_nav' onclick="openSettings()">
        <div class="nav-icon">⚙</div>
        <span class="nav-label">Settings</span>
        <div class="nav-tip">Settings</div>
      </div>
    </div>

    <!-- Footer: collapse toggle -->
    <div class="nav-footer">
      <button class="nav-toggle" id="navToggle" onclick="toggleSidebar()">
        <div id='nav-toggle-icon' class="nav-icon">◁</div>
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

              <div class="season-opt-itm" id='seasall'>
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

              <div class="buyer-opt-itm" id='buyall'>
                  <label for="bitm_all" style="font-weight:bold;">All</label>
                  <input type="checkbox" checked name="buyers[]" id="bitm_all" value="all">
              </div>
      
              <?php foreach($buyers as $idx1 => $buyer){?>
                <div class="buyer-opt-itm">
                  <label for="bitm<?=$idx1?>"><?=$buyer['BUYERNAME']?></label>
                  <input type="checkbox" name="buyers[]" checked id="bitm<?=$idx1?>" value="<?= $buyer['BUYERNAME']?>">
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

              <div class="company-opt-itm" id='compall'>
                  <label for="citm_all" style="font-weight:bold;">All</label>
                  <input type="checkbox" checked name="company[]" id="citm_all" value="all">
              </div>
      
              <?php foreach($company as $idx1 => $comp){?>
                <div class="company-opt-itm">
                  <label for="citm<?=$idx1?>"><?=$comp['COMPANYID']?></label>
                  <input type="checkbox" name="company[]" checked id="citm<?=$idx1?>" value="<?= $comp['COMPANYID']?>">
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
      <button class="top-btn" id='bell_btn' onclick="notify('5 orders need attention','#ff4e4e')" title="Alerts">
        🔔
        <div class="notif-badge"></div>
      </button>

      <!-- Dark/Light Toggle -->
      <div class="theme-toggle" id='toggle_theme' onclick="toggleTheme()" title="Toggle theme">
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
            <div class="dd-item" id='prof_opt' onclick="notify('Profile page coming soon','#3b9eff');closeDropdown()">
              <span class="dd-icon">◷</span> My Profile
            </div>
            <div class="dd-item" id='setting_opt' onclick="openSettings()">
              <span class="dd-icon">⚙</span> Settings
            </div>
            <div class="dd-item" id='notify_opt'  onclick="notify('Notifications opened','#f0a500');closeDropdown()">
              <span class="dd-icon">🔔</span> Notifications
              <span style="margin-left:auto;background:var(--red);color:#fff;font-size:9px;padding:1px 6px;border-radius:10px;font-weight:700;">5</span>
            </div>
            <div class="dd-item" id='help_opt' onclick="notify('Help & Support coming soon','#9b6dff');closeDropdown()">
              <span class="dd-icon">◉</span> Help & Support
            </div>
            <div class="dd-sep"></div>
            <div class="dd-item danger" id='logout_opt' onclick="notify('Logging out…','#ff4e4e');closeDropdown()">
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
              <button class="fpill active" id="filt_all" onclick="setFilter('all',this)">All Orders</button>
              <button class="fpill" id="filt_delayed" onclick="setFilter('delayed',this)">Delayed</button>
              <button class="fpill" id="filt_ontime" onclick="setFilter('ontime',this)">On Time</button>
              <button class="fpill" id="filt_running" onclick="setFilter('running',this)">Running</button>
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
              <button class="close-x" id='close_ordet' onclick="closeDetail()">✕</button>
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
                          <th>Delay Days</th>
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
                <button class="close-x" id='close_delay' onclick="closeDelay()">✕</button>
              </div>
            </div>
            <div id="delayItems"></div>
          </div>
        </div>

        <!-- RIGHT -->
        <div class="right-col">

          <!-- Merch -->
          <div class="panel" style="animation:fadeUp .6s .25s ease both">
            <div class="sec-title">Merch Groups <span id="merchfilt_box"><input id="merchfinput" placeholder='Search Merch Name' type="text" ><button id="merch_voice_btn"><img style="transition:all .25s;"  src="<?php echo base_url()?>assets/images/mic.png" width="15" height="15" alt=""></button></span></div>
            <div id='merch_filter_btn' class="merch_filter_btn"><button id="merchfbtn" type='button'>Filter</button><button id='merchfreset' type='button'>Reset</button></div>
            <div id="merchWrap"></div>  
          </div>

          <!-- Chart -->
          <div  class="panel" style="animation:fadeUp .6s .35s ease both">
            <div class="sec-title">Status by Buyer</div>
            <div style="display:flex;flex-wrap:wrap;gap:10px;margin-bottom:10px;" id="chartLeg"></div>
            <div class="bar-row" id="chartBars"></div>
          </div>

          <!-- Heatmap -->  
          <div class="panel" style="animation:fadeUp .6s .45s ease both">
            <div class="sec-title">Delay Stage Heatmap</div>
            <div id="heatWrap"></div>
          </div>

        </div>
      </div>
    </main>
  </div><!-- /main-wrap -->   
</div><!-- /shell -->

<script>
  let orders_json = <?php echo json_encode($orders)?>;
  let seasons = <?php echo json_encode($seasons)?>;
  let buyers = <?php echo json_encode($buyers)?>;
  let company = <?php echo json_encode($company)?>;
  let base_url = "<?php echo base_url()?>Dashboard/";
</script>
  <script src="<?php echo base_url()?>assets/js/dashboard.js"></script>
</body>
</html>
