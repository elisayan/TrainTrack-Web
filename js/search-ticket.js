// Initialize date and time inputs with current values
function initializeDateTime() {
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0');
    const day = String(today.getDate()).padStart(2, '0');
    const hours = String(today.getHours()).padStart(2, '0');
    const minutes = String(today.getMinutes()).padStart(2, '0');

    document.getElementById('data_partenza').value = `${year}-${month}-${day}`;
    document.getElementById('orario_partenza').value = `${hours}:${minutes}`;
}

// Update ticket quantity
function updateTickets(inputId, change) {
    const input = document.getElementById(inputId);
    let value = parseInt(input.value) + change;
    if (value < 0) value = 0; 
    input.value = value;
}

// Search route from carousel click
function searchRoute(departure, destination) {
    // Get current date and time
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0');
    const day = String(today.getDate()).padStart(2, '0');
    const hours = String(today.getHours()).padStart(2, '0');
    const minutes = String(today.getMinutes()).padStart(2, '0');

    // Create a form dynamically
    const form = document.createElement('form');
    form.method = 'GET';
    form.action = 'search-tickets-results.php';
    
    // Add hidden inputs
    const addInput = (name, value) => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = name;
        input.value = value;
        form.appendChild(input);
    };

    addInput('stazione_partenza', departure);
    addInput('stazione_arrivo', destination);
    addInput('data_partenza', `${year}-${month}-${day}`);
    addInput('orario_partenza', `${hours}:${minutes}`);
    addInput('numero_biglietti_adulti', '1');
    addInput('numero_biglietti_bambini', '0');
    
    // Submit the form
    document.body.appendChild(form);
    form.submit();
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    initializeDateTime();
    
    // Add hover effects to route cards
    const routeCards = document.querySelectorAll('.route-card');
    routeCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px)';
            this.style.boxShadow = '0 0.5rem 1rem rgba(0, 0, 0, 0.15)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = '';
            this.style.boxShadow = '';
        });
    });
});