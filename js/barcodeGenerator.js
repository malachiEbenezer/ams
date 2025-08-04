// Function to generate barcode based on form data
function generateBarcode() {
    // Get form data
    const firstName = document.getElementById('firstName').value || 'Unknown';
    const lastName = document.getElementById('lastName').value || 'Unknown';
    const middleName = document.getElementById('middleName').value || '';
    const birthDate = document.getElementById('birth').value || '';
    
    // Check if required fields are filled
    if (!firstName || firstName === 'Unknown' || !lastName || lastName === 'Unknown') {
        alert('Please fill in the required First Name and Last Name fields before generating the barcode.');
        return;
    }
    
    // Create a unique identifier for the student with VPSC format
    // Using a base format VPSC-00000000001 and incrementing number
    const studentId = 'VPSC-00000000001';
    
    // Create barcode container
    const barcodeContainer = document.getElementById('checkBarcode');
    
    // Get the canvas element
    const canvas = barcodeContainer.querySelector('#studentBarcode');
    
    if (canvas) {
        // Update existing barcode with the new student ID
        JsBarcode(canvas, studentId, {
            format: "CODE128",
            displayValue: true,
            fontSize: 14,
            textMargin: 5,
            margin: 5,
            lineColor: "#003d8b"
        });
    }
    
    // Update student information below the barcode
    const existingDetails = barcodeContainer.querySelector('.student-details');
    if (existingDetails) {
        // Update the existing details
        const studentInfo = existingDetails.querySelector('p:nth-child(1)');
        const codeInfo = existingDetails.querySelector('p:nth-child(2)');
        
        if (studentInfo) {
            studentInfo.textContent = `Student: ${firstName} ${middleName} ${lastName}`;
        }
        
        if (codeInfo) {
            codeInfo.textContent = `Code: ${studentId}`;
        }
    } else {
        // If no existing details, create them (this shouldn't happen in normal flow)
        // Add student information below the barcode
        const infoContainer = document.createElement('div');
        infoContainer.className = 'student-details';
        infoContainer.style.textAlign = 'left';
        infoContainer.style.marginTop = '15px';
        infoContainer.style.marginLeft = '20px';
        
        const info = document.createElement('p');
        info.textContent = `Student: ${firstName} ${middleName} ${lastName}`;
        info.style.margin = '5px 0';
        
        const codeInfo = document.createElement('p');
        codeInfo.textContent = `Code: ${studentId}`;
        codeInfo.style.margin = '5px 0';
        
        infoContainer.appendChild(info);
        infoContainer.appendChild(codeInfo);
        barcodeContainer.appendChild(infoContainer);
    }
}

// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    // Add event listener to the submit button to generate barcode
    const submitButton = document.getElementById('generateBarcodeBtn');
    if (submitButton) {
        submitButton.addEventListener('click', function(e) {
            e.preventDefault(); // Prevent default form submission
            generateBarcode(); // Generate barcode when submit button is clicked
        });
    }
    
    // Generate the barcode lines on page load (without details)
    const barcodeContainer = document.getElementById('checkBarcode');
    if (barcodeContainer) {
        // Create canvas element for barcode
        const canvas = document.createElement('canvas');
        canvas.id = 'studentBarcode';
        barcodeContainer.appendChild(canvas);
        
        // Generate barcode using JsBarcode with the default format
        // Using placeholder text that will result in the same width as the generated code
        JsBarcode(canvas, 'VPSC-00000000001', {
            format: "CODE128",
            displayValue: true,
            fontSize: 14,
            textMargin: 5,
            margin: 5,
            lineColor: "#003d8b"
        });
        
        // Add placeholder labels for student information below the barcode
        const infoContainer = document.createElement('div');
        infoContainer.className = 'student-details';
        infoContainer.style.textAlign = 'left';
        infoContainer.style.marginTop = '15px';
        infoContainer.style.marginLeft = '20px';
        
        const info = document.createElement('p');
        info.textContent = 'Student: ';
        info.style.margin = '5px 0';
        
        const codeInfo = document.createElement('p');
        codeInfo.textContent = 'Code: VPSC-XXXXXXXXXXX';
        codeInfo.style.margin = '5px 0';
        
        infoContainer.appendChild(info);
        infoContainer.appendChild(codeInfo);
        barcodeContainer.appendChild(infoContainer);
    }
});
