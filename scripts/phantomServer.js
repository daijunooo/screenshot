var webserver = require('webserver');
var server = webserver.create();
var webpage = require('webpage');

var service = server.listen(8181, function (request, response) {

    var page = webpage.create(), address;

    page.settings.resourceTimeout = 5000;

    page.settings.javascriptEnabled = false;

    page.viewportSize = {width: 750, height: 1334};

    address = request.url.substr(4);

    page.open(address, function (status) {
        if (status !== 'success') {
            console.log('Unable to load the address!');
            response.write(0);
        } else {
            console.log(address);
            response.write(page.renderBase64('PNG'));
        }
        response.close();
        page.close();
    });

});