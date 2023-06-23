import { createApp } from 'https://cdn.skypack.dev/vue@3.0.11'
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type'
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size'
import 'filepond/dist/filepond.min.css'
import 'filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.css'
import 'filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.css'

const initFilePond = () => {
    FilePond.registerPlugin(FilePondPluginFileValidateType, FilePondPluginFileValidateSize)
    const inputElement = document.querySelector('input[type="file"]')
    const pond = FilePond.create(inputElement)
}

createApp({}).directive('filepond', {
    mounted() {
        initFilePond()
    },
}).mount()
