<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Shortener</title>
    <script src="script.js"></script>
</head>
<body>
    <div>
        <input type="url" id="input-url" required>
        <label for="input-url">Type URL you wish to be shortened:</label>
        <button onclick="shorten()">Submit</button>
    </div>

    <p id="output-url"></p>
    <button disabled="disabled" id="copy-btn" onclick="copy()">Copy</button>
</body>
</html>