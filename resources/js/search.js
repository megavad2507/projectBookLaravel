$('#search_input').on('input',function(el) {
    const searchText = $('#search_input').val();
    console.log(searchText);
    axios.get('/search?searchQuery=' + searchText)
        .then((response) => {
            console.log(response);
        });
});
