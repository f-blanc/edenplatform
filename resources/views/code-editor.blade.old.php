<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $exercise->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/codemirror.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/theme/material.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/addon/hint/show-hint.min.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/codemirror.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/xml/xml.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/mode/htmlmixed/htmlmixed.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/addon/hint/show-hint.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/addon/hint/xml-hint.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.65.5/addon/hint/html-hint.min.js"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4 md:flex h-screen">
        <div class="w-full md:w-1/2 md:pr-2 h-4/5">
            <h1 class="text-2xl mb-4">{{ $exercise->title }}</h1>
            <p class="mb-4">{{ $exercise->directive }}</p>
            <textarea id="code" name="code" class="w-full h-96 md:h-full">{{ $exercise->initial_code }}</textarea>
        </div>
        <div class="w-full md:w-1/2 md:pl-2 mt-4 md:mt-0 h-4/5">
            <iframe id="result" class="w-full h-96 md:h-full border-2 border-gray-300"></iframe>
        </div>
    </div>
    <div class="text-center mt-4">
        <button id="submitBtn" class="bg-blue-500 text-white px-4 py-2 rounded">Soumettre</button>
    </div>

    <script>
        var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
            mode: "htmlmixed",
            lineNumbers: true,
            theme: "material",
            extraKeys: { "Ctrl-Space": "autocomplete" }
        });

        function updateResult() {
            var iframe = document.getElementById("result");
            var iframeDoc = iframe.contentDocument || iframe.contentWindow.document;
            iframeDoc.open();
            iframeDoc.write(editor.getValue());
            iframeDoc.close();
        }

        editor.on("change", updateResult);
        updateResult();

        document.getElementById('submitBtn').addEventListener('click', function() {
            fetch('/exercise/submit', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ code: editor.getValue() })
            })
            .then(response => response.json())
            .then(data => alert(data.message));
        });
    </script>
</body>
</html>
