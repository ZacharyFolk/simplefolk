////////////////////////////////////
//                                //
//    Light Dark Mode switcher    //
//                                //
////////////////////////////////////
/* Observes click of checkbox label and adds/removes a body class and cookie */

document.addEventListener('DOMContentLoaded', function () {
  const modebutton = document.querySelector('.mode-button');
  const listItem = document.getElementById('event-toggle');
  const modetoggle = document.getElementById('mode-toggle');
  if (listItem) {
    listItem.addEventListener('click', function () {
      modetoggle.checked = !modetoggle.checked;
      modetoggle.dispatchEvent(new Event('change'));
      if (modetoggle.checked) {
        document.body.classList.add('lightmode');
        document.cookie = `mode=light; path=/; max-age=${60 * 60 * 24 * 14};`;
      } else {
        document.body.classList.remove('lightmode');
        document.cookie = `mode=dark; path=/; max-age=${60 * 60 * 24 * 14};`;
      }
    });


    /**
     * Get the value of a cookie
     * Source: https://gist.github.com/wpsmith/6cf23551dd140fb72ae7
     * @param  {String} name  The name of the cookie
     * @return {String}       The cookie value
     */
    function getCookie(name) {
      let value = `; ${document.cookie}`;
      let parts = value.split(`; ${name}=`);
      if (parts.length === 2) return parts.pop().split(';').shift();
    }

    // load this early?
    function cookieCheck() {
      let mode = getCookie('mode');
      if (mode == 'light') {
        modetoggle.checked = true;
        document.body.classList.add('lightmode');
      }
    }

    cookieCheck();
  }
});

/////////////////////////////////////////
//                                     //
//    Initialize isotope containers    //
//                                     //
/////////////////////////////////////////

var elem = document.querySelector('.archive-container');

if (elem) {
  imagesLoaded(elem, function (instance) {
    var iso = new Isotope(elem, {
      itemSelector: '.archive-card',
      layoutMode: 'masonry',
      masonry: {
        columnWidth: '.archive-card',
        gutter: 0,
      },
    });

    var tagFilters = document.querySelectorAll('.tag-buttons button');

    tagFilters.forEach(function (button) {
      button.addEventListener('click', function () {
        var filterValue = this.getAttribute('data-category');
        iso.arrange({ filter: filterValue });
        document
          .querySelector('.tag-buttons button.active')
          .classList.remove('active');
        this.classList.add('active');
      });
    });
  });
}

// var tags = document.querySelector('.tag-container');

// if (tags) {
//   imagesLoaded(tags, function (instance) {
//     var iso = new Isotope(tags, {
//       itemSelector: '.archive-card',
//       layoutMode: 'masonry',
//       masonry: {
//         columnWidth: '.dumb-masonry-sizer',
//         fitWidth: true,
//       },
//     });
//   });
// }

// https://github.com/biati-digital/glightbox/blob/master/README.md
const lightbox = GLightbox({
  skin: 'clean simple',
});

// this is kind of painful but I see options are either build a custom Guttenberg gallery
// mainly to add the glightbox class to the href rather than the parent OR
// do this and change format so all images for the lightbox are .glightbox > figure > a (link to full size)

const lightbox2 = GLightbox({
  selector: ' .single-post figure a',
  skin: 'clean simple',
});

// lightbox.on('open', () => {
//   alert('i am opening');
// });



/* Carousel */
/* https://www.wiktorwisniewski.dev/blog/build-simple-javascript-slider */

function delta(oldPoint, newPoint) {
  return newPoint - oldPoint;
}

function readPoint(event, isMouse) {
  return isMouse ? event.screenX : (event.changedTouches && event.changedTouches[0].clientX) || event.screenX;
}

function toPercent(value, width) {
  return (value / width) * 100;
}

function invert(value) {
  return value * -1;
}
function isNegative(number) {
  return !Object.is(Math.abs(number), +number);
}

function easeInOutCubic(x) {
  return x < 0.5 ? 4 * x * x * x : 1 - Math.pow(-2 * x + 2, 3) / 2;
}

