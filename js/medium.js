// Game variables for Medium Mode
let mode = "Medium";
let round = 1;
let timeLeft = 20; // Time limit for each round
let score = 0;
let errorsLeft = 3; // Maximum of 3 errors allowed
let totalRounds = 15; // Total rounds
let timer;
let solution;
let userName = "example2"; // Assuming the username is available

// Initialize the game for Medium mode
function startGame() {
    setupMediumMode();
    nextRound();
}

// Configure game settings for Medium mode
function setupMediumMode() {
    errorsLeft = 3; // Reset errors to 3
    timeLeft = 20; // Reset timer to 20 seconds
    totalRounds = 15; // Reset total rounds
    updateUI();
}

// Fetch question and start the timer for each round
async function nextRound() {
    if (round > totalRounds) {
        alert(`Medium mode completed! Your score is: ${score}`);
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
        setTimeout(nextRound, 1000); // Move to the next round
    } else {
        document.getElementById("note").innerText = "Incorrect!";
        errorsLeft--;
        if (errorsLeft <= 0) {
            gameOver(); // End game if errors reach the limit
        }
    }
    updateUI();
}

// Start the timer
function startTimer() {
    timeLeft = 20; // Reset timer for each round
    clearInterval(timer); // Clear any existing timer
    updateUI();

    timer = setInterval(() => {
        timeLeft--;
        updateUI();

        if (timeLeft <= 0) {
            clearInterval(timer); // Stop the timer when time is up
            document.getElementById("note").innerText = "Time's up!";
            errorsLeft--;
            if (errorsLeft <= 0) {
                gameOver(); // End game if errors reach the limit
            } else {
                round++;
                setTimeout(nextRound, 1000); // Move to the next round
            }
        }
    }, 1000); // Decrease time every second
}

// Game over
function gameOver() {
    document.getElementById("note").innerText = "Game Over!";
    clearInterval(timer); // Stop the timer
    alert(`Game Over! Try again. Your score is: ${score}`);
    saveScoreToDatabase(userName, score); // Save the score to the database
    window.location.href = "levelMenu.php"; // Redirect to the menu page
}

// Update UI elements
function updateUI() {
    document.getElementById("mode").innerText = mode;
    document.getElementById("time").innerText = timeLeft;
    document.getElementById("score").innerText = score;
    document.getElementById("errors").innerText = errorsLeft;
    document.getElementById("round").innerText = `${round}/${totalRounds}`;
}

// Function to send score to the database
function saveScoreToDatabase(userName, score) {
    fetch('mediumScore.php', {
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

