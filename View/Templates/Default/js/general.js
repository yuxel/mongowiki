$(document).ready( function() {
    $("a._blank, .wiki_content a:not(.wiki_url)").click( function() {
        href = $(this).attr("href");
        window.open ( href );
        return false;
    });
});

