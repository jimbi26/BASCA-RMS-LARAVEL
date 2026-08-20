<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Print Photo - A4</title>
    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            background: #fff;
        }

        @page {
            size: A4;
            margin: 0;
        }

        .a4-page {
            width: 210mm;
            height: 297mm;
            margin: 0 auto;
            page-break-after: always;
            display: flex;
            align-items: center;
            justify-content: center;
            box-sizing: border-box;
        }

        .photo {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }
    </style>
</head>

<body onload="window.print()">

    <div class="a4-page">
        <img src="{{ $photoUrl }}" alt="Senior Photo" class="photo">
    </div>

</body>

</html>