function compose(...functions) {
  return function (args) {
    return functions.reduceRight((arg, fn) => fn(arg), args);
  }
}


class Carousel {
  constructor(containerReference, options) {
    this.container = containerReference;
    this.state = {
      isMouse: false,
      currentPosition: 0,
      offset: 0,
      size: {
        width: 0,
        slidePercentageWidth: 0
      }
    };

    const defaults = {}

    this.sliderOptions = { ...defaults, ...options }

    this.#countSlides();
    this.#setCarouselSizes();
  }

  #countSlides() {
    const slides = this.container.querySelectorAll('.carousel-slide');
    this.state.slidesCount = slides.length;
  }

  #getMaxWidth() {
    const { slidesCount } = this.state;
    const { slidePercentageWidth } = this.#measureCarousel();
    return slidesCount * slidePercentageWidth;
  }

  #getOffsetHighestPoint() {
    const { slidesCount } = this.state;
    const { slidePercentageWidth } = this.#measureCarousel();
    return (slidesCount - 1) * slidePercentageWidth;
  }

  #measureContainerElement() {
    const { width: containerWidth } = this.container.getBoundingClientRect();
    return containerWidth;
  }

  #measureSlide() {
    const { width: slideWidth } = this.container.firstElementChild.getBoundingClientRect();
    return slideWidth;
  }

  #measureCarousel() {
    const containerWidth = this.#measureContainerElement();
    const slideWidth = this.#measureSlide();
    const slidePercentageWidth = parseInt(((slideWidth / containerWidth) * 100).toFixed(0), 10);

    return { containerWidth, slidePercentageWidth }
  }

  #setCarouselSizes() {
    const { containerWidth, slidePercentageWidth } = this.#measureCarousel();
    const maxWidth = this.#getMaxWidth();
    const offsetMax = this.#getOffsetHighestPoint();
    this.state.size = {
      maxWidth,
      offsetMax,
      width: containerWidth,
      slidePercentageWidth
    }
  }

  resize() {
    this.#setCarouselSizes();
  }
}
const SlideTo = Carousel => class extends Carousel {
  #animateSmoothly(offset) {
    this.container.style.transition = 'transform ease-in-out .2s';
    this.container.style.transform = `translateX(${offset}%)`;
  }

  #endAnimation() {
    requestAnimationFrame(() => cancelAnimationFrame(this.state.raf));
  }

  #limitSlideTo({ target, max }) {
    let slideTo = 0;
    if (target > max) {
      slideTo = max;
    } else if (target < 1) {
      slideTo = 1;
    } else {
      slideTo = target;
    }
    return slideTo;
  }

  #parseSlideTo(targetSlide) {
    const {
      slideCount,
      state: {
        size: {
          slidePercentageWidth
        }
      }
    } = this;

    const limitedAnimateTo = this.#limitSlideTo({ target: targetSlide, max: slideCount });
    const ARRAY_OFFSET = 1;

    return (limitedAnimateTo - ARRAY_OFFSET) * invert(slidePercentageWidth);
  }

  handleAnimation(offset) {
    this.state.raf = requestAnimationFrame(() => {
      this.#animateSmoothly(offset);
    })

    return offset;
  }

  slideTo(targetSlide) {
    const validatedTarget = this.#parseSlideTo(targetSlide);

    this.handleAnimation(validatedTarget);
    this.state.currentPosition = validatedTarget;

    this.#endAnimation();
  }
}
const Drag = Carousel => class extends Carousel {
  constructor(containerReference, options) {
    super(containerReference, options);
    this.#attachActivationEvents();
  }

  #animateRough() {
    const { offset } = this.state;
    this.container.style.transition = '';
    this.container.style.transform = `translateX(${offset}%)`;
  }

  #animateSmoothly(offset) {
    this.container.style.transition = 'transform ease-in-out .8s';
    this.container.style.transform = `translateX(${offset}%)`;
  }

  #attachActivationEvents() {
    const { container } = this;
    if (container) {
      container.addEventListener('contextmenu', this.handleUp);
      container.addEventListener('mousedown', this.#handleDown);
      container.addEventListener('touchcancel', this.handleUp);
      container.addEventListener('touchstart', this.#handleDown, { passive: true });
    }
  }

  #attachInteractionEvents() {
    const node = !this.state.isMouse ? this.container : document;
    if (node) {
      node.addEventListener('mousemove', this.#handleMove);
      node.addEventListener('mouseup', this.handleUp);
      node.addEventListener('touchend', this.handleUp);
      node.addEventListener('touchmove', this.#handleMove, { passive: true });
    }
  }
  #calculateDragOffset(event) {
    const {
      currentPosition,
      isMouse,
      pointerPosition,
      size: {
        width: containerWidth
      }
    } = this.state;

    const currentPoint = readPoint(event, isMouse);
    const pointerOffsetMade = delta(pointerPosition, currentPoint);
    const pointerOffsetInPercents = toPercent(pointerOffsetMade, containerWidth);
    const carouselOffset = currentPosition + pointerOffsetInPercents;

    this.state.offset = carouselOffset;
  }

  #drag() {
    this.removeInteractionEvents();
    this.#stopDrag();
  }

  #handleDown = (event) => {
    const { type } = event;
    this.state.isMouse = type === 'mousedown';
    this.#attachInteractionEvents();
    this.#startDrag();
    this.#setCurrentDragPosition(event);
  }
  #handleDrag = (event) => {
    this.#calculateDragOffset(event);
    this.handleAnimation();
  }

  #handleMove = (event) => {
    const { isDragging } = this.state;
    if (isDragging) this.#handleDrag(event);
  }

  removeInteractionEvents() {
    const node = !this.state.isMouse ? this.container : document;
    if (node) {
      node.removeEventListener('mousemove', this.#handleMove);
      node.removeEventListener('mouseup', this.handleUp);
      node.removeEventListener('touchend', this.handleUp);
      node.removeEventListener('touchmove', this.#handleMove, { passive: true });
    }
  }
  #setCurrentDragPosition(event) {
    const { isMouse } = this.state;
    this.state.pointerPosition = readPoint(event, isMouse);
  }

  #startDrag() {
    this.state.isDragging = true;
  }

  #stopDrag() {
    const { offset } = this.state;
    this.state.isMouse = false;
    this.state.isDragging = false;
    this.state.currentPosition = offset;
  }

  handleAnimation(inputOffset) {
    this.state.raf = requestAnimationFrame(() => {
      if (typeof inputOffset !== 'undefined') {
        this.#animateSmoothly(inputOffset);
      } else {
        this.#animateRough();
      }
    })

    return typeof inputOffset !== 'undefined' ? inputOffset : this.state.offset;
  }
  handleUp = (event) => {
    this.#drag();

  }
}
const Snap = Carousel => class extends Carousel {
  #getOffsetMade(dataSource) {
    const {
      isMouse,
      pointerPosition,
      size: {
        width: containerWidth
      }
    } = this.state;

    const currentPoint = readPoint(dataSource, isMouse);
    const offsetMade = delta(pointerPosition, currentPoint);
    return toPercent(offsetMade, containerWidth);
  }

  #detectInMarginOffset(offsetMade, marginSize) {
    return Math.abs(offsetMade) <= marginSize;
  }

  #finishSnap(offset) {
    this.removeInteractionEvents();
    this.state.isDragging = false;
    this.state.currentPosition = offset;
    this.state.isMouse = false;
    requestAnimationFrame(() => cancelAnimationFrame(this.state.raf));
  }

  #getOffsetInSlides(offset) {
    const { slidePercentageWidth } = this.state.size;
    const slideSize = offset / slidePercentageWidth;
    return slideSize < 0 ? Math.ceil(slideSize) : Math.floor(slideSize);
  }

  #getSlideToValue(slideBy, inMargin) {
    const { slidePercentageWidth } = this.state.size;
    const backwardMovement = isNegative(slideBy);
    const MOVE_OFFSET = 1;

    const snapForward = () => this.state.currentPosition + (slideBy - MOVE_OFFSET) * slidePercentageWidth;
    const snapBackward = () => this.state.currentPosition + (slideBy + MOVE_OFFSET) * slidePercentageWidth;
    const stay = () => this.state.currentPosition

    if (inMargin) {
      return stay();
    } else if (backwardMovement) {
      return snapForward();
    } else {
      return snapBackward();
    }
  }

  #getSnapOffset(event) {
    const { slideCount } = this;

    const offsetMade = this.#getOffsetMade(event);
    const isInMargin = this.#detectInMarginOffset(offsetMade, 10);
    const slideBy = this.#getOffsetInSlides(offsetMade);
    const calculatedOffset = this.#getSlideToValue(slideBy, isInMargin);
    const limitedOffset = this.#validateSlideToValue(calculatedOffset);
    const offset = slideCount === Infinity ? calculatedOffset : limitedOffset;
    return offset;
  }

  #stopAnimation(finalOffset) {
    cancelAnimationFrame(this.state.snapRaf);
    this.state.offset = finalOffset;
  }

  #validateSlideToValue(inputOffset) {
    const {
      size: {
        slidePercentageWidth,
        maxWidth,
      }
    } = this.state;

    const CAROUSEL_START_POINT = 0;
    const GAP_ON_END = 100 - slidePercentageWidth;
    const CAROUSEL_END_POINT = -(maxWidth) + slidePercentageWidth + GAP_ON_END;

    if (inputOffset > CAROUSEL_START_POINT) {
      return 0;
    } else if (inputOffset < CAROUSEL_END_POINT) {
      return CAROUSEL_END_POINT;
    } else {
      return inputOffset;
    }
  }

  animationHook() { }

  handleSnapAnimation(offset) {
    const DURATION = 1000;
    const animationInput = this.state.offset;
    const animationTarget = offset;

    let animationFrame = null;

    let stop = false;
    let start = null

    const calculateFrame = (easingPoint) => animationInput + (animationTarget - animationInput) * easingPoint;

    const draw = () => {
      const now = Date.now();
      const point = (now - start) / DURATION;
      const easingPoint = easeInOutCubic(point);

      if (stop) {
        this.#stopAnimation(animationFrame);
        return;
      }

      animationFrame = calculateFrame(easingPoint);

      if (now - start >= DURATION) {
        stop = true;
        const roundedEndFrame = Math.round(animationFrame);
        animationFrame = roundedEndFrame;
      };
      this.animationHook(animationFrame);
      this.container.style.transform = `translateX(${animationFrame}%)`;
      this.state.snapRaf = requestAnimationFrame(draw)
    }

    const startAnimation = () => {
      start = Date.now();
      draw(start)
    }

    startAnimation();
  }

  handleUp = (event) => {
    this.snap(event);
  }

  snap(event) {
    const offset = this.#getSnapOffset(event);
    const offsetSet = this.handleAnimation(offset);
    this.#finishSnap(offsetSet);
  }
}

