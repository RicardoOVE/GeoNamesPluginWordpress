jQuery(document).ready(function($) {
    
    var username = 'ricardoortizv';

    // Fetch all countries from GeoNames API
    $.ajax({
        url: 'http://api.geonames.org/countryInfoJSON',
        type: 'GET',
        dataType: 'json',
        data: {
            formatted: true,
            lang: 'en',
            username: username
        },
        success: function(data) {
            if (data && data.geonames) {
                var countries = data.geonames;
                var countryDropdown = $('#countryDropdown');
                
                countries.forEach(function(country) {
                    countryDropdown.append($('<option>', {
                        value: country.countryCode,
                        text: country.countryName
                    }));
                });
            }
        },
        error: function(error) {
            console.error('Error fetching countries:', error);
        }
    });

    // Handle city selection based on the selected country
    $('#countryDropdown').on('change', function() {
        var selectedCountryCode = $(this).val();
        var cityDropdown = $('#cityDropdown');
        cityDropdown.empty();

        // Fetch cities for the selected country from GeoNames API
        $.ajax({
            url: 'http://api.geonames.org/searchJSON',
            type: 'GET',
            dataType: 'json',
            data: {
                formatted: true,
                lang: 'en',
                username: username,
                country: selectedCountryCode,
                featureClass: 'P',
                maxRows: 1000
            },
            success: function(data) {
                if (data && data.geonames) {
                    var cities = data.geonames;

                    cities.forEach(function(city) {
                        cityDropdown.append($('<option>', {
                            value: city.name,
                            text: city.name
                        }));
                    });
                }
            },
            error: function(error) {
                console.error('Error fetching cities:', error);
            }
        });
    });
});