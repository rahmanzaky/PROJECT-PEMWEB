function showPopup(message, type = 'success') {
    const popup = document.createElement('div');
    popup.id = 'dynamicPopup';
    popup.style.position = 'fixed';
    popup.style.top = '20px';
    popup.style.left = '50%';
    popup.style.transform = 'translateX(-50%)';
    popup.style.padding = '16px 20px';
    popup.style.borderRadius = '8px';
    popup.style.zIndex = '1001';
    popup.style.boxShadow = '0 4px 15px rgba(0,0,0,0.2)';
    popup.style.fontSize = '16px';
    popup.style.textAlign = 'center';
    popup.style.color = 'white';
    popup.style.backgroundColor = type === 'success' ? '#28a745' : '#dc3545';
    
    const messageSpan = document.createElement('span');
    messageSpan.textContent = message;
    messageSpan.style.marginRight = '20px';

    const closeButton = document.createElement('button');
    closeButton.innerHTML = '&times;';
    closeButton.style.background = 'none';
    closeButton.style.border = 'none';
    closeButton.style.color = 'white';
    closeButton.style.fontWeight = 'bold';
    closeButton.style.fontSize = '22px';
    closeButton.style.lineHeight = '1';
    closeButton.style.cursor = 'pointer';
    closeButton.style.verticalAlign = 'middle';
    closeButton.onclick = () => {
        popup.remove();
    };

    popup.appendChild(messageSpan);
    popup.appendChild(closeButton);
    
    document.body.appendChild(popup);

    setTimeout(() => {
        if (document.body.contains(popup)) {
            popup.remove();
        }
    }, 5000);
} 