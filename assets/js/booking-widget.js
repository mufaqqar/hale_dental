/**
 * Hale Dental - Home booking widget
 * Step 1: consultant + date + time  ->  Step 2: name, email, phone, message  ->  AJAX submit
 */
(function () {

    'use strict';

    var OPEN_DATE = ['bg-white', 'border-[#f0f0f0]', 'hover:border-secondary'];
    var ACTIVE_DATE = ['active-date', '!border-secondary', '!bg-secondary'];

    var OPEN_SLOT = ['border-secondary', 'bg-white', 'text-secondary', 'hover:bg-secondary', 'hover:text-white'];
    var ACTIVE_SLOT = ['border-secondary', 'bg-secondary', 'text-white', 'hover:bg-secondary', 'hover:text-white'];
    var CLOSED_SLOT = ['cursor-not-allowed', 'border-[#e6e6e6]', 'bg-white', 'text-[#c4c4c4]', 'line-through'];

    function each(list, fn) {
        Array.prototype.forEach.call(list || [], fn);
    }

    function removeClasses(el, classes) {
        if (!el) {
            return;
        }
        classes.forEach(function (cls) {
            el.classList.remove(cls);
        });
    }

    function addClasses(el, classes) {
        if (!el) {
            return;
        }
        classes.forEach(function (cls) {
            el.classList.add(cls);
        });
    }

    function toggle(el, show) {
        if (!el) {
            return;
        }
        el.classList.toggle('hidden', !show);
    }

    function parseTimeToMinutes(time) {
        var parts = String(time).split(':');

        return (parseInt(parts[0], 10) * 60) + parseInt(parts[1], 10);
    }

    function pad(number) {
        return number < 10 ? '0' + number : String(number);
    }

    function localDateString(date) {
        return date.getFullYear() + '-' + pad(date.getMonth() + 1) + '-' + pad(date.getDate());
    }

    function init() {

        each(document.querySelectorAll('.booking-widget'), function (root) {

            var config = window.haleBooking || {};

            var today = root.getAttribute('data-today') || localDateString(new Date());
            var leadMinutes = parseInt(root.getAttribute('data-lead-minutes'), 10) || 0;

            var dropdown = root.querySelector('#consultantDropdown');
            var changeButton = root.querySelector('#changeConsultant');
            var consultantText = root.querySelector('#selectedConsultantText');
            var stepLabel = root.querySelector('#bookingStepLabel');

            var stepOne = root.querySelector('#bookingStepOne');
            var stepTwo = root.querySelector('#bookingStepTwo');
            var success = root.querySelector('#bookingSuccess');

            var slotsContainer = root.querySelector('#slotsContainer');
            var morningGroup = root.querySelector('#morningGroup');
            var afternoonGroup = root.querySelector('#afternoonGroup');
            var noSlots = root.querySelector('#noSlots');
            var continueButton = root.querySelector('#bookingContinue');

            var summary = root.querySelector('#bookingSummary');
            var summaryConsultant = root.querySelector('#bookingSummaryConsultant');
            var editButton = root.querySelector('#bookingEdit');

            var form = root.querySelector('#bookingForm');
            var submitButton = root.querySelector('#bookingSubmit');
            var formMsg = root.querySelector('#bookingFormMsg');
            var restartButton = root.querySelector('#bookingRestart');

            if (!form || !stepOne || !stepTwo) {
                return;
            }

            var state = {
                consultant: root.getAttribute('data-default-consultant') || '',
                date: '',
                dateLabel: '',
                time: ''
            };


            /*
            |--------------------------------------------------------------------------
            | Consultant dropdown
            |--------------------------------------------------------------------------
            */

            function openDropdown() {
                toggle(dropdown, true);
            }

            function closeDropdown() {
                toggle(dropdown, false);
            }

            function selectConsultant(option) {
                state.consultant = option.getAttribute('data-name') || '';

                if (consultantText) {
                    consultantText.textContent = state.consultant;
                }

                each(root.querySelectorAll('.consultant-check'), function (check) {
                    check.classList.add('hidden');
                });

                var check = option.querySelector('.consultant-check');

                if (check) {
                    check.classList.remove('hidden');
                }

                updateSummary();
                closeDropdown();
            }

            if (changeButton) {
                changeButton.addEventListener('click', function (event) {
                    event.stopPropagation();
                    toggle(dropdown, dropdown.classList.contains('hidden'));
                });
            }

            if (consultantText) {
                consultantText.addEventListener('click', function (event) {
                    event.stopPropagation();
                    openDropdown();
                });
            }

            each(root.querySelectorAll('.consultant-option'), function (option) {
                option.addEventListener('click', function () {
                    selectConsultant(this);
                });
            });

            document.addEventListener('click', function (event) {
                if (!dropdown || dropdown.classList.contains('hidden')) {
                    return;
                }

                if (
                    !dropdown.contains(event.target) &&
                    event.target !== changeButton &&
                    event.target !== consultantText
                ) {
                    closeDropdown();
                }
            });


            /*
            |--------------------------------------------------------------------------
            | Date selection
            |--------------------------------------------------------------------------
            */

            function paintDate(button) {
                each(root.querySelectorAll('.date-button'), function (item) {
                    var isActive = item === button;

                    removeClasses(item, OPEN_DATE);
                    removeClasses(item, ACTIVE_DATE);
                    addClasses(item, isActive ? ACTIVE_DATE : OPEN_DATE);

                    item.setAttribute('aria-pressed', isActive ? 'true' : 'false');

                    var number = item.querySelector('.date-number');
                    var name = item.querySelector('.date-name');

                    if (number) {
                        removeClasses(number, ['text-white', 'text-[#999]']);
                        number.classList.add(isActive ? 'text-white' : 'text-[#999]');
                    }

                    if (name) {
                        removeClasses(name, ['text-white', 'text-[#aaa]']);
                        name.classList.add(isActive ? 'text-white' : 'text-[#aaa]');
                    }
                });
            }

            each(root.querySelectorAll('.date-button'), function (button) {
                button.addEventListener('click', function () {
                    state.date = this.getAttribute('data-date') || '';
                    state.dateLabel = this.getAttribute('data-label') || '';
                    state.time = '';

                    paintDate(this);
                    refreshSlots();
                    updateSummary();
                });
            });


            /*
            |--------------------------------------------------------------------------
            | Time slots
            |--------------------------------------------------------------------------
            */

            function slotIsPast(slot) {
                if (slot.getAttribute('data-server-closed') === '1') {
                    return true;
                }

                if (state.date !== today) {
                    return false;
                }

                var now = new Date();
                var cutoff = now.getHours() * 60 + now.getMinutes() + leadMinutes;

                return parseTimeToMinutes(slot.getAttribute('data-time')) < cutoff;
            }

            function paintSlot(slot) {
                var isPast = slotIsPast(slot);
                var isActive = state.time !== '' && slot.getAttribute('data-time') === state.time;

                if (isPast) {
                    removeClasses(slot, OPEN_SLOT);
                    removeClasses(slot, ACTIVE_SLOT);
                    addClasses(slot, CLOSED_SLOT);
                    slot.disabled = true;
                    slot.setAttribute('aria-disabled', 'true');
                    return;
                }

                removeClasses(slot, CLOSED_SLOT);
                slot.disabled = false;
                slot.removeAttribute('aria-disabled');

                if (isActive) {
                    removeClasses(slot, OPEN_SLOT);
                    addClasses(slot, ACTIVE_SLOT);
                } else {
                    removeClasses(slot, ACTIVE_SLOT);
                    addClasses(slot, OPEN_SLOT);
                }
            }

            function refreshSlots() {
                var available = 0;

                each(root.querySelectorAll('.time-slot'), function (slot) {
                    paintSlot(slot);

                    if (!slot.disabled) {
                        available++;
                    }
                });

                each([morningGroup, afternoonGroup], function (group) {
                    if (!group) {
                        return;
                    }

                    var open = group.querySelectorAll('.time-slot:not([disabled])').length;

                    toggle(group, open > 0);
                });

                toggle(slotsContainer, available > 0);
                toggle(noSlots, available === 0);

                updateContinueState();
            }

            each(root.querySelectorAll('.time-slot'), function (slot) {
                slot.addEventListener('click', function () {
                    if (this.disabled) {
                        return;
                    }

                    state.time = this.getAttribute('data-time') || '';

                    refreshSlots();
                    updateSummary();
                });
            });


            /*
            |--------------------------------------------------------------------------
            | Steps
            |--------------------------------------------------------------------------
            */

            function updateContinueState() {
                if (!continueButton) {
                    return;
                }

                var ready = state.date !== '' && state.time !== '';

                continueButton.disabled = !ready;
                continueButton.classList.toggle('opacity-40', !ready);
                continueButton.classList.toggle('cursor-not-allowed', !ready);
                continueButton.classList.toggle('hover:bg-black', ready);
            }

            function updateSummary() {
                if (summary) {
                    summary.textContent = state.time
                        ? state.dateLabel + ' at ' + state.time
                        : (state.dateLabel || 'Pick a date and time');
                }

                if (summaryConsultant) {
                    summaryConsultant.textContent = state.consultant
                        ? 'with ' + state.consultant
                        : '';
                }
            }

            function showStep(which) {
                toggle(stepOne, which === 1);
                toggle(stepTwo, which === 2);
                toggle(success, which === 3);
                toggle(dropdown, false);

                if (stepLabel) {
                    stepLabel.textContent = which === 3 ? 'All done' : 'Step ' + which + ' of 2';
                }
            }

            if (continueButton) {
                continueButton.addEventListener('click', function () {
                    if (this.disabled) {
                        return;
                    }

                    showStep(2);
                    hideMessage();
                    clearErrors();
                });
            }

            if (editButton) {
                editButton.addEventListener('click', function () {
                    showStep(1);
                });
            }

            if (restartButton) {
                restartButton.addEventListener('click', function () {
                    state.date = '';
                    state.dateLabel = '';
                    state.time = '';

                    form.reset();
                    clearErrors();
                    hideMessage();

                    paintDate(null);
                    refreshSlots();
                    showStep(1);
                });
            }


            /*
            |--------------------------------------------------------------------------
            | Validation
            |--------------------------------------------------------------------------
            */

            function fieldWrapper(field) {
                return field.closest('div');
            }

            function setError(field, show) {
                var wrapper = fieldWrapper(field);
                var error = wrapper ? wrapper.querySelector('.booking-error') : null;

                toggle(error, show);
                field.classList.toggle('border-red-400', show);
            }

            function clearErrors() {
                each(form.querySelectorAll('.booking-error'), function (error) {
                    error.classList.add('hidden');
                });

                each(form.querySelectorAll('.border-red-400'), function (field) {
                    field.classList.remove('border-red-400');
                });
            }

            function isEmail(value) {
                return /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(value);
            }

            function validate() {
                var name = form.querySelector('#bookingName');
                var email = form.querySelector('#bookingEmail');
                var phone = form.querySelector('#bookingPhone');

                var ok = true;

                [name, email, phone].forEach(function (field) {
                    if (!field) {
                        return;
                    }

                    var value = field.value.trim();
                    var valid = value !== '';

                    if (valid && field === email) {
                        valid = isEmail(value);
                    }

                    if (valid && field === phone) {
                        valid = value.replace(/[^0-9]/g, '').length >= 6;
                    }

                    setError(field, !valid);

                    ok = ok && valid;
                });

                return ok;
            }


            /*
            |--------------------------------------------------------------------------
            | Messages
            |--------------------------------------------------------------------------
            */

            function showMessage(text, isError) {
                if (!formMsg) {
                    return;
                }

                formMsg.textContent = text;
                formMsg.classList.remove('hidden', 'text-green-600', 'text-red-500');
                formMsg.classList.add(isError ? 'text-red-500' : 'text-green-600');
            }

            function hideMessage() {
                if (formMsg) {
                    formMsg.textContent = '';
                    formMsg.classList.add('hidden');
                }
            }


            /*
            |--------------------------------------------------------------------------
            | Submit
            |--------------------------------------------------------------------------
            */

            form.addEventListener('submit', function (event) {
                event.preventDefault();

                var honeypot = form.querySelector('[name="website"]');

                if (honeypot && honeypot.value !== '') {
                    return;
                }

                if (state.date === '' || state.time === '') {
                    showMessage('Please choose a date and a time first.', true);
                    showStep(1);
                    return;
                }

                if (!validate()) {
                    showMessage('Please correct the highlighted fields.', true);
                    return;
                }

                var payload = new FormData(form);

                payload.append('action', 'hale_booking_submit');
                payload.append('nonce', config.nonce || '');
                payload.append('consultant', state.consultant);
                payload.append('date', state.date);
                payload.append('date_label', state.dateLabel);
                payload.append('time', state.time);

                var originalText = submitButton ? submitButton.textContent : '';

                hideMessage();

                if (submitButton) {
                    submitButton.disabled = true;
                    submitButton.textContent = 'Sending...';
                }

                fetch(config.ajaxUrl || '/wp-admin/admin-ajax.php', {
                    method: 'POST',
                    credentials: 'same-origin',
                    body: payload
                })
                    .then(function (response) {
                        return response.json();
                    })
                    .then(function (result) {
                        if (result && result.success) {
                            var successMsg = root.querySelector('#bookingSuccessMsg');

                            if (successMsg && result.data) {
                                successMsg.textContent = result.data;
                            }

                            showStep(3);
                            return;
                        }

                        showMessage(
                            (result && result.data) ? result.data : 'Something went wrong. Please try again.',
                            true
                        );
                    })
                    .catch(function () {
                        showMessage('Network error. Please try again.', true);
                    })
                    .then(function () {
                        if (submitButton) {
                            submitButton.disabled = false;
                            submitButton.textContent = originalText;
                        }
                    });
            });


            /*
            |--------------------------------------------------------------------------
            | Init
            |--------------------------------------------------------------------------
            */

            var initialDate = root.querySelector('.date-button');

            each(root.querySelectorAll('.time-slot'), function (slot) {
                if (slot.disabled) {
                    slot.setAttribute('data-server-closed', '1');
                }
            });

            if (initialDate) {
                state.date = initialDate.getAttribute('data-date') || '';
                state.dateLabel = initialDate.getAttribute('data-label') || '';
                paintDate(initialDate);
            }

            each(root.querySelectorAll('.consultant-option'), function (option) {
                if (option.getAttribute('data-name') === state.consultant) {
                    var check = option.querySelector('.consultant-check');

                    if (check) {
                        check.classList.remove('hidden');
                    }
                }
            });

            refreshSlots();
            updateSummary();
            showStep(1);
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();
