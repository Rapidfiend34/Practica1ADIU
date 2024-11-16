// Get the header element
const header = document.getElementById('cabecera');

// Get the computed height of the header
const headerHeight = header.offsetHeight;

// Use the header height in your CSS
document.documentElement.style.setProperty('--header-height', `${headerHeight}px`);
