function sendProductSearchRequest(event) {
    if (event.key === 'Enter') {
        var userInput = document.getElementById('searchProductInput').value;
        // Construct the new URL
        var newURL = 'http://localhost:8080/products?phrase=' + encodeURIComponent(userInput);
        // Redirect to the new page
        window.location.href = newURL;
    }
}

function sendShopSearchRequest(event) {
    if (event.key === 'Enter') {
        var userInput = document.getElementById('searchShopInput').value;
        // Construct the new URL
        var newURL = 'http://localhost:8080/shops?phrase=' + encodeURIComponent(userInput);
        // Redirect to the new page
        window.location.href = newURL;
    }
}

document.getElementById('profile_basic_view').style.removeProperty('height');
