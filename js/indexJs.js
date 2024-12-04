var backgroundMusic = document.getElementById('backgroundMusic');
var muteButton = document.getElementById('muteButton');

// Function to play audio
function playAudio() {
    backgroundMusic.play(); // Start playing the music after user interaction
}

// Function to toggle mute
function toggleMute() {
    if (backgroundMusic.muted) {
        backgroundMusic.muted = false;
        muteButton.textContent = '🔊';  // Unmute and show the 'sound' icon
    } else {
        backgroundMusic.muted = true;
        muteButton.textContent = '🔇';  // Mute and show the 'mute' icon
    }
}
