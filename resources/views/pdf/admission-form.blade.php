<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    @include('pdf.admission-form-style')
</head>

<body>
    @include('pdf.admission-form-content', ['app' => $app])
</body>

</html>