const Loop = Carousel => class extends Carousel {
  constructor(containerReference, options) {
    super(containerReference, options);
    this.slideCount = Infinity;
  }

  #animateSmoothly(offset) {
    this.container.style.transition = 'transform ease-in-out .2s';
    this.container.style.transform = `translateX(${offset}%)`;
  }
  #animateRough(inputOffset) {
    const { offset } = this.state;
    const moveToOffset = typeof inputOffset !== 'undefined' ? inputOffset : offset;
    this.container.style.transition = '';
    this.container.style.transform = `translateX(${moveToOffset}%)`;
  }

  #calcCurrentGapSize(offset) {
    const { size: { slidePercentageWidth, maxWidth } } = this.state;

    const GAP_ON_END = 100 - slidePercentageWidth;
    const CAROUSEL_END_POINT = invert(-(maxWidth) + slidePercentageWidth + GAP_ON_END);
    const invertedOffset = invert(offset);
    const carouselHasGap = invertedOffset >= CAROUSEL_END_POINT;

    if (carouselHasGap) {
      return invertedOffset - CAROUSEL_END_POINT;
    } else {
      return 0;
    }
  }

  #detectIfCarouselIsOnEnds(offset) {
    const CAROUSEL_START = 0;
    const CAROUSEL_END = this.#getCarouselEnd();
    return (offset > CAROUSEL_START || offset <= -CAROUSEL_END - 1);
  }

  #fillGap(offset) {
    const isOnEnd = this.#detectIfCarouselIsOnEnds(offset);
    if (isOnEnd) {
      const gapSize = this.#calcCurrentGapSize(offset);
      const slideAmount = this.#getHowManySlidesFills(gapSize);
      this.#translateSlides(slideAmount);
    } else {
      this.#resetTranslation()
    }
  }

  #getHowManySlidesFills(gap) {
    const { slidePercentageWidth } = this.state.size;
    return Math.ceil(gap / slidePercentageWidth);
  }

  #getCarouselEnd() {
    const { state: { slidesCount, size: { slidePercentageWidth } } } = this;
    const GAP_ON_END = 100 - slidePercentageWidth;
    const END_OFFSET = (slidesCount - 1) * slidePercentageWidth;
    return (END_OFFSET - GAP_ON_END);
  }

  #overWriteOffset(offset) {
    const {
      size: {
        slidePercentageWidth,
        offsetMax,
        maxWidth
      }
    } = this.state;

    const rangeWithoutGap = invert(offsetMax - (100 - slidePercentageWidth));
    const rangeWithGap = invert(maxWidth);
    const range = this.slideCount === Infinity ? rangeWithGap : rangeWithoutGap;
    if (offset > 0) {
      return this.#processOffsetAboveZero(offset);
    } else if (offset < range) {
      return this.#processOffsetBelowMax(offset);
    } else {
      return offset;
    }
  }

  #processOffsetAboveZero(offset) {
    const { maxWidth } = this.state.size;
    return invert(maxWidth - ((offset / (maxWidth)) % 1) * (maxWidth));
  }

  #processOffsetBelowMax(offset) {
    const { maxWidth } = this.state.size;
    return invert(((invert(offset) / maxWidth) % 1) * maxWidth);
  }

  #resetTranslation() {
    const { container } = this;

    const carouselSlides = container.children;
    const slidesToReset = Array.from(carouselSlides);
    for (let i = 0; i < slidesToReset.length; i++) {
      slidesToReset[i].style.transform = `initial`
    }
  }

  #runLoopAnimation(offset) {
    this.#fillGap(offset);
    this.#animateRough(offset);
  }

  #handleSlideToAnimation(offset) {
    const { container } = this;
    this.#fillGap(offset);
    this.#animateSmoothly(offset);
  }

  #translateSlides(amountOfSlidesToMove) {
    const { container, state: { slidesCount } } = this;

    const PERCENT = 100;

    const carouselSlides = container.children;
    const slidesToMove = Array.from(carouselSlides);
    const carouselWidth = slidesCount * PERCENT;

    for (let i = 0; i < slidesToMove.length; i++) {
      if (i < amountOfSlidesToMove) {
        slidesToMove[i].style.transform = `translateX(${carouselWidth}%)`
      } else {
        slidesToMove[i].style.transform = `initial`
      }
    }
  }

  animationHook(offset) {
    this.#fillGap(offset);
  }

  handleAnimation(inputOffset) {
    const { offset } = this.state;
    const moveToOffset = typeof inputOffset !== 'undefined' ? inputOffset : offset;

    const newOffset = this.#overWriteOffset(moveToOffset);

    const snapModuleLoaded = this.handleSnapAnimation;
    const slideToModuleLoaded = this.slideTo;
    this.state.raf = requestAnimationFrame(() => {
      if (typeof inputOffset !== 'undefined' && snapModuleLoaded) {
        this.handleSnapAnimation(newOffset);
      } else if (typeof inputOffset !== 'undefined' && slideToModuleLoaded) {
        this.#handleSlideToAnimation(newOffset)
      } else {
        this.#runLoopAnimation(newOffset);
      }
      this.state.offset = newOffset;
    })
    return newOffset;
  }
}


document.addEventListener('DOMContentLoaded', function () {
  const DragSnapCarousel = compose(Loop, Snap, Drag, SlideTo)(Carousel);
  const wrapper = document.getElementById('collection_carousel');
  const draggableCarousel = new DragSnapCarousel(wrapper);
});