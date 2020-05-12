const finalScore = document.getElementById("userAvengersScoreDisplay");
const finalTime = document.getElementById("userAvengersTimeDisplay");
const finalScoreHidden = document.getElementById("userAvengersScore");
const finalTimeHidden = document.getElementById("userAvengersTime");
const mostRecentScore = sessionStorage.getItem("mostRecentScore");
const mostRecentTime = sessionStorage.getItem("mostRecentTime");
const saveScoreBtn = document.getElementById("saveAvengersScoreBtn");
const scoreboard = document.getElementById("avengersScoreboard");

const MAX_QUESTIONS = 20;
const CORRECT_BONUS = 5;

finalScore.innerText = mostRecentScore + "/" + (MAX_QUESTIONS * CORRECT_BONUS);
finalTime.innerText = mostRecentTime + " seconds";
finalScoreHidden.value = mostRecentScore;
finalTimeHidden.value = mostRecentTime;