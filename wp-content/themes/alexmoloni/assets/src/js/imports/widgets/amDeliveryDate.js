import helpers from "../helpers";
import wpRestApi from "../wpRestApi";
import wcLoader from "./wcLoader";

const $ = jQuery.noConflict();
const allowSameDayDelivery = false;

const wrap = document.querySelector('.am-delivery-date');
const infoSelectedDate = document.querySelector('.info-selected-date');
const $calendar = $('#datetimepicker');
const $hourSelect = $('#delivery-hour');
const $inputHiddenDeliveryDate = $('input[name=delivery_date]');

function init() {
    $('body').trigger('update_checkout');

    $calendar.datepicker({
        changeYear: true,
        changeMonth: true,
        minDate: 1,//start from tomorrow
        dateFormat: 'mm/dd/yy',
        yearRange: "-100:+20",
        maxDate: '+1Y',
        beforeShowDay: function (date) {
            const day = date.getDay();
            return [(day !== 0), ''];
        },
        onSelect: function (dateText) {
            const dateSelected = new Date(dateText);
            handleChangeDate(dateSelected);
        },
        firstDay: 1
    });

}

function afterInitDatepicker() {
    const firstAvailableDate = document.querySelector('td.ui-datepicker-current-day');
    firstAvailableDate.click();

}

function handleChangeDate(dateSelected) {
    populateHiddenInput(dateSelected);
    showInfoSelectedDate();

    const currentHour = helpers.getCurrentHour();
    if ( allowSameDayDelivery ) {
        const today = new Date();
        const options = $hourSelect.find('option');
        if ( helpers.compareDaysInDates(today, dateSelected) ) {
            for ( let option of options ) {
                const hourStart = parseInt(option.dataset.hourStart);
                option.disabled = hourStart - 2 < currentHour;
            }
        }
        else {
            for ( let option of options ) {
                option.disabled = false;
            }
        }
    }

}

function populateHiddenInput(date) {
    const selDate = new Date(date);
    const selDateLong = helpers.formatDateLong(selDate);
    const selDateShort = helpers.formatDateShort(selDate);
    $inputHiddenDeliveryDate.val(selDateShort);
    $inputHiddenDeliveryDate.attr('data-date-short', selDateShort);
}

function showInfoSelectedDate() {
    let date = $inputHiddenDeliveryDate.get(0).dataset.dateShort;
    const hourSelect = $hourSelect.get(0);
    const hours = hourSelect.value;
    infoSelectedDate.querySelector('.value-date').innerHTML = date;
    infoSelectedDate.querySelector('.value-hours').innerHTML = hours;
}

function handleHourChange() {
    $hourSelect.on('change', function (ev) {
        const hourSelect = $hourSelect.get(0);
        wcLoader.add(wrap);
        const hours = hourSelect.value;
        const selOption = hourSelect.options[ hourSelect.selectedIndex ];
        const isExtra = typeof selOption.dataset.isExtra !== 'undefined' ? '1' : 0;
        if ( isExtra ) {
            document.querySelector('.extra-price-info').classList.remove('hidden');
        }
        else {
            document.querySelector('.extra-price-info').classList.add('hidden');
        }

        infoSelectedDate.classList.remove('hidden');
        showInfoSelectedDate();

        const formData = new FormData;
        formData.append('action', 'set_hour');
        formData.append('nonce', wpRest.nonce);
        formData.append('hours', hours);
        formData.append('is_extra', isExtra);
        wpRestApi.post('', formData).then((resp) => {
            return true;
        }).then((resp) => {
            $('body').trigger('update_checkout');
            wcLoader.remove(wrap);
        })
    })
}

export default function () {
    if ( !helpers.isCheckoutPage() ) {
        return;
    }
    init();
    afterInitDatepicker();
    handleHourChange();
}