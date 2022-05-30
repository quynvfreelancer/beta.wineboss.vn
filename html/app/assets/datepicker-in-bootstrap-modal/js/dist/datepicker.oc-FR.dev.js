"use strict";

function _typeof(obj) { if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

(function (global, factory) {
  (typeof exports === "undefined" ? "undefined" : _typeof(exports)) === 'object' && typeof module !== 'undefined' ? factory(require('jquery')) : typeof define === 'function' && define.amd ? define(['jquery'], factory) : factory(global.jQuery);
})(void 0, function ($) {
  'use strict';

  $.fn.datepicker.languages['oc-FR'] = {
    format: 'dd/mm/yyyy',
    days: ['Dimenge', 'Diluns', 'Dimars', 'Dimècres', 'Dijòus', 'Divendres', 'Dissabte'],
    daysShort: ['Dg', 'Dl', 'Dm', 'Dc', 'Dj', 'Dv', 'Ds'],
    daysMin: ['dg', 'dl', 'dm', 'dc', 'dj', 'dv', 'ds'],
    weekStart: 1,
    months: ['Genièr', 'Febrièr', 'Març', 'Abrial', 'Mai', 'Junh', 'Julhet', 'Agost', 'Setembre', 'Octòbre', 'Novembre', 'Decembre'],
    monthsShort: ['Gen', 'Feb', 'Març', 'Abr', 'Mai', 'Junh', 'Julh', 'Ago', 'Set', 'Oct', 'Nov', 'Dec']
  };
});