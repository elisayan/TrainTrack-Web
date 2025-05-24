function cloneStation() {
    const template = document.getElementById('station-template');
    const clone = template.content.cloneNode(true);
    document.getElementById('stazioni-container').appendChild(clone);
}
