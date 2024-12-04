// Game variables
let mode = "Easy";
let round = 1;
let timeLeft = 40;
let score = 0;
let errorsLeft = Infinity; // Unlimited for Easy
let totalRounds = 10;
let timer;
let solution;

// Initialize the game
function startGame() {
    setupMode();
    nextRound();
}

// Configure game based on mode
function setupMode() {
    if (mode === "Easy") {
        errorsLeft = Infinity;
        timeLeft = 40;
        totalRounds = 10;
    } else if (mode === "Medium") {
        errorsLeft = 3;
        timeLeft = 20;
        totalRounds = 15;
    } else if (mode === "Hard") {
        errorsLeft = 0;
        timeLeft = 10;
        totalRounds = 20;
    }

    updateUI();
}

// Fetch quest and start timer
async function nextRound() {
    if (round > totalRounds) {
        advanceMode();
        return;
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
        score += 10;
        document.getElementById("note").innerText = "Correct!";
        clearTimeout(timer);
        round++;
        setTimeout(nextRound, 1000);
    } else {
        document.getElementById("note").innerText = "Incorrect!";
        errorsLeft = Math.max(0, errorsLeft - 1);
        if (errorsLeft === 0) {
            gameOver();
        }
    }

    updateUI();
}

// Start the timer
function startTimer() {
    clearTimeout(timer);
    timeLeft = mode === "Easy" ? 40 : mode === "Medium" ? 20 : 10;
    updateUI();

    timer = setInterval(() => {
        timeLeft--;
        updateUI();

        if (timeLeft <= 0) {
            clearTimeout(timer);
            if (errorsLeft > 0) {
                errorsLeft--;
            }
            document.getElementById("note").innerText = "Time's up!";
            if (errorsLeft === 0) {
                gameOver();
            } else {
                round++;
                setTimeout(nextRound, 1000);
            }
        }
    }, 1000);
}

// Advance to the next difficulty mode
function advanceMode() {
    if (mode === "Easy") {
        mode = "Medium";
    } else if (mode === "Medium") {
        mode = "Hard";
    } else {
        document.getElementById("note").innerText = "Congratulations! You completed all levels!";
        return;
    }

    round = 1;
    setupMode();
    nextRound();
}

// Game over
function gameOver() {
    document.getElementById("note").innerText = "Game Over!";
    clearTimeout(timer);
}

// Update UI elements
function updateUI() {
    document.getElementById("mode").innerText = mode;
    document.getElementById("time").innerText = timeLeft;
    document.getElementById("score").innerText = score;
    document.getElementById("errors").innerText = errorsLeft === Infinity ? "Unlimited" : errorsLeft;
    document.getElementById("round").innerText = `${round}/${totalRounds}`;
}

// Start the game on load
startGame();
