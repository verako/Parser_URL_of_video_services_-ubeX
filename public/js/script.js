
function showForm() {
    document.getElementById("edit_desc").hidden = false;
    document.getElementById("desc").hidden = true;
    document.getElementById("edit").hidden = true;
}

function showDesc() {
    document.getElementById("edit_desc").hidden = true;
    document.getElementById("desc").hidden = false;
    document.getElementById("edit").hidden = false;
}