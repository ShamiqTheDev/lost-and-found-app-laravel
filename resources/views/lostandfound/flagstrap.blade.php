<script type="text/javascript">
/*
 *  FlagStrap - v3.3.5
 *  A lightwieght jQuery plugin for creating Bootstrap 3 compatible country select boxes with flags.
 *  http://www.blazeworx.com/flagstrap
 *
 *  Made by Alex Carter
 *  Under MIT License
 */
 (function ($) {
    var defaults = {
        buttonSize: "btn-md",
        buttonType: "btn-default",
        labelMargin: "10px",
        scrollable: true,
        scrollableHeight: "250px"
    };
    var countries = {
      "PK": "Pakistan",
      "AF": "Afghanistan",
      "AL": "Albania",
      "DZ": "Algeria",
      "AS": "American Samoa",
      "AD": "Andorra",
      "AO": "Angola",
      "AI": "Anguilla",
      "AG": "Antigua",
      "AR": "Argentina",
      "AM": "Armenia",
      "AW": "Aruba",
      "AU": "Australia",
      "AT": "Austria",
      "AZ": "Azerbaijan",
      "BS": "Bahamas",
      "BH": "Bahrain",
      "BD": "Bangladesh",
      "BB": "Barbados",
      "BY": "Belarus",
      "BE": "Belgium",
      "BZ": "Belize",
      "BJ": "Benin",
      "BM": "Bermuda",
      "BT": "Bhutan",
      "BO": "Bolivia",
      "BA": "Bosnia",
      "BW": "Botswana",
      "BV": "Bouvet Island",
      "BR": "Brazil",
      "IO": "British Indian",
      "BN": "Brunei",
      "BG": "Bulgaria",
      "BF": "Burkina Faso",
      "BI": "Burundi",
      "KH": "Cambodia",
      "CM": "Cameroon",
      "CA": "Canada",
      "CV": "Cape Verde",
      "KY": "Cayman Islands",
      "CF": "Central Africa",
      "TD": "Chad",
      "CL": "Chile",
      "CN": "China",
      "CO": "Colombia",
      "KM": "Comoros",
      "CG": "Congo",
      "CD": "DR Congo",
      "CK": "Cook Islands",
      "CR": "Costa Rica",
      "CI": "CÃƒÂ´te d'Ivoire",
      "HR": "Croatia",
      "CU": "Cuba",
      "CW": "CuraÃƒÂ§ao",
      "CY": "Cyprus",
      "CZ": "Czech Republic",
      "DK": "Denmark",
      "DJ": "Djibouti",
      "DM": "Dominica",
      "DO": "DO Republic",
      "EC": "Ecuador",
      "EG": "Egypt",
      "SV": "El Salvador",
      "GQ": "Equatorial Guinea",
      "ER": "Eritrea",
      "EE": "Estonia",
      "ET": "Ethiopia",
      "FK": "Falkland Islands",
      "FO": "Faroe Islands",
      "FJ": "Fiji",
      "FI": "Finland",
      "FR": "France",
      "GF": "French Guiana",
      "PF": "French Polynesia",
      "TF": "French Southern",
      "GA": "Gabon",
      "GM": "Gambia",
      "GE": "Georgia",
      "DE": "Germany",
      "GH": "Ghana",
      "GI": "Gibraltar",
      "GR": "Greece",
      "GL": "Greenland",
      "GD": "Grenada",
      "GP": "Guadeloupe",
      "GU": "Guam",
      "GT": "Guatemala",
      "GG": "Guernsey",
      "GN": "Guinea",
      "GW": "Guinea-Bissau",
      "GY": "Guyana",
      "HT": "Haiti",
      "HM": "Heard Island",
      "VA": "Holy See",
      "HN": "Honduras",
      "HK": "Hong Kong",
      "HU": "Hungary",
      "IS": "Iceland",
      "IN": "India",
      "ID": "Indonesia",
      "IR": "Iran,",
      "IQ": "Iraq",
      "IE": "Ireland",
      "IM": "Isle of Man",
      "IT": "Italy",
      "JM": "Jamaica",
      "JP": "Japan",
      "JE": "Jersey",
      "JO": "Jordan",
      "KZ": "Kazakhstan",
      "KE": "Kenya",
      "KI": "Kiribati",
      "KP": "Korea, D",
      "KR": "Korea, R",
      "KW": "Kuwait",
      "KG": "Kyrgyzstan",
      "LA": "Lao",
      "LV": "Latvia",
      "LB": "Lebanon",
      "LS": "Lesotho",
      "LR": "Liberia",
      "LY": "Libya",
      "LI": "Liechtenstein",
      "LT": "Lithuania",
      "LU": "Luxembourg",
      "MO": "Macao",
      "MK": "Macedonia",
      "MG": "Madagascar",
      "MW": "Malawi",
      "MY": "Malaysia",
      "MV": "Maldives",
      "ML": "Mali",
      "MT": "Malta",
      "MH": "Marshall Islands",
      "MQ": "Martinique",
      "MR": "Mauritania",
      "MU": "Mauritius",
      "YT": "Mayotte",
      "MX": "Mexico",
      "FM": "Micronesia",
      "MD": "Moldova",
      "MC": "Monaco",
      "MN": "Mongolia",
      "ME": "Montenegro",
      "MS": "Montserrat",
      "MA": "Morocco",
      "MZ": "Mozambique",
      "MM": "Myanmar",
      "NA": "Namibia",
      "NR": "Nauru",
      "NP": "Nepal",
      "NL": "Netherlands",
      "NC": "New Caledonia",
      "NZ": "New Zealand",
      "NI": "Nicaragua",
      "NE": "Niger",
      "NG": "Nigeria",
      "NU": "Niue",
      "NF": "Norfolk",
      "MP": "Mariana",
      "NO": "Norway",
      "OM": "Oman",

       
      "PW": "Palau",
      "PS": "Palestin",
      "PA": "Panama",
      "PG": "Papua N Guinea",
      "PY": "Paraguay",
      "PE": "Peru",
      "PH": "Philippines",
      "PN": "Pitcairn",
      "PL": "Poland",
      "PT": "Portugal",
      "PR": "Puerto Rico",
      "QA": "Qatar",
      "RE": "RÃƒÂ©union",
      "RO": "Romania",
      "RU": "Russia",
      "RW": "Rwanda",
      "SH": "Saint Helena",
      "KN": "Saint Kitts",
      "LC": "Saint Lucia",
      "MF": "Saint Martin",
      "PM": "Saint Pierre",
      "VC": "Saint Vincent",
      "WS": "Samoa",
      "SM": "San Marino",
      "ST": "Sao Tome",
      "SA": "Saudi Arabia",
      "SN": "Senegal",
      "RS": "Serbia",
      "SC": "Seychelles",
      "SL": "Sierra Leone",
      "SG": "Singapore",
      "SX": "Sint Maarten",
      "SK": "Slovakia",
      "SI": "Slovenia",
      "SB": "Solomon Islands",
      "SO": "Somalia",
      "ZA": "South Africa",
      "GS": "South Georgia",
      "SS": "South Sudan",
      "ES": "Spain",
      "LK": "Sri Lanka",
      "SD": "Sudan",
      "SR": "Suriname",
      "SZ": "Swaziland",
      "SE": "Sweden",
      "CH": "Switzerland",
      "SY": "Syria",
      "TW": "Taiwan",
      "TJ": "Tajikistan",
      "TZ": "Tanzania",
      "TH": "Thailand",
      "TL": "Timor-Leste",
      "TG": "Togo",
      "TK": "Tokelau",
      "TO": "Tonga",
      "TT": "Trinidad & Tobago",
      "TN": "Tunisia",
      "TR": "Turkey",
      "TM": "Turkmenistan",
      "TC": "Turks & Caicos",
      "TV": "Tuvalu",
      "UG": "Uganda",
      "UA": "Ukraine",
      "AE": "UAE",
      "GB": "United Kingdom",
      "US": "United States",
      "UM": "US Minor",
      "UY": "Uruguay",
      "UZ": "Uzbekistan",
      "VU": "Vanuatu",
      "VE": "Venezuela",
      "VN": "Viet Nam",
      "VG": "Virgin, British",
      "VI": "Virgin, U.S.",
      "WF": "Wallis & Futuna",
      "EH": "Western Sahara",
      "YE": "Yemen",
      "ZM": "Zambia",
      "ZW": "Zimbabwe"

   };
   $.flagStrap = function (element, options, i) {
    var plugin = this;
    var uniqueId = generateId(8);
    plugin.countries = {};
    plugin.selected = {value: null, text: null};
    plugin.settings = {inputName: 'country-' + uniqueId};
    var $container = $(element);
    var htmlSelectId = 'flagstrap-' + uniqueId;
    var htmlSelect = '#' + htmlSelectId;
    plugin.init = function () {
            // Merge in global settings then merge in individual settings via data attributes
            plugin.countries = countries;
            // Initialize Settings, priority: defaults, init options, data attributes
            plugin.countries = countries;
            plugin.settings = $.extend({}, defaults, options, $container.data());
            if (undefined !== plugin.settings.countries) {
                plugin.countries = plugin.settings.countries;
            }
            // Build HTML Select, Construct the drop down button, Assemble the drop down list items element and insert
            $container
            .addClass('flagstrap')
            .append(buildHtmlSelect)
            .append(buildDropDownButton)
            .append(buildDropDownButtonItemList);
            // Hide the actual HTML select
            $(htmlSelect).hide();
        };
        var buildHtmlSelect = function () {
            var htmlSelectElement = $('<select/>').attr('id', htmlSelectId).attr('name', plugin.settings.inputName);
            $.each(plugin.countries, function (code, country) {
                var optionAttributes = {value: code};
                if (plugin.settings.selectedCountry !== undefined) {
                    if (plugin.settings.selectedCountry === code) {
                        optionAttributes = {value: code, selected: "selected"};
                        plugin.selected = {value: code, text: country}
                    }
                }
                htmlSelectElement.append($('<option>', optionAttributes).text(country));
            });
            return htmlSelectElement;
        };
        var buildDropDownButton = function () {
            <?php
            $country = get_country();
            ?>
            var selectedText = "{{ $country['country_name'] }}";
            var selectedValue = "{{ $country['country_code'] }}";
            selectedText = plugin.selected.text || selectedText;
            selectedValue = plugin.selected.value || selectedValue;
            var $selectedLabel = $('<i/>').addClass('flagstrap-icon flagstrap-' + selectedValue.toLowerCase()).css('margin-right', plugin.settings.labelMargin);
            var buttonLabel = $('<span/>')
            .addClass('flagstrap-selected-' + uniqueId)
            .html($selectedLabel)
                //uper wala
                .append('<span style="font-size:12px;">'+selectedValue+'</span>');
                var button = $('<button/>')
                .attr('data-toggle', 'dropdown')
                .attr('id', 'flagstrap-drop-down-' + uniqueId)
                .addClass('btn f-btn-f' + plugin.settings.buttonType + ' ' + plugin.settings.buttonSize + ' dropdown-togglee')
                .html(buttonLabel);
                $('<span/>')
                .addClass('caret')
                .css('margin-left', plugin.settings.labelMargin)
                .insertAfter(buttonLabel);
                return button;
            };
            var buildDropDownButtonItemList = function () {
                var items = $('<ul/>')
                .attr('id', 'flagstrap-drop-down-' + uniqueId + '-list')
                .attr('aria-labelled-by', 'flagstrap-drop-down-' + uniqueId)
                .addClass('dropdown-menuu');
                if (plugin.settings.scrollable) {
                    items.css('height', 'auto')
                    .css('max-height', plugin.settings.scrollableHeight)
                    .css('overflow-x', 'hidden');
                }
            // Populate the bootstrap dropdown item list
            $(htmlSelect).find('option').each(function () {
                // Get original select option values and labels
                var text = $(this).text();
                var value = $(this).val();
                // Build the flag icon
                var flagIcon = $('<i/>').addClass('flagstrap-icon flagstrap-' + value.toLowerCase()).css('margin-right', plugin.settings.labelMargin);
               // console.log(flagIcon.html);
                // Build a clickable drop down option item, insert the flag and label, attach click event
                var flagStrapItem = $('<a/>')
                .attr('data-val', $(this).val())
                .attr('data-name', text)
                .addClass('flag-options')
                .html(flagIcon)
                    //andr wala
                    .append("<span style='font-size:12px;'>"+text+"</span>")
                    .on('click', function (e) {
                        $(htmlSelect).find('option').removeAttr('selected');
                        $(htmlSelect).find('option[value="' + $(this).data('val') + '"]').attr("selected", "selected");
                        $('.flagstrap-selected-' + uniqueId).html('<i class="flagstrap-icon flagstrap-'+$(this).data('val').toLowerCase()+'" style="margin-right: 10px;"></i><span style="font-size:12px;">'+$(this).data('val')+'</span>');
                        e.preventDefault();
                    });
                // Make it a list item
                var listItem = $('<li/>').prepend(flagStrapItem);
                // Append it to the drop down item list
                items.append(listItem);
            });
            return items;
        };
        function generateId(length) {
            var chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz'.split('');
            if (!length) {
                length = Math.floor(Math.random() * chars.length);
            }
            var str = '';
            for (var i = 0; i < length; i++) {
                str += chars[Math.floor(Math.random() * chars.length)];
            }
            return str;
        }
        plugin.init();
    };
    $.fn.flagStrap = function (options) {
        return this.each(function (i) {
            if ($(this).data('flagStrap') === undefined) {
                $(this).data('flagStrap', new $.flagStrap(this, options, i));
            }
        });
    }
})(jQuery);
</script>