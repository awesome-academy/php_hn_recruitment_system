function toggleCVViewer() {
    document.querySelector('.cv-container').classList.toggle('hidden');
}
document.querySelectorAll('#view-cv').forEach((viewCVButton) => {
    viewCVButton.addEventListener('click', (event) => {
        toggleCVViewer();
        document.querySelector('.cv-viewer').src = event.target.value;
    });
});

document.querySelector('.cv-overlay').addEventListener('click', () => {
    toggleCVViewer();
});
