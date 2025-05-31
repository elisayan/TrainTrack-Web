function searchSub(departure, destination, type, duration) {
    form.method = 'GET';
    form.action = 'search-subscriptions-results.php';
    
    const addInput = (name, value) => {
        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = name;
        input.value = value;
        form.appendChild(input);
    };

    addInput('departure-station', departure);
    addInput('destination-station', destination);
    addInput('duration', duration);
    addInput('train-type', type);
    
    document.body.appendChild(form);
    form.submit();
}

document.addEventListener('DOMContentLoaded', function() {
    initializeDateTime();
    
    const subCards = document.querySelectorAll('.sub-card');
    subCards.forEach(card => {
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