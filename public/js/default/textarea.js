document.addEventListener("DOMContentLoaded", function() {
    const textarea = document.querySelector("textarea");
    textarea.focus();
    textarea.setSelectionRange(textarea.value.length, textarea.value.length);
});
