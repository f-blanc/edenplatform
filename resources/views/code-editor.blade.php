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
    <header class="text-gray-600 body-font">
        <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
          <a class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full" viewBox="0 0 24 24">
              <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
            </svg>
            <span class="mx-3 text-xl dark:text-white">EdenSchool</span>
          </a>
          <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
            <a href="{{ route('courses.index') }}" class="mr-5 hover:text-gray-900">Cours</a>
            <a href="{{ route('filament.admin.pages.dashboard') }}" class="mr-5 hover:text-gray-900">Admin</a>
            <a class="mr-5 hover:text-gray-900">À propos</a>
          </nav>

        </div>
      </header>
    <div class="container mx-auto p-4 md:flex h-screen">
        
        <div class="w-full md:w-1/2 md:pr-2 h-4/5">
            <h1 class="text-2xl mb-4">{{ $exercise->title }}</h1>
            <p class="mb-4">{{ $exercise->directive }}</p>
            <textarea id="code" name="code" class="w-full h-96 md:h-full">{{ $exercise->initial_code }}</textarea>
            {{-- <input type="hidden" id="exercise_id" value="{{ $exercise->id }}"> --}}
            <input type="hidden" id="course" value="{{ $course }}">
            <input type="hidden" id="chapter" value="{{ $chapter }}">
            <input type="hidden" id="lesson" value="{{ $lesson }}">
            <input type="hidden" id="exercise" value="{{ $exercise->id }}">
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
            extraKeys: {
                "Ctrl-Space": "autocomplete"
            }
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
            var course = document.getElementById('course').value;
            var chapter = document.getElementById('chapter').value;
            var lesson = document.getElementById('lesson').value;
            var exerciseId = document.getElementById('exercise').value;
            fetch('/courses/' + course + '/chapter/' + chapter + '/lesson/' + lesson + '/exercise/' + exerciseId + '/submit', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        exercise_id: exerciseId,
                        code: editor.getValue()
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        window.location.href = '/courses/' + course ; 
                    } else {
                        alert(data.message);
                    }
                });
        });
    </script>
</body>

</html>
