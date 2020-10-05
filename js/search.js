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
                typingTimer = setTimeout(() => getResults(), 1000);
            } else {
                resultsDiv.html("");
                isSpinnerVisible = false;
            }
        }
    
        previousValue = searchField.val();
    };

    function getResults() {

        $.getJSON(radiozapzapData.root_url + "/wp-json/radiozapzap/v1/search?keyword=" + searchField.val(), (results) => {
            resultsDiv.html(`
                <div class="row">
                    <div class="one-third">
                        <h2 class="search-overlay__section-title">General Information</h2>
                        ${results.generalInfo.length ? '<ul class-"link-list min-list">' : '<p>검색 결과 없음</p>'}
                        ${results.generalInfo.map(item => `<li><a href="${item.permalink}">${item.title}</a>
                        ${item.postType == "post" ? `by ${item.authorName}` : ''}</li>`).join('')}
                        ${results.generalInfo.length ? '</ul>' : ''}                        
                    </div>
                    <div class="one-third">
                        <h2 class="search-overlay__section-title">Projects</h2>
                        ${results.projects.length ? '<ul class-"link-list min-list">' : '<p>검색 결과 없음</p>'}
                        ${results.projects.map(item => `<li><a href="${item.permalink}">${item.title}</a></li>`).join('')}
                        ${results.projects.length ? '</ul>' : ''}                               
                    </div>
                </div>
            `);
            isSpinnerVisible = false;
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
        searchField.val('');
        setTimeout(() => searchField.focus(), 301);
        searchField.focus();
        isOverlayOpen = true;
    };

    function closeOverlay() {
        searchOverlay.removeClass("search-overlay--active");
        $("body").removeClass("body-no-scroll");
        isOverlayOpen = false;
    };
});
