const finalScore = document.getElementById("userDisneyScoreDisplay");
const finalTime = document.getElementById("userDisneyTimeDisplay");
const finalScoreHidden = document.getElementById("userDisneyScore");
const finalTimeHidden = document.getElementById("userDisneyTime");
const mostRecentScore = sessionStorage.getItem("mostRecentScore");
const mostRecentTime = sessionStorage.getItem("mostRecentTime");
const saveScoreBtn = document.getElementById("saveDisneyScoreBtn");
const scoreboard = document.getElementById("disneyScoreboard");

const MAX_QUESTIONS = 20;
const CORRECT_BONUS = 5;

finalScore.innerText = mostRecentScore + "/" + (MAX_QUESTIONS * CORRECT_BONUS);
finalTime.innerText = mostRecentTime + " seconds";
finalScoreHidden.value = mostRecentScore;
finalTimeHidden.value = mostRecentTime;