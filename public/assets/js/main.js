'use strict';

/* exported extend, ready */
let extend = function(out) {
  out = out || {};

  for (let i = 1; i < arguments.length; i++) {
    if (!arguments[i]) {
      continue;
    }

    for (let key in arguments[i]) {
      if (Object.prototype.hasOwnProperty.call(arguments[i], key)) {
        out[key] = arguments[i][key];
      }
    }
  }

  return out;
};

function ready(fn) {
  if (document.readyState !== 'loading') {
    fn();
  } else {
    document.addEventListener('DOMContentLoaded', fn);
  }
}

ready(() => {

  // detect Mac OS X
  if (navigator.platform.toUpperCase().indexOf('MAC') >= 0) {
    document.getElementsByTagName('html')[0].classList.add('mac');
  }
});


// --------------------------
// sidebar
// --------------------------

/* global ready */
ready(() => {
  'use strict';

  const sidebarToggle = document.getElementById('sidebar-toggle');
  const sidebar = document.getElementById('sidebar');

  if (sidebar) {
    const navbarOverlay = document.createElement('div');

    navbarOverlay.classList.add('overlay', 'overlay-sidebar');
    sidebar.insertAdjacentElement('afterend', navbarOverlay);
    navbarOverlay.addEventListener('click', () => {
      sidebarNavClose();
    });

    sidebarToggle.addEventListener('click', (e) => {
      e.preventDefault();
      sidebar.classList.toggle('show');
    });

    document.getElementById('sidebar-close').addEventListener('click', (e) => {
      e.preventDefault();
      sidebarNavClose();
    });
  }

  function sidebarNavClose() {
    const event = document.createEvent('HTMLEvents');
    event.initEvent('click', true, false);
    sidebarToggle.dispatchEvent(event);
  }
});


// --------------------------
// navbar
// --------------------------

/* global ready */
ready(() => {
  'use strict';

  // document.getElementById('nav-main').scrollLeft = 0;
  const navLinks = document.querySelectorAll('.nav-main .nav-link');
  for (let i = 0; i < navLinks.length; i++) {
    if (navLinks[i].classList.contains('active')) {
      document.getElementById('nav-main').scrollLeft = navLinks[i].offsetLeft - 12;
    }
  }
});


// --------------------------
// bootstrap
// --------------------------

/* global ready, bootstrap */
ready(() => {
  'use strict';

  // tooltip
  const elTooltip = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  elTooltip.map((el) => {
    return new bootstrap.Tooltip(el);
  });

  // popover
  const elPopover = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
  elPopover.map(function (el) {
    return new bootstrap.Popover(el);
  });
});


// --------------------------
// flatpickr
// --------------------------

/* global ready, extend, flatpickr */
ready(() => {
  'use strict';

  const elFlatpickr = document.querySelectorAll('[data-plugin="flatpickr"]');
  Array.prototype.forEach.call(elFlatpickr, (el) => {
    let defaults = {
      // altInput: true,
      // altFormat: "F j, Y",
      // altInputClass: 'form-control flatpickr-input-alt',
      dateFormat: 'd-m-Y',
      wrap: true,
      locale: 'vn',
      animate: false
    };
    let options = extend({}, defaults, JSON.parse(el.getAttribute('data-options')));

    flatpickr(el, options);
  });
});


// --------------------------
// select2
// --------------------------

/* global extend */
$(document).ready(function() {
  'use strict';

  const elSwiper = document.querySelectorAll('[data-plugin="select2"]');
  Array.prototype.forEach.call(elSwiper, (el) => {
    let defaults = {
      minimumResultsForSearch: Infinity,
    };
    let options = extend({}, defaults, JSON.parse(el.getAttribute('data-options')));

    $(el).select2(options);
  });
});


// --------------------------
// daterangepicker
// --------------------------

/* global moment */
(function ($) {
  $.fn.pluginDateRangePicker = function (opts) {
    var defaults = {
      locale: {
        format: 'DD/MM/YYYY'
      },
      ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      alwaysShowCalendars: true,
      applyButtonClasses: 'btn-primary',
      cancelButtonClasses: 'btn-cancel'
    };
    var options = $.extend({}, defaults, opts);

    $(this).daterangepicker(options);
    return this;
  };
}(jQuery));

// execute
$(document).ready(function () {
  $('[data-plugin="daterangepicker"]').each(function () {
    $(this).pluginDateRangePicker($(this).data('options'));

    $(this).val('');
    // $(this).attr('placeholder', 'Chọn ngày');
  });
});


// --------------------------
// sumoselect
// --------------------------

/* global extend */
/* eslint new-cap: ["error", { "capIsNewExceptions": ["SumoSelect"] }] */
$(document).ready(function() {
  'use strict';

  const elSwiper = document.querySelectorAll('[data-plugin="sumoselect"]');
  Array.prototype.forEach.call(elSwiper, (el) => {
    let defaults = {
      triggerChangeCombined: true,
      forceCustomRendering: true
    };
    let options = extend({}, defaults, JSON.parse(el.getAttribute('data-options')));

    $(el).SumoSelect(options);
  });
});
