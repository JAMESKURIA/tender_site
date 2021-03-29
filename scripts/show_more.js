const Utils = {
    addClass: function (element, theClass) {
      element.classList.add(theClass);
    },
  
    removeClass: function (element, theClass) {
      element.classList.remove(theClass);
    },
  
    showMore: function (element, excerpt) {
      this.removeClass(excerpt, "excerpt-visible");
      this.addClass(excerpt, "excerpt-hidden");
  
      element.addEventListener("click", (e) => {
        const linktext = e.target.textContent.toLowerCase();
        e.preventDefault();
  
        if (linktext == "show more ...") {
          element.textContent = "... show less";
          this.addClass(excerpt, "excerpt-visible");
          this.removeClass(excerpt, "excerpt-hidden");
        } else {
          element.textContent = "show more ...";
          this.removeClass(excerpt, "excerpt-visible");
          this.addClass(excerpt, "excerpt-hidden");
        }
      });
    },
  };
  
  const excerptWidget = {
    showMore: function (showMoreLinksTarget, excerptTarget) {
      const showMorelinks = Array.from(document.querySelectorAll(showMoreLinksTarget));

      showMorelinks.forEach((link) => {
        const excerpt = link.parentElement.querySelector(excerptTarget);
  
        Utils.showMore(link, excerpt);
      });
    },
  };

  excerptWidget.showMore(".js-show-more", ".js-excerpt");