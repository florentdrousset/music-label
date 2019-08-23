// VARIABLES

var div = document.querySelector('.hidden');
var button = document.querySelector('.btn');

// FUNCTIONS

function asyncRequest() {
    fetch(`artist/${id}/same-style`)
        .then(function(response) {
            return response.json();
        })
}

function hide() {
    div.classList.toggle('hidden');
}

// EVENT LISTENERS

button.addEventListener('click', hide, true);
