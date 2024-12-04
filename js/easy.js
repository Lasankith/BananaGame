// Game variables for Easy Mode
let mode = "Easy";
let round = 1;
let timeLeft = 40;
let score = 0;
let errorsLeft = Infinity; // Unlimited for Easy
let totalRounds = 10;
let timer;
let solution;
let userName = "kamal"; // Assuming the username is available

// Initialize the game for Easy mode
function startGame() {
    setupEasyMode();
    nextRound();
}

// Configure game settings for Easy mode
function setupEasyMode() {
    errorsLeft = Infinity;
    timeLeft = 40; // Reset the timer at the start of the game
    totalRounds = 10;
    updateUI();
}

// Fetch question and start the timer for each round
async function nextRound() {
    if (round > totalRounds) {
        alert(`Easy mode completed! Your score is: ${score}`);
        saveScoreToDatabase(userName, score); // Save the score to the database
        window.location.href = "levelMenu.php"; // Redirect to the menu page after the alert
        return;  // Stop the game when rounds are completed
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
    // Reset timeLeft when a new round starts
    timeLeft = 40;
    clearInterval(timer); // Clear the previous timer if any
    updateUI();

    timer = setInterval(() => {
        timeLeft--;
        updateUI();

        if (timeLeft <= 0) {
            clearInterval(timer); // Stop the timer
            document.getElementById("note").innerText = "Time's up!";
            if (errorsLeft > 0) {
                errorsLeft--;
            }
            if (errorsLeft === 0) {
                gameOver();
            } else {
                round++;
                setTimeout(nextRound, 1000);
            }
        }
    }, 1000); // Decrease time every second
}

// Game over
function gameOver() {
    document.getElementById("note").innerText = "Game Over!";
    clearInterval(timer); // Stop the timer
}

// Update UI elements
function updateUI() {
    document.getElementById("mode").innerText = mode;
    document.getElementById("time").innerText = timeLeft;
    document.getElementById("score").innerText = score;
    document.getElementById("errors").innerText = errorsLeft === Infinity ? "Unlimited" : errorsLeft;
    document.getElementById("round").innerText = `${round}/${totalRounds}`;
}

// Function to send score to the database
function saveScoreToDatabase(userName, score) {
    fetch('save_score.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `userName=${encodeURIComponent(userName)}&score=${score}`
    })
    .then(response => response.text())
    .then(data => {
        console.log("Score saved:", data);
    })
    .catch(error => {
        console.error("Error saving score:", error);
    });
}

// Start the game on load
startGame();
