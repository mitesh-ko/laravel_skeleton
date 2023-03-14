<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
    </head>
    <body>
    <form id="timezone-form" method="post" action="/">
        @csrf
        <input type="hidden" id="timezone" name="timezone">
    </form>
    <script>
        document.body.style.backgroundColor = localStorage.getItem('templateCustomizer-vertical-menu-template-starter--Style') === 'dark' ?
            '#2f3349' : '#ffffff';
        document.getElementById('timezone').value = Intl.DateTimeFormat().resolvedOptions().timeZone;
        document.getElementById('timezone-form').submit();

    </script>
    </body>
</html>
