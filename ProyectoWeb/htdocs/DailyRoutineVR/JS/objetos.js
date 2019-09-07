$(document).ready(function() {
    // make code pretty
    window.prettyPrint && prettyPrint();

    $('#search').multiselect({
        search: {
            left: '<input type="text" name="q" class="form-control" placeholder="Buscar..." />',
            right: '<input type="text" name="q" class="form-control" placeholder="Buscar..." />',
        },
        fireSearch: function(value) {
            return value.length > 0;
        }
    });
});