
document.addEventListener('deviceready', function() {
       
    Kinvey.init({
        'appKey': 'kid_eeDSAU8R6f',
        'appSecret': '04ee1d7bf8114048a7fac15f2c4188e0'
    });

    Kinvey.ping({
        success: function(response) {
            alert('Kinvey Ping Success. Kinvey Service is alive, version: ' + response.version + ', response: ' + response.kinvey);
        },
        error: function(error) {
            alert('Kinvey Ping Failed. Response: ' + error.description);
        }
    });

var user = new Kinvey.User();
user.loginWithLinkedIn({
    access_token: '<access-token>',
    access_token_secret: '<access-token-secret>',
    consumer_key: '<consumer-key>',
    consumer_secret: '<consumer-secret>'
}, { name: 'John Doe' }, {
    success: function(user) {
        // The LinkedIn account is now linked to a Kinvey.User.
        // user.getIdentity() will return the users LinkedIn identity.
    },
    error: function(e) {
        // Failed to login with LinkedIn.
        // e holds information about the nature of the error.
    }
});


}, false);
