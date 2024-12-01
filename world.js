document.addEventListener("DOMContentLoaded", function () {
    const button = document.getElementById("lookup");
    const results = document.getElementById("result");
    const input = document.getElementById("country");

    button.addEventListener("click", function () {
        const value = input.value.trim() // Get the input value
        fetch(`http://localhost:8888/info2180-lab5/world.php?countryww=${encodeURIComponent(value)}`)
            .then(response => response.text())
            .then(data => results.innerHTML = data)  // Display the results in the result div
            .catch(error => alert(error));  // Display error if the fetch fails
    });
});