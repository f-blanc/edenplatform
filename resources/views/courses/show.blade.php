<x-guest-layout>

    <section class="text-gray-600 body-font">
        <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
          <div class="lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
            <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">{{ $course->title }}
            </h1>
            <p class="mb-8 leading-relaxed">{{ $course->description }}</p>
            {{-- <div class="flex justify-center">
              <button class="inline-flex text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">Button</button>
              <button class="ml-4 inline-flex text-gray-700 bg-gray-100 border-0 py-2 px-6 focus:outline-none hover:bg-gray-200 rounded text-lg">Button</button>
            </div> --}}
          </div>
          <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6">
            <img class="object-cover object-center rounded" alt="hero" src="https://dummyimage.com/720x600">
          </div>
        </div>
      </section>

    <div class=" mx-auto p-4">
        <div class="bg-white shadow rounded mb-6">
            {{-- <div class="p-4">
                <h2 class="text-xl font-semibold mb-2">{{ $course->title }}</h2>
                <p class="text-gray-600">{{ $course->description }}</p>
            </div> --}}
            <div class="p-4">
                @foreach($course->chapters as $chapter)
                <div class="mb-4">
                    <div class="bg-gray-200 px-4 py-2 text-gray-800">
                        <h3 class="text-lg font-medium">{{ $chapter->title }}</h3>
                        <p class="text-gray-600">{{ $chapter->description }}</p>
                    </div>
                    <div class="mt-2 ml-4">
                        <ul>
                            @foreach($chapter->lessons as $lesson)
                            <li class="mb-2">
                                <div x-data="{ open: false }" class="mt-1 ml-4">
                                <button @click="open = !open" class="w-full text-left px-4 py-2 bg-gray-400 text-gray-900">
                                        <div class="bg-gray-300 px-4 py-2 text-gray-800">
                                            <h4 class="text-md font-medium">{{ $lesson->title }}</h4>
                                            <p class="text-gray-600">{{ $lesson->description }}</p>
                                        </div>
                                </button>
                                    {{-- <button @click="open = !open" class="w-full text-left px-4 py-2 bg-gray-400 text-gray-900">
                                        Voir les exercices
                                    </button> --}}
                                    <div x-show="open" class="mt-2">
                                        <ul>
                                            @foreach($lesson->exercises as $exercise)
                                            <li class="px-4 py-2 bg-gray-500 text-white">
                                                <a href="{{ route('exercises.show', [$course->slug, $chapter->slug, $lesson->slug, $exercise->id]) }}">
                                                    {{ $exercise->title }}
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</x-guest-layout>