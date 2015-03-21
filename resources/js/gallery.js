$(document).ready(function() {
    // Initialize the tabsController that handles the tab behaviour and loads the defined content
    var tabsCtrl = new TabsController({
        tabs: [
            {
                url: "My Images",
                id: "my-images-tab"
            },
            {
                url: "Images",
                id: "images-tab"
            },
            {
                url: "Saved Images",
                id: "saved-images-tab"
            } 
        ],
        tabsElement: "tabs a",
        activeClass: "active"
    });
    
    // Initialize the ratingController function that handles the ratings for each image
    ratingController({ 
        emptyClass: "icon-star-outline", 
        filledClass: "icon-star", 
        url: "tempUrl" 
    });

    // Initialize the filterController that handles the filters
    filterController({
        filters: [
            {
                url: "one",
                selector: ".user-filter"
            },
            {
                url: "two",
                selector: ".date-filter"
            },
            {
                url: "three",
                selector: ".rating-filter"
            }
        ],
        filterCallback: function(e) { // e.data contains the needed information
            // Make an ajax request with the url and load the correct data
            console.log(tabsCtrl.currentTab);
        },
        clickElements: [
            ".filter-btn",
            ".filter-name"
        ],
        clickCallback: function() {
            $(".filter-menu").slideToggle(450);
        },
    });

    // Initialize the imageViewer that handles the gallery part
    var gallery = new ImageViewer({});

    // Change event for the upload image input
    $("#fileInput").change(function(){
        // Display options for the selected image upload
        $(".popup-panel").show();
        $(".opacity-cover").show();

        // Fill the panel with the right information
        $(".popup-panel").html('<h3>Upload Preview</h3><img src="#" id="image-preview" alt=""><p class="option"><span class="option-name">EFIX data</span><span class="option-checkbox icon-check-box-outline-blank"></span></p><div class="btn-group"><button class="final-upload-btn">Upload</button><button class="cancel">Cancel</button></div>');

        // Display preview of the selected image inside the panel
        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#image-preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        }
    });

    // Click Events
    $(".opacity-cover").click(function() {
        // Hide everything that uses this cover
        $(".popup-panel").hide();
        $(".image-viewer").hide();
        $(this).hide();
    });

    $(document).on("click", ".popup-panel button.cancel", function() {
        // Close the panel
        closePopupPanel();
    });
    $(document).on("click", ".option-checkbox", function() {
        if($(this).hasClass("icon-check-box-outline-blank")) {
            $(this).removeClass("icon-check-box-outline-blank").addClass("icon-check-box");
        }else {
            $(this).removeClass("icon-check-box").addClass("icon-check-box-outline-blank");
        }
    });
    
    $(".add-image-btn").click(function() { // Click event for the button that adds a new image
        $("#fileInput").click();
    });
    $(document).on("click", ".final-upload-btn", function() { // Click event for the button that adds a new image
        // Upload the image
        alert("Uploaded");
    });

    $(".search-btn").click(function() {
        // Display input and animate the width
        $(".search-bar").animate({width: "150px", marginLeft: "10px"});

        // Set focus on input
        $(".search-bar").focus();

        // Catch the keyup event
        $(".search-bar").keyup(function() {
            // Make an ajax request with the value in the search bar
        });
    });
    $(".menu-btn").click(function() { // Click event for the menu button in the header
        $(".misc-menu").slideToggle(250);
    });
    $(".logout-btn").click(function() {
        window.location.href = "/user/logout";
    });
});

// Controls the behaviour of the filters
var filterController = (function(options) {
    // Default values
    var defaults = {
        filters: [ // Example: { url: "", selector: "./#example" } 

        ],
        filterCallback: function() { // Runs after the AJAX request to the filter url

        },
        clickElements: [ // Elements that trigger the clickCallback

        ],
        clickCallback: function() { // Triggered from clickElements, and is used to display the nav

        },
    };

    // Merge our options with our defaults
    var settings = $.extend({}, defaults, options);

    // Add click events to each entry in settings.clickElements
    for(var i = 0; i < settings.clickElements.length; i++) {
        // Add click event that calls the clickCallback, which normally opens the menu
        $(document).on("click", settings.clickElements[i], settings.clickCallback);
    }

    // Loop through each filter and add click events to each that runs the filterCallback
    for(var i = 0; i < settings.filters.length; i++) {
        // Add click event that sends the correct filter object to the callback
        $(settings.filters[i].selector).click(settings.filters[i], settings.filterCallback);
    }
});

// Rating system that between different numbers (i.e. 1-5)
var ratingController = (function(options) {
    // Default values
    var defaults = {
        emptyClass: "empty-rating",
        filledClass: "filled-rating",
        url: ""
    };

    // Merge our options with our defaults
    var settings = $.extend({}, defaults, options);

    // When the empty rating unit is hovered
    $("." + settings.emptyClass).mouseover(function() {
        // Exchange all hovered and previous outlined stars with filled stars
        $(this).prevAll().andSelf().removeClass(settings.emptyClass).addClass(settings.filledClass);

        // Default back to original outlined stars
        $(this).mouseleave(function() {
            $(this).prevAll().andSelf().removeClass(settings.filledClass).addClass(settings.emptyClass);                
        });

        // If clicked, make an AJAX request with the number of stars chosen
        var stars = $(this).index() + 1; // Number of stars picked

        // Exchange the stars for the average rating
    });
});

