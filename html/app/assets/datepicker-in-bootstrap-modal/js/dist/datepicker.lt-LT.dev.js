"use strict";

function _typeof(obj) { if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

(function (global, factory) {
  (typeof exports === "undefined" ? "undefined" : _typeof(exports)) === 'object' && typeof module !== 'undefined' ? factory(require('jquery')) : typeof define === 'function' && define.amd ? define(['jquery'], factory) : factory(global.jQuery);
})(void 0, function ($) {
  'use strict';

  $.fn.datepicker.languages['lt-LT'] = {
    format: 'yyyy-mm-dd',
    days: ['Sekmadienis', 'Pirmadienis', 'Antradienis', 'Trečiadienis', 'Ketvirtadienis', 'Penktadienis', 'Šeštadienis'],
    daysShort: ['Sekm', 'Pirm', 'Antr', 'Treč', 'Ketv', 'Penkt', 'Šešt'],
    daysMin: ['Sk', 'Pr', 'An', 'Tr', 'Kt', 'Pn', 'Št'],
    weekStart: 1,
    months: ['Sausis', 'Vasaris', 'Kovas', 'Balandis', 'Gegužė', 'Birželis', 'Liepa', 'Rugpjūtis', 'Rugsėjis', 'Spalis', 'Lapkritis', 'Gruodis'],
    monthsShort: ['Sau', 'Vas', 'Kov', 'Bal', 'Geg', 'Bir', 'Lie', 'Rgp', 'Rgs', 'Spa', 'Lap', 'Gru']
  };
});