jQuery(document).ready(function( $ ) {

    var openButton = $(".js-search-trigger");
    var searchOverlay = $(".search-overlay");
    var closeButton =  $(".search-overlay__close");
    var searchField = $("#search-term");
    var resultsDiv = $("#search-overlay__results");

    var typingTimer;
    var isSpinnerVisible = false;
    var isOverlayOpen = false;
    var previousValue;

    openButton.on('click', function() {
        openOverlay();
    })

    closeButton.on('click', function() {
        closeOverlay();
    });

    $(document).on('kwydown', function() {
        keyPressDispatcher();
    });

    searchField.on('keyup', function(e) {
        typingLogic();
    });

    function typingLogic() {
        if (searchField.val() != previousValue) {
            clearTimeout(typingTimer);
        
            if (searchField.val()) {
                if (!isSpinnerVisible) {
                    resultsDiv.html('<div class="spinner-loader"></div>');
                    isSpinnerVisible = true;
                }
                typingTimer = setTimeout(getResults(), 2000);
            } else {
                resultsDiv.html("");
                isSpinnerVisible = false;
            }
        }
    
        previousValue = searchField.val();
    };

    function getResults() {
        $.getJSON(radiozapzapData.root_url + "/wp-json/wp/v2/posts?search=" + searchField.val(), function (posts) {
            resultsDiv.html(`
                <h2 class="search-overlay__section-title">General Information</h2>
                ${posts.length ? '<ul class-"link-list min-list">' : '<p>검색 결과 없음</p>'}
                    ${posts.map(item => `<li><a href="${item.link}">${item.title.rendered}</li>`).join('')}
                ${posts.length ? '</ul>' : ''}
            `);
        });
    }

    function keyPressDispatcher(e) {
        if (e.keyCode == 83 && !isOverlayOpen && !$("input, textarea").is(":focus")) {
            openOverlay();
        }

        if (e.keyCode == 27 && isOverlayOpen) {
            closeOverlay();
        }
    }

    function openOverlay() {
        searchOverlay.addClass("search-overlay--active");
        $("body").addClass("body-no-scroll");
        isOverlayOpen = true;
    };

    function closeOverlay() {
        searchOverlay.removeClass("search-overlay--active");
        $("body").removeClass("body-no-scroll");
        isOverlayOpen = false;
    };
});
