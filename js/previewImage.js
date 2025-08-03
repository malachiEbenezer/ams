// Function to preview the selected image
function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('previewImage');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block'; // Show the image
        }
        reader.readAsDataURL(file);
    } else {
        preview.src = '/ams/res/icon-user.png';
        preview.style.display = 'block'; // Show the default image if no file is selected
    }
}

// Attach event listener to the file input after the DOM is fully loaded
document.addEventListener('DOMContentLoaded', function() {
    const profileInput = document.getElementById('studentPhoto');
    const preview = document.getElementById('previewImage');

    // Initialize the default photo
    preview.src = '/ams/res/icon-user.png';
    preview.style.display = 'block'; // Show the default image

    profileInput.addEventListener('change', previewImage);
});
