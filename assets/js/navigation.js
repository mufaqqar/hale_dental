/**
 * Hale Coffee - Mobile Navigation & Mega Menu toggle
 */
(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    var toggle = document.querySelector('.menu-toggle');
    var nav = document.getElementById('site-navigation');
    var mobileNav = document.getElementById('mobile-nav');
    var panel = mobileNav || nav;

    if (toggle && panel) {
      toggle.addEventListener('click', function () {
        var expanded = this.getAttribute('aria-expanded') === 'true';
        this.setAttribute('aria-expanded', !expanded);
        panel.classList.toggle('hidden');
      });
    }

    /* Mega menu hover grace: keep the panel open while moving across the gap */
    document.querySelectorAll('.primary-navigation .menu-item-mega').forEach(function (item) {
      var timer;
      item.addEventListener('mouseenter', function () {
        clearTimeout(timer);
        item.classList.add('open');
      });
      item.addEventListener('mouseleave', function () {
        clearTimeout(timer);
        timer = setTimeout(function () {
          item.classList.remove('open');
        }, 300);
      });
    });

    /* Mobile: toggle sub-menus / mega panels on click */
    var isMobile = function () { return window.innerWidth < 768; };

    document.querySelectorAll('.primary-navigation .menu-item-has-children > a, .primary-navigation .menu-item-mega > a').forEach(function (link) {
      link.addEventListener('click', function (e) {
        if (!isMobile()) return;
        e.preventDefault();
        var parent = this.parentElement;
        var sub = parent.querySelector(':scope > .sub-menu, :scope > .mega-panel');
        if (sub) {
          sub.classList.toggle('open');
        }
      });
    });

    /* Close mobile menu when a menu link is clicked */
    panel && panel.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', function () {
        if (isMobile() && !this.parentElement.querySelector('.open')) {
          panel.classList.add('hidden');
          toggle && toggle.setAttribute('aria-expanded', 'false');
        }
      });
    });

    /* Language switch dropdowns */
    document.querySelectorAll('.lang-switch').forEach(function (sw) {
      sw.addEventListener('click', function (e) {
        e.stopPropagation();
        var isOpen = this.classList.contains('open');
        document.querySelectorAll('.lang-switch.open').forEach(function (o) {
          o.classList.remove('open');
          o.setAttribute('aria-expanded', 'false');
        });
        if (!isOpen) {
          this.classList.add('open');
          this.setAttribute('aria-expanded', 'true');
        }
      });
    });

    document.addEventListener('click', function () {
      document.querySelectorAll('.lang-switch.open').forEach(function (o) {
        o.classList.remove('open');
        o.setAttribute('aria-expanded', 'false');
      });
    });
  });
})();