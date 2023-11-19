<div>
    <div class="max-w-md mx-auto p-6 bg-white rounded-md shadow-md">
        <form wire:submit.prevent="save" enctype="multipart/form-data">
            <div class="mb-4">
                <label for="image" class="block text-sm font-medium mb-2 text-gray-600">Imagen:</label>
                <input wire:model="image" type="file" id="image" class="hidden">
                <label for="image"
                    class="cursor-pointer bg-blue-500 text-white p-2 rounded-md hover:bg-blue-600 transition duration-300 w-full">
                    {{ $image ? 'Cambiar Imagen' : 'Seleccionar Imagen' }}
                </label>
                @error('image')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            @if ($image)
                <div class="mb-4">
                    <p class="block text-sm font-medium text-gray-600">Previsualización:</p>
                    <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="mt-2 w-full object-cover rounded-md">
                </div>
            @endif

            <div class="mb-4">
                <label for="price" class="block text-sm font-medium text-gray-600">Precio Bs:</label>
                <input wire:model="price" type="number" id="price" class="mt-1 p-2 border rounded-md w-full">
                @error('price')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="eventId" class="block text-sm font-medium text-gray-600">Evento:</label>
                <select wire:model="eventId" id="eventId" class="mt-1 p-2 border rounded-md w-full">
                    <option value="">Seleccione un evento</option>
                    @foreach ($events as $event)
                        <option value="{{ $event->id }}">{{ $event->nombre }}</option>
                    @endforeach
                </select>
                @error('eventId')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit"
                class="bg-green-500 text-white p-2 rounded-md hover:bg-green-600 transition duration-300 w-full">
                Subir Foto
            </button>
        </form>

        @if (session()->has('message'))
            <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-md relative">
                <span class="block sm:inline">{{ session('message') }}</span>
                <button wire:click="$set('message', null)" class="absolute top-0 right-0 p-2">
                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
        @endif
    </div>
    <button hidden id="btnNotificaciones" class="">
        <i class="fa-solid fa-bell"></i> Notificar </button>

        <script src="{{ asset('js/face-api.min.js') }}" type="text/javascript"></script>
        <script>
            Livewire.on('face-api', (usuarios) => {
    
                console.log(usuarios);
                const imageUpload = document.getElementById('image')
                const btnNotificaciones = document.getElementById('btnNotificaciones')
    
    
                //cargo los modelos de FACEAPI cuanndo la funcion start comience
                Promise.all([
                    faceapi.nets.faceRecognitionNet.loadFromUri('/models'),
                    faceapi.nets.faceLandmark68Net.loadFromUri('/models'),
                    faceapi.nets.ssdMobilenetv1.loadFromUri('/models')
                ]).then(start)
    
                function loadLabeledImages() {
                    //nombre de las carpetas(usuarios)
                    const labels = usuarios.flat();
                    //const labels = usuarios;
                     console.log(labels);
                    return Promise.all(
                        labels.map(async label => {
                            const descriptions = [];
                            for (let i = 1; i <= 3; i++) {
                                console.log(label);
                                const img = await faceapi.fetchImage(`/storage/perfil/${label}/${i}.jpg`);
                                const detections = await faceapi.detectSingleFace(img).withFaceLandmarks()
                                    .withFaceDescriptor();
                                descriptions.push(detections.descriptor);
                                //console.log(label, descriptions)
                            }
    
                            return new faceapi.LabeledFaceDescriptors(label, descriptions);
                        })
                    )
                }
    
    
    
                async function start() {
    
                    //obtengo los nombres de las caras de las imagenes del servidor
                    const labeledFaceDescriptors = await loadLabeledImages();
                    console.log(labeledFaceDescriptors);
                    //console.log(labeledFaceDescriptors)
    
                    //que tenga una presicion arriba de 60%
                    const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors, 0.6);
                    console.log(faceMatcher);
    
                    console.log('Listo');
                    btnNotificaciones.addEventListener('click', async () => {
    
                        //obtengo la imagen subida en el input
                        resultados = [];
                        for (i = 0; i < imageUpload.files.length; i++) {
                            image = await faceapi.bufferToImage(imageUpload.files[i]);
                            const displaySize = {
                                width: image.width,
                                height: image.height
                            };
                            //detecta todas las caras de la imagagen del input
                            const detections = await faceapi.detectAllFaces(image).withFaceLandmarks()
                                .withFaceDescriptors();
    
                            const resizedDetections = faceapi.resizeResults(detections, displaySize);
    
                            //las coincidencias
                            const results = resizedDetections.map(d => faceMatcher.findBestMatch(d
                                .descriptor));
    
                            resultados.push(results);
                        }
                        console.log(resultados);
                        idusuarios = []
                        for (i = 0; i < resultados.length; i++) {
                            let result = resultados[i];
                            for (j = 0; j < result.length; j++) {
                                //console.log(result[j].label)
                                idusuarios.push(result[j].label);
                            };
                        }
                        console.log(idusuarios);
                        Livewire.dispatch('notiAparecesFoto', idusuarios);
                    })
                    btnNotificaciones.click()
    
                }
            });
        </script>
   

</div>
