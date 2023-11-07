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


// --------------------------
// Input mask
// --------------------------

/* global extend */
(function ($) {
  $.fn.addMaskNumeric = function(options = {}) {
    Inputmask({
      alias: "numeric",
      groupSeparator: " ",
      autoGroup: !0,
      min: 0,
      max: options.max ? options.max : undefined,
    }).mask(this)
    return this
  }
}(jQuery))

/* execute */
$(document).ready(function() {
  $('input[data-plugin="inputmask-numeric"]').each(function() {
    let options = {}
    $(this).addMaskNumeric(options)
  })
})



// --------------------------
// active menu sidebar
// --------------------------
$(document).ready(function() {
  'use strict'

  const menuitems = document.querySelectorAll('.menu-link')
  const curUrl = window.location.protocol + '//' + window.location.host + window.location.pathname
  Array.prototype.forEach.call(menuitems, (el) => {
    el.classList.remove('active')
    if(el.getAttribute('href') === curUrl)
    {
      el.classList.add('active')
    }
  })
})



// --------------------------
//  Number Processing
// --------------------------

/* global extend */
// $(document).ready(function() {
//   'use strict'
  var formatNumber = function (input) {
    const roundedNumber = Math.round(parseFloat(input) * 1000) / 1000;
    const parts = roundedNumber.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, " ");
    return parts[1] ? parts.join(".") : parts[0];
  }

  var cleanNumber = function (input) {
    const cleanedInput = input.replace(/[^\d.]/g, '');
    const normalizedInput = cleanedInput.replace(',', '.');
    const floatValue = parseFloat(normalizedInput);
    return floatValue;
  }

  var cleanStrNumber = function(input) {
    var cleaned = input.replace(/[^\d.,]/g, '');
    cleaned = cleaned.replace(/\./g, '');;
    cleaned = cleaned.replace(/,/g, '.');
    cleaned = cleaned.replace(/\.(?=.*\.)/g, '');
    var parts = cleaned.split('.');
    if (parts.length > 1 && parts[1].length < 2) {
      cleaned += '0';
    }
    var number = parseFloat(cleaned);
    return number;
  }
// })



// --------------------------
//  Notifications
// --------------------------

var addNotifications = function (notifications, itemNoti) {
  var firstItem = $(itemNoti).first()
  var html = ''
  $.each(notifications, function(i, item) {
    html += `<div class="d-flex flex-stack py-4">
              <div class="d-flex align-items-center">
                <div class="symbol symbol-35px me-4">
                  <span class="symbol-label bg-light-info"><span class="svg-icon svg-icon-2 svg-icon-info"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M21 10H13V11C13 11.6 12.6 12 12 12C11.4 12 11 11.6 11 11V10H3C2.4 10 2 10.4 2 11V13H22V11C22 10.4 21.6 10 21 10Z" fill="currentColor"></path>
                    <path opacity="0.3" d="M12 12C11.4 12 11 11.6 11 11V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V11C13 11.6 12.6 12 12 12Z" fill="currentColor"></path>
                    <path opacity="0.3" d="M18.1 21H5.9C5.4 21 4.9 20.6 4.8 20.1L3 13H21L19.2 20.1C19.1 20.6 18.6 21 18.1 21ZM13 18V15C13 14.4 12.6 14 12 14C11.4 14 11 14.4 11 15V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18ZM17 18V15C17 14.4 16.6 14 16 14C15.4 14 15 14.4 15 15V18C15 18.6 15.4 19 16 19C16.6 19 17 18.6 17 18ZM9 18V15C9 14.4 8.6 14 8 14C7.4 14 7 14.4 7 15V18C7 18.6 7.4 19 8 19C8.6 19 9 18.6 9 18Z" fill="currentColor"></path>
                    </svg></span>
                  </span>
                </div>
                <div class="mb-0 me-2">
                  <a href="#" class="fs-6 text-gray-800 text-hover-primary fw-bolder">${item.message}</a>
                  <div class="text-gray-400 fs-7">${item.time}</div>
                </div>
              </div>
            </div>`
  })
  $(html).insertBefore(firstItem)
}
