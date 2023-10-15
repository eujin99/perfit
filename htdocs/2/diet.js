function showContent(tableId) {
    var incrementTable = document.getElementById('incrementTable');
    var decrementTable = document.getElementById('decrementTable');

    if (tableId === 'increment') {
        incrementTable.style.display = 'table';
        decrementTable.style.display = 'none';
    } else if (tableId === 'decrement') {
        incrementTable.style.display = 'none';
        decrementTable.style.display = 'table';
    }
}