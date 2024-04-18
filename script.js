const url = window.location.href.split('/');

if (url.length == 4 && url[3] != '') {
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText != '') {
                window.location.href = this.responseText;
            }
        }
    }
    xhr.open('get', 'shortener.php?key='+url[3], true);
    xhr.send();
}

const regexp = /https?:\/\//;

let input, output, copyButton;

document.addEventListener('DOMContentLoaded', () => {
    input = document.getElementById('input-url');
    output = document.getElementById('output-url');
    copyButton = document.getElementById('copy-btn');
});

function shorten() {
    if (input.value.search(regexp) !== -1) {
        copyButton.disabled = false;
        const xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                output.innerText = 'Your shortened URL is: ' + this.responseText;
            }
        }
        xhr.open('post', 'shortener.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.send('url='+input.value);
    } else {
        alert('Provide a valid link!');
    }
}

function copy() {
    navigator.clipboard.writeText(output.innerText.slice(22));
}