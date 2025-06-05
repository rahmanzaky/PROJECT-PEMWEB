document.addEventListener('DOMContentLoaded', function() {
    const popup = document.getElementById('successPopup');
    const popupMessageSpan = document.getElementById('popupMessage');

    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');

    let message = '';

    if (status === 'speaker_signup_success') {
        message = 'Congratulations! You are now signed up as a speaker.';
    } else if (status === 'joined') {
        message = 'Successfully joined the event!';
    } else if (status === 'event_created') {
        message = 'Event created successfully!';
    }

    if (message && popup && popupMessageSpan) {
        popupMessageSpan.textContent = message;
        popup.style.display = 'block';

        setTimeout(function() {
            if (popup) {
                popup.style.display = 'none';
            }
        }, 2000);
    }
});

