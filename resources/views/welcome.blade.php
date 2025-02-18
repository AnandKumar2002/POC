<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GrapesJS</title>
    <link rel="stylesheet" href="//unpkg.com/grapesjs/dist/css/grapes.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css">

    <style>
        body {
            margin: 0;
        }
    </style>
</head>

<body>
    <div id="gjs"></div>
    <script src="//unpkg.com/grapesjs"></script>
    <script src="https://unpkg.com/grapesjs-tailwind"></script>
    <script src="https://unpkg.com/grapesjs-blocks-bootstrap4"></script>

    <script src="https://unpkg.com/grapesjs-plugin-export"></script>
    <script src="https://unpkg.com/grapesjs-preset-webpage"></script>
    <script src="https://unpkg.com/grapesjs-custom-code"></script>
    <script src="https://unpkg.com/grapesjs-navbar"></script>
    <script src="https://unpkg.com/grapesjs-blocks-flexbox"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const editor = grapesjs.init({
                container: '#gjs',
                height: '100vh',
                storageManager: false,
                plugins: [
                    'grapesjs-blocks-bootstrap4',
                    'grapesjs-tailwind',
                    'grapesjs-plugin-export',
                    'grapesjs-preset-webpage',
                    'grapesjs-custom-code',
                    'grapesjs-navbar',
                    'grapesjs-blocks-flexbox'
                ],
                // storageManager: {
                //     type: 'local',
                //     autosave: true,
                //     autoload: true,
                //     stepsBeforeSave: 1,
                // }
            });
        });
    </script>
</body>

</html>
