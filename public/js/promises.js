function asyncRequest(url) {
    fetch(url)
        .then(function(response) {
            return response.json();
        })
}

console.log(asyncRequest('https://fr.wikipedia.org/w/api.php?action=opensearch&search=zero&format=json'));