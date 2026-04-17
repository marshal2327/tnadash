document.addEventListener('DOMContentLoaded', ()=>{

  console.log('TNA DASHBOARD PAGE PARSED');
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

let ORDERS = [];
let MERCH = [];
let TNA = [];

let seas=[];
let buy = [];
let comp = [];

// global search variable
let searchInput = document.getElementById('searchInput');


// let TNA = ["REQUIRMENT", "PRE COSTING", "TRIMS PURCHASE", "YARN PURCHASE", "DYEING SEND", "DYEING RECIEVED", "PP SAMPLE", "PRINTING SENT", "PRINTING RECIEVED"];

function getOrders(seas, buy, comp, merch){
  
  console.log(seas, buy, comp, merch);

  ORDERS = [];
  MERCH = [];
  TNA = [];

  seas = seas;
  buy = buy;
  comp = comp;


  // console.log(orders_json);

  ORDERS = orders_json.filter(ol => 
  (seas.includes('all') || seas.includes(ol.SEASON)) &&
   (buy.includes('all') || buy.includes(ol.BUYERNAME)) && 
   (comp.includes('all') || comp.includes(ol.COMPANYID))&&
   (merch.includes('all')|| merch.includes(ol.MERCH))
  )

  const uniqmerch = [...new Set(ORDERS.map(ol => ol.MERCH))].sort();

  // console.log(uniqmerch);

  MERCH = uniqmerch.map(um => ({
    name : um?um:'Unknown',
    initials : um?get_initials(um):null,
    color : '#3b9eff',
    orders : ORDERS.filter(ol => ol.MERCH === um).length,
    delayed : ORDERS.filter(ol => ol.MERCH === um && ol.STATUS ==='delayed').length
  }));



  // console.log(ORDERS);
  // console.log(MERCH);


  /* ── INIT ── */
  initKPIs();
  renderOrders();
  renderMerch();
  renderChart();
  // renderHeat(seas, buy, comp);

}


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
function countUp(el,target,dur=200){
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
    <tr class="${selOrder===o.PONO?'sel':''}" data-pono="${o.PONO}" style="animation:slideRight .3s ${i*.03}s ease both">
      <td><span class="order-no ">${o.PONO}</span></td>
      <td><span class="buyer-nm">${o.BUYERNAME}</span></td>
      <td><span class="style-nm">${o.SEASON}</span></td>
      <td><span class="style-nm">${o.COMPANYID? o.COMPANYID : '-'}</span></td>
      <td><span class="merch-ch">${o.MERCH? o.MERCH : '-'}</span></td>
      <td style="font-weight:600;color:var(--text); text-align:right;">${o.QTY.toLocaleString()}</td>
      <td><span class="ship-dt">${o.SHIPDT? o.SHIPDT :  '-'}</span></td>
      <td><span class="pill pill-${o.STATUS}"><span class="pill-dot pd-${o.STATUS}"></span>${o.STATUS}</span></td>
    </tr>`).join('');


  let srows = tbody.querySelectorAll('tr');

  srows.forEach(srow => {
    if(!srow) return; 
    const pono = srow.dataset.pono;
    srow.onclick = ()=>{selOrderFn(pono)}
  });

}

// FOR SELECT TABLE ROW


function setFilter(f,btn){

  activeFilter=f;
  searchInput.value='';
  searchInput.dispatchEvent(new Event('input'));
  document.querySelectorAll('.fpill').forEach(b=>b.classList.remove('active'));
  btn.classList.add('active');
  renderOrders();
}

document.getElementById('filt_all').onclick = (e)=>{
  setFilter('all', e.target);
}
document.getElementById('filt_delayed').onclick = (e)=>{
  setFilter('delayed', e.target);
}
document.getElementById('filt_ontime').onclick = (e)=>{
  setFilter('ontime', e.target);
}
document.getElementById('filt_running').onclick = (e)=>{
  setFilter('running', e.target);
}


function doSearch(q){
  q=q.trim().toLowerCase();
  // console.log(q); 
  if(!q){renderOrders();return;}
  const filtered=ORDERS.filter(o=>
    o.STATUS.toLowerCase().replace('/\s+/g','').includes(activeFilter === 'all' ? '' : activeFilter) &&
    (o.PONO.toLowerCase().replace('/\s+/g','').includes(q)||
    o.BUYERNAME.toLowerCase().replace('/\s+/g','').includes(q)||
    o.COMPANYID.toLowerCase().replace('/\s+/g','').includes(q)||
    o.MERCH.toLowerCase().replace('/\s+/g','').includes(q))
  );

  // console.log(filtered);

  renderOrders(filtered);   
}

document.getElementById('searchInput').oninput  = (e)=>{
  doSearch(e.target.value);
};

/* ── Select order ── */
async function selOrderFn(id){
  selOrder=id;
  renderOrders();
  const o=ORDERS.find(x=>x.PONO===id);
  // console.log(o);
  const panel=document.getElementById('detailPanel');
  document.getElementById('dpNo').textContent=o.PONO;
  document.getElementById('dpBuyer').textContent=`${o.BUYERNAME} · ${o.QTY.toLocaleString()} pcs`;
  document.getElementById('dpMeta').innerHTML=`
    <div class="meta-box"><div class="meta-lbl">Ship Date</div><div class="meta-val">${o.SHIPDT ? o.SHIPDT : '-'}</div></div>
    <div class="meta-box"><div class="meta-lbl">Merchandiser</div><div class="meta-val">${o.MERCH ? o.MERCH : '-'}</div></div>
    <div class="meta-box"><div class="meta-lbl">Status</div><div class="meta-val"><span class="pill pill-${o.STATUS}">${o.STATUS ? o.STATUS:'-'}</span></div></div>
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
    const res = await fetch(base_url+`getdelayDetails?pono=${encodeURIComponent(id)}`)
    const datas = await res.json();

    let proc_tb_body = document.querySelector('#proc-table tbody');

    if(datas){

      TNA = [...new Set(datas.map(dt => dt.PRONAME))];

      proc_tb_body.innerHTML = datas.map((dt, i) => {
        return `<tr style="animation:slideRight .3s ${i*.03}s ease both">
        <td style='text-align:left; '>${dt.PRONAME||'-'}</td>
        <td style='text-align:left; '>${dt.PLANED?dtformat(dt.PLANED) : '-'}</td>
        <td style='text-align:center;'>${dt.REVPLANED?dtformat(dt.REVPLANED):'-'}</td>
        <td style='text-align:center;'>${dt.ACTEDDT?dtformat(dt.ACTEDDT):'-'}</td>
        <td style='text-align:center;'>${Math.round(dt.COMPPER)+'%'||'-'}</td>
        <td style='text-align:center; font-weight:550; color:${dt.DELDAYS !== '0'?'#ff4e4e': 'var(--text2)' }'>${dt.DELDAYS !== '0'?'+'+dt.DELDAYS:'-'}</td>
        <td><span class="pill pill-${dt.STATUS.trim().toLowerCase().replace(' ','')}"><span class='pill-dot pd-${dt.STATUS.trim().toLowerCase().replace(' ','')}'></span>${dt.STATUS||'-'}</span></td>
        </tr>`
      }).join('');

      console.log(datas);
      console.log(TNA);

      const done=Math.round(TNA.length*o.PROGRESS/100);
      document.getElementById('tnaWrap').innerHTML=datas.map((s,i)=>{
      // const isDelay=o.STATUS&&s.toLowerCase().includes(o.STATUS.toLowerCase().slice(0,4));
      const status = (s.STATUS || '').trim().toLowerCase().replace(' ', '');    
      // console.log(status);
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
  
  notify(`Viewing ${o.PONO} — ${o.BUYERNAME}`,'#3b9eff');
  panel.scrollIntoView({behavior:'smooth',block:'nearest'});
}

function closeDetail(){
  document.getElementById('detailPanel').classList.remove('show');
  selOrder=null; renderOrders();
}

document.getElementById('close_ordet').onclick = closeDetail;

// /* ── Delay panel ── */
// function openDelay(id){
//   const o=ORDERS.find(x=>x.id===id);
//   const panel=document.getElementById('delayPanel');
//   document.getElementById('dp2Ref').textContent=`${o.id} · ${o.buyer} · ${o.style}`;
//   document.getElementById('dp2Stage').textContent=o.delayStage;
//   document.getElementById('delayItems').innerHTML=o.dd.map((d,i)=>{
//     const pw=Math.round(60*(d.days)/(d.days+4));  
//     const gw=100-pw;
//     return`<div class="delay-item" style="animation-delay:${i*.1}s">
//       <div class="di-hdr">
//         <div class="di-action">${d.action}</div>
//         <div class="di-days">+${d.days}d</div>
//       </div>
//       <div class="tl-wrap"> 
//         <div class="tl-plan" style="flex:${pw}"></div>
//         <div class="tl-gap" style="flex:${gw}"></div>
//       </div>
//       <div class="di-dates">
//         <div class="di-date"><div class="di-date-lbl">Plan</div><div class="di-date-val plan-c">${d.plan}</div></div>
//         <div class="di-date"><div class="di-date-lbl">Actual</div><div class="di-date-val actual-c">${d.actual}</div></div>
//         <div class="di-date"><div class="di-date-lbl">Gap</div><div class="di-date-val gap-c">+${d.days} days</div></div>
//       </div>
//       <div class="di-reason">${d.reason}</div>
//     </div>`;
//   }).join('');
//   panel.classList.remove('show'); 
//   void panel.offsetWidth;
//   panel.classList.add('show');
//   notify(`Delay: ${o.delayStage} — ${o.id}`,'#ff4e4e');
//   panel.scrollIntoView({behavior:'smooth',block:'nearest'});
// }

// function closeDelay(){ document.getElementById('delayPanel').classList.remove('show'); }

// document.getElementById('close_delay').onclick = closeDelay;

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
    <div class="m-bar-bg"><div class="m-bar-fg" style="width:0;background:${delperc > 70 ? '#ff6f6f' : delperc > 50 ? 'orange' : delperc < 30 ? 'green' : delperc < 50 ? m.color : ''}" data-w="${delperc}"></div></div>
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
  // console.log(ORDERS);
  const buyers=[...new Set(ORDERS.map(o=>o.BUYERNAME))].sort();

  const maxQty=Math.max(...buyers.map(b=>ORDERS.filter(o=>o.BUYERNAME===b).reduce((s,o)=>s+Number(o.QTY),0)),1);

  document.getElementById('chartLeg').innerHTML=
    [['#00c48c','On Time'],['#3b9eff','Running'],['#ff4e4e','Delayed']].map(([c,l])=>
      `<span style="display:flex;align-items:center;gap:5px;font-size:10px;color:var(--text2)">
        <span style="width:8px;height:8px;border-radius:2px;background:${c};display:inline-block"></span>${l}
      </span>`).join('');


  document.getElementById('chartBars').innerHTML=buyers.map(b=>{
    const bO=ORDERS.filter(o=>o.BUYERNAME===b);

    // const qty=bO.reduce((s,o)=>s + Number(o.QTY),0);

    // const h=Math.round(qty/maxQty*100);

    // let hasDelay=[...bO.map(o=>o.STATUS)];

    const delcnt = bO.filter(o => o.STATUS === 'delayed').length;
    const ontcnt = bO.filter(o => o.STATUS === 'ontime').length;
    const runcnt = bO.filter(o => o.STATUS === 'running').length;
    const ordcnt = bO.length;

    
    const delperc = Math.round(delcnt/ordcnt*100);
    const ontperc = Math.round(ontcnt/ordcnt*100);
    const runperc = Math.round(runcnt/ordcnt*100);
    
    
    console.log(b);
    console.log([delcnt, ordcnt], [ontcnt, ordcnt], [runcnt, ordcnt]);
    console.log(delperc, ontperc, runperc);
  
    return`<div class="bar-col">
      <div class="bar-body" style="height:0;background:${(ontperc < 50 && delperc > 50) ? '#ff4e4e88': (ontperc > 50 && delperc < 50) ? '#00c48cbd': (runperc > 50) ?  '#3b9eff88' : ''}; 
      color:white; font-family:var(--font-b); font-weight:bold; font-size:10px; text-align:center; letter-spacing:1.5px;" data-h="${delperc}px">${delperc}%</div>
      <div class="bar-lbl">${b}</div> 
    </div>`;  
  }).join('');  
  setTimeout(()=>{
    document.querySelectorAll('.bar-body').forEach((el,i)=>{
      setTimeout(()=>{el.style.height=el.dataset.h;},i* 80);
    });
  },700);
}

// /* ── Heatmap ── */
// async function renderHeat(seas, buy, comp){
//   // const stageD={};

//   // ORDERS.filter(o=>o.delayStage).forEach(o=>{
//   //   stageD[o.delayStage]=(stageD[o.delayStage]||0)+o.dd.reduce((s,d)=>s+Number(d.days),0);
//   // });

//   // const maxD=Math.max(...Object.values(stageD),1);

//   // console.log(seas, buy, comp);

//   try{

//     const resp = await fetch(base_url+`getheatmap?seas=${encodeURIComponent(JSON.stringify(seas))}&buy=${encodeURIComponent(JSON.stringify(buy))}&comp=${encodeURIComponent(JSON.stringify(comp))}`);
//     const res = await resp.json();

//     if(res){

//       // console.log(res);
//       const Hlength = Number(res.length);
//           // console.log(Hlength);

//       const maxD = Math.max(...res.map(o => Number(o.TTLDEL)),1);

//       // console.log(maxD);

//       document.getElementById('heatWrap').innerHTML=Object.entries(res).map(([s,d])=>`
//     <div class="hm-row">
//       <div class="hm-label">${d.PRONAME}</div>
//       <div class="hm-track"><div class="hm-fill" style="width:0;background:rgba(255,78,78,${.3+Number(d.TTLDEL)/maxD*.70})" data-w="${Math.round(Number(d.TTLDEL)/maxD*100)}%"></div></div>
//       <div class="hm-val">+${d.TTLDEL}d</div> 
//     </div>`).join('');
//   setTimeout(()=>{
//     document.querySelectorAll('.hm-fill').forEach(el=>{el.style.width=el.dataset.w;});
//   },700);   



//     } 



//   }catch(err){
//     console.error('HEAT MAP FETCH ERROR : ', err);
//   }           
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

document.getElementById('dashboard_nav').onclick = ()=>{
  notify('Dashboard','#f0a500')
}
document.getElementById('orders_nav').onclick = ()=>{
  notify('Orders module coming soon','#3b9eff')
}
document.getElementById('tna_tracker_nav').onclick = ()=>{
  notify('TNA Tracker coming soon','#00c48c')
}
document.getElementById('delays_mod_nav').onclick = ()=>{
  notify('Delays module coming soon','#ff4e4e')
}


document.getElementById('buyer_nav').onclick = ()=>{
  notify('Buyer Reports coming soon','#9b6dff')
}
document.getElementById('merch_nav').onclick = ()=>{
  notify('Merch Summary coming soon','#f0a500')
}
document.getElementById('analitics_nav').onclick = ()=>{
  notify('Analytics coming soon','#00c48c')
}

// ------------------------------------------

document.getElementById('bell_btn').onclick = ()=>{
  notify('No Notifications','#ff4e4e');
  closeDropdown()
};

// -------------------------------------
// document.getElementById('prof_opt').onclick = ()=>{
//   notify('Profile page coming soon','#3b9eff');
//   closeDropdown()

// };

// document.getElementById('setting_opt').onclick = ()=>{
//   notify('Notifications opened','#f0a500');
//   closeDropdown()

// };

// document.getElementById('notify_opt').onclick = ()=>{
//   notify('Notifications opened','#f0a500');
//   closeDropdown()

// };

// document.getElementById('help_opt').onclick = ()=>{
//   notify('Help & Support coming soon','#ff4e4e');
//   closeDropdown()

// };

  // document.getElementById('logout_opt').onclick = ()=>{
  //   notify('Logging out…','#ff4e4e');
  //   closeDropdown()

  // };





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
  // document.getElementById('hamburger').classList.toggle('open',mobileNavOpen);
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

document.getElementById('toggle_theme').onclick = toggleTheme;

/* ── User dropdown ── */
// function toggleDropdown(){
//   const btn=document.getElementById('userBtn');
//   const dd=document.getElementById('userDropdown');
//   btn.classList.toggle('open');
//   dd.classList.toggle('open');
// }

// document.getElementById('userBtn').onclick = toggleDropdown;

function closeDropdown(){
  document.getElementById('userBtn').classList.remove('open');
  // document.getElementById('userDropdown').classList.remove('open');
}
document.addEventListener('click',e=>{
  if(!e.target.closest('.user-wrap'))closeDropdown();
});

function openSettings(){
  closeDropdown();
  notify('Settings panel coming soon','#9b6dff');
}

document.getElementById('setting_nav').onclick = openSettings;

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
// renderHeat(seas, buy, comp);


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
let seasall = document.getElementById('seasall');
let seas_opt_itms = seasopt.querySelectorAll(".season-opt-itm");

// HANDLE CHECK ALL AND UNCHECK ALL
seasall.onchange = ()=>{
  let isChecked = seasall.querySelector('input').checked;
  
  seas_opt_itms.forEach(itm => {
    itm.querySelector('input').checked = isChecked;
  });
}


// HANDLE UNCHECK ALL , WHEN UNCHECK OTHER
seas_opt_itms.forEach(itm => {
  let checkbox = itm.querySelector('input');

  checkbox.onchange = ()=>{
    if(!checkbox.checked){
      seasall.querySelector('input').checked = false;
    }
  }
  
});

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
  seas_searchbox.value='';
  seas_searchbox.dispatchEvent(new Event('input'));
  
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

   searchInput.value='';

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
  // console.log(seas_searchbox.value);

  clearTimeout(timeout1);

  timeout1 = setTimeout(() => {

    const query = seas_searchbox.value.trim().toLowerCase();

    // console.log(query);

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
let buyall = document.getElementById('buyall');

buyall.onchange = ()=>{
  let isChecked = buyall.querySelector('input').checked;

  buy_opt_itms.forEach(itm => {
    itm.querySelector('input').checked = isChecked;
  });
}

buy_opt_itms.forEach(itm => {
  let checkbox = itm.querySelector('input');

  checkbox.onchange = ()=>{
    if(!checkbox.checked){
      buyall.querySelector('input').checked= false;
    }
  }

});


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

  buy_searchbox.value='';
  let checked = document.querySelectorAll('input[name="buyers[]"]:checked');
  checked.forEach(cb => {
    cb.checked = false;
  });   
}


// FILTER CHECKED
buy_apply.onclick = ()=>{

  // console.log('clicked');

   svalues = [];
   bvalues = [];
   cvalues = [];

   searchInput.value='';

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
  buyopt.classList.remove('show');

  // console.log(orders);
}



let timeout2;
buy_searchbox.addEventListener('input',()=>{
  // console.log(buy_searchbox.value);

  clearTimeout(timeout2);

  timeout2 = setTimeout(() => {

    const query = buy_searchbox.value.trim().toLowerCase().trim().toLowerCase();

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
let compall = document.getElementById('compall');


compfil.addEventListener('click', ()=>{
  compopt.classList.toggle('show');
});

document.addEventListener('click', (e)=>{
  // console.log(e.target);
  if(!compopt.contains(e.target) && !comp_searchbox.contains(e.target) && !compfil.contains(e.target)) {
    compopt.classList.remove('show');
  }
})


compall.onclick = ()=>{
  let isChecked = compall.querySelector('input').checked;

  comp_opt_itms.forEach(itm => {
    itm.querySelector('input').checked = isChecked;
  });
}

comp_opt_itms.forEach(itm => {
  let checkbox = itm.querySelector('input');

  itm.onchange = ()=>{
    if(!checkbox.checked){
      compall.querySelector('input').checked = false;
    }
  }
  
});


// CLEAR CHECKED
comp_clear.onclick = ()=>{

  comp_searchbox.value='';
  let checked = document.querySelectorAll('input[name="company[]"]:checked');
  checked.forEach(cb => {
    cb.checked = false;
  });   
}

// FILTER CHECKED
comp_apply.onclick = ()=>{

// console.log('clicked');

 svalues = [];
 bvalues = [];
 cvalues = [];

 searchInput.value='';

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
compopt.classList.remove('show');

// console.log(orders);
}




let timeout3;
comp_searchbox.addEventListener('input',()=>{
  // console.log(buy_searchbox.value);

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

    const query = merchfinput.value.trim().toLowerCase();

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

  searchInput.value = '';
  if(MERCH.length===0) return;

  let merchWrap_itms = merchWrap.querySelectorAll('.merch-item');

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
  searchInput.value='';

  if(MERCH.length === 0) return;

  // console.log('MERCH FILTER RESETED');
  getOrders(svalues, bvalues, cvalues, ['all']);

  
}


// MERCH VOICE FILTERING

let is_merchrecognizing = false;


const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
const recognition = new SpeechRecognition();

recognition.continuous  = false;
recognition.lang = 'ta-US';
recognition.interimResults = false;

merch_voice_btn.onclick = ()=>{
  // console.log('recognit ion clicked'); 

  if(is_globrecognizing)return;


  if(merchfinput.value){
    getOrders(svalues, bvalues, cvalues, ['all']);
    merchfinput.value = '';
    merchfinput.dispatchEvent(new Event('input'));
  }

  if(!is_merchrecognizing && MERCH.length > 0){
    recognition.start();
  }else{
    recognition.abort();
  }


  // RECOGNIZING EVENTS
  recognition.onstart = ()=>{
    // console.log('recognizing start');
    merch_voice_btn.querySelector('img').src='assets/images/recording.png';
    // merch_voice_btn.querySelector('img').width='20';
    // merch_voice_btn.querySelector('img').height='20';
    is_merchrecognizing = true;
  }


  recognition.onresult = async (res)=>{

    // console.log('Voice Gathering..');
  
    let final_res = ''; 
  
    const last = res.resultIndex;
    if(res.results[last].isFinal){
  
      final_res = res.results[last][0].transcript;
      let trans = await translateTamil(final_res);
      merchfinput.value = trans;
      // TRIGGER INPUT MANUALLY
      merchfinput.dispatchEvent(new Event('input')); 
      
  
      // SLICING FOUND WORD TO SEARCH 
      let i=5;
      while(i >= 1){
        merchfinput.value = trans.slice(0,i);
        // console.log(trans.slice(0, i));
        merchfinput.dispatchEvent(new Event('input')); 
  
        await delay(100);
  
        let ispers = checkMerchName();
        if(ispers.includes('flex')){
          // console.log(ispers, 'here');
          merchfbtn.click();
          break;
        }
        i--;
  
    }
      
        // setTimeout(() => {
        //   merchfbtn.click();
        // }, 100);
  
        // console.log(final_res);   
    }
  
  }

  recognition.onend = ()=>{
    console.log('Recognition stopped');
    recognition.abort();
    is_merchrecognizing = false;
    // merch_voice_btn.querySelector('img').width='15';
    // merch_voice_btn.querySelector('img').height='15';
    merch_voice_btn.querySelector('img').src='assets/images/mic.png';
    }


  recognition.onerror = (err)=>{
    console.log('Recognition Error !!'+err.error);
    // merch_voice_btn.querySelector('img').width='15';
    // merch_voice_btn.querySelector('img').height='15';
    merch_voice_btn.querySelector('img').src='assets/images/mic.png';
    recognition.abort();    
    is_merchrecognizing = false;
    }

}






// FOR WAIT
function delay(ms){
  return new Promise(resolve => setTimeout(resolve, ms));
}

function checkMerchName(){
  let merchWrap_itms = merchWrap.querySelectorAll('.merch-item');
  
    let ispers = [];    
    merchWrap_itms.forEach(itm => {
      let disp = window.getComputedStyle(itm).display;  
      ispers.push(disp);
    });
    return ispers;
      
}





// VOICE FOR GLOBAL SEARCH
let globsearch_voice_btn = document.getElementById('globsearch_voice_btn');

let is_globrecognizing = false;

numchars = {
  one:1,
  two:2,
  three:3,
  four:4,
  five:5,
  six:6,
  seven:7,
  eight:8,
  nine:9,
  ten:10
}

globsearch_voice_btn.onclick = ()=>{

  if(is_merchrecognizing) return;

  if(searchInput.value){
    searchInput.value='';
    searchInput.dispatchEvent(new Event('input'));
  }
  

  if(!is_globrecognizing && ORDERS.length > 0){
    recognition.start();
  }else{
    recognition.abort();
  }


  recognition.onstart = ()=>{
    is_globrecognizing = true;
    globsearch_voice_btn.querySelector('img').src='assets/images/recording.png';
  }

    recognition.onresult = async (res)=>{

      let last = res.resultIndex;
      if(res.results[last].isFinal){

        let finalRes = res.results[last][0].transcript;
        console.log(finalRes);
        let trans = await translateTamil(finalRes);
        console.log(trans.trim());
        
        let cleaned = trans.trim().toLowerCase().replace(/\s+/g,'');

        searchInput.value = cleaned;
        doSearch(cleaned);

        await delay(300);
          
        let i = cleaned.length;
        while(i >= 1){
          searchInput.value = cleaned.slice(0, i);
          doSearch(cleaned.slice(0,i));

          let isPres = checkGlobSearch();
          if(!isPres){
            console.log(searchInput.value);
            break;
          }
          i--;
        }

    
      }

    }

  recognition.onend = ()=>{
    console.log('Recognition End');
    recognition.abort();
    is_globrecognizing = false;
    globsearch_voice_btn.querySelector('img').src='assets/images/mic.png';

  } 

  recognition.onerror = ()=>{
    console.log('Globalsearch Recognition Error');
    recognition.abort();
    is_globrecognizing = false;
    globsearch_voice_btn.querySelector('img').src='assets/images/mic.png';

  }

}

// HELPER FUNC


function checkGlobSearch(){
  let rows = document.querySelectorAll('.otbl tbody tr');

  let is_empty = false;
  rows.forEach(row => {
    let td = row.querySelector('td').textContent;
    if(td.trim().toLowerCase().replace(/\s+/g,'') === 'noordersfound'){
      is_empty = true;
    }else{
      is_empty = false;
    }
  });

  return is_empty;
  
}




// TAMIL TO ENGLISH TRANSCRIPT
async function  translateTamil(text) {
  const res = await fetch(
    `https://api.mymemory.translated.net/get?q=${encodeURIComponent(text)}&langpair=ta|en`
  );
  const data = await res.json();
  return data.responseData.translatedText;
}



});