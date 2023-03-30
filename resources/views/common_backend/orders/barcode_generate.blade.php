<html>
    <head>
        <style>
            @media print {
                .sticker {
                    width: 80mm;
                    height: 40mm;
                    padding: 5mm;
                    margin: 0;
                }
            }
        </style>
    </head>
    <body onload="window.print();">
        <div class="sticker">
            <div>
                <img src="{{ $barcodeUrl }}" />
                <p>{{ $data->name }}</p>
            </div>
        </div>
    </body>
</html>
