class Search {
  constructor() {
    this.$ = jQuery;
    this.openButton = document.querySelector('.js-search-trigger');
    this.closeButton = this.$('.search-overlay__close');
    this.searchOverlay = this.$('.search-overlay');
    this.events();
  }

  events() {
    // this.openButton.on('click', this.openOverlay.bind(this));
    // this.closeButton.on('click', this.closeOverlay.bind(this));

  }

  openOverlay() {
    this.searchOverlay.addClass('search-overlay--active');
    this.$('body').addClass('body-no-scroll');
  }

  closeOverlay() {
    this.searchOverlay.removeClass('search-overlay--active');
    this.$('body').removeClass('body-no-scroll');
  }
}

export default Search;