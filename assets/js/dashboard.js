document.addEventListener('DOMContentLoaded',()=>{
    console.log('DASHBOARD PAGE IS PARSED');
    /* ──────────────────────────────────────────
   DATA
────────────────────────────────────────── */
const ORDERS=[
    {id:'PO-2501',buyer:'H&M', season:'MS-25', style:'Woven Shirt',merch:'Sarah K',qty:3200,ship:'2025-04-10',status:'delayed',progress:55,delayStage:'Cutting',
  
     dd:[
        {action:'Fabric In-house',plan:'2025-03-05',actual:'2025-03-14',reason:'Supplier delayed fabric delivery due to port congestion at Colombo.',days:9},
  
        {action:'Cutting Start',plan:'2025-03-06',actual:'2025-03-16',reason:'Line not allocated — awaiting fabric arrival from supplier.',days:10}
        ]
    },
  
    {id:'PO-2502',buyer:'Zara',season:'MS-25',style:'Jersey Dress',merch:'Mike T',qty:1800,ship:'2025-04-15',status:'ontime',progress:72,delayStage:null,dd:[]},
    {id:'PO-2503',buyer:'M&S',season:'MS-25',style:'Chino Trouser',merch:'Priya R',qty:2500,ship:'2025-04-20',status:'running',progress:40,delayStage:null,dd:[]},
    {id:'PO-2504',buyer:'Next',season:'MS-25',style:'Polo Tee',merch:'Sarah K',qty:4000,ship:'2025-04-08',status:'delayed',progress:65,delayStage:'Sewing',
     dd:[{action:'Sewing Start',plan:'2025-03-10',actual:'2025-03-18',reason:'Power outage — 3-day production halt; no backup generator available.',days:8},
         {action:'Inline QC',plan:'2025-03-20',actual:'2025-03-28',reason:'High defect rate (15%) required full rework of seam allowances.',days:8}]},
    {id:'PO-2505',buyer:'ASOS',season:'MS-25',style:'Linen Blazer',merch:'James O',qty:900,ship:'2025-05-01',status:'ontime',progress:30,delayStage:null,dd:[]},
    {id:'PO-2506',buyer:'GAP',season:'MS-25',style:'Denim Jacket',merch:'Lena V',qty:1500,ship:'2025-04-25',status:'delayed',progress:48,delayStage:'Finishing',
     dd:[{action:'Washing',plan:'2025-03-22',actual:'2025-03-29',reason:'Wash machine breakdown — process outsourced causing schedule slip.',days:7},
         {action:'Finishing',plan:'2025-03-25',actual:'2025-04-02',reason:'Outsourced wash return delayed; pressing line was not ready.',days:8}]},
    {id:'PO-2507',buyer:'H&M',season:'MS-25',style:'Knit Sweater',merch:'Sarah K',qty:2200,ship:'2025-04-30',status:'running',progress:25,delayStage:null,dd:[]},
    {id:'PO-2508',buyer:'Primark',season:'MS-25',style:'Casual Shorts',merch:'Raj M',qty:5000,ship:'2025-04-12',status:'ontime',progress:80,delayStage:null,dd:[]},
    {id:'PO-2509',buyer:'Zara',season:'MS-25',style:'Maxi Skirt',merch:'Mike T',qty:1200,ship:'2025-04-18',status:'delayed',progress:35,delayStage:'PP Sample',
     dd:[{action:'PP Sample Submission',plan:'2025-03-01',actual:'2025-03-12',reason:'Buyer requested 3 rounds of colour corrections on fabric shade.',days:11},
         {action:'PP Approval',plan:'2025-03-03',actual:'2025-03-15',reason:'Approval delayed pending buyer internal QA review board.',days:12}]},
    {id:'PO-2510',buyer:'C&A',season:'MS-25',style:'Fleece Jacket',merch:'Lena V',qty:800,ship:'2025-05-05',status:'running',progress:15,delayStage:null,dd:[]},
    {id:'PO-2511',buyer:'Primark',season:'MS-25',style:'Hoodie Fleece',merch:'Raj M',qty:3600,ship:'2025-04-22',status:'ontime',progress:60,delayStage:null,dd:[]},
    {id:'PO-2512',buyer:'M&S',season:'MS-25',style:'Oxford Shirt',merch:'Priya R',qty:2100,ship:'2025-04-28',status:'delayed',progress:42,delayStage:'Final QC',
     dd:[{action:'Final QC',plan:'2025-04-01',actual:'2025-04-08',reason:'Multiple shade variation issues found — fabric lot retest required.',days:7}]},
  ];
  
  const MERCH=[
    {name:'Sarah K',initials:'SK',color:'#3b9eff',orders:3,delayed:1},
    {name:'Mike T', initials:'MT',color:'#00c48c',orders:2,delayed:1},
    {name:'Priya R',initials:'PR',color:'#f0a500',orders:2,delayed:1},
    {name:'James O',initials:'JO',color:'#9b6dff',orders:1,delayed:0},
    {name:'Lena V', initials:'LV',color:'#ff4e4e',orders:2,delayed:1},
    {name:'Raj M',  initials:'RM',color:'#00e6a5',orders:2,delayed:0},
  ];
  
  const TNA=['Fabric Ord','Fabric In','PP Sample','PP Apprvl','Cutting','Sewing','Inline QC','Washing','Finishing','Final QC','Ex-Factory'];
  
  let activeFilter='all', selOrder=null, navCollapsed=false, mobileNavOpen=false;
  
  /* ── Clock ── */
  function tick(){
    const n=new Date();
    document.getElementById('liveTime').textContent=
      n.toLocaleTimeString('en-GB',{hour:'2-digit',minute:'2-digit',second:'2-digit', hour12:true});
  }
  setInterval(tick,1000); tick();
  
  /* ── CountUp ── */
  function countUp(el,target,dur=1100){
    let v=0,step=target/Math.ceil(dur/16);
    const t=setInterval(()=>{v=Math.min(v+step,target);el.textContent=Math.round(v);if(v>=target)clearInterval(t);},16);
  }
  
  /* ── KPI init ── */
  function initKPIs(){
    const total=ORDERS.length;
    const delayed=ORDERS.filter(o=>o.status==='delayed').length;
    const ontime=ORDERS.filter(o=>o.status==='ontime').length;
    const running=ORDERS.filter(o=>o.status==='running').length;
    setTimeout(()=>countUp(document.getElementById('kTotal'),total),200);
    setTimeout(()=>countUp(document.getElementById('kRunning'),running),300);
    setTimeout(()=>countUp(document.getElementById('kDelayed'),delayed),400);
    setTimeout(()=>countUp(document.getElementById('kOntime'),ontime),500);
    document.getElementById('kSub').textContent=Math.round(ontime/total*100)+'% on-time rate';
    setTimeout(()=>{
      document.getElementById('kb0').style.width='100%';
      document.getElementById('kb1').style.width=(running/total*100)+'%';
      document.getElementById('kb2').style.width=(delayed/total*100)+'%';
      document.getElementById('kb3').style.width=(ontime/total*100)+'%';
    },500);
  }
  
  /* ── Render orders ── */
  function renderOrders(list){
    const data=list||(activeFilter==='all'?ORDERS:ORDERS.filter(o=>o.status===activeFilter));
    const tbody=document.getElementById('tbody');
    if(!data.length){
      tbody.innerHTML=`<tr><td colspan="8" style="text-align:center;padding:32px;color:var(--text3);font-size:13px;">No orders found</td></tr>`;
      return;
    }
    tbody.innerHTML=data.map((o,i)=>`
      <tr class="${selOrder===o.id?'sel':''}" onclick="selOrderFn('${o.id}')" style="animation:slideRight .3s ${i*.03}s ease both">
        <td><span class="order-no">${o.id}</span></td>
        <td><span class="buyer-nm">${o.buyer}</span></td>
        <td><span class="style-nm">${o.season}</span></td>
        <td><span class="style-nm">${o.style}</span></td>
        <td><span class="merch-ch">${o.merch}</span></td>
        <td style="font-weight:600;color:var(--text)">${o.qty.toLocaleString()}</td>
        <td><span class="ship-dt">${o.ship}</span></td>
        <td><span class="pill pill-${o.status}"><span class="pill-dot pd-${o.status}"></span>${o.status}</span></td>
        <td>${o.delayStage
          ?`<span class="stage-tag" onclick="event.stopPropagation();openDelay('${o.id}')">${o.delayStage}</span>`
          :`<span style="color:var(--text3);font-size:11px;">—</span>`}
        </td>
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
    if(!q){renderOrders();return;}
    const filtered=ORDERS.filter(o=>
      o.id.toLowerCase().includes(q)||
      o.buyer.toLowerCase().includes(q)||
      o.style.toLowerCase().includes(q)||
      o.merch.toLowerCase().includes(q)
    );
    renderOrders(filtered);
  }

  document.getElementById('searchInput').oninput = (e)=> doSearch(e.target.value);
  
  /* ── Select order ── */
  function selOrderFn(id){
    selOrder=id;
    renderOrders();
    const o=ORDERS.find(x=>x.id===id);
    const panel=document.getElementById('detailPanel');
    document.getElementById('dpNo').textContent=o.id;
    document.getElementById('dpBuyer').textContent=`${o.buyer} · ${o.style} · ${o.qty.toLocaleString()} pcs`;
    document.getElementById('dpMeta').innerHTML=`
      <div class="meta-box"><div class="meta-lbl">Ship Date</div><div class="meta-val">${o.ship}</div></div>
      <div class="meta-box"><div class="meta-lbl">Merchandiser</div><div class="meta-val">${o.merch}</div></div>
      <div class="meta-box"><div class="meta-lbl">Status</div><div class="meta-val"><span class="pill pill-${o.status}">${o.status}</span></div></div>
      <div class="meta-box"><div class="meta-lbl">Progress</div><div class="meta-val" style="color:var(--gold)">${o.progress}%</div></div>`;
    document.getElementById('dpPct').textContent=o.progress+'%';
    panel.classList.remove('show');
    void panel.offsetWidth;
    panel.classList.add('show');
    requestAnimationFrame(()=>requestAnimationFrame(()=>{
      document.getElementById('dpFill').style.width=o.progress+'%';
    }));
    const done=Math.round(TNA.length*o.progress/100);
    document.getElementById('tnaWrap').innerHTML=TNA.map((s,i)=>{
      const isDelay=o.delayStage&&s.toLowerCase().includes(o.delayStage.toLowerCase().slice(0,4));
      const cls=isDelay?'delay':i<done?'done':'pending';
      const icon=isDelay?'!':i<done?'✓':(i+1)+'';
      return`<div class="tna-node ${cls}" style="animation-delay:${i*.05}s">
        <div class="tna-dot">${icon}</div>
        <div class="tna-lbl">${s}</div>
      </div>`;
    }).join('');
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
    document.getElementById('merchWrap').innerHTML=MERCH.map((m,i)=>`
      <div class="merch-item" style="animation-delay:${i*.07}s" onclick="filterByMerch('${m.name}')">
        <div class="m-av" style="background:${m.color}18;color:${m.color};border:1px solid ${m.color}33;">${m.initials}</div>
        <div class="m-body">
          <div class="m-name">${m.name}</div>
          <div class="m-meta">${m.orders} orders · <span class="m-delayed">${m.delayed} delayed</span></div>
        </div>
        <div class="m-right">
          <div class="m-bar-bg"><div class="m-bar-fg" style="width:0;background:${m.color}" data-w="${Math.round(m.orders/maxO*100)}"></div></div>
          <div class="m-pct">${m.delayed>0?Math.round(m.delayed/m.orders*100)+'% delay':'clean'}</div>
        </div>
      </div>`).join('');
    setTimeout(()=>{
      document.querySelectorAll('.m-bar-fg').forEach(el=>{el.style.width=el.dataset.w+'%';});
    },600);
  }
  
  function filterByMerch(name){
    const list=ORDERS.filter(o=>o.merch===name);
    document.querySelectorAll('.fpill').forEach(b=>b.classList.remove('active'));
    document.querySelector('.fpill').classList.add('active');
    activeFilter='all';
    renderOrders(list);
    notify(`Orders for ${name}`,'#f0a500');
  }
  
  /* ── Chart ── */
  function renderChart(){
    const buyers=[...new Set(ORDERS.map(o=>o.buyer))];
    const maxQty=Math.max(...buyers.map(b=>ORDERS.filter(o=>o.buyer===b).reduce((s,o)=>s+o.qty,0)));
    document.getElementById('chartLeg').innerHTML=
      [['#00c48c','On Time'],['#3b9eff','Running'],['#ff4e4e','Delayed']].map(([c,l])=>
        `<span style="display:flex;align-items:center;gap:5px;font-size:10px;color:var(--text2)">
          <span style="width:8px;height:8px;border-radius:2px;background:${c};display:inline-block"></span>${l}
        </span>`).join('');
    document.getElementById('chartBars').innerHTML=buyers.map(b=>{
      const bO=ORDERS.filter(o=>o.buyer===b);
      const qty=bO.reduce((s,o)=>s+o.qty,0);
      const h=Math.round(qty/maxQty*70)+4;
      const hasDelay=bO.some(o=>o.status==='delayed');
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
  function renderHeat(){
    const stageD={};
    ORDERS.filter(o=>o.delayStage).forEach(o=>{
      stageD[o.delayStage]=(stageD[o.delayStage]||0)+o.dd.reduce((s,d)=>s+d.days,0);
    });
    const maxD=Math.max(...Object.values(stageD),1);
    document.getElementById('heatWrap').innerHTML=Object.entries(stageD).map(([s,d])=>`
      <div class="hm-row">
        <div class="hm-label">${s}</div>
        <div class="hm-track"><div class="hm-fill" style="width:0;background:rgba(255,78,78,${.3+d/maxD*.65})" data-w="${Math.round(d/maxD*100)}%"></div></div>
        <div class="hm-val">+${d}d</div>
      </div>`).join('');
    setTimeout(()=>{
      document.querySelectorAll('.hm-fill').forEach(el=>{el.style.width=el.dataset.w;});
    },700);
  }
  
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

  document.getElementById('navToggle').onclick = toggleSidebar;
  
  /* ── Mobile nav ── */
  function toggleMobileNav(){
    mobileNavOpen=!mobileNavOpen;
    document.getElementById('sidebar').classList.toggle('mobile-open',mobileNavOpen);
    document.getElementById('navOverlay').classList.toggle('show',mobileNavOpen);
    document.getElementById('hamburger').classList.toggle('open',mobileNavOpen);
  }

  document.getElementById('hamburger').onclick = toggleMobileNav;

  function closeMobileNav(){
    mobileNavOpen=false;
    document.getElementById('sidebar').classList.remove('mobile-open');
    document.getElementById('navOverlay').classList.remove('show');
    document.getElementById('hamburger').classList.remove('open');
  }
  
  document.getElementById('navOverlay').onclick = closeMobileNav;

  /* ── Theme toggle ── */
  function toggleTheme(){
    const isDark=document.documentElement.dataset.theme==='dark';
    document.documentElement.dataset.theme=isDark?'light':'dark';
    document.getElementById('themeIcon').textContent=isDark?'☀':'🌙';
    notify(isDark?'Light mode on':'Dark mode on', isDark?'#f0a500':'#3b9eff');
  }

  document.querySelector('.theme-toggle').onclick = toggleTheme;

  
  /* ── User dropdown ── */
  function toggleDropdown(){
    const btn=document.getElementById('userBtn');
    const dd=document.getElementById('userDropdown');
    btn.classList.toggle('open');
    dd.classList.toggle('open');
  }

  document.getElementById('userBtn').onclick = toggleDropdown;

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

  document.querySelectorAll('.nav-item').forEach(navitem => navitem.onclick = openSettings);

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
  renderHeat(); 

  let div = document.createElement('div');
  



});