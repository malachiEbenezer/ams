<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/ams/res/victory.fav.png" type="image/x-icon" />
    <link rel="stylesheet" href="/ams/css/register.css?v=<?php echo time(); ?>" type="text/css" />
    <link rel="stylesheet" href="/ams/css/action-css/printID.css?v=<?php echo time(); ?>" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jsbarcode/3.11.5/JsBarcode.all.min.js"></script>
    <title>Print ID | Attendance Management System</title>
    <style>
        /* Dynamic data overlay styles for skeletonID */
        .skeletonID {
            position: relative;
            display: inline-block;
        }
        
        .data-overlay {
            position: absolute;
            color: white;
            font-family: Arial, sans-serif;
            font-size: 12px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.8);
            pointer-events: none;
        }
        
        /* Front ID positioning */
        .front-name {
            top: 85px;
            left: 120px;
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .front-sex {
            top: 105px;
            left: 120px;
            font-size: 11px;
        }
        
        .front-birthdate {
            top: 120px;
            left: 120px;
            font-size: 11px;
        }
        
        .front-address {
            top: 135px;
            left: 120px;
            font-size: 10px;
            width: 200px;
            line-height: 1.2;
        }
        
        /* Back ID positioning */
        .back-emergency {
            top: 50px;
            left: 20px;
            font-size: 11px;
            width: 300px;
        }
        
        .back-date {
            bottom: 20px;
            right: 20px;
            font-size: 10px;
            font-weight: bold;
        }
        
        .print-button {
            margin: 20px;
            padding: 10px 20px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        
        .print-button:hover {
            background: #764ba2;
        }
        
        @media print {
            .print-button {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="paper">
        <div class="skeletonID" id="skeletonID">
            <img src="/ams/res/ID-F-Skeleton.png" alt="ID Front" id="frontID">
            <img src="/ams/res/ID-B-Skeleton.png" alt="ID Back" id="backID">
            
            <!-- Front ID Data Overlays -->
            <div class="data-overlay front-name" id="frontName">Loading...</div>
            <div class="data-overlay front-sex" id="frontSex">Sex: -</div>
            <div class="data-overlay front-birthdate" id="frontBirthdate">Birthdate: -</div>
            <div class="data-overlay front-address" id="frontAddress">Address: -</div>
            
            <!-- Back ID Data Overlays -->
            <div class="data-overlay back-emergency" id="backEmergency">
                <strong>Emergency Contact:</strong><br>
                <span id="emName">-</span><br>
                <span id="emContact">-</span><br>
                <span id="emAddress">-</span>
            </div>
            <div class="data-overlay back-date" id="backDate">Generated: <?php echo date('M j, Y'); ?></div>
        </div>
    </div>

    <button class="print-button" onclick="window.print()">Print ID</button>

    <script>
        // Function to populate ID card with data
        function populateIDCard() {
            // Get data from URL parameters
            const params = new URLSearchParams(window.location.search);
            
            // Front ID data
            const fName = params.get('f_name') || '';
            const mName = params.get('m_name') || '';
            const lName = params.get('l_name') || '';
            const suffix = params.get('suffix') || '';
            const sex = params.get('sex') || '';
            const birthdate = params.get('birth') || '';
            const address = params.get('address') || '';
            
            // Back ID data
            const emName = params.get('em_name') || '';
            const emContact = params.get('em_conNum') || '';
            const emAddress = params.get('em_address') || '';
            
            // Format full name
            let fullName = `${fName} ${mName} ${lName}`.trim();
            if (suffix) fullName += ` ${suffix}`;
            
            // Format birthdate
            let formattedBirthdate = birthdate;
            if (birthdate) {
                const date = new Date(birthdate);
                formattedBirthdate = date.toLocaleDateString('en-US', { 
                    year: 'numeric', 
                    month: 'long', 
                    day: 'numeric'
                });
            }
            
            // Populate the fields
            document.getElementById('frontName').textContent = fullName || 'No Name';
            document.getElementById('frontSex').textContent = 'Sex: ' + (sex || '-');
            document.getElementById('frontBirthdate').textContent = 'Birthdate: ' + (formattedBirthdate || '-');
            document.getElementById('frontAddress').textContent = 'Address: ' + (address || '-');
            
            // Back ID data
            document.getElementById('emName').textContent = emName || '-';
            document.getElementById('emContact').textContent = emContact || '-';
            document.getElementById('emAddress').textContent = emAddress || '-';
        }
        
        // Initialize the ID card when page loads
        document.addEventListener('DOMContentLoaded', function() {
            populateIDCard();
        });
    </script>
</body>
</html>
