const finalScore = document.getElementById("userStarwarsScoreDisplay");
const finalTime = document.getElementById("userStarwarsTimeDisplay");
const finalScoreHidden = document.getElementById("userStarwarsScore");
const finalTimeHidden = document.getElementById("userStarwarsTime");
const mostRecentScore = sessionStorage.getItem("mostRecentScore");
const mostRecentTime = sessionStorage.getItem("mostRecentTime");
const saveScoreBtn = document.getElementById("saveStarwarsScoreBtn");
const scoreboard = document.getElementById("starwarsScoreboard");

const MAX_QUESTIONS = 20;
const CORRECT_BONUS = 5;

finalScore.innerText = mostRecentScore + "/" + (MAX_QUESTIONS * CORRECT_BONUS);
finalTime.innerText = mostRecentTime + " seconds";
finalScoreHidden.value = mostRecentScore;
finalTimeHidden.value = mostRecentTime;