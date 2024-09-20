import {
    ClassicEditor,
    AccessibilityHelp,
    Autosave,
    Bold,
    Essentials,
    Italic,
    Mention,
    Paragraph,
    SelectAll,
    Undo
} from 'ckeditor5';
import { SlashCommand } from 'ckeditor5-premium-features';

const editorConfig = {
    toolbar: {
        items: [
            'undo', 'redo', '|',
            'bold', 'italic', 'underline', '|',
            'link', 'bulletedList', 'numberedList', '|',
            'imageUpload', 'blockQuote', 'insertTable', '|',
            'mediaEmbed'
        ],
        shouldNotGroupWhenFull: true
    },
    placeholder: 'Type or paste your content here!',
    plugins: [AccessibilityHelp, Autosave, Bold, Essentials, Italic, Mention, Paragraph, SelectAll, Undo],
    licenseKey: '<YOUR_LICENSE_KEY>',
};

ClassicEditor
    .create(document.querySelector('#editor'), editorConfig)
    .then(editor => {
        console.log('Editor was initialized', editor);
    })
    .catch(error => {
        console.error('There was a problem initializing the editor.', error);
    });
