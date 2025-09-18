<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>Laravel</title>
</head>

<body>
    <h1>Laravel User Stream Demo</h1>

    <ul id="user-list">
        <!-- Streamed users will appear here -->
    </ul>

    <script>
        const evtSource = new EventSource('/api/users-stream');

        evtSource.onmessage = (event) => {
            try {
                const user = JSON.parse(event.data);
                const li = document.createElement('li');
                li.textContent = `${user.id}: ${user.name} (${user.email})`;
                document.getElementById('user-list').appendChild(li);
            } catch (e) {
                console.error('Failed to parse user:', e, event.data);
            }
        };

        evtSource.addEventListener('end', (event) => {
            console.log('Stream finished:', event.data);
            evtSource.close();
        });

        evtSource.onerror = (err) => {
            console.error('EventSource failed:', err);
            evtSource.close();
        };
    </script>
</body>

</html>
