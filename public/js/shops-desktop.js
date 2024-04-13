function sendProductSearchRequest(event) {
    if (event.key === 'Enter')
    {
        var userInput = document.getElementById('searchShopInput').value;
        var url = 'http://localhost:8080/getProducts?phrase=' + encodeURIComponent(userInput);
    
        // You can use fetch API to send the GET request
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(data => {
                var parser = new DOMParser();
                // Parse the HTML string into a DOM Document
                var doc = parser.parseFromString(data, 'text/html');
    
                // Handle the response data as needed
                console.log(doc);
    
                document.getElementById('shops-list').innerHTML = doc.getElementById('shops-list').innerHTML;
    
                setupAsyncRequests()
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
    }
}

function sendGetProductRequest(destinationURI) {
    var url = destinationURI

    // You can use fetch API to send the GET request
    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.text();
        })
        .then(data => {
            var parser = new DOMParser();
            // Parse the HTML string into a DOM Document
            var doc = parser.parseFromString(data, 'text/html');

            // Handle the response data as needed
            console.log(doc);

            document.getElementById('shop-description').innerHTML = doc.getElementById('shop-description').innerHTML;

        })
        .catch(error => {
            console.error('There was a problem with the fetch operation:', error);
        });
}

function setupAsyncRequests()
{
    var products_list = document.getElementById("shops-list");
    var productLinks = products_list.getElementsByTagName('a');
         for (var i = 0; i < productLinks.length; i++) {
             productLinks[i].addEventListener('click', function(event) {
                 event.preventDefault();
                 var productId = this.getAttribute('href');
                 sendGetProductRequest(productId)
             });
         }
}

setupAsyncRequests()

document.getElementById('profile_basic_view').style.removeProperty('height');