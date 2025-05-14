<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🌾 ระบบติดตามแมลงศัตรูพืช | Smart Farming</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #5D9C59; /* เขียวธรรมชาติ */
            --secondary-color: #DDF7E3; /* เขียวอ่อน */
            --accent-color: #7FB77E; /* เขียวสด */
            --warning-color: #DF7861; /* สีแดงอิฐ */
            --light-color: #F7F5F2; /* เบจอ่อน */
            --dark-color: #3D5656; /* เทาเข้ม */
            --text-color: #333333;
            --bg-color: #F7F9F7; /* พื้นหลังเบจอ่อนนวล */
            --card-bg: #FFFFFF;
            --border-color: #E8EDED; /* ขอบสีอ่อน */
            --shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
            --border-radius: 16px;
            --spacing: 1.5rem;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Noto Sans Thai', sans-serif;
            background: var(--bg-color);
            color: var(--text-color);
            line-height: 1.6;
            padding: 0;
            margin: 0;
            min-height: 100vh;
        }
        
        .header {
            background: var(--primary-color);
            padding: var(--spacing);
            text-align: center;
            border-bottom: 1px solid var(--border-color);
            color: white;
            box-shadow: var(--shadow);
        }
        
        .header h1 {
            font-size: 1.6rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .dashboard {
            max-width: 1200px;
            margin: var(--spacing) auto;
            padding: 0 var(--spacing);
        }
        
        .summary-bar {
            background: var(--secondary-color);
            border-radius: var(--border-radius);
            padding: var(--spacing);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: var(--spacing);
            box-shadow: var(--shadow);
        }
        
        .summary-item {
            text-align: center;
            padding: 0 1rem;
        }
        
        .summary-item strong {
            font-size: 2rem;
            color: var(--primary-color);
            display: block;
        }
        
        .summary-label {
            font-size: 0.9rem;
            color: var(--dark-color);
        }
        
        .container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
            gap: var(--spacing);
            margin-bottom: var(--spacing);
        }
        
        .card {
            background: var(--card-bg);
            padding: var(--spacing);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            border: 1px solid var(--border-color);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }
        
        .card-header {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid var(--border-color);
        }
        
        .card-header i {
            font-size: 1.5rem;
            color: var(--primary-color);
            margin-right: 0.75rem;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--secondary-color);
            border-radius: 50%;
        }
        
        .card h3 {
            font-size: 1.1rem;
            font-weight: 500;
            color: var(--text-color);
            flex-grow: 1;
        }
        
        .card-status {
            background: var(--secondary-color);
            color: var(--primary-color);
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 1rem;
            font-weight: 500;
        }
        
        .value-container {
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            position: relative;
            margin: 1.5rem 0;
        }
        
        .value {
            font-size: 4rem;
            font-weight: 300;
            color: var(--primary-color);
            text-align: center;
            background: var(--secondary-color);
            width: 180px;
            height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 0 auto;
            box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.05);
            border: 4px solid var(--light-color);
            position: relative;
        }
        
        .value-icon {
            font-size: 1.5rem;
            position: absolute;
            right: -5px;
            top: -5px;
            background: white;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            border: 2px solid var(--accent-color);
            box-shadow: var(--shadow);
        }
        
        .critical .value {
            background: #FDDFD7;
            color: var(--warning-color);
            border-color: var(--warning-color);
        }
        
        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 1rem;
            border-top: 1px solid var(--border-color);
            font-size: 0.9rem;
            color: var(--dark-color);
        }
        
        .trend {
            display: flex;
            align-items: center;
            gap: 5px;
            color: var(--accent-color);
        }
        
        .trend-up {
            color: var(--warning-color);
        }
        
        .trend-down {
            color: var(--primary-color);
        }
        
        .pest-actions {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
        }
        
        .action-button {
            background: transparent;
            border: 1px solid var(--accent-color);
            color: var(--accent-color);
            border-radius: var(--border-radius);
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.2s ease;
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }
        
        .action-button:hover {
            background: var(--accent-color);
            color: white;
        }
        
        .warning {
            border-color: var(--warning-color);
            color: var(--warning-color);
        }
        
        .warning:hover {
            background: var(--warning-color);
            color: white;
        }
        
        .refresh-time {
            background: var(--card-bg);
            padding: var(--spacing);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: var(--spacing);
            border: 1px solid var(--border-color);
        }
        
        .refresh-btn {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: var(--border-radius);
            cursor: pointer;
            font-size: 0.875rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s ease;
        }
        
        .refresh-btn:hover {
            background: var(--accent-color);
            transform: translateY(-2px);
        }
        
        .interval-selector {
            padding: 0.5rem;
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            background: var(--card-bg);
            color: var(--text-color);
            font-size: 0.875rem;
            margin-left: 1rem;
        }
        
        .empty-value {
            color: var(--border-color);
            font-style: italic;
        }
        
        .footer {
            text-align: center;
            padding: var(--spacing);
            color: var(--dark-color);
            font-size: 0.875rem;
            background: var(--secondary-color);
            border-top: 1px solid var(--border-color);
            margin-top: var(--spacing);
        }
        
        .zone-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: var(--secondary-color);
            color: var(--primary-color);
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 1rem;
            font-weight: 500;
        }
        
        @media (max-width: 768px) {
            .container {
                grid-template-columns: 1fr;
            }
            
            .summary-bar {
                flex-direction: column;
                gap: 1rem;
            }
            
            .refresh-time {
                flex-direction: column;
                gap: 1rem;
            }
            
            .interval-selector {
                margin: 0.5rem 0;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1><i class="fas fa-leaf"></i> ระบบติดตามแมลงศัตรูพืช | Smart Farming Dashboard</h1>
    </div>

    <div class="dashboard">
        <div class="summary-bar">
            <div class="summary-item">
                <strong id="total-pests">0</strong>
                <span class="summary-label">แมลงทั้งหมดวันนี้</span>
            </div>
            <div class="summary-item">
                <strong id="total-zones">2</strong>
                <span class="summary-label">จำนวนโซน</span>
            </div>
            <div class="summary-item">
                <strong id="active-alerts">0</strong>
                <span class="summary-label">แจ้งเตือน</span>
            </div>
            <div class="summary-item">
                <strong id="weather">28°C</strong>
                <span class="summary-label">อุณหภูมิ</span>
            </div>
        </div>

        <div class="container">
            <div class="card" id="sheet1-d2-card">
                <div class="zone-badge">โซน A</div>
                <div class="card-header">
                    <i class="fas fa-bug"></i>
                    <h3>ตั๊กแตนที่ตรวจพบ</h3>
                    <span class="card-status">ออนไลน์</span>
                </div>
                <div class="value-container">
                    <div class="value">
                        <span id="sheet1-d2-value" class="empty-value">0</span>
                        <span class="value-icon">🦗</span>
                    </div>
                </div>
                <div class="card-footer">
                    <span>อัพเดทล่าสุด: <span id="sheet1-d2-time">-</span></span>
                    <span class="trend trend-up"><i class="fas fa-arrow-up"></i> +2 (24 ชม.)</span>
                </div>
                <div class="pest-actions">
                    <button class="action-button"><i class="fas fa-camera"></i> ดูภาพ</button>
                    <button class="action-button warning"><i class="fas fa-bell"></i> ตั้งเตือน</button>
                </div>
            </div>
            
            <div class="card" id="sheet1-e2-card">
                <div class="zone-badge">โซน A</div>
                <div class="card-header">
                    <i class="fas fa-worm"></i>
                    <h3>หนอนที่ตรวจพบ</h3>
                    <span class="card-status">ออนไลน์</span>
                </div>
                <div class="value-container">
                    <div class="value">
                        <span id="sheet1-e2-value" class="empty-value">0</span>
                        <span class="value-icon">🐛</span>
                    </div>
                </div>
                <div class="card-footer">
                    <span>อัพเดทล่าสุด: <span id="sheet1-e2-time">-</span></span>
                    <span class="trend trend-down"><i class="fas fa-arrow-down"></i> -3 (24 ชม.)</span>
                </div>
                <div class="pest-actions">
                    <button class="action-button"><i class="fas fa-camera"></i> ดูภาพ</button>
                    <button class="action-button"><i class="fas fa-chart-line"></i> ดูแนวโน้ม</button>
                </div>
            </div>
        </div>
        
        <div class="container">
            <div class="card critical" id="sheet2-d2-card">
                <div class="zone-badge">โซน B</div>
                <div class="card-header">
                    <i class="fas fa-bug"></i>
                    <h3>ตั๊กแตนที่ตรวจพบ</h3>
                    <span class="card-status">ออนไลน์</span>
                </div>
                <div class="value-container">
                    <div class="value">
                        <span id="sheet2-d2-value" class="empty-value">0</span>
                        <span class="value-icon">🦗</span>
                    </div>
                </div>
                <div class="card-footer">
                    <span>อัพเดทล่าสุด: <span id="sheet2-d2-time">-</span></span>
                    <span class="trend trend-up"><i class="fas fa-arrow-up"></i> +12 (24 ชม.)</span>
                </div>
                <div class="pest-actions">
                    <button class="action-button"><i class="fas fa-camera"></i> ดูภาพ</button>
                    <button class="action-button warning"><i class="fas fa-spray-can"></i> จัดการ</button>
                </div>
            </div>
            
            <div class="card" id="sheet2-e2-card">
                <div class="zone-badge">โซน B</div>
                <div class="card-header">
                    <i class="fas fa-worm"></i>
                    <h3>หนอนที่ตรวจพบ</h3>
                    <span class="card-status">ออนไลน์</span>
                </div>
                <div class="value-container">
                    <div class="value">
                        <span id="sheet2-e2-value" class="empty-value">0</span>
                        <span class="value-icon">🐛</span>
                    </div>
                </div>
                <div class="card-footer">
                    <span>อัพเดทล่าสุด: <span id="sheet2-e2-time">-</span></span>
                    <span class="trend"><i class="fas fa-equals"></i> 0 (24 ชม.)</span>
                </div>
                <div class="pest-actions">
                    <button class="action-button"><i class="fas fa-camera"></i> ดูภาพ</button>
                    <button class="action-button"><i class="fas fa-chart-line"></i> ดูแนวโน้ม</button>
                </div>
            </div>
        </div>
        
        <div class="refresh-time">
            <span>อัพเดทล่าสุด: <span id="last-update-time">-</span></span>
            <div>
                <select id="update-interval" class="interval-selector">
                    <option value="3000">ทุก 3 วินาที</option>
                    <option value="5000">ทุก 5 วินาที</option>
                    <option value="10000" selected>ทุก 10 วินาที</option>
                    <option value="30000">ทุก 30 วินาที</option>
                    <option value="60000">ทุก 1 นาที</option>
                </select>
                <button id="manual-refresh" class="refresh-btn">
                    <i class="fas fa-sync-alt"></i> อัพเดทข้อมูล
                </button>
            </div>
        </div>
    </div>

    <div class="footer">
        &copy; <span id="current-year"></span> ระบบติดตามแมลงศัตรูพืช | Smart Farming Dashboard
    </div>

    <script>
        // ตั้งค่าพื้นฐาน
        const spreadsheetId = '1Qp4sOxtHleHZPaUoyWK6bcM--LX-rm2omzTPGAIj_TA';
        const apiKey = 'AIzaSyBFSCGY_HxpxlvwuWoaCsmm2eiFsM75NSg';
        const sheets = ['Sheet1', 'Sheet2'];
        let updateInterval = 10000; // ค่าเริ่มต้น 10 วินาที
        let intervalId = null;
        
        // ข้อมูลจำลอง (สำหรับตัวอย่าง)
        const mockData = {
            Sheet1: { 'D2': '6', 'E2': '3' },
            Sheet2: { 'D2': '14', 'E2': '2' }
        };
        
        // แสดงปีปัจจุบัน
        document.getElementById('current-year').textContent = new Date().getFullYear();
        
        // ฟังก์ชันสำหรับการดึงข้อมูลจาก Google Sheets API
        async function fetchSheetData() {
            try {
                const data = {};
                
                for (const sheetName of sheets) {
                    const range = `${sheetName}!D2:E2`;
                    const url = `https://sheets.googleapis.com/v4/spreadsheets/${spreadsheetId}/values/${range}?key=${apiKey}`;
                    
                    try {
                        const response = await fetch(url);
                        if (!response.ok) {
                            throw new Error(`API request failed with status ${response.status}`);
                        }
                        
                        const json = await response.json();
                        
                        if (json.values && json.values[0]) {
                            data[sheetName] = {
                                'D2': json.values[0][0] || '0',
                                'E2': json.values[0][1] || '0'
                            };
                        } else {
                            data[sheetName] = { 'D2': '0', 'E2': '0' };
                        }
                    } catch (error) {
                        console.error(`Error fetching data for ${sheetName}:`, error);
                        // ใช้ข้อมูลจำลองเมื่อการเชื่อมต่อ API ล้มเหลว
                        data[sheetName] = mockData[sheetName];
                    }
                }
                
                updateDashboard(data);
                updateLastRefreshTime();
                updateSummaryData(data);
            } catch (error) {
                console.error('Error fetching data:', error);
                // ใช้ข้อมูลจำลองเมื่อการเชื่อมต่อ API ล้มเหลว
                updateDashboard(mockData);
                updateLastRefreshTime();
                updateSummaryData(mockData);
            }
        }
        
        // ฟังก์ชันสำหรับอัพเดทข้อมูลสรุป
        function updateSummaryData(data) {
            // คำนวณจำนวนแมลงทั้งหมด
            const totalPests = parseInt(data.Sheet1.D2) + parseInt(data.Sheet1.E2) + 
                               parseInt(data.Sheet2.D2) + parseInt(data.Sheet2.E2);
            document.getElementById('total-pests').textContent = totalPests;
            
            // สมมติว่ามีการแจ้งเตือนเมื่อค่ามากกว่า 10
            const alerts = (parseInt(data.Sheet1.D2) > 10 ? 1 : 0) + 
                           (parseInt(data.Sheet1.E2) > 10 ? 1 : 0) + 
                           (parseInt(data.Sheet2.D2) > 10 ? 1 : 0) + 
                           (parseInt(data.Sheet2.E2) > 10 ? 1 : 0);
            document.getElementById('active-alerts').textContent = alerts;
        }
        
        // ฟังก์ชันสำหรับอัพเดทเวลาล่าสุด
        function updateLastRefreshTime() {
            const now = new Date();
            const formattedDate = `${padZero(now.getDate())}/${padZero(now.getMonth() + 1)}/${now.getFullYear()} ${padZero(now.getHours())}:${padZero(now.getMinutes())}:${padZero(now.getSeconds())}`;
            document.getElementById('last-update-time').textContent = formattedDate;
            
            // อัพเดทเวลาสำหรับแต่ละการ์ด
            document.getElementById('sheet1-d2-time').textContent = `${padZero(now.getHours())}:${padZero(now.getMinutes())}`;
            document.getElementById('sheet1-e2-time').textContent = `${padZero(now.getHours())}:${padZero(now.getMinutes())}`;
            document.getElementById('sheet2-d2-time').textContent = `${padZero(now.getHours())}:${padZero(now.getMinutes())}`;
            document.getElementById('sheet2-e2-time').textContent = `${padZero(now.getHours())}:${padZero(now.getMinutes())}`;
        }
        
        // ฟังก์ชันเติม 0 ข้างหน้าตัวเลขที่น้อยกว่า 10
        function padZero(num) {
            return num < 10 ? `0${num}` : num;
        }
        
        // ฟังก์ชันสำหรับอัพเดทข้อมูลในแดชบอร์ด
        function updateDashboard(data) {
            // อัพเดทข้อมูลจาก Sheet1
            updateCardData('sheet1-d2', data.Sheet1.D2);
            updateCardData('sheet1-e2', data.Sheet1.E2);
            
            // อัพเดทข้อมูลจาก Sheet2
            updateCardData('sheet2-d2', data.Sheet2.D2);
            updateCardData('sheet2-e2', data.Sheet2.E2);
        }
        
        // ฟังก์ชันสำหรับอัพเดทข้อมูลในการ์ด
        function updateCardData(cardId, value) {
            const valueElement = document.getElementById(`${cardId}-value`);
            const cardElement = document.getElementById(`${cardId}-card`);
            
            // ตรวจสอบว่าข้อมูลมีหรือไม่
            if (value === 'N/A' || value === 'Error' || value === '' || value === null || value === undefined) {
                valueElement.className = 'empty-value';
                valueElement.textContent = '0';
            } else {
                valueElement.className = '';
                valueElement.textContent = value;
                
                // เพิ่มคลาส 'critical' ถ้าค่ามากกว่า 10
                if (parseInt(value) > 10) {
                    cardElement.classList.add('critical');
                } else {
                    cardElement.classList.remove('critical');
                }
            }
        }
        
        // ฟังก์ชันเริ่มต้นการอัพเดทอัตโนมัติ
        function startAutoUpdate(interval) {
            // ยกเลิก interval เดิม (ถ้ามี)
            if (intervalId) {
                clearInterval(intervalId);
            }
            
            // ตั้งค่า interval ใหม่
            updateInterval = interval;
            intervalId = setInterval(fetchSheetData, updateInterval);
            
            // อัพเดทข้อมูลทันที
            fetchSheetData();
        }
        
        // เริ่มต้นการทำงานเมื่อหน้าเว็บโหลดเสร็จ
        document.addEventListener('DOMContentLoaded', function() {
            // เริ่มต้นการอัพเดทอัตโนมัติ
            startAutoUpdate(updateInterval);
            
            // กำหนดการทำงานเมื่อเปลี่ยนช่วงเวลาอัพเดท
            document.getElementById('update-interval').addEventListener('change', function() {
                startAutoUpdate(parseInt(this.value));
            });
            
            // กำหนดการทำงานเมื่อกดปุ่มรีเฟรชด้วยตนเอง
            document.getElementById('manual-refresh').addEventListener('click', function() {
                this.innerHTML = '<i class="fas fa-sync-alt fa-spin"></i> กำลังโหลด...';
                fetchSheetData().then(() => {
                    this.innerHTML = '<i class="fas fa-sync-alt"></i> อัพเดทข้อมูล';
                });
            });
        });
    </script>
</body>
</html>