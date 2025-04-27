var sendBtn = document.getElementById("send-btn");
if(sendBtn){
    sendBtn.addEventListener('click', function() {
        let message = document.getElementById('chat-input').value;
        if (!message.trim()) return;

        let chatBox = document.getElementById('chat-box');

        // Display user's message
        let userMessageDiv = document.createElement('div');
        userMessageDiv.classList.add('message', 'user-message');
        userMessageDiv.innerHTML = "<strong>You:</strong> " + message;
        chatBox.appendChild(userMessageDiv);

        // Clear input field
        document.getElementById('chat-input').value = '';
        chatBox.scrollTop = chatBox.scrollHeight; // Auto-scroll to the latest message

        // Send AJAX request to Laravel backend
        fetch("/chat/send", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify({ message: message })
        })
            .then(response => response.json())
            .then(data => {
                if (data.bot_reply) {
                    let botMessageDiv = document.createElement('div');
                    botMessageDiv.classList.add('message', 'bot-message');
                    botMessageDiv.innerHTML = "<strong>AI:</strong> " + data.bot_reply;
                    chatBox.appendChild(botMessageDiv);
                    chatBox.scrollTop = chatBox.scrollHeight; // Auto-scroll
                }
            })
            .catch(error => console.error(error));
    });
}


