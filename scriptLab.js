// Function to show Lab Incharge details
function showLabInchargeDetails() {
    document.getElementById('labInchargeDetails').style.display = 'block';
    // Hide other sections
    hideAllSectionsExcept('labInchargeDetails');
}

// Function to show Dashboard details
function showDashboardDetails() {
    document.getElementById('dashboardDetails').style.display = 'block';
    // Hide other sections
    hideAllSectionsExcept('dashboardDetails');
}

// Function to show PC details
function showPCDetails() {
    document.getElementById('pcDetails').style.display = 'block';
    // Hide other sections
    hideAllSectionsExcept('pcDetails');
}



// Function to show Lab Availability details
function showLabAvailabilityDetails() {
    document.getElementById('labAvailabilityDetails').style.display = 'block';
    // Hide other sections
    hideAllSectionsExcept('labAvailabilityDetails');
}

// Function to hide all sections except the one passed in
function hideAllSectionsExcept(exceptId) {
    const sections = document.querySelectorAll('.details-section');
    sections.forEach(section => {
        if (section.id !== exceptId) {
            section.style.display = 'none';
        }
    });
}
