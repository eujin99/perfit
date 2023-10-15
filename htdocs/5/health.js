
function showDifficultyButtons() {
    var incrementButton = document.getElementById("increment");
    var decrementButton = document.getElementById("decrement");
    incrementButton.classList.add("hidden");
    decrementButton.classList.add("hidden");

    var easyButton = document.getElementById("easy");
    var normalButton = document.getElementById("normal");
    var hardButton = document.getElementById("hard");
    easyButton.classList.remove("hidden");
    normalButton.classList.remove("hidden");
    hardButton.classList.remove("hidden");
}

function showTabs() {
    var easyButton = document.getElementById("easy");
    var normalButton = document.getElementById("normal");
    var hardButton = document.getElementById("hard");
    easyButton.classList.add("hidden");
    normalButton.classList.add("hidden");
    hardButton.classList.add("hidden");

    var tabs = document.getElementById("tabs");
    tabs.classList.remove("hidden");
}

function showContent(tabId) {
    var content = document.getElementById("content");
    content.innerHTML = "";

    if (tabId === "tab1") {
        content.innerHTML = "내용 1";
    } else if (tabId === "tab2") {
        content.innerHTML = "내용 2";
    } else if (tabId === "tab3") {
        content.innerHTML = "내용 3";
    }
}