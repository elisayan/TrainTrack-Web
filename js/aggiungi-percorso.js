function cloneStation() {
    const container = document.getElementById('stazioni-container');
    const template  = document.getElementById('station-template');
    const clone     = template.content.cloneNode(true);
    container.appendChild(clone);
}