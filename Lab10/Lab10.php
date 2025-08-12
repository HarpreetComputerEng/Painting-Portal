<?php include("Header.php"); ?>

<h3>Select a genre:</h3>

<form>
    <select name="genre" onchange="showBooks(this.value)">
        <option value="">Select a genre</option>
        <option value="Computer">Computer</option>
        <option value="Fantasy">Fantasy</option>
        <option value="Romance">Romance</option>
        <option value="Horror">Horror</option>
        <option value="Science Fiction">Science Fiction</option>
    </select>
</form>

<br>
<div id="result"><b>Book details will appear here...</b></div>

<script>
function showBooks(str) {
    if (str == "") {
        document.getElementById("result").innerHTML = "";
        return;
    }

    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("result").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "Books.php?q=" + str, true);
    xhttp.send();
}
</script>

<?php include("Footer.php"); ?>
