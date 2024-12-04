// Game variables for Hard Mode
let mode = "Hard";
let round = 1;
let timeLeft = 10; // Time limit for each round
let score = 0;
let totalRounds = 20; // Total rounds for Hard Mode
let timer;
let solution;

// Initialize the game for Hard mode
function startGame() {
    setupHardMode();
    nextRound();
}

// Configure game settings for Hard mode
function setupHardMode() {
    timeLeft = 10; // Reset timer to 10 seconds
    totalRounds = 20; // Total rounds set to 20
    updateUI();
}

// Fetch question and start the timer for each round
async function nextRound() {
    if (round > totalRounds) {
        alert("Hard mode completed! Congratulations!");
        window.location.href = "levelMenu.php"; // Redirect to the menu page
        return; // Stop the game
    }

    const response = await fetch("https://marcconrad.com/uob/banana/api.php");
    const data = await response.json();
    solution = data.solution;
    document.getElementById("quest").src = data.question;
    document.getElementById("note").innerText = "Quest is ready.";
    generateAnswerButtons();
    startTimer();
}

// Generate buttons for answers
function generateAnswerButtons() {
    const answersDiv = document.getElementById("answers");
    answersDiv.innerHTML = "";
    for (let i = 0; i <= 9; i++) {
        const button = document.createElement("button");
        button.innerText = i;
        button.onclick = () => handleAnswer(i);
        answersDiv.appendChild(button);
    }
}

// Handle player's answer
function handleAnswer(answer) {
    if (answer === solution) {
        score += 10; // Increase score by 10 for correct answers
        document.getElementById("note").innerText = "Correct!";
        clearTimeout(timer);
        round++;
        setTimeout(nextRound, 1000); // Move to the next round
    } else {
        gameOver("Incorrect answer! Game over."); // End game on incorrect answer
    }
    updateUI();
}

// Start the timer
function startTimer() {
    timeLeft = 10; // Reset timer for each round
    clearInterval(timer); // Clear any existing timer
    updateUI();

    timer = setInterval(() => {
        timeLeft--;
        updateUI();

        if (timeLeft <= 0) {
            clearInterval(timer); // Stop the timer
            gameOver("Time's up! Game over."); // End game if time runs out
        }
    }, 1000); // Decrease time every second
}

// Game over
function gameOver(message) {
    clearInterval(timer); // Stop the timer
    document.getElementById("note").innerText = message;
    alert(message);
    window.location.href = "levelMenu.php"; // Redirect to the menu page
}

// Update UI elements
function updateUI() {
    document.getElementById("mode").innerText = mode;
    document.getElementById("time").innerText = timeLeft;
    document.getElementById("score").innerText = score;
    document.getElementById("round").innerText = `${round}/${totalRounds}`;
}

// Start the game on load
startGame();
