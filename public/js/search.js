var btn_search = document.getElementById("btn-search");

var input_search = document.getElementById("input-search");''


btn_search.addEventListener("click", function(){

    if (input_search.value !== null && input_search.value.trim() !== "") {

        var urlpage = "https://graficaaffinity.com.br/produto/" + encodeURIComponent(input_search.value);
        
        window.location.href = urlpage;
    }

});
