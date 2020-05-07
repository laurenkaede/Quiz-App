const finalScore = document.getElementById("userScoreDisplay");
const finalTime = document.getElementById("userTimeDisplay");
const finalScoreHidden = document.getElementById("userScore");
const finalTimeHidden = document.getElementById("userTime");
const mostRecentScore = sessionStorage.getItem("mostRecentScore");
const mostRecentTime = sessionStorage.getItem("mostRecentTime");
const saveScoreBtn = document.getElementById("saveScoreBtn");
const scoreboard = document.getElementById("scoreboard");

const MAX_QUESTIONS = 20;
const CORRECT_BONUS = 5;

finalScore.innerText = mostRecentScore + "/" + (MAX_QUESTIONS * CORRECT_BONUS);
finalTime.innerText = mostRecentTime + " seconds";
finalScoreHidden.value = mostRecentScore;
finalTimeHidden.value = mostRecentTime;