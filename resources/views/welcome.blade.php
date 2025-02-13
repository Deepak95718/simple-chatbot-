<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chatgpt</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

<div style="max-width: 400px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 5px;">
    <h4>Deepak's Chatbot</h4>
    <div id="chatbox" style="height: 300px; overflow-y: auto; border: 1px solid #ddd; padding: 10px;"></div>
    
    <input type="text" id="userMessage" placeholder="Type your message..." 
           style="width: 100%; padding: 8px; margin-top: 10px;">
    <button onclick="sendMessage()" style="margin-top: 10px; padding: 8px;">Send</button>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function sendMessage() {
        var message = $("#userMessage").val().trim();
        if (message === '') return;

        $("#chatbox").append("<div><strong>You:</strong> " + message + "</div>");
        $("#userMessage").val('');

        $.ajax({
            url: "{{ route('chatbot.response') }}",
            type: "POST",
            data: { message: message, _token: "{{ csrf_token() }}" },
            success: function(response) {
                $("#chatbox").append("<div><strong>Bot:</strong> " + response.message + "</div>");
                $("#chatbox").scrollTop($("#chatbox")[0].scrollHeight);
            }
        });
    }
</script>


</body>
</html>