// Controls the behaviour of tabs and the content to be loaded
var TabsController = function(options) {
    var defaults = {
        tabs: [ // Format {url: "", id: ""}

        ],
        tabsElement: "tabs a",
        activeClass: "active"
    }, 
    _self = this;
    
    // Merge our options with our defaults
    var settings = $.extend({}, defaults, options);
    
    // Set currentTab to the first tab
    this.currentTab = settings.tabs[0];

    // Loop through each tab and add events to each
    $("." + settings.tabsElement).each(function() {
        $(this).click(function() {
            // Remove the active class from the active tab
            $("." + settings.tabsElement + "." + settings.activeClass).removeClass(settings.activeClass);

            // Add the active class to the clicked tab
            $(this).addClass(settings.activeClass);

            // Load the correct content for each tab
            for(var i = 0; i < settings.tabs.length; i++) {
                if(settings.tabs[i].id == $(this).attr("id")) {
                    console.log(settings.tabs[i].url);
                    // Make an ajax request to the url, and load the content

                    // Set the right tab
                    _self.currentTab = settings.tabs[i];
                }
            }
        });
    });
};

// Allows us to view images in a bigger format
var ImageViewer = function(options) {
    // Default values, serves as an overview of the options
    this.defaults = {
        galleryContainer: ".gallery",
        popupGalleryContainer: ".image-viewer",
        thumbExt: "",
        clickSelector: ".image-wrapper > a",
        backgroundSelector: ".opacity-cover"
    },
    self = this,
    this.extractedData = [],
    this.currentImageIndex;

    // Merge our options with our defaults
    this.settings = $.extend({}, this.defaults, options);

    // Extract all the images data
    this.extractImageDatas();
    
    console.log(this.extractedData);
    // Close button click event
    $(".close").click(function() {
        $(self.settings.popupGalleryContainer).hide();
        $(self.settings.backgroundSelector).hide();
    });

    // Add click event to each
    $(this.settings.galleryContainer + " .image-wrapper a").each(function() {
        $(this).click(function(e) {
            e.preventDefault();

            // Initialize the panel
            self.initPanel();

            // Open clicked image
            self.showImage($(this).parent().index());

            // Update the position of the panel after the image has loaded
            self.positionPanel();

            // Initialize the buttons
            self.initBtns();
        });
    });
}
// Shows the galleryContainer and positions it
ImageViewer.prototype.initPanel = function() {
    // Position and show the galleryContainer
    $(".opacity-cover").show();
};
ImageViewer.prototype.positionPanel = function() {
    $(this.settings.popupGalleryContainer).css({top: "100px", left: $(window).outerWidth() / 2 - $(this.settings.popupGalleryContainer).width() / 2, display: "block"});

    // Resize event, that centers the container
    $(window).resize(function() {
        $(self.settings.popupGalleryContainer).css({top: "100px", left: $(window).outerWidth() / 2 - $(self.settings.popupGalleryContainer).width() / 2});
        $(".btn-prev, .btn-next").css("top", $(self.settings.popupGalleryContainer + " section img").height() / 2 - $(self.settings.popupGalleryContainer + " section .btn-prev").height());
    });
};
// Adds the prev and next buttons, and their behaviour
ImageViewer.prototype.initBtns = function() {
    // Position the prev and next buttons
    $(this.settings.popupGalleryContainer + " .btn-prev, " + this.settings.popupGalleryContainer + " .btn-next").css({top: $(this.settings.popupGalleryContainer + " section img").height() / 2 - $(this.settings.popupGalleryContainer + " section .btn-prev").height()});

    // Behaviour for prev button
    $(this.settings.popupGalleryContainer + " .btn-prev").unbind("click").click(function() {
        self.prevImage();
    });

    // Behaviour for next button
    $(this.settings.popupGalleryContainer + " .btn-next").unbind("click").click(function() {
        self.nextImage();
    });
};
// Updates the visibility of the prev and next buttons
ImageViewer.prototype.updateBtns = function() {
    // Check the bounds of the current image, and hide when needed
    if(this.currentImageIndex == 0) {
        $(this.settings.popupGalleryContainer + " .btn-prev").hide();
    }else {
        $(this.settings.popupGalleryContainer + " .btn-prev").show();
    }
    if(this.currentImageIndex == this.extractedData.length - 1) {
        $(this.settings.popupGalleryContainer + " .btn-next").hide();
    }else {
        $(this.settings.popupGalleryContainer + " .btn-next").show();
    }
};
// Extracts the data from the specified images in the galleryContainer
ImageViewer.prototype.extractImageDatas = function() {
    // Extract all data from the wrappers inside the container
    $(this.settings.galleryContainer + " .image-wrapper .image-data").each(function() {
        // Parse JSON data and append it to this.extractedData
        self.extractedData.push(JSON.parse($(this).html()));
    });
};
// Shows the specified id
ImageViewer.prototype.showImage = function(id) {
    // Set the current image index
    this.currentImageIndex = id;
    
    // Update the buttons so we don't accidentally go out of bounds
    this.updateBtns();

    // Load data
    $(this.settings.popupGalleryContainer + " section img").attr("src", this.extractedData[id].image_src);
    $(this.settings.popupGalleryContainer + " header h3").html(this.extractedData[id].title);
    // Load other data too
};
// Show the previous image
ImageViewer.prototype.prevImage = function() {
    this.showImage(this.currentImageIndex - 1);
};
// Show the next image
ImageViewer.prototype.nextImage = function() {
    this.showImage(this.currentImageIndex + 1);
};

var closePopupPanel = (function() {
    $(".popup-panel").hide();
    $(".opacity-cover").hide();
});